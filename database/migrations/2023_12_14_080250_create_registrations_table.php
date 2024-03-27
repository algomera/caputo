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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('training_id')->constrained()->onDelete('cascade');
            $table->boolean('special')->default(false);
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('registration_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('branch_id')->constrained()->onDelete('cascade');
            $table->string('transmission')->nullable();
            $table->json('optionals')->nullable();
            $table->json('step_skipped')->nullable();
            $table->decimal('price');
            $table->decimal('discount')->nullable();
            $table->string('state')->default('aperta');
            $table->string('code_statino')->nullable();
            $table->string('protocol')->nullable();
            $table->dateTime('protocol_release')->nullable();
            $table->date('protocol_expiration')->nullable();
            $table->string('presented')->nullable();
            $table->string('variation')->nullable();
            $table->string('approved')->nullable();
            $table->date('registration_date')->nullable();
            $table->string('n_registration')->nullable();
            $table->boolean('welded')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
