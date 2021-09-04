<?php

namespace Modules\AfricasTalking\Facades;

use Illuminate\Support\Facades\Facade;

class AfricasTalking extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Modules\AfricasTalking\Services\AfricasTalking::class;
    }
}
