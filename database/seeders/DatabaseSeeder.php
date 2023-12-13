<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            RolePermissionSeeder::class,
            SchoolSeeder::class,
            UserSeeder::class,
            ServiceSeeder::class,
            CoursesSeeder::class,
            OptionSeeder::class,
        ]);

        Customer::factory(30)->create();

        $this->call([
            identificationDocumentSeeder::class,
        ]);

    }
}
