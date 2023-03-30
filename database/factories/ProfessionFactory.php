<?php

namespace Database\Factories;

use App\Models\Profession;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profession>
 */
class ProfessionFactory extends Factory
{
    protected $model = Profession::class;

    public function definition()
    {
        return [
            'name' => fake()->sentence(2),
            'description' => fake()->sentence(),
        ];
    }
}
