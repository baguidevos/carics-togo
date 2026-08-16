<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('research_projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            // en_cours | complete | archive | a_venir
            $table->enum('status', ['en_cours', 'complete', 'archive', 'a_venir'])
                ->default('en_cours');
            $table->string('funder')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('country')->default('Togo');
            $table->string('region')->nullable();
            $table->json('intervention_zones')->nullable();   // ["Tône", "Cinkassé", ...]
            $table->decimal('map_lat', 10, 7)->nullable();
            $table->decimal('map_lng', 10, 7)->nullable();
            $table->text('context')->nullable();
            $table->text('objective')->nullable();
            $table->text('methodology')->nullable();
            $table->json('expected_results')->nullable();    // liste ordonnée
            $table->json('research_domains')->nullable();    // tags thématiques libres
            $table->foreignId('lead_id')
                ->nullable()
                ->constrained('team_members')
                ->nullOnDelete();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->unsignedInteger('display_order')->default(0);
            $table->timestamps();

            $table->index('slug');
            $table->index('status');
            $table->index('is_featured');
            $table->index('is_published');
            $table->index('display_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('research_projects');
    }
};
