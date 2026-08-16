<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\News;
use App\Models\Opportunity;
use App\Models\Resource;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            // BlogPost categories
            [
                'name' => 'Épidémiologie & Santé Mondiale',
                'slug' => 'epidemiologie-sante-mondiale',
                'color_class' => 'primary',
                'description' => 'Articles et analyses sur l\'épidémiologie des maladies transmissibles et non transmissibles.',
                'categorizable_type' => BlogPost::class,
                'display_order' => 1,
            ],
            [
                'name' => 'Paludisme & CPS',
                'slug' => 'paludisme-cps',
                'color_class' => 'accent',
                'description' => 'Recherches sur le contrôle et l\'élimination du paludisme, ChimioPrévention Saisonnière.',
                'categorizable_type' => BlogPost::class,
                'display_order' => 2,
            ],
            [
                'name' => 'Sciences de la Mise en Œuvre',
                'slug' => 'sciences-mise-en-oeuvre',
                'color_class' => 'info',
                'description' => 'Méthodologies, fidélité et faisabilité des interventions de santé en vie réelle.',
                'categorizable_type' => BlogPost::class,
                'display_order' => 3,
            ],
            [
                'name' => 'Santé Communautaire',
                'slug' => 'sante-communautaire',
                'color_class' => 'success',
                'description' => 'Engagement des communautés, agents de santé communautaires et soins de santé primaires.',
                'categorizable_type' => BlogPost::class,
                'display_order' => 4,
            ],
            [
                'name' => 'Santé Numérique & SIG',
                'slug' => 'sante-numerique-sig',
                'color_class' => 'warning',
                'description' => 'Technologies de l\'information sanitaire, cartographie épidémiologique et suivi en temps réel.',
                'categorizable_type' => BlogPost::class,
                'display_order' => 5,
            ],

            // Resource categories
            [
                'name' => 'Articles Scientifiques',
                'slug' => 'articles-scientifiques',
                'color_class' => 'primary',
                'description' => 'Articles revus par les pairs publiés dans des revues internationales.',
                'categorizable_type' => Resource::class,
                'display_order' => 1,
            ],
            [
                'name' => 'Rapports Techniques & Évaluations',
                'slug' => 'rapports-techniques',
                'color_class' => 'info',
                'description' => 'Rapports d\'études terrain, évaluations de processus et bilans de projets.',
                'categorizable_type' => Resource::class,
                'display_order' => 2,
            ],
            [
                'name' => 'Notes de Politique (Policy Briefs)',
                'slug' => 'notes-de-politique',
                'color_class' => 'accent',
                'description' => 'Synthèses décisionnelles destinées aux ministères et décideurs de santé publique.',
                'categorizable_type' => Resource::class,
                'display_order' => 3,
            ],
            [
                'name' => 'Guides & Outils Pratiques',
                'slug' => 'guides-outils',
                'color_class' => 'success',
                'description' => 'Protocoles, questionnaires d\'enquêtes, modules de formation et outils d\'analyse.',
                'categorizable_type' => Resource::class,
                'display_order' => 4,
            ],

            // Opportunity categories
            [
                'name' => 'Emplois & Recrutements',
                'slug' => 'emplois-recrutements',
                'color_class' => 'primary',
                'description' => 'Postes contractuels et permanents au sein de CARICS-Togo.',
                'categorizable_type' => Opportunity::class,
                'display_order' => 1,
            ],
            [
                'name' => 'Consultances Techniques',
                'slug' => 'consultances-techniques',
                'color_class' => 'info',
                'description' => 'Missions d\'expertise courte et moyenne durée.',
                'categorizable_type' => Opportunity::class,
                'display_order' => 2,
            ],
            [
                'name' => 'Stages & Mentorat',
                'slug' => 'stages-mentorat',
                'color_class' => 'accent',
                'description' => 'Accueil d\'étudiants en Master, Doctorat et jeunes chercheurs.',
                'categorizable_type' => Opportunity::class,
                'display_order' => 3,
            ],
            [
                'name' => 'Bourses & Formations',
                'slug' => 'bourses-formations',
                'color_class' => 'warning',
                'description' => 'Bourses d\'études, financements de mobilité et programmes de formation.',
                'categorizable_type' => Opportunity::class,
                'display_order' => 4,
            ],

            // News categories
            [
                'name' => 'Institutionnel',
                'slug' => 'institutionnel',
                'color_class' => 'primary',
                'description' => 'Vie institutionnelle, gouvernance et partenariats officiels.',
                'categorizable_type' => News::class,
                'display_order' => 1,
            ],
            [
                'name' => 'Recherche & Projets',
                'slug' => 'recherche-projets-news',
                'color_class' => 'accent',
                'description' => 'Avancements et lancements de projets de recherche.',
                'categorizable_type' => News::class,
                'display_order' => 2,
            ],
            [
                'name' => 'Événements & Séminaires',
                'slug' => 'evenements-seminaires',
                'color_class' => 'info',
                'description' => 'Conférences, webinaires, ateliers régionaux et séminaires.',
                'categorizable_type' => News::class,
                'display_order' => 3,
            ],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                [
                    'slug' => $cat['slug'],
                    'categorizable_type' => $cat['categorizable_type'],
                ],
                $cat
            );
        }
    }
}
