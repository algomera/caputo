<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\IdentificationDocument;
use App\Models\IdentificationType;
use Faker\Provider\it_IT\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class identificationDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::all();
        $documentType = IdentificationType::all();

        foreach ($customers as $customer) {
            foreach ($documentType as $type) {
                if ($type->name == 'patente') {
                    IdentificationDocument::create([
                        'customer_id' => $customer->id,
                        'identification_type_id' => $type->id,
                        'n_document' => fake()->regexify('[A-Z]{2}[0-9]{7}'),
                        'document_release' => fake()->date(),
                        'document_from' => fake()->word(),
                        'document_expiration' => fake()->date(),
                        'qualification' => json_encode(['1','6'])
                    ]);
                }

                if ($type->name == 'carta di identita') {
                    IdentificationDocument::create([
                        'customer_id' => $customer->id,
                        'identification_type_id' => $type->id,
                        'n_document' => fake()->regexify('[A-Z]{2}[0-9]{7}'),
                        'document_release' => fake()->date(),
                        'document_from' => fake()->word(),
                        'document_expiration' => fake()->date(),
                    ]);
                }
            }
        }
    }
}
