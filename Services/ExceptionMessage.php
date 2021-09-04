<?php

namespace Modules\AfricasTalking\Services;

use Modules\AfricasTalking\Services\Contracts\ResponseMessage;

class ExceptionMessage implements ResponseMessage
{
    /**
     * The message keys for translation
     *
     * @var array
     */
    const TRANSLATION_KEYS = [
        "1" => "throttled",
        "2" => "missing_parameters",
        "4" => "invalid_credentials",
        "6" => "unroutable",
        "8" => "partner_account_barred",
        "9" => "partner_quota_violation",
        "15" => "invalid_sender",
        "29" => "non_white_list",
    ];


    /**
     * @var \Exception
     */
    public $exception;


    /**
     * The handle exception message for user read the message
     * .
     * @param \Exception $exception
     */
    public function __construct(\Exception $exception)
    {
        $this->exception = $exception;
    }

    /**
     * @return array|\Illuminate\Contracts\Translation\Translator|string|null
     */
    public function message()
    {
        if (array_key_exists($key = (string)$this->exception->getCode(), self::TRANSLATION_KEYS)) {
            return trans('africas-talking::responses.' . self::TRANSLATION_KEYS[$key]);
        }

        return $this->exception->getMessage();
    }

    /**
     * @return bool
     */
    public function fail()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function success()
    {
        return false;
    }

    /**
     * @return string|null
     */
    public function __toString()
    {
        return $this->message();
    }

    /**
     * @return string
     */
    public function jsonSerialize()
    {
        return $this->message();
    }

    public function content()
    {
        return $this->message();
    }

    public function processId()
    {
        // TODO: Implement processId() method.
    }
}
