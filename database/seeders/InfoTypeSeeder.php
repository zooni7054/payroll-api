<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use File;

class InfoTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('info_types')->truncate();
        $json = File::get("database/data/info_types.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
            DB::table('info_types')->insert(array(
            'name' => $obj->name,
            'status' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
          ));
        }
    }
}
