<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Opportunity;
use Illuminate\Database\Seeder;

class OpportunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catStage = Category::forModel(Opportunity::class)->where('slug', 'stages-mentorat')->first();
        $catEmploi = Category::forModel(Opportunity::class)->where('slug', 'emplois-recrutements')->first();

        $opportunities = [
            [
                'title' => 'Stage de recherche en Épidémiologie et Santé Communautaire',
                'category_id' => $catStage?->id,
                'description' => 'CARICS-Togo accueille des stagiaires Master et Doctorat motivés pour participer aux activités de collecte de données, nettoyage statistique et analyse qualitative sur le projet CPS Savanes.',
                'requirements' => [
                    'Inscrit en Master 2 ou Doctorat en santé publique, épidémiologie, démographie ou statistiques',
                    'Bonne maîtrise des outils d\'analyse de données (R, Stata, Python ou QGIS)',
                    'Capacité de travail en équipe multidisciplinaire et autonomie',
                    'Résidence ou mobilité dans la Région des Savanes (Togo)',
                ],
                'location' => 'Dapaong, Région des Savanes, Togo',
                'contract_type' => 'stage',
                'deadline' => now()->addMonths(3),
                'application_email' => 'contact@carics-togo.org',
                'application_url' => null,
                'status' => 'ouverte',
                'is_published' => true,
            ],
            [
                'title' => 'Appel à candidatures spontanées : Consultants & Experts techniques',
                'category_id' => $catEmploi?->id,
                'description' => 'Constitution d\'un vivier d\'experts pour nos prochaines missions d\'évaluation de programmes, enquêtes de santé publique et formations.',
                'requirements' => [
                    'Diplôme supérieur (Bac+5 minimum) en santé publique, médecine, économie de la santé ou sociologie',
                    'Au moins 5 années d\'expérience probante en Afrique de l\'Ouest',
                    'Excellente maîtrise du français et de l\'anglais',
                ],
                'location' => 'Togo / À distance',
                'contract_type' => 'consultance',
                'deadline' => now()->addMonths(6),
                'application_email' => 'contact@carics-togo.org',
                'application_url' => null,
                'status' => 'ouverte',
                'is_published' => true,
            ],
        ];

        foreach ($opportunities as $opp) {
            Opportunity::updateOrCreate(
                ['title' => $opp['title']],
                $opp
            );
        }
    }
}
