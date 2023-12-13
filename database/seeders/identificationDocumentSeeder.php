<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\IdentificationDocument;
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

        foreach ($customers as $customer) {
            IdentificationDocument::create([
                'customer_id' => $customer->id,
                'type' => fake()->randomElement(['carta di identita','patente di guida']),
                'n_document' => Company::vat(),
                'document_release' => fake()->date(),
                'document_from' => fake()->word(),
                'document_expiration' => fake()->date(),
                'n_patent' => Company::vat(),
                'patent_release' => fake()->date(),
                'patent_from' => fake()->word(),
                'patent_expiration' => fake()->date(),
                'qualification' => json_encode(['A','B'])
            ]);
        }
    }
}
