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
        Schema::create('identification_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('type');
            $table->string('n_document');
            $table->date('document_release');
            $table->string('document_from');
            $table->date('document_expiration');
            $table->string('n_patent')->nullable();
            $table->date('patent_release')->nullable();
            $table->string('patent_from')->nullable();
            $table->date('patent_expiration')->nullable();
            $table->json('qualification')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identification_documents');
    }
};
