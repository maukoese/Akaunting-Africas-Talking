<?php

namespace Modules\AfricasTalking\Database\Seeds;

use App\Abstracts\Model;
use App\Traits\Permissions as Helper;
use Illuminate\Database\Seeder;

class Permissions extends Seeder
{
    use Helper;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->create();

        Model::reguard();
    }

    private function create()
    {
        // c=create, r=read, u=update, d=delete
        $this->attachPermissionsToAdminRoles(
            [
                'africas-talking-settings' => 'r,u',
                'africas-talking-send-sms' => 'c,r',
                'africas-talking-logs'     => 'r',

            ]
        );
    }
}
