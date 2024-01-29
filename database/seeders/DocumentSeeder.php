<?php

namespace Database\Seeders;

use App\Models\Chronology;
use App\Models\Customer;
use App\Models\Document;
use App\Models\Payment;
use App\Models\Registration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registrations = Registration::all();
        $customers = Customer::all();
        $payments = Payment::all();

        $documents = [
            [
                'type' => 'fototessera',
                'path' =>  '/resources/images/photo.png'
            ],
            [
                'type' => 'firma',
                'path' =>  '/resources/images/signature.png'
            ],
            [
                'type' => 'documenti di riconoscimento',
                'path' =>  '/resources/images/c.id.jpg'
            ],
        ];

        foreach ($customers as $customer) {
            foreach ($documents as $document) {
                $customer->documents()->create([
                    'type' => $document['type'],
                    'path' => $document['path']
                ]);
            }
        }

        foreach ($registrations as $registration) {
            foreach ($documents as $document) {
                if ($document['type'] != 'fototessera') {
                    $registration->documents()->create([
                        'type' => $document['type'],
                        'path' => $document['path']
                    ]);
                }
            }
        }

        foreach ($payments as $payment) {
            $payment->document()->create([
                'type' => 'Pagamento',
                'path' => fake()->imageUrl(245, 245, 'Personal', true, 'Payment', false, 'jpg')
            ]);
        }
    }
}
