<?php

namespace Database\Factories\Activity;

use App\Models\Activity\Type;
use App\Models\Activity\Process;
use App\Models\Activity\Activity;
use App\Models\Activity\Attention;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Activity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'type_id' => Type::all()->random()->id,
          'attention_id' => Attention::all()->random()->id,
          'process_id' => Process::all()->random()->id,
          'description' => $this->faker->text(50),
          'created_at' => now(),
          'updated_at' => now()
        ];
    }
}
