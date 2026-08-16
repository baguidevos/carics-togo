<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            // article_scientifique | rapport_technique | note_politique | acte_conference
            $table->enum('type', [
                'article_scientifique',
                'rapport_technique',
                'note_politique',
                'acte_conference',
            ])->default('article_scientifique');
            $table->text('abstract')->nullable();
            $table->string('journal_or_publisher')->nullable();
            // JSON car auteurs multiples ordonnés (évite un pivot supplémentaire)
            $table->json('author_ids')->nullable();
            $table->string('external_co_authors')->nullable();
            $table->string('file_path')->nullable();
            $table->string('external_url')->nullable();
            $table->date('published_date')->nullable();
            $table->foreignId('research_project_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            // a_paraitre | publie
            $table->enum('status', ['a_paraitre', 'publie'])->default('a_paraitre');
            $table->timestamps();

            $table->index('type');
            $table->index('status');
            $table->index('published_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
