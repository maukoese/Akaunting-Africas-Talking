<?php

namespace Modules\AfricasTalking\Http\Controllers;

use App\Models\Common\Contact;
use Illuminate\Routing\Controller;
use Modules\AfricasTalking\Events\CheckedSmsStatus;
use Modules\AfricasTalking\Facades\AfricasTalking;
use Modules\AfricasTalking\Models\SmsLog;
use Modules\AfricasTalking\Services\AfricasTalkingHelper;

class Log extends Controller
{
    public function __invoke()
    {
        config()->set('columnsortable.default_direction', 'desc');

        $logs = SmsLog::collect('created_at');

        $customers = collect(Contact::customer()->enabled()->orderBy('name')->pluck('name', 'id'));

        $statuses = AfricasTalkingHelper::statuses();

        return view('africas-talking::logs.index', get_defined_vars());
    }

    public function checkStatus(SmsLog $log)
    {
        try {
            $status = AfricasTalking::getStatus($log->process_id);
        } catch (\Exception $e) {
            flash($e->getMessage())->error();

            return redirect()->route('africas-talking.logs');
        }

        if ($status === null) {
            return redirect()->route('africas-talking.logs');
        }

        $log->update(['status' => $status]);

        event(new CheckedSmsStatus($log));

        return redirect()->route('africas-talking.logs');
    }
}
