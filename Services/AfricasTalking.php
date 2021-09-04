<?php

namespace Modules\AfricasTalking\Services;

use Modules\AfricasTalking\Services\AfricasTalkingService;

class AfricasTalking
{
    /**
     * @var AfricasTalkingService
     */
    protected $service;
    /**
     * @var string
     */
    protected $from;

    public function __construct($key, $username, $from)
    {
        $this->service = new AfricasTalkingService($key, $username, $from);

        $this->from = $from;
    }

    /**
     * Get of the current operator balance
     *
     * @return mixed
     */
    public function getBalance()
    {
        return $this->service->balance();
    }

    /**
     * Send the message to phone
     *
     * @param $phone
     * @param $message
     *
     * @param null $country
     * @return \Modules\AfricasTalking\Services\ExceptionMessage|\Modules\AfricasTalking\Services\ResponseMessage
     */
    public function send($phone, $message,$country = null)
    {
        return $this->service->message($country)->to($phone)->text($message)->send();
    }


    /**
     * Get of the current operator status
     *
     * @param string|int $id
     *
     * @return mixed
     */
    public function getStatus($id)
    {
        return $this->service->status($id);
    }

    /**
     * Get of the current operator sender name
     *
     * @return string
     */
    public function from()
    {
        return $this->from;
    }

}
