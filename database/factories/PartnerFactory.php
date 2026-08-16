<?php

namespace Database\Factories;

use App\Models\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Partner>
 */
class PartnerFactory extends Factory
{
    protected $model = Partner::class;

    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'full_name' => fake()->sentence(4),
            'logo' => null,
            'website_url' => fake()->optional()->url(),
            'type' => fake()->randomElement(['financeur', 'academique', 'institutionnel', 'ong', 'autre']),
            'is_active' => true,
            'display_order' => fake()->numberBetween(1, 50),
        ];
    }
}
