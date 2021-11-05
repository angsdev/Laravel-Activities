<?php

namespace Database\Factories\Activity;

use App\Models\Activity\Attention;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttentionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attention::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(50),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
