<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Resource;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Resource>
 */
class ResourceFactory extends Factory
{
    protected $model = Resource::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(6),
            'description' => fake()->paragraph(),
            'category_id' => Category::factory(['categorizable_type' => Resource::class]),
            'file_path' => null,
            'external_url' => fake()->optional()->url(),
            'status' => 'disponible',
            'display_order' => fake()->numberBetween(1, 20),
        ];
    }
}
