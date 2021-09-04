<?php

namespace Modules\AfricasTalking\Services\Contracts;


interface ResponseMessage extends \JsonSerializable
{
    public function message();

    public function content();

    public function fail();

    public function success();

    public function processId();

    public function __toString();

}
