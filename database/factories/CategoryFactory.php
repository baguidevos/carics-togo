<?php

namespace Database\Factories;

use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $name = fake()->unique()->words(2, true);

        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'color_class' => fake()->randomElement(['primary', 'accent', 'info', 'success', 'warning']),
            'description' => fake()->sentence(),
            'categorizable_type' => BlogPost::class,
            'display_order' => fake()->numberBetween(1, 20),
        ];
    }
}
