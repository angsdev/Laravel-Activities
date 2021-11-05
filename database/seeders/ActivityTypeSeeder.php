<?php

namespace Database\Seeders;

use App\Models\Activity\Type;
use Illuminate\Database\Seeder;

class ActivityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Type::factory(5)->create();
    }
}
