<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('full_name')->nullable();
            $table->string('logo')->nullable();
            $table->string('website_url')->nullable();
            // financeur | academique | institutionnel | ong | autre
            $table->enum('type', ['financeur', 'academique', 'institutionnel', 'ong', 'autre'])
                ->default('autre');
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('display_order')->default(0);
            $table->timestamps();

            $table->index('is_active');
            $table->index('display_order');
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
