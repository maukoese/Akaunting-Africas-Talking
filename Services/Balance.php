<?php

namespace Modules\AfricasTalking\Services;


use Illuminate\Support\Str;
use AfricasTalking\SDK\AfricasTalking;

/**
 * Class Balance
 * @package Modules\AfricasTalking\Services
 */
class Balance
{
    /**
     * @var mixed;
     */
    public $balance;


    public function __construct(AfricasTalking $client)
    {
        $this->balance = 0;
        // $client->account()->getBalance();
    }

    /**
     * Get the total balance
     *
     * @return string
     */
    public function get()
    {
        try {
            return isset($this->balance->data['balance'])
                ? $this->currencyString($this->balance->data['balance'])
                : $this->currencyString(0);

        } catch (\Exception $exception) {

            return $this->currencyString(0);
        }
    }

    /**
     * Parse to euro currency
     *
     * @param $balance
     * @return string
     */
    protected function currencyString($balance)
    {

        return number_format($balance, 2). ' units';
    }
}
