<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            // article | fiche_projet
            $table->enum('type', ['article', 'fiche_projet'])->default('article');
            $table->text('excerpt')->nullable();
            $table->longText('body')->nullable();
            $table->string('cover_image')->nullable();
            $table->foreignId('author_id')
                ->nullable()
                ->constrained('team_members')
                ->nullOnDelete();
            // Relation polymorphique via categories
            // (categorizable_type = 'App\Models\BlogPost')
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete();
            $table->foreignId('research_project_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->unsignedInteger('reading_time_minutes')->nullable();
            $table->json('references')->nullable();   // bibliographie [{text}, ...]
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            // brouillon | publie | archive
            $table->enum('status', ['brouillon', 'publie', 'archive'])
                ->default('brouillon');
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();

            $table->index('slug');
            $table->index('type');
            $table->index('status');
            $table->index('published_at');
            $table->index('is_featured');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
