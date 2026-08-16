<?php

namespace Database\Seeders;

use App\Models\Partner;
use App\Models\ResearchProject;
use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class ResearchProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lead = TeamMember::where('slug', 'gountante-kombate')->first();
        $coLead = TeamMember::where('slug', 'komi-ameko-azianu')->first();
        $rstmh = Partner::where('name', 'RSTMH')->first();
        $pnlp = Partner::where('name', 'PNLP Togo')->first();

        $project = ResearchProject::updateOrCreate(
            ['slug' => 'cps-savanes'],
            [
                'title' => 'Évaluation de la fidélité de mise en œuvre, de la couverture et de l’adhésion à la ChimioPrévention du Paludisme Saisonnier (CPS) dans la Région des Savanes au Togo',
                'status' => 'en_cours',
                'funder' => 'Royal Society of Tropical Medicine and Hygiene (RSTMH)',
                'start_date' => '2026-06-01',
                'end_date' => '2027-05-31',
                'country' => 'Togo',
                'region' => 'Région des Savanes',
                'intervention_zones' => ['Tône', 'Kpendjal', 'Kpendjal-Ouest', 'Oti', 'Oti-Sud', 'Tandjouaré', 'Cinkassé'],
                'map_lat' => 10.8634,
                'map_lng' => 0.2074,
                'context' => 'La Région des Savanes au Togo fait face à une transmission palustre hautement saisonnière et à des défis sécuritaires et migratoires transfrontaliers. La CPS y constitue une stratégie clé pour protéger les enfants de moins de 5 ans contre le paludisme grave.',
                'objective' => "Mesurer avec rigueur la fidélité de mise en œuvre des cycles de CPS, évaluer la couverture effective et identifier les déterminants socio-comportementaux de l'adhésion complète au traitement chez les enfants ciblés.",
                'methodology' => "Approche mixte combinant des enquêtes quantitatives représentatives auprès des ménages après chaque passage de CPS, des observations directes de l'administration des doses par les distributeurs communautaires, et des entretiens qualitatifs approfondis avec les soignants, leaders communautaires et professionnels de santé.",
                'expected_results' => [
                    'Estimation précise des taux de couverture administrative vs couverture réelle vérifiée.',
                    "Cartographie des goulots d'étranglement de la fidélité d'administration des jours 2 et 3.",
                    'Recommandations opérationnelles concrètes transmises au Ministère de la Santé et au PNLP pour adapter les futures campagnes.',
                    'Publications scientifiques internationales et notes de politique pour les décideurs de la sous-région.',
                ],
                'research_domains' => [
                    'Paludisme et maladies infectieuses',
                    'Sciences de la mise en œuvre',
                    'Santé communautaire',
                    'Épidémiologie de terrain',
                    'Suivi-évaluation des programmes',
                ],
                'lead_id' => $lead?->id,
                'is_featured' => true,
                'is_published' => true,
                'display_order' => 1,
            ]
        );

        // Attacher l'équipe
        if ($lead) {
            $project->teamMembers()->syncWithoutDetaching([
                $lead->id => ['role_on_project' => 'Investigateur Principal (PI)'],
            ]);
        }
        if ($coLead) {
            $project->teamMembers()->syncWithoutDetaching([
                $coLead->id => ['role_on_project' => 'Co-investigateur & Coordonnateur terrain'],
            ]);
        }

        // Attacher les partenaires
        $partnerIds = array_filter([$rstmh?->id, $pnlp?->id]);
        if (! empty($partnerIds)) {
            $project->partners()->syncWithoutDetaching($partnerIds);
        }
    }
}
