<?php

namespace Modules\AfricasTalking\Services;


use AfricasTalking\Client;
use AfricasTalking\Client\Credentials\Basic;
use AfricasTalking\SDK\AfricasTalking;

class AfricasTalkingService
{

    /**
     * @var Client
     */
    public $client;
    /**
     * @var string
     */
    public $from;


    /**
     * AfricasTalkingService constructor.
     * @param $key
     * @param $username
     * @param $from
     */
    public function __construct($key, $username, $from)
    {
        $this->client = new AfricasTalking(
            $username, $key
        );

        $this->from = $from;
    }

    /**
     * @param null $country
     * @return Message
     */
    public function message($country = null)
    {
        return new Message($this->client, $this->from, $country);
    }

    public function balance()
    {
        return (new Balance($this->client))->get();
    }

    public function status($id)
    {
        return (new Status($this->client, $id))->get();
    }


}
