<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catRecherche = Category::forModel(News::class)->where('slug', 'recherche-projets-news')->first();
        $catInstitutionnel = Category::forModel(News::class)->where('slug', 'institutionnel')->first();
        $catEvents = Category::forModel(News::class)->where('slug', 'evenements-seminaires')->first();

        $newsItems = [
            [
                'title' => 'CARICS-Togo lance son premier projet de recherche financé à l’international',
                'slug' => 'lancement-projet-cps-savanes-rstmh',
                'excerpt' => 'Avec le soutien de la Royal Society of Tropical Medicine and Hygiene (RSTMH), CARICS-Togo démarre un projet sur la mise en œuvre de la CPS dans la Région des Savanes.',
                'content' => 'Ce projet marque une étape majeure pour CARICS-Togo, qui obtient son premier financement international quelques mois seulement après sa création. Il portera sur la fidélité de mise en œuvre, la couverture et l’adhésion à la CPS dans un contexte transfrontalier complexe.',
                'category_id' => $catRecherche?->id,
                'published_date' => '2026-06-01',
                'is_featured' => true,
                'is_published' => true,
            ],
            [
                'title' => 'CARICS-Togo officiellement enregistré à Dapaong',
                'slug' => 'enregistrement-officiel-dapaong',
                'excerpt' => 'Le Centre Africain d’Action pour la Recherche et l’Innovation Communautaire en Santé obtient son enregistrement officiel auprès des autorités togolaises.',
                'content' => 'Le Centre Africain d’Action pour la Recherche et l’Innovation Communautaire en Santé (CARICS-Togo) a obtenu son statut légal d’association et centre de recherche à Dapaong (Préfecture de Tône, Région des Savanes).',
                'category_id' => $catInstitutionnel?->id,
                'published_date' => '2026-03-15',
                'is_featured' => false,
                'is_published' => true,
            ],
            [
                'title' => 'Présentation des premiers résultats lors d’un séminaire régional',
                'slug' => 'presentation-resultats-seminaire-regional',
                'excerpt' => 'L’équipe CARICS prévoit de présenter les premières données terrain du projet CPS lors d’un séminaire régional sur la santé communautaire en Afrique de l’Ouest.',
                'content' => 'Un séminaire regroupant chercheurs, décideurs et acteurs communautaires sera organisé afin de partager les résultats préliminaires et d’engager un dialogue constructif.',
                'category_id' => $catEvents?->id,
                'published_date' => '2026-09-20',
                'is_featured' => false,
                'is_published' => true,
            ],
        ];

        foreach ($newsItems as $news) {
            News::updateOrCreate(
                ['slug' => $news['slug']],
                $news
            );
        }
    }
}
