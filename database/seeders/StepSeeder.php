<?php

namespace Database\Seeders;

use App\Models\Step;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $steps = [
            [ //1
                'name' => 'Dati cliente',
                'short_name' => 'dati',
                'required' => true,
            ],
            [ //2
                'name' => 'Documenti riconoscimento',
                'short_name' => 'documenti',
                'required' => false,
            ],
            [ //3
                'name' => 'Scansione documenti riconoscimento',
                'short_name' => 'scansioni',
                'required' => false,
            ],
            [ //4
                'name' => 'Fototessera',
                'short_name' => 'fototessera',
                'required' => false,
            ],
            [ //5
                'name' => 'Firma cliente',
                'short_name' => 'firma',
                'required' => true,
            ],
            [ //6
                'name' => 'Scansione documenti e firma genitore/tutore',
                'short_name' => 'genitore/tutore',
                'required' => false,
            ],
            [ //7
                'name' => 'Scansione documenti e firma accompagnatore',
                'short_name' => 'accompagnatori',
                'required' => false,
            ],
            [ //8
                'name' => 'Conferma residenza',
                'short_name' => 'residenza',
                'required' => true,
            ],
            [ //9
                'name' => 'Visita medica',
                'short_name' => 'visita',
                'required' => false,
            ],
        ];

        foreach ($steps as $step) {
            Step::create([
                'name' => $step['name'],
                'short_name' => $step['short_name'],
                'required' => $step['required'],
            ]);
        }
    }
}
