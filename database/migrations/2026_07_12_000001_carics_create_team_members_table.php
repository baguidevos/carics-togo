<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('slug')->unique();
            $table->string('role_title');
            // bureau_executif | chercheur_associe | consultant
            $table->string('role_category')->default('bureau_executif')->nullable();
            $table->text('bio_short')->nullable();
            $table->longText('bio_full')->nullable();
            $table->text('mission_text')->nullable();
            $table->json('expertises')->nullable();   // ["Épidémiologie", "Paludisme", ...]
            $table->json('education')->nullable();    // [{degree, field, institution}, ...]
            $table->json('distinctions')->nullable(); // [{title, organisation, year}, ...]
            $table->json('affiliations')->nullable(); // ["RTI International", ...]
            $table->string('photo')->nullable();
            $table->string('avatar_color')->default('primary');
            $table->string('email')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('orcid_url')->nullable();
            $table->string('google_scholar_url')->nullable();
            $table->boolean('is_founder')->default(false);
            $table->boolean('is_published')->default(true);
            $table->unsignedInteger('display_order')->default(0);
            $table->timestamps();

            $table->index('slug');
            $table->index('is_published');
            $table->index('display_order');
            $table->index('role_category');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};