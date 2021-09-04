<?php

namespace Modules\AfricasTalking\Events;

use Illuminate\Queue\SerializesModels;
use Modules\AfricasTalking\Models\SmsLog;

class CheckedSmsStatus
{
    use SerializesModels;

    /**
     * @var SmsLog
     */
    public $log;


    /**
     * Create a new event instance.
     *
     * @param SmsLog $log
     */
    public function __construct($log)
    {
        $this->log = $log;
    }
}
