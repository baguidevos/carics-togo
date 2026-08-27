<?php

namespace Database\Seeders;

use App\Models\PageBanner;
use Illuminate\Database\Seeder;

class PageBannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'page_key' => 'about',
                'title' => [
                    'fr' => 'À propos de nous',
                    'en' => 'About Us',
                ],
                'image' => 'images/abouts.webp',
                'hero_media_type' => 'image',
                'is_active' => true,
            ],
            [
                'page_key' => 'research',
                'title' => [
                    'fr' => 'Recherche, Expertise & Projets',
                    'en' => 'Research, Expertise & Projects',
                ],
                'image' => 'images/pub.webp',
                'hero_media_type' => 'image',
                'is_active' => true,
            ],
            [
                'page_key' => 'resources_publications',
                'title' => [
                    'fr' => 'Ressources & Publications',
                    'en' => 'Resources & Publications',
                ],
                'image' => 'images/pub.webp',
                'hero_media_type' => 'image',
                'is_active' => true,
            ],
            [
                'page_key' => 'news_opportunities',
                'title' => [
                    'fr' => 'Actualités & Opportunités',
                    'en' => 'News & Opportunities',
                ],
                'image' => 'images/1.jpg',
                'hero_media_type' => 'image',
                'is_active' => true,
            ],
            [
                'page_key' => 'team',
                'title' => [
                    'fr' => 'Notre Équipe & Gouvernance',
                    'en' => 'Our Team & Governance',
                ],
                'image' => 'images/banners/ban2.webp',
                'hero_media_type' => 'image',
                'is_active' => true,
            ],
            [
                'page_key' => 'contact',
                'title' => [
                    'fr' => 'Contact & Partenariats',
                    'en' => 'Contact & Partnerships',
                ],
                'image' => 'images/contact.webp',
                'hero_media_type' => 'image',
                'is_active' => true,
            ],
        ];

        foreach ($banners as $data) {
            PageBanner::updateOrCreate(
                ['page_key' => $data['page_key']],
                $data
            );
        }
    }
}
