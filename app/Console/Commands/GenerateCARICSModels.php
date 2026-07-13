<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

#[Signature('carics:generate-models')]
#[Description('Génère tous les modèles Eloquent pour le projet CARICS-Togo')]
class GenerateCARICSModels extends Command
{
    private string $modelPath;

    public function __construct()
    {
        parent::__construct();
        $this->modelPath = app_path('Models');
    }

    public function handle(): void
    {
        $this->info('🚀 Génération des modèles Eloquent CARICS-Togo...');
        $this->newLine();

        $this->generateTeamMember();
        $this->generatePartner();
        $this->generateCategory();
        $this->generateBlogTag();
        $this->generateResearchProject();
        $this->generateBlogPost();
        $this->generatePublication();
        $this->generateResource();
        $this->generateOpportunity();
        $this->generateNews();
        $this->generateContactSubmission();
        $this->generateNewsletterSubscriber();
        $this->generateSiteSetting();

        $this->newLine();
        $this->info('✅ Tous les modèles ont été générés dans app/Models/');
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Helper
    // ─────────────────────────────────────────────────────────────────────────

    private function createModel(string $className, string $content): void
    {
        $filepath = $this->modelPath . '/' . $className . '.php';

        if (File::exists($filepath)) {
            if (! $this->confirm("  Le modèle {$className}.php existe déjà. L'écraser ?", false)) {
                $this->line("  <fg=yellow>⏭</> {$className} ignoré.");
                return;
            }
        }

        File::put($filepath, $content);
        $this->line("  <fg=green>✓</> Modèle créé : <fg=cyan>{$className}.php</>");
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 01 — TeamMember
    // ─────────────────────────────────────────────────────────────────────────

    private function generateTeamMember(): void
    {
        $content = <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class TeamMember extends Model
{
    use HasFactory;

    // ─── Attributs ───────────────────────────────────────────────────────────

    protected $fillable = [
        'full_name', 'slug', 'role_title', 'role_category',
        'bio_short', 'bio_full', 'mission_text',
        'expertises', 'education', 'distinctions', 'affiliations',
        'photo', 'avatar_color',
        'email', 'linkedin_url', 'orcid_url', 'google_scholar_url',
        'is_founder', 'is_published', 'display_order',
    ];

    protected function casts(): array
    {
        return [
            'expertises'   => 'array',
            'education'    => 'array',   // [{degree, field, institution}, ...]
            'distinctions' => 'array',   // [{title, organisation, year}, ...]
            'affiliations' => 'array',   // ["RTI International", ...]
            'is_founder'   => 'boolean',
            'is_published' => 'boolean',
        ];
    }

    // ─── Hooks ───────────────────────────────────────────────────────────────

    protected static function booted(): void
    {
        static::saving(function (self $model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->full_name);
            }
        });
    }

    // ─── Relations ───────────────────────────────────────────────────────────

    /** Articles de blog rédigés par ce membre */
    public function blogPosts(): HasMany
    {
        return $this->hasMany(BlogPost::class, 'author_id');
    }

    /** Projets dont ce membre est l'investigateur principal */
    public function ledProjects(): HasMany
    {
        return $this->hasMany(ResearchProject::class, 'lead_id');
    }

    /** Projets auxquels ce membre est associé (via pivot) */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(
            ResearchProject::class,
            'research_project_team_member'
        )->withPivot('role_on_project')->withTimestamps();
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeFounders(Builder $query): Builder
    {
        return $query->where('is_founder', true);
    }

    public function scopeBureauExecutif(Builder $query): Builder
    {
        return $query->where('role_category', 'bureau_executif');
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('display_order')->orderBy('full_name');
    }

    // ─── Accesseurs ──────────────────────────────────────────────────────────

    /** Initiales pour l'avatar de substitution (ex. "GK") */
    public function getInitialsAttribute(): string
    {
        $parts = preg_split('/\s+/', trim($this->full_name));
        return implode('', array_map(
            fn ($p) => mb_strtoupper(mb_substr($p, 0, 1)),
            array_slice($parts, 0, 2)
        ));
    }
}
PHP;
        $this->createModel('TeamMember', $content);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 02 — Partner
    // ─────────────────────────────────────────────────────────────────────────

    private function generatePartner(): void
    {
        $content = <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'full_name', 'logo', 'website_url',
        'type', 'is_active', 'display_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    // ─── Relations ───────────────────────────────────────────────────────────

    public function researchProjects(): BelongsToMany
    {
        return $this->belongsToMany(
            ResearchProject::class,
            'partner_research_project'
        )->withTimestamps();
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('display_order')->orderBy('name');
    }

    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }
}
PHP;
        $this->createModel('Partner', $content);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 03 — Category  (modèle polymorphique central)
    // ─────────────────────────────────────────────────────────────────────────

    private function generateCategory(): void
    {
        $content = <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;

/**
 * Catégorie polymorphique.
 *
 * Le champ `categorizable_type` contient le FQCN du modèle propriétaire.
 * Une même table catégorise BlogPost, Resource, Opportunity et News.
 *
 * Usage Filament :
 *   Category::forModel(BlogPost::class)->pluck('name', 'id')
 *
 * La relation polymorphique inverse (categorizable) permet de retrouver
 * le "propriétaire" conceptuel d'un groupe de catégories, mais en pratique
 * c'est toujours via les relations HasMany ci-dessous qu'on navigue.
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'color_class', 'description',
        'categorizable_type', 'display_order',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    // ─── Relation polymorphique inverse ──────────────────────────────────────

    /**
     * Retourne le modèle "propriétaire" de ce type de catégorie.
     * Ex : $category->categorizable → instance de BlogPost (logique)
     *
     * Note : cette relation est principalement utile pour la navigation
     * sémantique. Dans le CRUD Filament, on utilise scopeForModel().
     */
    public function categorizable(): MorphTo
    {
        return $this->morphTo();
    }

    // ─── Relations HasMany vers chaque modèle enfant ─────────────────────────

    public function blogPosts(): HasMany
    {
        return $this->hasMany(BlogPost::class);
    }

    public function resources(): HasMany
    {
        return $this->hasMany(Resource::class);
    }

    public function opportunities(): HasMany
    {
        return $this->hasMany(Opportunity::class);
    }

    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    /**
     * Filtre les catégories destinées à un modèle donné.
     * Usage : Category::forModel(BlogPost::class)->get()
     */
    public function scopeForModel(Builder $query, string $modelClass): Builder
    {
        return $query->where('categorizable_type', $modelClass);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('display_order')->orderBy('name');
    }
}
PHP;
        $this->createModel('Category', $content);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 04 — BlogTag
    // ─────────────────────────────────────────────────────────────────────────

    private function generateBlogTag(): void
    {
        $content = <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class BlogTag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    protected static function booted(): void
    {
        static::saving(function (self $model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    // ─── Relations ───────────────────────────────────────────────────────────

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(BlogPost::class, 'blog_post_blog_tag');
    }
}
PHP;
        $this->createModel('BlogTag', $content);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 05 — ResearchProject
    // ─────────────────────────────────────────────────────────────────────────

    private function generateResearchProject(): void
    {
        $content = <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ResearchProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'status', 'funder',
        'start_date', 'end_date', 'country', 'region',
        'intervention_zones', 'map_lat', 'map_lng',
        'context', 'objective', 'methodology',
        'expected_results', 'research_domains',
        'lead_id', 'is_featured', 'is_published', 'display_order',
    ];

    protected function casts(): array
    {
        return [
            'start_date'         => 'date',
            'end_date'           => 'date',
            'intervention_zones' => 'array',
            'expected_results'   => 'array',
            'research_domains'   => 'array',
            'is_featured'        => 'boolean',
            'is_published'       => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (self $model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug(Str::limit($model->title, 80, ''));
            }
        });
    }

    // ─── Relations ───────────────────────────────────────────────────────────

    /** Investigateur principal */
    public function lead(): BelongsTo
    {
        return $this->belongsTo(TeamMember::class, 'lead_id');
    }

    /** Équipe projet (pivot avec rôle) */
    public function teamMembers(): BelongsToMany
    {
        return $this->belongsToMany(
            TeamMember::class,
            'research_project_team_member'
        )->withPivot('role_on_project')->withTimestamps();
    }

    /** Partenaires et financeurs associés */
    public function partners(): BelongsToMany
    {
        return $this->belongsToMany(
            Partner::class,
            'partner_research_project'
        )->withTimestamps();
    }

    /** Articles de blog liés (articles + fiches projets) */
    public function blogPosts(): HasMany
    {
        return $this->hasMany(BlogPost::class);
    }

    /** Publications scientifiques produites par ce projet */
    public function publications(): HasMany
    {
        return $this->hasMany(Publication::class);
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeOngoing(Builder $query): Builder
    {
        return $query->where('status', 'en_cours');
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('display_order')->orderBy('start_date', 'desc');
    }

    /** Filtre par statut : scopeStatus($query, 'en_cours') */
    public function scopeStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }
}
PHP;
        $this->createModel('ResearchProject', $content);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 06 — BlogPost
    // ─────────────────────────────────────────────────────────────────────────

    private function generateBlogPost(): void
    {
        $content = <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'type', 'excerpt', 'body', 'cover_image',
        'author_id', 'category_id', 'research_project_id',
        'reading_time_minutes', 'references',
        'meta_title', 'meta_description',
        'status', 'published_at', 'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'references'   => 'array',
            'published_at' => 'datetime',
            'is_featured'  => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (self $model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug(Str::limit($model->title, 80, ''));
            }
            // Calcul automatique du temps de lecture si non renseigné
            if (empty($model->reading_time_minutes) && $model->body) {
                $words = str_word_count(strip_tags($model->body));
                $model->reading_time_minutes = max(1, (int) ceil($words / 200));
            }
        });
    }

    // ─── Relations ───────────────────────────────────────────────────────────

    /** Auteur (membre de l'équipe) */
    public function author(): BelongsTo
    {
        return $this->belongsTo(TeamMember::class, 'author_id');
    }

    /**
     * Catégorie — relation polymorphique côté enfant.
     * La catégorie correspondante a categorizable_type = 'App\Models\BlogPost'.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /** Projet de recherche lié (optionnel) */
    public function researchProject(): BelongsTo
    {
        return $this->belongsTo(ResearchProject::class);
    }

    /** Tags */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(BlogTag::class, 'blog_post_blog_tag');
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where('status', 'publie')
            ->where('published_at', '<=', now());
    }

    public function scopeArticles(Builder $query): Builder
    {
        return $query->where('type', 'article');
    }

    public function scopeProjectSheets(Builder $query): Builder
    {
        return $query->where('type', 'fiche_projet');
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeRecent(Builder $query, int $days = 90): Builder
    {
        return $query->where('published_at', '>=', now()->subDays($days));
    }
}
PHP;
        $this->createModel('BlogPost', $content);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 07 — Publication
    // ─────────────────────────────────────────────────────────────────────────

    private function generatePublication(): void
    {
        $content = <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'type', 'abstract',
        'journal_or_publisher', 'author_ids', 'external_co_authors',
        'file_path', 'external_url',
        'published_date', 'research_project_id', 'status',
    ];

    protected function casts(): array
    {
        return [
            'author_ids'     => 'array',  // [1, 4] → IDs de team_members
            'published_date' => 'date',
        ];
    }

    // ─── Relations ───────────────────────────────────────────────────────────

    public function researchProject(): BelongsTo
    {
        return $this->belongsTo(ResearchProject::class);
    }

    /**
     * Membres auteurs résolus depuis author_ids (pas de pivot dédié car
     * l'ordre des auteurs est significatif en publication scientifique).
     *
     * @return \Illuminate\Database\Eloquent\Collection<TeamMember>
     */
    public function authors()
    {
        return TeamMember::whereIn('id', $this->author_ids ?? [])
            ->orderByRaw('FIELD(id, ' . implode(',', $this->author_ids ?? [0]) . ')')
            ->get();
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'publie');
    }

    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }

    public function scopeRecent(Builder $query): Builder
    {
        return $query->orderBy('published_date', 'desc');
    }
}
PHP;
        $this->createModel('Publication', $content);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 08 — Resource
    // ─────────────────────────────────────────────────────────────────────────

    private function generateResource(): void
    {
        $content = <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'category_id',
        'file_path', 'external_url', 'status', 'display_order',
    ];

    // ─── Relations ───────────────────────────────────────────────────────────

    /**
     * Catégorie — relation polymorphique côté enfant.
     * La catégorie correspondante a categorizable_type = 'App\Models\Resource'.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('status', 'disponible');
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('display_order')->orderBy('title');
    }
}
PHP;
        $this->createModel('Resource', $content);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 09 — Opportunity
    // ─────────────────────────────────────────────────────────────────────────

    private function generateOpportunity(): void
    {
        $content = <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Opportunity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'category_id', 'description', 'requirements',
        'location', 'contract_type',
        'deadline', 'application_email', 'application_url',
        'status', 'is_published',
    ];

    protected function casts(): array
    {
        return [
            'requirements' => 'array',
            'deadline'     => 'date',
            'is_published' => 'boolean',
        ];
    }

    // ─── Relations ───────────────────────────────────────────────────────────

    /**
     * Catégorie — relation polymorphique côté enfant.
     * La catégorie correspondante a categorizable_type = 'App\Models\Opportunity'.
     * Exemples : "Emploi & Consultance", "Stage & Mentorat", "Bourse", "Partenariat".
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopeOpen(Builder $query): Builder
    {
        return $query
            ->where('status', 'ouverte')
            ->where('is_published', true);
    }

    public function scopeExpiringSoon(Builder $query, int $days = 14): Builder
    {
        return $query
            ->where('status', 'ouverte')
            ->whereBetween('deadline', [now(), now()->addDays($days)]);
    }

    public function scopeOfContractType(Builder $query, string $type): Builder
    {
        return $query->where('contract_type', $type);
    }
}
PHP;
        $this->createModel('Opportunity', $content);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 10 — News
    // ─────────────────────────────────────────────────────────────────────────

    private function generateNews(): void
    {
        $content = <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 'cover_image',
        'category_id', 'blog_post_id',
        'published_date', 'is_featured', 'is_published',
    ];

    protected function casts(): array
    {
        return [
            'published_date' => 'date',
            'is_featured'    => 'boolean',
            'is_published'   => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (self $model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug(Str::limit($model->title, 80, ''));
            }
        });
    }

    // ─── Relations ───────────────────────────────────────────────────────────

    /**
     * Catégorie — relation polymorphique côté enfant.
     * La catégorie correspondante a categorizable_type = 'App\Models\News'.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /** Article de blog complet auquel cette actualité renvoie */
    public function relatedBlogPost(): BelongsTo
    {
        return $this->belongsTo(BlogPost::class, 'blog_post_id');
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeRecent(Builder $query): Builder
    {
        return $query->orderBy('published_date', 'desc');
    }
}
PHP;
        $this->createModel('News', $content);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 11 — ContactSubmission
    // ─────────────────────────────────────────────────────────────────────────

    private function generateContactSubmission(): void
    {
        $content = <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_type', 'full_name', 'email', 'organisation', 'subject',
        'message', 'file_path', 'meta',
        'is_read', 'is_archived',
    ];

    protected function casts(): array
    {
        return [
            'meta'        => 'array',
            'is_read'     => 'boolean',
            'is_archived' => 'boolean',
        ];
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopeUnread(Builder $query): Builder
    {
        return $query->where('is_read', false);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_archived', false);
    }

    public function scopeOfType(Builder $query, string $formType): Builder
    {
        return $query->where('form_type', $formType);
    }

    public function scopeRecent(Builder $query): Builder
    {
        return $query->orderBy('created_at', 'desc');
    }
}
PHP;
        $this->createModel('ContactSubmission', $content);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 12 — NewsletterSubscriber
    // ─────────────────────────────────────────────────────────────────────────

    private function generateNewsletterSubscriber(): void
    {
        $content = <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NewsletterSubscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'email', 'preferences', 'is_active',
        'unsubscribe_token', 'subscribed_at',
    ];

    protected function casts(): array
    {
        return [
            'preferences'   => 'array',
            'is_active'     => 'boolean',
            'subscribed_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            if (empty($model->unsubscribe_token)) {
                $model->unsubscribe_token = Str::random(40);
            }
            if (empty($model->subscribed_at)) {
                $model->subscribed_at = now();
            }
        });
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /** Abonnés intéressés par un thème donné */
    public function scopeInterestedIn(Builder $query, string $topic): Builder
    {
        return $query->whereJsonContains('preferences', $topic);
    }
}
PHP;
        $this->createModel('NewsletterSubscriber', $content);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 13 — SiteSetting
    // ─────────────────────────────────────────────────────────────────────────

    private function generateSiteSetting(): void
    {
        $content = <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * Paramètres globaux du site éditables via FilamentPHP.
 *
 * Usage dans Blade :
 *   {{ SiteSetting::get('mission_text') }}
 *   {{ SiteSetting::get('phone_1', '+228 00 00 00 00') }}
 *
 * Usage en PHP :
 *   SiteSetting::set('hero_title', 'Nouveau titre');
 */
class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'group', 'key', 'value', 'type', 'label', 'display_order',
    ];

    // ─── Helpers statiques ───────────────────────────────────────────────────

    /**
     * Récupère une valeur par sa clé avec mise en cache permanente.
     * Le cache est invalidé automatiquement à chaque modification.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::rememberForever(
            "site_setting_{$key}",
            fn () => static::where('key', $key)->value('value') ?? $default
        );
    }

    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget("site_setting_{$key}");
    }

    protected static function booted(): void
    {
        static::saved(fn (self $s) => Cache::forget("site_setting_{$s->key}"));
        static::deleted(fn (self $s) => Cache::forget("site_setting_{$s->key}"));
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopeOfGroup(Builder $query, string $group): Builder
    {
        return $query->where('group', $group)->orderBy('display_order');
    }
}
PHP;
        $this->createModel('SiteSetting', $content);
    }
}
