<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Table de catégories polymorphique.
     *
     * Le champ `categorizable_type` contient le FQCN du modèle propriétaire :
     *   App\Models\BlogPost, App\Models\Resource,
     *   App\Models\Opportunity, App\Models\News.
     *
     * Les tables enfants (blog_posts, resources, opportunities, news) portent
     * chacune un `category_id FK → categories.id`.
     *
     * Filament filtre les options via :
     *   Category::forModel(BlogPost::class)->pluck('name', 'id')
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            // Classe CSS du site : cat-recherche, cat-projets, cat-innovation...
            $table->string('color_class')->nullable();
            $table->text('description')->nullable();
            // Discriminant polymorphique — FQCN du modèle cible
            $table->string('categorizable_type');
            $table->unsignedInteger('display_order')->default(0);
            $table->timestamps();

            $table->index('slug');
            $table->index('categorizable_type');
            $table->index(['categorizable_type', 'display_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
