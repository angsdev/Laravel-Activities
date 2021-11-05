<?php

namespace Database\Factories\Activity;

use App\Models\Activity\Activity;
use App\Models\Activity\Source;
use App\Models\Activity\Identifier;
use Illuminate\Database\Eloquent\Factories\Factory;

class IdentifierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Identifier::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'activity_id' => Activity::all()->random()->id,
          'source_id' => Source::all()->random()->id,
          'value' => $this->faker->numberBetween(1, 999),
          'created_at' => now(),
          'updated_at' => now()
        ];
    }
}
