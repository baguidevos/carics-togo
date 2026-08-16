<?php

namespace Database\Factories;

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\TeamMember;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<BlogPost>
 */
class BlogPostFactory extends Factory
{
    protected $model = BlogPost::class;

    public function definition(): array
    {
        $title = fake()->sentence(6);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'type' => fake()->randomElement(['article', 'fiche_projet']),
            'excerpt' => fake()->paragraph(),
            'body' => '<p>'.fake()->paragraph().'</p><p>'.fake()->paragraph().'</p>',
            'cover_image' => null,
            'author_id' => TeamMember::factory(),
            'category_id' => Category::factory(['categorizable_type' => BlogPost::class]),
            'research_project_id' => null,
            'reading_time_minutes' => fake()->numberBetween(2, 10),
            'references' => [fake()->sentence()],
            'meta_title' => $title,
            'meta_description' => fake()->sentence(),
            'status' => 'publie',
            'published_at' => now(),
            'is_featured' => false,
        ];
    }
}
