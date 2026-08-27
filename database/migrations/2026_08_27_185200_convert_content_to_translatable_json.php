<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Helper to encode existing text as JSON if not already JSON
     */
    private function toJsonLocale(?string $value, string $locale = 'fr'): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        // Si c'est déjà un JSON valide représentant des traductions
        $decoded = json_decode($value, true);
        if (is_array($decoded) && (isset($decoded['fr']) || isset($decoded['en']))) {
            return $value;
        }

        return json_encode([$locale => $value], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function up(): void
    {
        // 1. News
        if (Schema::hasTable('news')) {
            $newsRows = DB::table('news')->get();
            foreach ($newsRows as $row) {
                DB::table('news')->where('id', $row->id)->update([
                    'title' => $this->toJsonLocale($row->title),
                    'slug' => $this->toJsonLocale($row->slug),
                    'excerpt' => $this->toJsonLocale($row->excerpt),
                    'content' => $this->toJsonLocale($row->content),
                    'location' => $this->toJsonLocale($row->location ?? null),
                ]);
            }
        }

        // 2. Blog Posts
        if (Schema::hasTable('blog_posts')) {
            $blogRows = DB::table('blog_posts')->get();
            foreach ($blogRows as $row) {
                DB::table('blog_posts')->where('id', $row->id)->update([
                    'title' => $this->toJsonLocale($row->title),
                    'slug' => $this->toJsonLocale($row->slug),
                    'excerpt' => $this->toJsonLocale($row->excerpt),
                    'body' => $this->toJsonLocale($row->body),
                    'meta_title' => $this->toJsonLocale($row->meta_title ?? null),
                    'meta_description' => $this->toJsonLocale($row->meta_description ?? null),
                ]);
            }
        }

        // 3. Categories
        if (Schema::hasTable('categories')) {
            $catRows = DB::table('categories')->get();
            foreach ($catRows as $row) {
                DB::table('categories')->where('id', $row->id)->update([
                    'name' => $this->toJsonLocale($row->name),
                    'slug' => $this->toJsonLocale($row->slug),
                    'description' => $this->toJsonLocale($row->description ?? null),
                ]);
            }
        }

        // 4. Team Members
        if (Schema::hasTable('team_members')) {
            $teamRows = DB::table('team_members')->get();
            foreach ($teamRows as $row) {
                DB::table('team_members')->where('id', $row->id)->update([
                    'role_title' => $this->toJsonLocale($row->role_title),
                    'bio_short' => $this->toJsonLocale($row->bio_short ?? null),
                    'bio_full' => $this->toJsonLocale($row->bio_full ?? null),
                    'bio_quote' => $this->toJsonLocale($row->bio_quote ?? null),
                    'mission_text' => $this->toJsonLocale($row->mission_text ?? null),
                    'current_position' => $this->toJsonLocale($row->current_position ?? null),
                ]);
            }
        }

        // 5. Research Projects
        if (Schema::hasTable('research_projects')) {
            $projRows = DB::table('research_projects')->get();
            foreach ($projRows as $row) {
                DB::table('research_projects')->where('id', $row->id)->update([
                    'title' => $this->toJsonLocale($row->title),
                    'slug' => $this->toJsonLocale($row->slug),
                    'context' => $this->toJsonLocale($row->context ?? null),
                    'objective' => $this->toJsonLocale($row->objective ?? null),
                    'methodology' => $this->toJsonLocale($row->methodology ?? null),
                ]);
            }
        }

        // 6. Publications
        if (Schema::hasTable('publications')) {
            $pubRows = DB::table('publications')->get();
            foreach ($pubRows as $row) {
                DB::table('publications')->where('id', $row->id)->update([
                    'title' => $this->toJsonLocale($row->title),
                    'abstract' => $this->toJsonLocale($row->abstract ?? null),
                ]);
            }
        }

        // 7. Opportunities
        if (Schema::hasTable('opportunities')) {
            $oppRows = DB::table('opportunities')->get();
            foreach ($oppRows as $row) {
                DB::table('opportunities')->where('id', $row->id)->update([
                    'title' => $this->toJsonLocale($row->title),
                    'description' => $this->toJsonLocale($row->description ?? null),
                    'location' => $this->toJsonLocale($row->location ?? null),
                ]);
            }
        }

        // 8. Resources
        if (Schema::hasTable('resources')) {
            $resRows = DB::table('resources')->get();
            foreach ($resRows as $row) {
                DB::table('resources')->where('id', $row->id)->update([
                    'title' => $this->toJsonLocale($row->title),
                    'description' => $this->toJsonLocale($row->description ?? null),
                ]);
            }
        }
    }

    public function down(): void
    {
        // Pas d'inversion destructive
    }
};
