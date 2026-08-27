<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use Illuminate\Database\Seeder;

class HeroSlideSeeder extends Seeder
{
    public function run(): void
    {
        $slides = [
            [
                'image' => 'images/banners/ban2.webp',
                'badge' => [
                    'fr' => 'Pôle d\'Excellence en Recherche & Santé Publique',
                    'en' => 'Center of Excellence in Research & Public Health',
                ],
                'title' => [
                    'fr' => 'Générer des données probantes pour transformer la santé en Afrique',
                    'en' => 'Generating Evidence to Transform Health in Africa',
                ],
                'description' => [
                    'fr' => 'Le CARICS-Togo mène des recherches rigoureuses et opérationnelles pour éclairer les politiques de santé et renforcer les systèmes de santé communautaires.',
                    'en' => 'CARICS-Togo conducts rigorous and operational research to inform health policies and strengthen community health systems.',
                ],
                'primary_cta_label' => [
                    'fr' => 'Découvrir nos Projets',
                    'en' => 'Explore our Projects',
                ],
                'primary_cta_url' => '/recherche-expertize-projet',
                'primary_cta_icon' => 'fa-solid fa-flask-vial',
                'secondary_cta_label' => [
                    'fr' => 'En savoir plus',
                    'en' => 'Learn More',
                ],
                'secondary_cta_url' => '/a-propos',
                'secondary_cta_icon' => 'fa-solid fa-circle-info',
                'display_order' => 1,
                'is_active' => true,
            ],
            [
                'image' => 'images/banners/ban3.webp',
                'badge' => [
                    'fr' => 'Innovation & Sciences de la Mise en Œuvre',
                    'en' => 'Innovation & Implementation Science',
                ],
                'title' => [
                    'fr' => 'Du laboratoire au terrain : des solutions concrètes pour les communautés',
                    'en' => 'From Lab to Field: Concrete Solutions for Communities',
                ],
                'description' => [
                    'fr' => 'Nous combinons épidémiologie de pointe, approches participatives et technologies numériques pour concevoir des interventions à fort impact.',
                    'en' => 'We combine cutting-edge epidemiology, participatory approaches, and digital tools to design high-impact interventions.',
                ],
                'primary_cta_label' => [
                    'fr' => 'Nos Domaines d\'Expertise',
                    'en' => 'Our Expertise Areas',
                ],
                'primary_cta_url' => '/recherche-expertize-projet',
                'primary_cta_icon' => 'fa-solid fa-microscope',
                'secondary_cta_label' => [
                    'fr' => 'Collaborer avec nous',
                    'en' => 'Partner With Us',
                ],
                'secondary_cta_url' => '/contact',
                'secondary_cta_icon' => 'fa-solid fa-handshake',
                'display_order' => 2,
                'is_active' => true,
            ],
            [
                'image' => 'images/banners/ban1.webp',
                'badge' => [
                    'fr' => 'Partage du Savoir & Publications Scientifiques',
                    'en' => 'Knowledge Sharing & Scientific Publications',
                ],
                'title' => [
                    'fr' => 'Diffuser la science ouverte au service des décideurs et des praticiens',
                    'en' => 'Open Science for Policy-Makers and Practitioners',
                ],
                'description' => [
                    'fr' => 'Consultez nos articles revus par les pairs, notes d\'orientation stratégique et rapports techniques accessibles librement.',
                    'en' => 'Access our peer-reviewed papers, policy briefs, and open-access technical reports.',
                ],
                'primary_cta_label' => [
                    'fr' => 'Publications & Rapports',
                    'en' => 'Publications & Reports',
                ],
                'primary_cta_url' => '/ressource-publication',
                'primary_cta_icon' => 'fa-solid fa-book-open',
                'secondary_cta_label' => [
                    'fr' => 'Nous contacter',
                    'en' => 'Contact Us',
                ],
                'secondary_cta_url' => '/contact',
                'secondary_cta_icon' => 'fa-solid fa-paper-plane',
                'display_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($slides as $data) {
            HeroSlide::updateOrCreate(
                ['display_order' => $data['display_order']],
                $data
            );
        }
    }
}
