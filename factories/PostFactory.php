<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posts>
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
            'title' => $this->faker->title(),
            'user_id' => $this->faker->user_id(),
            'category_id' => $this->faker->category_id(),
            'content' => $this->faker->content(),
            'img_post' => $this->faker->img_post(),
            'remember_token' => Str::random(10),
        ];
    }

}
