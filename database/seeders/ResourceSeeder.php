<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Resource;
use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catArticles = Category::forModel(Resource::class)->where('slug', 'articles-scientifiques')->first();
        $catRapports = Category::forModel(Resource::class)->where('slug', 'rapports-techniques')->first();
        $catBriefs = Category::forModel(Resource::class)->where('slug', 'notes-de-politique')->first();
        $catGuides = Category::forModel(Resource::class)->where('slug', 'guides-outils')->first();

        $resources = [
            [
                'title' => 'Protocole d\'enquête d\'évaluation de la CPS en contexte transfrontalier',
                'description' => 'Guide méthodologique détaillé pour l\'échantillonnage et la collecte de données auprès des ménages après campagne de CPS.',
                'category_id' => $catGuides?->id,
                'file_path' => 'resources/protocole-cps-2026.pdf',
                'external_url' => null,
                'status' => 'disponible',
                'display_order' => 1,
            ],
            [
                'title' => 'Rapport annuel 2026 des activités et projets de recherche CARICS-Togo',
                'description' => 'Bilan des initiatives scientifiques, partenariats académiques et perspectives stratégiques pour l\'année à venir.',
                'category_id' => $catRapports?->id,
                'file_path' => 'resources/rapport-annuel-2026.pdf',
                'external_url' => null,
                'status' => 'disponible',
                'display_order' => 2,
            ],
            [
                'title' => 'Note stratégique : Intégration de la santé numérique dans la surveillance sentinelle du paludisme',
                'description' => 'Synthèse pour les décideurs sur les gains d\'efficience apportés par la remontée des données mobiles en temps réel.',
                'category_id' => $catBriefs?->id,
                'file_path' => 'resources/note-sante-numerique.pdf',
                'external_url' => null,
                'status' => 'disponible',
                'display_order' => 3,
            ],
        ];

        foreach ($resources as $res) {
            Resource::updateOrCreate(
                ['title' => $res['title']],
                $res
            );
        }
    }
}
