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
                'name' => 'dati cliente',
                'short_name' => 'dati',
                'required' => true,
            ],
            [ //2
                'name' => 'documenti riconoscimento',
                'short_name' => 'documenti',
                'required' => false,
            ],
            [ //3
                'name' => 'scansione documenti riconoscimento',
                'short_name' => 'scansioni',
                'required' => false,
            ],
            [ //4
                'name' => 'fototessera',
                'short_name' => 'fototessera',
                'required' => false,
            ],
            [ //5
                'name' => 'firma cliente',
                'short_name' => 'firma',
                'required' => true,
            ],
            [ //6
                'name' => 'scansione documenti e firma genitore/tutore',
                'short_name' => 'genitore/tutore',
                'required' => false,
            ],
            [ //7
                'name' => 'scansione documenti e firma accompagnatore',
                'short_name' => 'accompagnatori',
                'required' => false,
            ],
            [ //8
                'name' => 'conferma residenza',
                'short_name' => 'residenza',
                'required' => true,
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
