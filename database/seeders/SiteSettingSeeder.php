<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Contact & Coordonnées
            [
                'group' => 'contact',
                'key' => 'phone_1',
                'value' => '+228 90 12 34 56',
                'type' => 'text',
                'label' => 'Téléphone Principal',
                'display_order' => 1,
            ],
            [
                'group' => 'contact',
                'key' => 'phone_2',
                'value' => '+228 99 88 77 66',
                'type' => 'text',
                'label' => 'Téléphone Secondaire',
                'display_order' => 2,
            ],
            [
                'group' => 'contact',
                'key' => 'email_contact',
                'value' => 'contact@carics-togo.org',
                'type' => 'text',
                'label' => 'Email Général',
                'display_order' => 3,
            ],
            [
                'group' => 'contact',
                'key' => 'address',
                'value' => 'Dapaong, Commune de Tône 1, Région des Savanes, Togo',
                'type' => 'textarea',
                'label' => 'Adresse Physique',
                'display_order' => 4,
            ],
            [
                'group' => 'contact',
                'key' => 'office_hours',
                'value' => 'Lundi – Vendredi : 08h00 – 17h00 (GMT)',
                'type' => 'text',
                'label' => 'Horaires d\'Ouverture',
                'display_order' => 5,
            ],

            // Réseaux sociaux
            [
                'group' => 'social',
                'key' => 'linkedin_url',
                'value' => 'https://linkedin.com/company/carics-togo',
                'type' => 'text',
                'label' => 'Page LinkedIn',
                'display_order' => 1,
            ],
            [
                'group' => 'social',
                'key' => 'twitter_url',
                'value' => 'https://x.com/carics_togo',
                'type' => 'text',
                'label' => 'Compte X (Twitter)',
                'display_order' => 2,
            ],
            [
                'group' => 'social',
                'key' => 'facebook_url',
                'value' => 'https://facebook.com/caricstogo',
                'type' => 'text',
                'label' => 'Page Facebook',
                'display_order' => 3,
            ],

            // Général
            [
                'group' => 'general',
                'key' => 'tagline',
                'value' => 'Recherche – Innovation – Action en Santé Publique',
                'type' => 'text',
                'label' => 'Slogan de l\'organisation',
                'display_order' => 1,
            ],
            [
                'group' => 'general',
                'key' => 'registration_info',
                'value' => 'Organisation enregistrée à Dapaong, Préfecture de Tône, République Togolaise.',
                'type' => 'textarea',
                'label' => 'Mentions Légales & Enregistrement',
                'display_order' => 2,
            ],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
