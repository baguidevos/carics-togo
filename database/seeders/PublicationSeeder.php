<?php

namespace Database\Seeders;

use App\Models\Publication;
use App\Models\ResearchProject;
use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class PublicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kombate = TeamMember::where('slug', 'gountante-kombate')->first();
        $azianu = TeamMember::where('slug', 'komi-ameko-azianu')->first();
        $cpsProject = ResearchProject::where('slug', 'cps-savanes')->first();

        $publications = [
            [
                'title' => 'Implementation fidelity and coverage of Seasonal Malaria Chemoprevention in cross-border security-compromised settings in Northern Togo: study protocol',
                'type' => 'article_scientifique',
                'abstract' => 'Background: Seasonal Malaria Chemoprevention (SMC) is recommended by WHO in areas with highly seasonal transmission. However, conflict and displacement in border zones present severe operational hurdles. This study investigates implementation fidelity and adherence in the Savanes region of Togo.',
                'journal_or_publisher' => 'BMJ Global Health (En cours de révision)',
                'author_ids' => array_filter([$kombate?->id, $azianu?->id]),
                'external_co_authors' => 'D. Hida, A. Ouedraogo, E. Rouamba, K. S. Somda',
                'file_path' => null,
                'external_url' => 'https://doi.org/10.1136/bmjgh-2026-cps-togo',
                'published_date' => '2026-06-15',
                'research_project_id' => $cpsProject?->id,
                'status' => 'publie',
            ],
            [
                'title' => 'Spatial disparities and determinants of malaria morbidity in children under 5 in West Africa: A multi-country spatial analysis',
                'type' => 'article_scientifique',
                'abstract' => 'This paper explores the geographical clusters of high malaria burden using spatial Bayesian models and Demographic and Health Surveys (DHS) data across Togo, Burkina Faso, and Ghana.',
                'journal_or_publisher' => 'Malaria Journal',
                'author_ids' => array_filter([$kombate?->id]),
                'external_co_authors' => 'J. van der Werf, M. Boele van Hensbroek',
                'file_path' => null,
                'external_url' => 'https://doi.org/10.1186/s12936-025-05120-x',
                'published_date' => '2025-11-20',
                'research_project_id' => null,
                'status' => 'publie',
            ],
            [
                'title' => 'Rapport d\'évaluation préliminaire du premier passage de la CPS 2026 dans les districts de Tône et Cinkassé',
                'type' => 'rapport_technique',
                'abstract' => 'Rapport synthétique décrivant les indicateurs clés de processus, la disponibilité des intrants SPAQ, et le niveau de participation communautaire lors du premier cycle de distribution.',
                'journal_or_publisher' => 'CARICS-Togo Technical Report Series, No. 1',
                'author_ids' => array_filter([$kombate?->id, $azianu?->id]),
                'external_co_authors' => null,
                'file_path' => null,
                'external_url' => null,
                'published_date' => '2026-07-10',
                'research_project_id' => $cpsProject?->id,
                'status' => 'publie',
            ],
            [
                'title' => 'Note de politique : Optimiser la distribution de la CPS en contexte d\'insécurité transfrontalière dans le Nord-Togo',
                'type' => 'note_politique',
                'abstract' => 'Recommandations stratégiques et opérationnelles à l\'attention du Ministère de la Santé, du PNLP et des partenaires techniques et financiers.',
                'journal_or_publisher' => 'CARICS Policy Brief Series',
                'author_ids' => array_filter([$kombate?->id]),
                'external_co_authors' => 'B. W. Nikiema Kombate, A. R. Sedogo',
                'file_path' => null,
                'external_url' => null,
                'published_date' => '2026-08-01',
                'research_project_id' => $cpsProject?->id,
                'status' => 'publie',
            ],
        ];

        foreach ($publications as $pub) {
            Publication::updateOrCreate(
                ['title' => $pub['title']],
                $pub
            );
        }
    }
}
