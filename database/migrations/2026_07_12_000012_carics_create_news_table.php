<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->string('cover_image')->nullable();
            // category_id → categories où categorizable_type = 'App\Models\News'
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete();
            // Lien optionnel vers un article de blog complet
            $table->foreignId('blog_post_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->date('published_date')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->timestamps();

            $table->index('slug');
            $table->index('is_featured');
            $table->index('is_published');
            $table->index('published_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
