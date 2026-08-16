<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<News>
 */
class NewsFactory extends Factory
{
    protected $model = News::class;

    public function definition(): array
    {
        $title = fake()->sentence(7);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => fake()->paragraph(),
            'content' => '<p>'.fake()->paragraph().'</p>',
            'cover_image' => null,
            'category_id' => Category::factory(['categorizable_type' => News::class]),
            'blog_post_id' => null,
            'published_date' => fake()->date(),
            'is_featured' => false,
            'is_published' => true,
        ];
    }
}
