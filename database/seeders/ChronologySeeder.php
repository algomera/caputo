<?php

namespace Database\Seeders;

use App\Models\chronology;
use App\Models\Registration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChronologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registrations = Registration::all();

        $title = [
            'Pagamento PagoPa',
            'Pagamento iscrizione',
            'Conferma visita',
            'Proposta appuntamento visita',
            'Prenotazione guida',
            'Prenotazione esame',
            'Consegna Patente'
        ];

        foreach ($registrations as $registration) {
            for ($i=0; $i < 5; $i++) {
                Chronology::create([
                    'registration_id' => $registration->id,
                    'title' => fake()->randomElement($title),
                    'content' => fake()->paragraph()
                ]);
            }
        }
    }
}
