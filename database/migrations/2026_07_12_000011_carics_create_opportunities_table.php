<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('opportunities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            // category_id → categories où categorizable_type = 'App\Models\Opportunity'
            // Ex. : Emploi & Consultance | Stage & Mentorat | Bourse | Partenariat
            $table->foreignId('category_id')
                  ->nullable()
                  ->constrained('categories')
                  ->nullOnDelete();
            $table->text('description')->nullable();
            $table->json('requirements')->nullable();   // critères / profils
            $table->string('location')->nullable();
            // cdd | cdi | consultance | stage | benevolat
            $table->enum('contract_type', ['cdd', 'cdi', 'consultance', 'stage', 'benevolat'])
                  ->nullable();
            $table->date('deadline')->nullable();
            $table->string('application_email')->nullable();
            $table->string('application_url')->nullable();
            // ouverte | fermee | pourvue
            $table->enum('status', ['ouverte', 'fermee', 'pourvue'])->default('ouverte');
            $table->boolean('is_published')->default(true);
            $table->timestamps();

            $table->index('status');
            $table->index('is_published');
            $table->index('deadline');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('opportunities');
    }
};