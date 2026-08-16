<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            'gountante-kombate' => [
                'full_name' => 'Dr Gountante KOMBATE',
                'slug' => 'gountante-kombate',
                'role_title' => 'Président',
                'role_category' => 'bureau_executif',
                'is_founder' => true,
                'avatar_color' => 'primary',
                'photo' => 'Kombate.jpg',
                'bio_short' => "Épidémiologiste et chercheur en santé mondiale, PhD de l'Université d'Utrecht. Lauréat du Early Career Grant 2025 de la RSTMH.",
                'bio_full' => [
                    "Épidémiologiste et chercheur en santé mondiale, le Dr Gountante KOMBATE est titulaire d'un Doctorat (PhD) en Épidémiologie et Santé Mondiale de l'Université d'Utrecht (Pays-Bas), réalisé sous la co-supervision scientifique de l'Université d'Utrecht et de l'Institute of Tropical Medicine (ITM) d'Anvers (Belgique).",
                    "Il est également titulaire d'un Master spécialisé en Santé Publique (Master of Public Health) avec une spécialisation en Systèmes de Santé et Contrôle des Maladies de l'ITM d'Anvers, ainsi que d'un Master de Recherche en Sciences de la Population et de la Santé de l'Institut Supérieur des Sciences de la Population (ISSP) de l'Université Joseph Ki-Zerbo (Burkina Faso).",
                    "Fort de plus de treize années d'expérience dans la recherche, le suivi-évaluation et la mise en œuvre de programmes de santé en Afrique de l'Ouest (Togo, Burkina Faso, Mali et Niger), il a collaboré avec plusieurs institutions nationales et internationales, notamment RTI International, John Snow, Inc. (JSI), Jhpiego / Johns Hopkins University et FHI 360 et différents programmes nationaux de santé.",
                    "Ses travaux portent principalement sur l'épidémiologie du paludisme, les sciences de la mise en œuvre, la recherche opérationnelle, la santé communautaire, le renforcement des systèmes de santé et la santé numérique.",
                    'Il est auteur et co-auteur de plusieurs publications scientifiques dans des revues internationales à comité de lecture.',
                ],
                'bio_quote' => "Lauréat du Early Career Grant 2025 de la Royal Society of Tropical Medicine and Hygiene (RSTMH, Royaume-Uni), il dirige actuellement un projet de recherche portant sur la mise en œuvre de la ChimioPrévention Saisonnière du Paludisme dans les zones transfrontalières confrontées à l'insécurité dans le nord du Togo.",
                'mission_text' => "En tant que Président et membre fondateur de CARICS-Togo, le Dr Kombaté assure l'orientation stratégique et scientifique de l'organisation, développe les partenariats nationaux et internationaux et veille à la production de données probantes de haute qualité au service de la santé publique en Afrique.",
                'expertises' => [
                    'Épidémiologie et santé mondiale',
                    'Paludisme et maladies infectieuses',
                    'Sciences de la mise en œuvre',
                    'Recherche opérationnelle',
                    'Renforcement des systèmes de santé',
                    'Santé communautaire',
                    'Analyse spatiale et systèmes d\'information géographique (SIG)',
                    'Suivi-évaluation et utilisation des données',
                    'Santé numérique et systèmes d\'information sanitaire',
                ],
                'education' => [
                    ['degree' => 'PhD', 'field' => 'Épidémiologie et Santé Mondiale', 'institution' => 'Université d\'Utrecht (Pays-Bas) — co-supervision ITM Anvers'],
                    ['degree' => 'MPH', 'field' => 'Systèmes de Santé et Contrôle des Maladies', 'institution' => 'Institute of Tropical Medicine, Anvers (Belgique)'],
                    ['degree' => 'Master de Recherche', 'field' => 'Sciences de la Population et de la Santé', 'institution' => 'ISSP, Université Joseph Ki-Zerbo (Burkina Faso)'],
                ],
                'distinctions' => [
                    ['title' => 'Early Career Grant 2025', 'organisation' => 'Royal Society of Tropical Medicine and Hygiene (RSTMH), Royaume-Uni', 'year' => '2025'],
                ],
                'affiliations' => [
                    'RTI International',
                    'John Snow, Inc. (JSI)',
                    'Jhpiego / Johns Hopkins University',
                    'FHI 360',
                ],
                'related_project_slug' => 'cps-savanes',
                'email' => 'contact@carics-togo.org',
                'linkedin_url' => '#',
                'orcid_url' => '#',
                'google_scholar_url' => '#',
                'is_published' => true,
                'display_order' => 1,
            ],

            'berthilde-nikiema-kombate' => [
                'full_name' => 'Berthilde W. NIKIEMA KOMBATE',
                'slug' => 'berthilde-nikiema-kombate',
                'role_title' => 'Secrétaire Générale',
                'role_category' => 'bureau_executif',
                'is_founder' => true,
                'avatar_color' => 'alt-1',
                'photo' => 'berthilde.png',
                'bio_short' => 'Juriste conseil spécialisée en droit public, gouvernance institutionnelle et commande publique.',
                'bio_full' => [
                    "Juriste conseil spécialisée en droit public, gouvernance institutionnelle et commande publique, Mme NIKIEMA W. Berthilde est titulaire d'une Licence en Droit Administratif, d'une Maîtrise en Droit Public des Affaires et d'un Master en Commande Publique (marchés publics et privés).",
                    "Elle a également suivi plusieurs formations professionnelles et obtenu diverses certifications en partenariats public-privé, financement de projets, ainsi qu'en passation et gestion des marchés publics conformément aux procédures des bailleurs de fonds internationaux.",
                    "Grâce à son expertise en droit public, en commande publique et en gestion des partenariats, elle contribue au développement des relations institutionnelles, à la mobilisation d'opportunités de collaboration et au renforcement des capacités organisationnelles de CARICS-Togo.",
                ],
                'bio_quote' => null,
                'mission_text' => "Au sein de CARICS-Togo, elle assure la coordination administrative et institutionnelle de l'organisation. Elle veille à la bonne gouvernance, à la conformité administrative, à la gestion documentaire et au suivi des décisions des instances dirigeantes.",
                'expertises' => [
                    'Droit administratif',
                    'Droit public des affaires',
                    'Commande publique (marchés publics et privés)',
                    'Partenariats public-privé',
                    'Financement de projets',
                    'Gouvernance institutionnelle',
                    'Gestion documentaire et conformité',
                ],
                'education' => [
                    ['degree' => 'Licence', 'field' => 'Droit Administratif', 'institution' => ''],
                    ['degree' => 'Maîtrise', 'field' => 'Droit Public des Affaires', 'institution' => ''],
                    ['degree' => 'Master', 'field' => 'Commande Publique (marchés publics et privés)', 'institution' => ''],
                ],
                'distinctions' => [],
                'affiliations' => [],
                'related_project_slug' => null,
                'email' => 'contact@carics-togo.org',
                'linkedin_url' => '#',
                'orcid_url' => null,
                'google_scholar_url' => null,
                'is_published' => true,
                'display_order' => 2,
            ],

            'abdoul-rassidou-sedogo' => [
                'full_name' => 'Abdoul Rassidou SEDOGO',
                'slug' => 'abdoul-rassidou-sedogo',
                'role_title' => 'Trésorier Général',
                'role_category' => 'bureau_executif',
                'is_founder' => true,
                'avatar_color' => 'alt-2',
                'photo' => 'sedogo.jpg',
                'bio_short' => "Gestionnaire financier senior, plus de 13 ans d'expérience en gestion financière de programmes de santé internationaux.",
                'bio_full' => [
                    "Gestionnaire financier senior spécialisé dans la gestion financière des programmes et projets de développement, M. Abdoul Rassidou SEDOGO cumule plus de treize années d'expérience en comptabilité, audit, contrôle interne, gestion budgétaire et conformité financière.",
                    "Il est titulaire d'un Master en Comptabilité, Contrôle et Audit, d'une Licence Professionnelle en Finance et Audit Comptable ainsi que d'un Diplôme Universitaire de Technologie en Finance-Comptabilité et Gestion des Entreprises.",
                    'Au cours de sa carrière, il a assuré la gestion financière de nombreux projets financés par des partenaires techniques et financiers internationaux, notamment USAID, CDC, le Fonds mondial, le Programme des Nations Unies pour le Développement (PNUD) et UNITAID.',
                    'Il occupe actuellement le poste de Finance Manager chez Jhpiego Burkina Faso, où il supervise la planification budgétaire, le contrôle financier, la conformité des dépenses et le reporting financier de programmes de santé publique de grande envergure.',
                ],
                'bio_quote' => null,
                'mission_text' => "Au sein de CARICS-Togo, il veille à la bonne gestion des ressources financières de l'organisation et contribue à la mise en place de mécanismes de gouvernance financière conformes aux standards internationaux de transparence et de redevabilité.",
                'expertises' => [
                    'Gestion financière des subventions et projets',
                    'Élaboration et suivi budgétaire',
                    'Comptabilité et audit',
                    'Contrôle interne',
                    'Gestion des risques',
                    'Trésorerie',
                    'Conformité financière des bailleurs internationaux',
                    'Renforcement des systèmes de gestion financière',
                ],
                'education' => [
                    ['degree' => 'Master', 'field' => 'Comptabilité, Contrôle et Audit', 'institution' => ''],
                    ['degree' => 'Licence Professionnelle', 'field' => 'Finance et Audit Comptable', 'institution' => ''],
                    ['degree' => 'DUT', 'field' => 'Finance-Comptabilité et Gestion des Entreprises', 'institution' => ''],
                ],
                'distinctions' => [],
                'affiliations' => [
                    'USAID',
                    'CDC',
                    'Fonds mondial',
                    'PNUD',
                    'UNITAID',
                    'Jhpiego Burkina Faso',
                ],
                'current_position' => 'Finance Manager chez Jhpiego Burkina Faso',
                'related_project_slug' => null,
                'email' => 'contact@carics-togo.org',
                'linkedin_url' => '#',
                'orcid_url' => null,
                'google_scholar_url' => null,
                'is_published' => true,
                'display_order' => 3,
            ],

            'komi-ameko-azianu' => [
                'full_name' => 'Komi Ameko AZIANU',
                'slug' => 'komi-ameko-azianu',
                'role_title' => 'Directeur des Programmes & de la Recherche',
                'role_category' => 'bureau_executif',
                'is_founder' => true,
                'avatar_color' => 'alt-3',
                'photo' => 'azianu.png',
                'bio_short' => "Démographe, doctorant en Démographie à l'ISSP, lauréat de la bourse Chaire UNESCO 2023.",
                'bio_full' => [
                    "Démographe et chercheur en population et santé, M. Komi Ameko AZIANU est titulaire d'un Master de Recherche en Population et Santé de l'Institut Supérieur des Sciences de la Population (ISSP) de l'Université Joseph Ki-Zerbo (Burkina Faso), où il poursuit actuellement un doctorat en Démographie.",
                    "Assistant de Recherche à l'ISSP, il possède une expertise reconnue en méthodes quantitatives et qualitatives, en analyse de données et en gestion de projets de recherche.",
                    'Ses travaux portent notamment sur les dynamiques migratoires, le changement climatique, la santé environnementale, la santé sexuelle et reproductive ainsi que les interactions entre population, santé et développement.',
                    'Il contribue activement à la production et à la diffusion des connaissances scientifiques à travers des publications et des communications lors de conférences nationales et internationales.',
                ],
                'bio_quote' => "Lauréat d'une bourse de jeune chercheur de la Chaire UNESCO « Défis partagés du développement : savoir, comprendre, agir » en 2023.",
                'mission_text' => "Au sein de CARICS-Togo, il coordonne les activités scientifiques et techniques des projets de recherche, participe au développement des partenariats académiques et contribue au renforcement des capacités de recherche de l'organisation.",
                'expertises' => [
                    'Démographie',
                    'Méthodes quantitatives et qualitatives',
                    'Analyse de données',
                    'Dynamiques migratoires',
                    'Changement climatique et santé environnementale',
                    'Santé sexuelle et reproductive',
                    'Population, santé et développement',
                    'Gestion de projets de recherche',
                ],
                'education' => [
                    ['degree' => 'Master de Recherche', 'field' => 'Population et Santé', 'institution' => 'ISSP, Université Joseph Ki-Zerbo (Burkina Faso)'],
                    ['degree' => 'Doctorat (en cours)', 'field' => 'Démographie', 'institution' => 'ISSP, Université Joseph Ki-Zerbo (Burkina Faso)'],
                ],
                'distinctions' => [
                    ['title' => 'Bourse de jeune chercheur — Chaire UNESCO « Défis partagés du développement : savoir, comprendre, agir »', 'organisation' => 'UNESCO', 'year' => '2023'],
                ],
                'affiliations' => [
                    'Institut Supérieur des Sciences de la Population (ISSP)',
                ],
                'current_position' => 'Assistant de Recherche à l\'ISSP',
                'related_project_slug' => 'cps-savanes',
                'email' => 'contact@carics-togo.org',
                'linkedin_url' => '#',
                'orcid_url' => null,
                'google_scholar_url' => null,
                'is_published' => true,
                'display_order' => 4,
            ],
        ];

        foreach ($members as $data) {
            TeamMember::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
