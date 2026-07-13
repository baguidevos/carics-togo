<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Pivot : membres d'équipe associés à un projet (avec rôle)
        Schema::create('research_project_team_member', function (Blueprint $table) {
            $table->id();
            $table->foreignId('research_project_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->foreignId('team_member_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->string('role_on_project')->nullable();
            $table->timestamps();

            $table->unique(['research_project_id', 'team_member_id']);
        });

        // Pivot : partenaires / financeurs liés à un projet
        Schema::create('partner_research_project', function (Blueprint $table) {
            $table->id();
            $table->foreignId('research_project_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->foreignId('partner_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['research_project_id', 'partner_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partner_research_project');
        Schema::dropIfExists('research_project_team_member');
    }
};