<?php

namespace Database\Factories;

use App\Models\Loker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kerja>
 */
class LokerFactory extends Factory
{
    protected $model = Loker::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'            => $this->faker->title(),
            'description'            => $this->faker->description(),
            'qualification'            => $this->faker->qualification(),
            'contact'            => $this->faker->contact(),
        ];
    }
}
