<?php

namespace Database\Factories\Module\Blog\Models;

use App\Module\Blog\Models\Bcategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;
use function fake;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BcategoryFactory extends Factory
{
    public function __construct($count = null, ?Collection $states = null, ?Collection $has = null, ?Collection $for = null, ?Collection $afterMaking = null, ?Collection $afterCreating = null, $connection = null)
    {
        $this->model = Bcategory::class;
        parent::__construct($count, $states, $has, $for, $afterMaking, $afterCreating, $connection);
    }

    public function definition()
    {
        return [
            'user_id' => mt_rand(1, 3),
            'label' => fake()->text(10)
        ];
    }
}
