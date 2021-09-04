<?php

namespace Modules\AfricasTalking\Listeners;

use Illuminate\Foundation\Events\LocaleUpdated;
use Illuminate\Support\Facades\Cache;

class ForgetBalanceValue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param LocaleUpdated $event
     * @return void
     */
    public function handle($event)
    {
        Cache::forget('africas_talking_balance');
    }
}
