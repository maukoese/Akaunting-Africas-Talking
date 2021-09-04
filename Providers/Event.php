<?php

namespace Modules\AfricasTalking\Providers;

use App\Events\Install\UpdateFinished;
use App\Events\Menu\AdminCreated;
use App\Events\Module\Installed;
use Illuminate\Foundation\Events\LocaleUpdated;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as Provider;
use Illuminate\Notifications\Events\NotificationSent;
use Modules\AfricasTalking\Events\CheckedSmsStatus;
use Modules\AfricasTalking\Events\SmsSent;
use Modules\AfricasTalking\Listeners\ForgetBalanceValue;
use Modules\AfricasTalking\Listeners\Menu\Admin;
use Modules\AfricasTalking\Listeners\Module\Installed as ModuleInstalled;
use Modules\AfricasTalking\Listeners\SendSmsWithInvoice;
use Modules\AfricasTalking\Listeners\SmsLog;
use Modules\AfricasTalking\Listeners\Update\V10\Version100;

class Event extends Provider
{
    /**
     * The event listener mappings for the module.
     *
     * @var array
     */
    protected $listen = [
        UpdateFinished::class   => [
            Version100::class,
        ],
        Installed::class        => [ModuleInstalled::class],
        AdminCreated::class     => [Admin::class],
        SmsSent::class          => [SmsLog::class, ForgetBalanceValue::class],
        LocaleUpdated::class    => [ForgetBalanceValue::class],
        CheckedSmsStatus::class => [ForgetBalanceValue::class],
        NotificationSent::class => [SendSmsWithInvoice::class],
    ];
}
