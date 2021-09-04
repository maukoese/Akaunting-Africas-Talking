<?php

namespace Modules\AfricasTalking\Services;

use Modules\AfricasTalking\Services\Contracts\ResponseMessage as ResponseMessageContract;
use AfricasTalking\Message\Message as AfricasTalkingMessage;

class ResponseMessage implements ResponseMessageContract
{
    /**
     * The success code by given the africas-talking api
     *
     * @var array
     */
    const SUCCESS_CODES = [
        "00",
        "01",
        "02",
    ];

    /**
     * The message keys for translation
     *
     * @var array
     */
    const TRANSLATION_KEYS = [
        "0" => "success_send",
    ];

    /**
     * The message content
     *
     * @var AfricasTalkingMessage
     */
    protected $message;

    /**
     * @param AfricasTalkingMessage $message
     */
    public function __construct(AfricasTalkingMessage $message)
    {
        $this->message = $message;
    }

    /**
     * @return array|\Illuminate\Contracts\Translation\Translator|string|null
     */
    public function message()
    {
        if (array_key_exists($key = (string)$this->message->getStatus(), self::TRANSLATION_KEYS)) {
            return trans('africas-talking::responses.' . self::TRANSLATION_KEYS[$key]);
        }

        return $this->content();
    }

    /**
     * @return bool
     */
    public function fail()
    {
        return in_array($this->message, self::SUCCESS_CODES);
    }

    /**
     * @return bool
     */
    public function success()
    {
        return !$this->fail();
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
        return $this->message->getBody();
    }

    public function processId()
    {
        if ($this->fail()) {
            return null;
        }

        return $this->message->getMessageId();
    }
}
