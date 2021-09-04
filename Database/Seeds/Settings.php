<?php

namespace Modules\AfricasTalking\Database\Seeds;

use App\Abstracts\Model;
use Illuminate\Database\Seeder;

class Settings extends Seeder
{
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
        setting()->set(
            [
                'africas-talking.show_balance'      => 1,
                'africas-talking.send_with_invoice' => 1,
                'africas-talking.invoice_message'   => trans('africas-talking::general.invoice_message'),
            ]
        );

        setting()->save();
    }
}
