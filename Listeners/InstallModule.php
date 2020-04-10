<?php

namespace Modules\AfricasTalking\Listeners;

use App\Events\Module\Installed as Event;
use App\Traits\Permissions;

class InstallModule
{
    use Permissions;

    public $alias = 'africas-talking';

    /**
     * Handle the event.
     *
     * @param  Event $event
     * @return void
     */
    public function handle(Event $event)
    {
        if ($event->alias != $this->alias) {
            return;
        }

        $this->updatePermissions();
    }

    protected function updatePermissions()
    {
        // c=create, r=read, u=update, d=delete
        $this->attachPermissionsToAdminRoles([
            $this->alias . '-main' => 'c,r,u,d',
        ]);
    }
}
