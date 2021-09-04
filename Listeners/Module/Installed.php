<?php

namespace Modules\AfricasTalking\Listeners\Module;

use App\Events\Module\Installed as Event;
use Illuminate\Support\Facades\Artisan;
use Modules\AfricasTalking\Database\Seeds\Install;

class Installed
{
    public $alias = 'africas-talking';

    /**
     * Handle the event.
     *
     * @param Event $event
     *
     * @return void
     */
    public function handle(Event $event): void
    {
        if ($event->alias !== $this->alias) {
            return;
        }

        $this->callSeeds();
    }

    protected function callSeeds()
    {
        Artisan::call(
            'company:seed',
            [
                'company' => company_id(),
                '--class' => Install::class,
            ]
        );
    }
}
