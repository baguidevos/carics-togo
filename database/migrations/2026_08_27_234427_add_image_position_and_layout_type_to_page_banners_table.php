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
        Schema::table('page_banners', function (Blueprint $table) {
            $table->string('layout_type')->default('full')->after('hero_media_type'); // 'full' or 'split'
            $table->string('image_position')->default('center')->after('layout_type'); // 'center', 'top', 'bottom', 'top-left', etc.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('page_banners', function (Blueprint $table) {
            $table->dropColumn(['layout_type', 'image_position']);
        });
    }
};
