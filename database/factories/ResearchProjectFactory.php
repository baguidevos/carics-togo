<?php

namespace Database\Factories;

use App\Models\ResearchProject;
use App\Models\TeamMember;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<ResearchProject>
 */
class ResearchProjectFactory extends Factory
{
    protected $model = ResearchProject::class;

    public function definition(): array
    {
        $title = fake()->sentence(8);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'status' => fake()->randomElement(['en_cours', 'complete', 'archive', 'a_venir']),
            'funder' => fake()->company(),
            'start_date' => fake()->date(),
            'end_date' => fake()->optional()->date(),
            'country' => 'Togo',
            'region' => 'Région des Savanes',
            'intervention_zones' => ['Tône', 'Cinkassé'],
            'map_lat' => 10.8634,
            'map_lng' => 0.2074,
            'context' => fake()->paragraph(),
            'objective' => fake()->paragraph(),
            'methodology' => fake()->paragraph(),
            'expected_results' => [fake()->sentence(), fake()->sentence()],
            'research_domains' => [fake()->word(), fake()->word()],
            'lead_id' => TeamMember::factory(),
            'is_featured' => false,
            'is_published' => true,
            'display_order' => fake()->numberBetween(1, 20),
        ];
    }
}
