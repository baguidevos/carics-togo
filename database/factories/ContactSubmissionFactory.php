<?php

namespace Database\Factories;

use App\Models\ContactSubmission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ContactSubmission>
 */
class ContactSubmissionFactory extends Factory
{
    protected $model = ContactSubmission::class;

    public function definition(): array
    {
        return [
            'form_type' => fake()->randomElement(['general', 'collaboration', 'stage', 'media']),
            'full_name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'organisation' => fake()->optional()->company(),
            'subject' => fake()->sentence(5),
            'message' => fake()->paragraph(),
            'file_path' => null,
            'meta' => [],
            'is_read' => false,
            'is_archived' => false,
        ];
    }
}
