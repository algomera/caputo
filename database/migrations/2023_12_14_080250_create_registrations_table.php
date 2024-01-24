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
            $table->string('type');
            $table->string('transmission')->nullable();
            $table->json('optionals')->nullable();
            $table->decimal('price')->nullable();
            $table->string('state')->default('aperta');
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
