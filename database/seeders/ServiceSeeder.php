<?php

namespace Database\Seeders;

use App\Models\School;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schools = School::all();

        $services = [
            'Servizi al conducente',
            'Patenti',
            'Formazione professionale',
            'Nautica',
            'Patenti professionali',
            'Corsi'
        ];

        foreach ($services as $value) {
            $service = Service::create([
                'name' => $value
            ]);

            foreach ($schools as $school) {
                $service->schools()->attach($school->id);
            }
        }
    }
}
