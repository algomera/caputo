<?php

namespace Database\Seeders;

use App\Models\chronology;
use App\Models\Customer;
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
        $customers = Customer::all();
        $registrations = Registration::all();

        $customerChronology = [
            'Registrazione cliente',
            'Modifica dati',
            'Inserimento file',
            'Inserimento documento',
            'Modifica documento',
            'Consegna documenti',
        ];

        $registrationChronology = [
            'Pagamento iscrizione',
            'Pagamento PagoPa',
            'Invio messaggio appuntamento visita medica',
            'Prenotazione guida',
            'Pagamento guida',
            'Prenotazione esame',
            'Consegna Patente'
        ];

        foreach ($customers as $customer) {
            for ($i=0; $i < count($customerChronology); $i++) {
                $customer->chronologies()->create([
                    'title' => $customerChronology[$i],
                    'content' => fake()->paragraph()
                ]);
            }
        }

        foreach ($registrations as $registration) {
            for ($i=0; $i < count($registrationChronology); $i++) {
                $registration->chronologies()->create([
                    'title' => $registrationChronology[$i],
                    'content' => fake()->paragraph()
                ]);
            }
        }
    }
}
