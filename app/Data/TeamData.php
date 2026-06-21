<?php

namespace App\Data;

class TeamData
{
    /**
     * @return array<string, array{
     *     id: int,
     *     slug: string,
     *     fullName: string,
     *     roleTitle: string,
     *     roleCategory: string,
     *     isFounder: bool,
     *     initials: string,
     *     avatarColor: string,
     *     imageName: string,
     *     bioShort: string,
     *     bioFull: array<string>,
     *     bioQuote: ?string,
     *     missionText: string,
     *     expertises: array<string>,
     *     education: array<array{degree: string, field: string, institution: string}>,
     *     distinctions: array<array{title: string, organisation: string, year: string}>,
     *     affiliations: array<string>,
     *     currentPosition?: string,
     *     relatedProjectSlug: ?string,
     *     links: array{email: string, linkedin: string, orcid: ?string, googleScholar: ?string}
     * }>
     */
    public static function all(): array
    {
        return [
            'gountante-kombate' => [
                'id' => 1,
                'slug' => 'gountante-kombate',
                'fullName' => 'Dr Gountante KOMBATE',
                'roleTitle' => 'Président',
                'roleCategory' => 'bureau_executif',
                'isFounder' => true,
                'initials' => 'GK',
                'avatarColor' => 'primary',
                'imageName' => 'Kombate.jpg',
                'bioShort' => "Épidémiologiste et chercheur en santé mondiale, PhD de l'Université d'Utrecht. Lauréat du Early Career Grant 2025 de la RSTMH.",
                'bioFull' => [
                    "Épidémiologiste et chercheur en santé mondiale, le Dr Gountante KOMBATE est titulaire d'un Doctorat (PhD) en Épidémiologie et Santé Mondiale de l'Université d'Utrecht (Pays-Bas), réalisé sous la co-supervision scientifique de l'Université d'Utrecht et de l'Institute of Tropical Medicine (ITM) d'Anvers (Belgique).",
                    "Il est également titulaire d'un Master spécialisé en Santé Publique (Master of Public Health) avec une spécialisation en Systèmes de Santé et Contrôle des Maladies de l'ITM d'Anvers, ainsi que d'un Master de Recherche en Sciences de la Population et de la Santé de l'Institut Supérieur des Sciences de la Population (ISSP) de l'Université Joseph Ki-Zerbo (Burkina Faso).",
                    "Fort de plus de treize années d'expérience dans la recherche, le suivi-évaluation et la mise en œuvre de programmes de santé en Afrique de l'Ouest (Togo, Burkina Faso, Mali et Niger), il a collaboré avec plusieurs institutions nationales et internationales, notamment RTI International, John Snow, Inc. (JSI), Jhpiego / Johns Hopkins University et FHI 360 et différents programmes nationaux de santé.",
                    "Ses travaux portent principalement sur l'épidémiologie du paludisme, les sciences de la mise en œuvre, la recherche opérationnelle, la santé communautaire, le renforcement des systèmes de santé et la santé numérique.",
                    'Il est auteur et co-auteur de plusieurs publications scientifiques dans des revues internationales à comité de lecture.',
                ],
                'bioQuote' => "Lauréat du Early Career Grant 2025 de la Royal Society of Tropical Medicine and Hygiene (RSTMH, Royaume-Uni), il dirige actuellement un projet de recherche portant sur la mise en œuvre de la ChimioPrévention Saisonnière du Paludisme dans les zones transfrontalières confrontées à l'insécurité dans le nord du Togo.",
                'missionText' => "En tant que Président et membre fondateur de CARICS-Togo, le Dr Kombaté assure l'orientation stratégique et scientifique de l'organisation, développe les partenariats nationaux et internationaux et veille à la production de données probantes de haute qualité au service de la santé publique en Afrique.",
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
                'relatedProjectSlug' => 'cps-savanes',
                'links' => [
                    'email' => 'contact@carics-togo.org',
                    'linkedin' => '#',
                    'orcid' => '#',
                    'googleScholar' => '#',
                ],
            ],

            'berthilde-nikiema-kombate' => [
                'id' => 2,
                'slug' => 'berthilde-nikiema-kombate',
                'fullName' => 'Berthilde W. NIKIEMA KOMBATE',
                'roleTitle' => 'Secrétaire Générale',
                'roleCategory' => 'bureau_executif',
                'isFounder' => true,
                'initials' => 'BN',
                'avatarColor' => 'alt-1',
                'imageName' => 'berthilde.png',
                'bioShort' => 'Juriste conseil spécialisée en droit public, gouvernance institutionnelle et commande publique.',
                'bioFull' => [
                    "Juriste conseil spécialisée en droit public, gouvernance institutionnelle et commande publique, Mme NIKIEMA W. Berthilde est titulaire d'une Licence en Droit Administratif, d'une Maîtrise en Droit Public des Affaires et d'un Master en Commande Publique (marchés publics et privés).",
                    "Elle a également suivi plusieurs formations professionnelles et obtenu diverses certifications en partenariats public-privé, financement de projets, ainsi qu'en passation et gestion des marchés publics conformément aux procédures des bailleurs de fonds internationaux.",
                    "Grâce à son expertise en droit public, en commande publique et en gestion des partenariats, elle contribue au développement des relations institutionnelles, à la mobilisation d'opportunités de collaboration et au renforcement des capacités organisationnelles de CARICS-Togo.",
                ],
                'bioQuote' => null,
                'missionText' => "Au sein de CARICS-Togo, elle assure la coordination administrative et institutionnelle de l'organisation. Elle veille à la bonne gouvernance, à la conformité administrative, à la gestion documentaire et au suivi des décisions des instances dirigeantes.",
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
                'relatedProjectSlug' => null,
                'links' => [
                    'email' => 'contact@carics-togo.org',
                    'linkedin' => '#',
                    'orcid' => null,
                    'googleScholar' => null,
                ],
            ],

            'abdoul-rassidou-sedogo' => [
                'id' => 3,
                'slug' => 'abdoul-rassidou-sedogo',
                'fullName' => 'Abdoul Rassidou SEDOGO',
                'roleTitle' => 'Trésorier Général',
                'roleCategory' => 'bureau_executif',
                'isFounder' => true,
                'initials' => 'AS',
                'avatarColor' => 'alt-2',
                'imageName' => 'sedogo.jpg',
                'bioShort' => "Gestionnaire financier senior, plus de 13 ans d'expérience en gestion financière de programmes de santé internationaux.",
                'bioFull' => [
                    "Gestionnaire financier senior spécialisé dans la gestion financière des programmes et projets de développement, M. Abdoul Rassidou SEDOGO cumule plus de treize années d'expérience en comptabilité, audit, contrôle interne, gestion budgétaire et conformité financière.",
                    "Il est titulaire d'un Master en Comptabilité, Contrôle et Audit, d'une Licence Professionnelle en Finance et Audit Comptable ainsi que d'un Diplôme Universitaire de Technologie en Finance-Comptabilité et Gestion des Entreprises.",
                    'Au cours de sa carrière, il a assuré la gestion financière de nombreux projets financés par des partenaires techniques et financiers internationaux, notamment USAID, CDC, le Fonds mondial, le Programme des Nations Unies pour le Développement (PNUD) et UNITAID.',
                    'Il occupe actuellement le poste de Finance Manager chez Jhpiego Burkina Faso, où il supervise la planification budgétaire, le contrôle financier, la conformité des dépenses et le reporting financier de programmes de santé publique de grande envergure.',
                ],
                'bioQuote' => null,
                'missionText' => "Au sein de CARICS-Togo, il veille à la bonne gestion des ressources financières de l'organisation et contribue à la mise en place de mécanismes de gouvernance financière conformes aux standards internationaux de transparence et de redevabilité.",
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
                'currentPosition' => 'Finance Manager chez Jhpiego Burkina Faso',
                'relatedProjectSlug' => null,
                'links' => [
                    'email' => 'contact@carics-togo.org',
                    'linkedin' => '#',
                    'orcid' => null,
                    'googleScholar' => null,
                ],
            ],

            'komi-ameko-azianu' => [
                'id' => 4,
                'slug' => 'komi-ameko-azianu',
                'fullName' => 'Komi Ameko AZIANU',
                'roleTitle' => 'Directeur des Programmes & de la Recherche',
                'roleCategory' => 'bureau_executif',
                'isFounder' => true,
                'initials' => 'KA',
                'avatarColor' => 'alt-3',
                'imageName' => 'azianu.png',
                'bioShort' => "Démographe, doctorant en Démographie à l'ISSP, lauréat de la bourse Chaire UNESCO 2023.",
                'bioFull' => [
                    "Démographe et chercheur en population et santé, M. Komi Ameko AZIANU est titulaire d'un Master de Recherche en Population et Santé de l'Institut Supérieur des Sciences de la Population (ISSP) de l'Université Joseph Ki-Zerbo (Burkina Faso), où il poursuit actuellement un doctorat en Démographie.",
                    "Assistant de Recherche à l'ISSP, il possède une expertise reconnue en méthodes quantitatives et qualitatives, en analyse de données et en gestion de projets de recherche.",
                    'Ses travaux portent notamment sur les dynamiques migratoires, le changement climatique, la santé environnementale, la santé sexuelle et reproductive ainsi que les interactions entre population, santé et développement.',
                    'Il contribue activement à la production et à la diffusion des connaissances scientifiques à travers des publications et des communications lors de conférences nationales et internationales.',
                ],
                'bioQuote' => "Lauréat d'une bourse de jeune chercheur de la Chaire UNESCO « Défis partagés du développement : savoir, comprendre, agir » en 2023.",
                'missionText' => "Au sein de CARICS-Togo, il coordonne les activités scientifiques et techniques des projets de recherche, participe au développement des partenariats académiques et contribue au renforcement des capacités de recherche de l'organisation.",
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
                'currentPosition' => 'Assistant de Recherche à l\'ISSP',
                'relatedProjectSlug' => 'cps-savanes',
                'links' => [
                    'email' => 'contact@carics-togo.org',
                    'linkedin' => '#',
                    'orcid' => null,
                    'googleScholar' => null,
                ],
            ],
        ];
    }

    /**
     * @return ?array{
     *     id: int,
     *     slug: string,
     *     fullName: string,
     *     roleTitle: string,
     *     roleCategory: string,
     *     isFounder: bool,
     *     initials: string,
     *     avatarColor: string,
     *     imageName: string,
     *     bioShort: string,
     *     bioFull: array<string>,
     *     bioQuote: ?string,
     *     missionText: string,
     *     expertises: array<string>,
     *     education: array<array{degree: string, field: string, institution: string}>,
     *     distinctions: array<array{title: string, organisation: string, year: string}>,
     *     affiliations: array<string>,
     *     currentPosition?: string,
     *     relatedProjectSlug: ?string,
     *     links: array{email: string, linkedin: string, orcid: ?string, googleScholar: ?string}
     * }
     */
    public static function find(string $slug): ?array
    {
        return self::all()[$slug] ?? null;
    }
}
