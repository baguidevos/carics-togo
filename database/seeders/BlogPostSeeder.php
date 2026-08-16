<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\ResearchProject;
use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kombate = TeamMember::where('slug', 'gountante-kombate')->first();
        $catCps = Category::forModel(BlogPost::class)->where('slug', 'paludisme-cps')->first();
        $catEpi = Category::forModel(BlogPost::class)->where('slug', 'epidemiologie-sante-mondiale')->first();
        $cpsProject = ResearchProject::where('slug', 'cps-savanes')->first();

        $posts = [
            [
                'title' => 'Défis et opportunités de la ChimioPrévention du Paludisme Saisonnier dans les Savanes',
                'slug' => 'defis-opportunites-cps-savanes',
                'type' => 'article',
                'excerpt' => 'Analyse des enjeux de mise en œuvre de la stratégie de CPS chez les enfants de moins de 5 ans dans le nord du Togo.',
                'body' => '<p>La chimio-prévention du paludisme saisonnier (CPS) représente une intervention hautement coût-efficace recommandée par l’OMS dans les zones de transmission saisonnière du Sahel et des savanes d’Afrique de l’Ouest.</p><p>Dans la Région des Savanes au Togo, les campagnes annuelles permettent de sauver des milliers de vies. Néanmoins, garantir que chaque enfant reçoive les trois doses requises à chaque passage nécessite un engagement communautaire sans faille et une logistique rigoureuse.</p><p>Les recherches menées par CARICS-Togo visent à documenter avec précision les taux d’adhésion effective et à identifier les leviers permettant d’accroître l’efficacité de cette stratégie vitale.</p>',
                'cover_image' => 'blog/cps-hero.jpg',
                'author_id' => $kombate?->id,
                'category_id' => $catCps?->id,
                'research_project_id' => $cpsProject?->id,
                'reading_time_minutes' => 4,
                'references' => [
                    'OMS. Lignes directrices pour le contrôle du paludisme, 2023.',
                    'Kombaté G. et al. Early Career Research Grant proposal, RSTMH 2025.',
                ],
                'meta_title' => 'Défis de la CPS dans les Savanes | CARICS-Togo',
                'meta_description' => 'Analyse des enjeux de la chimio-prévention du paludisme saisonnier dans le nord du Togo par le Dr Gountante Kombaté.',
                'status' => 'publie',
                'published_at' => '2026-06-10 10:00:00',
                'is_featured' => true,
            ],
            [
                'title' => 'L’importance de la recherche sur la mise en œuvre pour transformer la santé communautaire',
                'slug' => 'importance-recherche-mise-en-oeuvre',
                'type' => 'article',
                'excerpt' => 'Pourquoi les données probantes issues du terrain sont indispensables pour éclairer les politiques de santé en Afrique de l’Ouest.',
                'body' => '<p>Trop souvent, d’excellentes interventions de santé publique échouent lors de leur déploiement à grande échelle en raison d’un manque de compréhension des réalités locales et organisationnelles.</p><p>Les sciences de la mise en œuvre (Implementation Science) apportent des réponses méthodologiques pour identifier les barrières et tester des solutions adaptatives.</p>',
                'cover_image' => 'blog/implementation-science.jpg',
                'author_id' => $kombate?->id,
                'category_id' => $catEpi?->id,
                'research_project_id' => null,
                'reading_time_minutes' => 3,
                'references' => [],
                'meta_title' => 'Sciences de la mise en œuvre et santé communautaire | CARICS-Togo',
                'meta_description' => 'Comprendre le rôle des sciences de la mise en œuvre pour améliorer les soins de santé primaires.',
                'status' => 'publie',
                'published_at' => '2026-07-05 14:30:00',
                'is_featured' => false,
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::updateOrCreate(
                ['slug' => $post['slug']],
                $post
            );
        }
    }
}
