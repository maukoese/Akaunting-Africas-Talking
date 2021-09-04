<?php

namespace Modules\AfricasTalking\Services;


use Illuminate\Support\Arr;
use Modules\AfricasTalking\Services\Contracts\Status as SmsStatus;

class Status implements SmsStatus
{


    /**
     * @var mixed;
     */
    public $status;
    /**
     * @var string|int
     */
    public $id;


    public function __construct($client, $id)
    {
        $this->status = $client->message()->search($id);
    }

    /**
     * Get the total balance
     *
     * @return string
     */
    public function get()
    {

        return $this->africasTalkingStatus(
            ($status = $this->status->getFinalStatus())
                ? $status
                : 'undefined'
        );
    }


    public function africasTalkingStatus($index)
    {
        return Arr::get($this->africasTalkingStatuses(), $index);
    }

    protected function africasTalkingStatuses()
    {
        return [
            'DELIVRD' => self::SENT,
            'EXPIRED' => self::CANCELED,
            'UNDELIV' => self::ERROR,
            'REJECTD' => self::SPAM,
            'UNKNOWN' => self::UNKNOWN,
            'unknown' => self::UNKNOWN
        ];
    }
}
