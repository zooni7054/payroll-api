<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        $this->call([
            AdminSeeder::class,
            CitySeeder::class,
            StateSeeder::class,
            AllowanceCategorySeeder::class,
            CompanyTypeSeeder::class,
            ContributionCategorySeeder::class,
            DeductionCategorySeeder::class,
            DocumentCategorySeeder::class,
            EmploymentTypeSeeder::class,
            InfoTypeSeeder::class,
            PayTypeSeeder::class,
            PaymentMethodSeeder::class,
            RelationshipTypeSeeder::class,
            RoleSeeder::class,
        ]);
    }
}
