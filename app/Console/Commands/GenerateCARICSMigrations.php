<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

#[Signature('carics:generate-migrations')]
#[Description('Génère toutes les migrations pour le projet CARICS-Togo')]
class GenerateCARICSMigrations extends Command
{
    private string $migrationPath;
    private int $timestamp = 0;

    public function __construct()
    {
        parent::__construct();
        $this->migrationPath = database_path('migrations');
    }

    public function handle(): void
    {
        $this->info('🚀 Génération des migrations CARICS-Togo...');
        $this->newLine();

        $this->cleanOldMigrations();

        // Ordre strict de dépendances (pas de FK vers table inexistante)
        $this->generateTeamMembersTable();
        $this->generatePartnersTable();
        $this->generateCategoriesTable();
        $this->generateBlogTagsTable();
        $this->generateResearchProjectsTable();
        $this->generateResearchProjectPivotTables();
        $this->generateBlogPostsTable();
        $this->generateBlogPostTagPivotTable();
        $this->generatePublicationsTable();
        $this->generateResourcesTable();
        $this->generateOpportunitiesTable();
        $this->generateNewsTable();
        $this->generateContactSubmissionsTable();
        $this->generateNewsletterSubscribersTable();
        $this->generateSiteSettingsTable();

        $this->newLine();
        $this->info('✅ Toutes les migrations ont été générées.');
        $this->info('👉 Lancez : php artisan migrate --seed');
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Helpers
    // ─────────────────────────────────────────────────────────────────────────

    private function cleanOldMigrations(): void
    {
        $files = File::glob($this->migrationPath . '/*_carics_*.php');
        foreach ($files as $file) {
            File::delete($file);
        }
        $this->info('🧹 Anciennes migrations CARICS nettoyées');
        $this->newLine();
    }

    private function getTimestamp(): string
    {
        $this->timestamp++;
        return date('Y_m_d_') . str_pad($this->timestamp, 6, '0', STR_PAD_LEFT);
    }

    private function createMigration(string $name, string $content): void
    {
        $timestamp = $this->getTimestamp();
        $filename  = "{$timestamp}_carics_{$name}.php";
        $filepath  = $this->migrationPath . '/' . $filename;

        File::put($filepath, $content);
        $this->line("  <fg=green>✓</> Migration créée : <fg=cyan>{$filename}</>");
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 01 — team_members
    // ─────────────────────────────────────────────────────────────────────────

    private function generateTeamMembersTable(): void
    {
        $content = <<<'PHP'
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
            $table->string('role_category')->default('bureau_executif');
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
PHP;
        $this->createMigration('create_team_members_table', $content);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 02 — partners
    // ─────────────────────────────────────────────────────────────────────────

    private function generatePartnersTable(): void
    {
        $content = <<<'PHP'
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
PHP;
        $this->createMigration('create_partners_table', $content);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 03 — categories  (table polymorphique centrale)
    // ─────────────────────────────────────────────────────────────────────────

    private function generateCategoriesTable(): void
    {
        $content = <<<'PHP'
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
PHP;
        $this->createMigration('create_categories_table', $content);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 04 — blog_tags
    // ─────────────────────────────────────────────────────────────────────────

    private function generateBlogTagsTable(): void
    {
        $content = <<<'PHP'
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();

            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_tags');
    }
};
PHP;
        $this->createMigration('create_blog_tags_table', $content);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 05 — research_projects
    // ─────────────────────────────────────────────────────────────────────────

    private function generateResearchProjectsTable(): void
    {
        $content = <<<'PHP'
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('research_projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            // en_cours | complete | archive | a_venir
            $table->enum('status', ['en_cours', 'complete', 'archive', 'a_venir'])
                  ->default('en_cours');
            $table->string('funder')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('country')->default('Togo');
            $table->string('region')->nullable();
            $table->json('intervention_zones')->nullable();   // ["Tône", "Cinkassé", ...]
            $table->decimal('map_lat', 10, 7)->nullable();
            $table->decimal('map_lng', 10, 7)->nullable();
            $table->text('context')->nullable();
            $table->text('objective')->nullable();
            $table->text('methodology')->nullable();
            $table->json('expected_results')->nullable();    // liste ordonnée
            $table->json('research_domains')->nullable();    // tags thématiques libres
            $table->foreignId('lead_id')
                  ->nullable()
                  ->constrained('team_members')
                  ->nullOnDelete();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->unsignedInteger('display_order')->default(0);
            $table->timestamps();

            $table->index('slug');
            $table->index('status');
            $table->index('is_featured');
            $table->index('is_published');
            $table->index('display_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('research_projects');
    }
};
PHP;
        $this->createMigration('create_research_projects_table', $content);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 06 — tables pivot de research_projects
    // ─────────────────────────────────────────────────────────────────────────

    private function generateResearchProjectPivotTables(): void
    {
        $content = <<<'PHP'
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
PHP;
        $this->createMigration('create_research_project_pivot_tables', $content);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 07 — blog_posts
    // ─────────────────────────────────────────────────────────────────────────

    private function generateBlogPostsTable(): void
    {
        $content = <<<'PHP'
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            // article | fiche_projet
            $table->enum('type', ['article', 'fiche_projet'])->default('article');
            $table->text('excerpt')->nullable();
            $table->longText('body')->nullable();
            $table->string('cover_image')->nullable();
            $table->foreignId('author_id')
                  ->nullable()
                  ->constrained('team_members')
                  ->nullOnDelete();
            // Relation polymorphique via categories
            // (categorizable_type = 'App\Models\BlogPost')
            $table->foreignId('category_id')
                  ->nullable()
                  ->constrained('categories')
                  ->nullOnDelete();
            $table->foreignId('research_project_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();
            $table->unsignedInteger('reading_time_minutes')->nullable();
            $table->json('references')->nullable();   // bibliographie [{text}, ...]
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            // brouillon | publie | archive
            $table->enum('status', ['brouillon', 'publie', 'archive'])
                  ->default('brouillon');
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();

            $table->index('slug');
            $table->index('type');
            $table->index('status');
            $table->index('published_at');
            $table->index('is_featured');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
PHP;
        $this->createMigration('create_blog_posts_table', $content);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 08 — pivot blog_post ↔ blog_tag
    // ─────────────────────────────────────────────────────────────────────────

    private function generateBlogPostTagPivotTable(): void
    {
        $content = <<<'PHP'
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_post_blog_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_post_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->foreignId('blog_tag_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->unique(['blog_post_id', 'blog_tag_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_post_blog_tag');
    }
};
PHP;
        $this->createMigration('create_blog_post_tag_pivot_table', $content);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 09 — publications
    // ─────────────────────────────────────────────────────────────────────────

    private function generatePublicationsTable(): void
    {
        $content = <<<'PHP'
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            // article_scientifique | rapport_technique | note_politique | acte_conference
            $table->enum('type', [
                'article_scientifique',
                'rapport_technique',
                'note_politique',
                'acte_conference',
            ])->default('article_scientifique');
            $table->text('abstract')->nullable();
            $table->string('journal_or_publisher')->nullable();
            // JSON car auteurs multiples ordonnés (évite un pivot supplémentaire)
            $table->json('author_ids')->nullable();
            $table->string('external_co_authors')->nullable();
            $table->string('file_path')->nullable();
            $table->string('external_url')->nullable();
            $table->date('published_date')->nullable();
            $table->foreignId('research_project_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();
            // a_paraitre | publie
            $table->enum('status', ['a_paraitre', 'publie'])->default('a_paraitre');
            $table->timestamps();

            $table->index('type');
            $table->index('status');
            $table->index('published_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
PHP;
        $this->createMigration('create_publications_table', $content);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 10 — resources
    // ─────────────────────────────────────────────────────────────────────────

    private function generateResourcesTable(): void
    {
        $content = <<<'PHP'
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
PHP;
        $this->createMigration('create_resources_table', $content);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 11 — opportunities
    // ─────────────────────────────────────────────────────────────────────────

    private function generateOpportunitiesTable(): void
    {
        $content = <<<'PHP'
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('opportunities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            // category_id → categories où categorizable_type = 'App\Models\Opportunity'
            // Ex. : Emploi & Consultance | Stage & Mentorat | Bourse | Partenariat
            $table->foreignId('category_id')
                  ->nullable()
                  ->constrained('categories')
                  ->nullOnDelete();
            $table->text('description')->nullable();
            $table->json('requirements')->nullable();   // critères / profils
            $table->string('location')->nullable();
            // cdd | cdi | consultance | stage | benevolat
            $table->enum('contract_type', ['cdd', 'cdi', 'consultance', 'stage', 'benevolat'])
                  ->nullable();
            $table->date('deadline')->nullable();
            $table->string('application_email')->nullable();
            $table->string('application_url')->nullable();
            // ouverte | fermee | pourvue
            $table->enum('status', ['ouverte', 'fermee', 'pourvue'])->default('ouverte');
            $table->boolean('is_published')->default(true);
            $table->timestamps();

            $table->index('status');
            $table->index('is_published');
            $table->index('deadline');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('opportunities');
    }
};
PHP;
        $this->createMigration('create_opportunities_table', $content);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 12 — news
    // ─────────────────────────────────────────────────────────────────────────

    private function generateNewsTable(): void
    {
        $content = <<<'PHP'
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
PHP;
        $this->createMigration('create_news_table', $content);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 13 — contact_submissions
    // ─────────────────────────────────────────────────────────────────────────

    private function generateContactSubmissionsTable(): void
    {
        $content = <<<'PHP'
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
PHP;
        $this->createMigration('create_contact_submissions_table', $content);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 14 — newsletter_subscribers
    // ─────────────────────────────────────────────────────────────────────────

    private function generateNewsletterSubscribersTable(): void
    {
        $content = <<<'PHP'
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('newsletter_subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            // ["recherche", "projets", "opportunites", "publications"]
            $table->json('preferences')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('unsubscribe_token')->unique()->nullable();
            $table->timestamp('subscribed_at')->nullable();
            $table->timestamps();

            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('newsletter_subscribers');
    }
};
PHP;
        $this->createMigration('create_newsletter_subscribers_table', $content);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 15 — site_settings
    // ─────────────────────────────────────────────────────────────────────────

    private function generateSiteSettingsTable(): void
    {
        $content = <<<'PHP'
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
PHP;
        $this->createMigration('create_site_settings_table', $content);
    }
}
