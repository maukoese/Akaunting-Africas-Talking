<?php

namespace Modules\AfricasTalking\Events;

use Illuminate\Queue\SerializesModels;
use Modules\AfricasTalking\Services\Contracts\ResponseMessage;

class SmsSent
{
    use SerializesModels;

    /**
     * @var ResponseMessage
     */
    public $response;
    /**
     * @var string
     */
    public $phone;
    /**
     * @var string
     */
    public $message;
    /**
     * @var string|null
     */
    public $status;

    /**
     * Create a new event instance.
     *
     * @param ResponseMessage $response
     * @param $phone
     * @param $message
     * @param string $status
     */
    public function __construct($response, $phone, $message,$status = null)
    {
        $this->response = $response;
        $this->phone = $phone;
        $this->message = $message;
        $this->status = $status;
    }
}
