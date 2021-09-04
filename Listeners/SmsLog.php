<?php

namespace Modules\AfricasTalking\Listeners;

use Modules\AfricasTalking\Events\SmsSent;
use Modules\AfricasTalking\Models\SmsLog as Model;
use Modules\AfricasTalking\Services\Contracts\Status;

class SmsLog
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param SmsSent $event
     * @return void
     */
    public function handle(SmsSent $event)
    {
        Model::create([
            'company_id' => company_id(),
            'user_id'    => auth()->id(),
            'process_id' => $event->response->processId(),
            'contact_id' => request()->get('contact_id'),
            'phone'      => $event->phone,
            'message'    => $event->message,
            'status'     => $event->status ?: Status::UNKNOWN,
        ]);
    }
}
