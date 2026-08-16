<?php

namespace Database\Factories;

use App\Models\SiteSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SiteSetting>
 */
class SiteSettingFactory extends Factory
{
    protected $model = SiteSetting::class;

    public function definition(): array
    {
        return [
            'group' => fake()->randomElement(['general', 'contact', 'social', 'seo']),
            'key' => fake()->unique()->word().'_'.fake()->unique()->numberBetween(100, 999),
            'value' => fake()->sentence(),
            'type' => 'text',
            'label' => fake()->words(2, true),
            'display_order' => fake()->numberBetween(1, 20),
        ];
    }
}
