<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            // general | contact | social | hero | stats | seo
            $table->string('group')->default('general');
            $table->string('key')->unique();
            $table->text('value')->nullable();
            // text | textarea | richtext | image | number | boolean | json
            $table->enum('type', ['text', 'textarea', 'richtext', 'image', 'number', 'boolean', 'json'])
                  ->default('text');
            $table->string('label')->nullable();
            $table->unsignedInteger('display_order')->default(0);
            $table->timestamps();

            $table->index('group');
            $table->index(['group', 'display_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};