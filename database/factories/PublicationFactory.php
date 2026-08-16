<?php

namespace Database\Factories;

use App\Models\Publication;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Publication>
 */
class PublicationFactory extends Factory
{
    protected $model = Publication::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(8),
            'type' => fake()->randomElement(['article_scientifique', 'rapport_technique', 'note_politique', 'acte_conference']),
            'abstract' => fake()->paragraph(),
            'journal_or_publisher' => fake()->company(),
            'author_ids' => [1],
            'external_co_authors' => fake()->optional()->name(),
            'file_path' => null,
            'external_url' => fake()->optional()->url(),
            'published_date' => fake()->date(),
            'research_project_id' => null,
            'status' => 'publie',
        ];
    }
}
