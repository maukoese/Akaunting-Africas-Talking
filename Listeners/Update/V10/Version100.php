<?php

namespace Modules\AfricasTalking\Listeners\Update\V10;

use App\Abstracts\Listeners\Update as Listener;
use App\Events\Install\UpdateFinished as Event;
use App\Traits\Permissions;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class Version100 extends Listener
{
    use Permissions;

    const ALIAS = 'africas-talking';

    const VERSION = '1.0.0';

    /**
     * Handle the event.
     *
     * @param  $event
     *
     * @return void
     */
    public function handle(Event $event)
    {
        if ($this->skipThisUpdate($event)) {
            return;
        }

        $this->updateDatabase();
    }

    protected function updateDatabase()
    {
        if (DB::table('migrations')->where('migration', '2021_09_03_000000_africas_talking')->first()) {
            return;
        }

        DB::table('migrations')->insert(
            [
                'id'        => DB::table('migrations')->max('id') + 1,
                'migration' => '2021_09_03_000000_africas_talking',
                'batch'     => DB::table('migrations')->max('batch') + 1,
            ]
        );

        Artisan::call('module:migrate', ['alias' => self::ALIAS, '--force' => true]);
    }
}
