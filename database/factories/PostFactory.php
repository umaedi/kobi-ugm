<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'     => $this->faker->sentence(mt_rand(2, 5)),
            'slug'      => $this->faker->slug(),
            'body'      => $this->faker->paragraph(mt_rand(2, 8)),
            'category_id'   => mt_rand(1, 2),
            'status'        => mt_rand(1, 2),
            'publish_at'    => Carbon::now(),
        ];
    }
}
