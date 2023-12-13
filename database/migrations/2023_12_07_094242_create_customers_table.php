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
            $table->string('photo')->nullable();
            $table->string('name');
            $table->string('lastName');
            $table->string('sex');
            $table->date('date_of_birth');
            $table->string('birth_place')->nullable();
            $table->string('country_of_birth')->nullable();
            $table->string('address');
            $table->string('postcode');
            $table->string('fiscal_code');
            $table->string('country');
            $table->string('email')->unique();
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
