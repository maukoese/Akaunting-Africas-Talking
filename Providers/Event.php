<?php

namespace Modules\AfricasTalking\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as Provider;
use Modules\AfricasTalking\Listeners\InstallModule;

class Event extends Provider
{
    /**
     * The event listener mappings for the module.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\Module\Installed::class => [
            InstallModule::class,
        ],
    ];
}
