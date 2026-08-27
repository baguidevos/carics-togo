<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer l'administrateur par défaut s'il n'existe pas
        User::firstOrCreate(
            ['email' => 'admin@carics-togo.org'],
            [
                'name' => 'Administrateur CARICS',
                'password' => Hash::make('password'),
            ]
        );

        $this->call([
            TeamMemberSeeder::class,
            CategorySeeder::class,
            PartnerSeeder::class,
            ResearchProjectSeeder::class,
            PublicationSeeder::class,
            BlogPostSeeder::class,
            NewsSeeder::class,
            OpportunitySeeder::class,
            ResourceSeeder::class,
            SiteSettingSeeder::class,
            HeroSlideSeeder::class,
            PageBannerSeeder::class,
        ]);
    }
}
