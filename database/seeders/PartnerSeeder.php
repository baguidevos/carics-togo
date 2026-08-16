<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            [
                'name' => 'RSTMH',
                'full_name' => 'Royal Society of Tropical Medicine and Hygiene',
                'logo' => 'partners/rstmh.png',
                'website_url' => 'https://rstmh.org',
                'type' => 'financeur',
                'is_active' => true,
                'display_order' => 1,
            ],
            [
                'name' => 'Université d\'Utrecht',
                'full_name' => 'Universiteit Utrecht (Pays-Bas)',
                'logo' => 'partners/utrecht.png',
                'website_url' => 'https://www.uu.nl',
                'type' => 'academique',
                'is_active' => true,
                'display_order' => 2,
            ],
            [
                'name' => 'ITM Anvers',
                'full_name' => 'Institute of Tropical Medicine Antwerp (Belgique)',
                'logo' => 'partners/itm.png',
                'website_url' => 'https://www.itg.be',
                'type' => 'academique',
                'is_active' => true,
                'display_order' => 3,
            ],
            [
                'name' => 'ISSP',
                'full_name' => 'Institut Supérieur des Sciences de la Population — Université Joseph Ki-Zerbo (Burkina Faso)',
                'logo' => 'partners/issp.png',
                'website_url' => 'http://www.issp.bf',
                'type' => 'academique',
                'is_active' => true,
                'display_order' => 4,
            ],
            [
                'name' => 'PNLP Togo',
                'full_name' => 'Programme National de Lutte contre le Paludisme — Ministère de la Santé (Togo)',
                'logo' => 'partners/pnlp-togo.png',
                'website_url' => null,
                'type' => 'institutionnel',
                'is_active' => true,
                'display_order' => 5,
            ],
            [
                'name' => 'Jhpiego',
                'full_name' => 'Jhpiego — Johns Hopkins University Affiliate',
                'logo' => 'partners/jhpiego.png',
                'website_url' => 'https://www.jhpiego.org',
                'type' => 'ong',
                'is_active' => true,
                'display_order' => 6,
            ],
            [
                'name' => 'RTI International',
                'full_name' => 'Research Triangle Institute',
                'logo' => 'partners/rti.png',
                'website_url' => 'https://www.rti.org',
                'type' => 'ong',
                'is_active' => true,
                'display_order' => 7,
            ],
        ];

        foreach ($partners as $partner) {
            Partner::updateOrCreate(
                ['name' => $partner['name']],
                $partner
            );
        }
    }
}
