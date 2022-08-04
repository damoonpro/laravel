<?php

namespace Database\Factories\Module\Blog\Models;

use App\Module\Blog\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BlogFactory extends Factory
{
    public function __construct($count = null, ?Collection $states = null, ?Collection $has = null, ?Collection $for = null, ?Collection $afterMaking = null, ?Collection $afterCreating = null, $connection = null)
    {
        $this->model = Blog::class;
        parent::__construct($count, $states, $has, $for, $afterMaking, $afterCreating, $connection);
    }

    public function definition()
    {
        return [
            'user_id' => mt_rand(1, 3),
            'title' => fake()->text(18),
            'description' => fake()->realText,
            'body' => fake()->realTextBetween(200, 400),
            'meta_title' => fake()->text(18),
            'meta_description' => fake()->realText(),
            'confirmed' => mt_rand(0, 3) > 2,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Blog $blog){
            $categories = mt_rand(1, 5);

            for($i = 1; $i <= $categories; $i++){
                $blog->categories()->attach($i);
            }

            $replies = mt_rand(0, 8);

            for($i = 0; $i < $replies; $i++){
                $blog->replies()->create([
                    'user_id' => mt_rand(1, 3),
                    'text' => fake()->text(30),
                    'confirmed' => mt_rand(0, 1)
                ]);
            }
        });
    }
}
