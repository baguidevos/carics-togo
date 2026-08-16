<?php

namespace Database\Factories;

use App\Models\TeamMember;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<TeamMember>
 */
class TeamMemberFactory extends Factory
{
    protected $model = TeamMember::class;

    public function definition(): array
    {
        $name = fake()->name();

        return [
            'full_name' => $name,
            'slug' => Str::slug($name),
            'role_title' => fake()->jobTitle(),
            'role_category' => fake()->randomElement(['bureau_executif', 'chercheur_associe', 'consultant']),
            'bio_short' => fake()->sentence(15),
            'bio_full' => [fake()->paragraph(), fake()->paragraph()],
            'bio_quote' => fake()->optional()->sentence(10),
            'mission_text' => fake()->paragraph(),
            'current_position' => fake()->optional()->company(),
            'related_project_slug' => null,
            'expertises' => [fake()->word(), fake()->word(), fake()->word()],
            'education' => [
                ['degree' => 'Master', 'field' => 'Santé Publique', 'institution' => fake()->company()],
            ],
            'distinctions' => [],
            'affiliations' => [fake()->company()],
            'photo' => null,
            'avatar_color' => fake()->randomElement(['primary', 'alt-1', 'alt-2', 'alt-3']),
            'email' => fake()->unique()->safeEmail(),
            'linkedin_url' => fake()->optional()->url(),
            'orcid_url' => fake()->optional()->url(),
            'google_scholar_url' => fake()->optional()->url(),
            'is_founder' => false,
            'is_published' => true,
            'display_order' => fake()->numberBetween(1, 50),
        ];
    }

    public function founder(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_founder' => true,
            'role_category' => 'bureau_executif',
        ]);
    }

    public function unpublished(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => false,
        ]);
    }
}
