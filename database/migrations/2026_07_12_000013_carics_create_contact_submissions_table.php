<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_submissions', function (Blueprint $table) {
            $table->id();
            // general | collaboration | stage | media
            $table->enum('form_type', ['general', 'collaboration', 'stage', 'media'])
                ->default('general');
            $table->string('full_name');
            $table->string('email');
            $table->string('organisation')->nullable();
            $table->string('subject')->nullable();
            $table->text('message');
            $table->string('file_path')->nullable();
            // Champs spécifiques selon form_type (niveau, média, institution...)
            $table->json('meta')->nullable();
            $table->boolean('is_read')->default(false);
            $table->boolean('is_archived')->default(false);
            $table->timestamps();

            $table->index('form_type');
            $table->index('is_read');
            $table->index('is_archived');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_submissions');
    }
};
