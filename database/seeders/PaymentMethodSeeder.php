<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use File;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->truncate();
        $json = File::get("database/data/payment_methods.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
            DB::table('payment_methods')->insert(array(
            'name' => $obj->name,
            'status' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
          ));
        }
    }
}
