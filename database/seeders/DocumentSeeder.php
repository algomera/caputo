<?php

namespace Database\Seeders;

use App\Models\Chronology;
use App\Models\Customer;
use App\Models\Document;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::all();
        $chronologies = Chronology::all();
        $documents = [
            'Fototessera',
            'Firma',
            'documenti di riconoscimento'
        ];

        foreach ($customers as $customer) {
            foreach ($documents as $document) {
                $customer->documents()->create([
                    'type' => $document,
                    'path' => fake()->imageUrl(245, 245, 'Personal', true, 'Document', false, 'jpg')
                ]);
            }
        }

        foreach ($chronologies as $chronology) {
            if (str_contains($chronology->title, 'Pagamento')) {
                $chronology->documents()->create([
                    'type' => 'Pagamento',
                    'path' => fake()->imageUrl(245, 245, 'Personal', true, 'Payment', false, 'jpg')
                ]);
            }
        }
    }
}
