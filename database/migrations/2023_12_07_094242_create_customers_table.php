<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('lastName')->nullable();
            $table->string('sex')->nullable();
            //birth
            $table->date('date_of_birth')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('country_of_birth')->nullable();
            //Residence
            $table->string('city');
            $table->string('province');
            $table->string('postcode');
            $table->string('toponym')->nullable();
            $table->string('address');
            $table->string('civic');
            $table->string('fiscal_code')->nullable();
            $table->string('country')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone_1')->nullable();
            $table->string('phone_2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
