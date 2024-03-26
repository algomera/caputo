<?php

namespace Database\Seeders;

use App\Models\Patent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patents = ['AM', 'A1', 'A2', 'A', 'B1','B', 'C1', 'C', 'D1', 'D', 'BE', 'C1E', 'CE', 'D1E', 'DE'];

        foreach ($patents as $patent) {
            Patent::create([
                'qualification' => $patent
            ]);
        }
    }
}
