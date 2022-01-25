<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'summary' => $this->faker->realText(),
            'type' => rand(1, 2),
            'short_summary' => $this->faker->realText(),
            'category_id' => Category::inRandomOrder()->first(),
            'instructor_id' => User::inRandomOrder()->first(),
            'difficulty' => rand(1, 4),
            'price' => rand(100, 10000),
            'seats' => rand(5, 50),
        ];
    }
}
