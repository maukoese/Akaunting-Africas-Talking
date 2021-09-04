<?php

namespace Modules\AfricasTalking\Listeners\Menu;

use App\Events\Menu\AdminCreated as Event;
use App\Traits\Modules;

class Admin
{
    use Modules;

    /**
     * Handle the event.
     *
     * @param Event $event
     *
     * @return void
     */
    public function handle(Event $event)
    {
        if (false === $this->moduleIsEnabled('africas-talking')) {
            return;
        }

        $user = auth()->user();

        if (false === $user->can(['read-africas-talking-logs']) && false === $user->can(['read-africas-talking-send-sms'])) {
            return;
        }

        $event->menu->dropdown(
            'Africa\'s Talking',
            function ($sub) use ($user) {
                if ($user->can(['read-africas-talking-logs'])) {
                    $sub->route('africas-talking.logs', trans('africas-talking::general.logs'));
                }

                if ($user->can(['read-africas-talking-send-sms'])) {
                    $sub->route('africas-talking.send.index', trans('general.send'));
                }
            },
            55,
            ['icon' => 'fa fa-mobile-alt']
        );
    }
}
