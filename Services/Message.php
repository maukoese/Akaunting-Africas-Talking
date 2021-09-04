<?php

namespace Modules\AfricasTalking\Services;

use AfricasTalking\SDK\AfricasTalking;
use AfricasTalking\SDK\SMS;
use Modules\AfricasTalking\Override\Phone\PhoneNumber;

class Message
{

    /**
     * @var
     */
    protected $to;
    /**
     * @var
     */
    protected $text;

    /**
     * @var string
     */
    protected $type = 'unicode';

    /**
     * @var SMS
     */
    protected SMS $sms;
    /**
     * @var string
     */
    public $from;
    /**
     * @var string
     */
    public $country;

    public function __construct(AfricasTalking $client, $from, $country)
    {
        $this->sms     = $client->sms();
        $this->from    = $from;
        $this->country = $country;
    }

    /**
     * @param $phone
     * @return $this
     */
    public function to($phone)
    {
        try {
            $this->to = PhoneNumber::make($phone, $this->country)->formatE164();
        } catch (\Exception $exception) {
            $this->to = $phone;
        }

        $this->to = str_replace(' ', '', $this->to);

        return $this;
    }

    /**
     * @param $message
     * @return $this
     */
    public function text($message)
    {
        $this->text = $message;

        return $this;
    }

    /**
     * @return ExceptionMessage|ResponseMessage
     */
    public function send()
    {
        try {
            return $this->sms->send([
                'to'      => $this->to,
                'from'    => $this->from,
                'message' => $this->text,
                'type'    => $this->type,
            ]);
        } catch (\Exception $exception) {
            return new ExceptionMessage($exception);
        }
    }
}
