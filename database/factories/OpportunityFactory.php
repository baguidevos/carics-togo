<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Opportunity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Opportunity>
 */
class OpportunityFactory extends Factory
{
    protected $model = Opportunity::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(6),
            'category_id' => Category::factory(['categorizable_type' => Opportunity::class]),
            'description' => fake()->paragraph(),
            'requirements' => [fake()->sentence(), fake()->sentence()],
            'location' => 'Dapaong, Togo',
            'contract_type' => fake()->randomElement(['cdd', 'cdi', 'consultance', 'stage', 'benevolat']),
            'deadline' => fake()->dateTimeBetween('+1 week', '+6 months'),
            'application_email' => fake()->safeEmail(),
            'application_url' => null,
            'status' => 'ouverte',
            'is_published' => true,
        ];
    }
}
