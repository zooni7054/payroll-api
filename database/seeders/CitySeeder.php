<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use File;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->truncate();
        $json = File::get("database/data/cities.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
            DB::table('cities')->insert(array(
            'name' => $obj->name,
            'state_id' => $obj->state_id,
            'status' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
          ));
        }
    }
}
