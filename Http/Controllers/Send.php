<?php

namespace Modules\AfricasTalking\Http\Controllers;

use Akaunting\Language\Language;
use App\Models\Common\Contact;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Modules\AfricasTalking\Events\SmsSent;
use Modules\AfricasTalking\Facades\AfricasTalking;

class Send extends Controller
{
    use ValidatesRequests;


    public function __invoke()
    {
        if (null === setting('africas-talking.key')) {
            flash(__('africas-talking::general.configure_settings'))->error();
            return redirect(company()->id . '/africas-talking/settings');
        }

        $showBalance = (bool)setting('africas-talking.show_balance');

        $customers = Contact::customer()->enabled()->orderBy('name')->whereNotNull('phone')->pluck('name', 'id');

        try {
            $balance = '';
            if ($showBalance) {
                $balance = Cache::remember(
                    'africas_talking_balance',
                    120,
                    function () {
                        return AfricasTalking::getBalance();
                    }
                );
            }
        } catch (\Exception $e) {
            flash($e->getMessage())->error();
        }


        return view('africas-talking::send.show', compact('showBalance', 'balance', 'customers'));
    }

    public function handle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required'
        ]);

        $validator->sometimes('contact_id', 'required', function ($data) {
            return false === isset($data->phone);
        });

        $validator->sometimes('phone', 'required|phone', function ($data) {
            return false === isset($data->contact_id);
        });

        $this->validateWith($validator, $request);

        $phones = array($request->get('phone'));
        if (null !== $request->get('contact_id')) {
            foreach ($request->get('contact_id') as $user_id) {
                $phones[] = Contact::findOrFail($user_id)->phone;
            }
        }

        $response = AfricasTalking::send(
            $phones,
            $message = $request->get('message'),
            Str::upper($request->get('phone_country'))
        );

        if ($response->success()) {
            foreach ($phones as $phone) {
                event(new SmsSent($response, $phone, $message));
            }

            flash()->success($response->message());

            return response()->json(
                [
                    'redirect' => route('africas-talking.send.index'),
                    'success'  => true,
                    'error'    => false,
                    'data'     => null,
                    'message'  => $response->message(),
                ]
            );
        }

        flash()->error($response->message())->important();


        return response()->json(
            [
                'redirect' => route('africas-talking.send.index'),
                'success'  => false,
                'error'    => true,
                'data'     => null,
                'message'  => $response->message(),
            ]
        );
    }
}
