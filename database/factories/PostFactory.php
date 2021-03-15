<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'title' => $this->faker->word,
            'theme' => $this->faker->word,
            'image' => rand(0, 1) ? $this->faker->image('storage/app/public/', 640, 480, null, false) : null,
            'content' => $this->faker->realText,
        ];

    }
}
