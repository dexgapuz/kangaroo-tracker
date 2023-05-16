<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Kangaroo;
use Illuminate\Database\Eloquent\Factories\Factory;

class KangarooFactory extends Factory
{
    protected $model = Kangaroo::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'nickname' => fake()->name(),
            'weight' => fake()->randomFloat(2, 1, 100),
            'height' => fake()->randomFloat(2, 1, 100),
            'gender' => fake()->randomElement(['male', 'female']),
            'color' => fake()->colorName(),
            'friendliness' => fake()->randomElement(['friendly', 'not friendly']),
            'birthday' => fake()->date()
        ];
    }
}
