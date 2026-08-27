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
        Schema::table('news', function (Blueprint $table) {
            $table->string('hero_media_type')->default('image')->after('cover_image');
        });

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->string('hero_media_type')->default('image')->after('cover_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn('hero_media_type');
        });

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn('hero_media_type');
        });
    }
};
