<?php

namespace Database\Seeders;

use App\Models\chronology;
use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChronologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::all();

        $title = [
            'Pagamento PagoPa',
            'Pagamento iscrizione',
            'Conferma visita',
            'Proposta appuntamento visita',
            'Prenotazione guida',
            'Prenotazione esame',
            'Consegna Patente'
        ];

        foreach ($customers as $customer) {
            for ($i=0; $i < 5; $i++) {
                Chronology::create([
                    'customer_id' => $customer->id,
                    'title' => fake()->randomElement($title),
                    'content' => fake()->paragraph()
                ]);
            }
        }
    }
}
