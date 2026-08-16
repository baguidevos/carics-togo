<?php

namespace Database\Factories;

use App\Models\NewsletterSubscriber;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<NewsletterSubscriber>
 */
class NewsletterSubscriberFactory extends Factory
{
    protected $model = NewsletterSubscriber::class;

    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail(),
            'preferences' => ['recherche', 'opportunites'],
            'is_active' => true,
            'unsubscribe_token' => Str::random(32),
            'subscribed_at' => now(),
        ];
    }
}
