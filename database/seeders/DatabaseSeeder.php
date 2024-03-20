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
            StepSeeder::class,
            RegistrationTypeSeeder::class,
            CoursesSeeder::class,
            OptionSeeder::class,
            VehicleSeeder::class
        ]);

        Customer::factory(20)->create();

        $this->call([
            IdentificationTypeSeeder::class,
            identificationDocumentSeeder::class,
            TrainingSeeder::class,
            InterestedSeeder::class,
            ChronologySeeder::class,
            PlanningSeeder::class,
            PaymentSeeder::class,
            DocumentSeeder::class,
            PresenceSeeder::class,
            PinkSheetSeeder::class
        ]);

    }
}
