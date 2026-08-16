<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            // category_id → categories où categorizable_type = 'App\Models\Resource'
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete();
            $table->string('file_path')->nullable();
            $table->string('external_url')->nullable();
            // a_paraitre | disponible
            $table->enum('status', ['a_paraitre', 'disponible'])->default('a_paraitre');
            $table->unsignedInteger('display_order')->default(0);
            $table->timestamps();

            $table->index('status');
            $table->index('display_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
