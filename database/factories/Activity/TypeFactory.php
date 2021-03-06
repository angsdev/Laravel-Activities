<?php

namespace Database\Factories\Activity;

use App\Models\Activity\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

class TypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Type::class;

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
