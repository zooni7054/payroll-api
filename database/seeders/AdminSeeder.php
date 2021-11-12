<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->truncate();
        DB::table('admins')->insert([
            'first_name' => 'Reach',
            'last_name' => 'First',
            'name' => 'Reach First',
            'email' => 'info@reachfirst.com',
            'password' => Hash::make('test123'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        	'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
