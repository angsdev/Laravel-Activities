<?php

namespace Database\Seeders;

use App\Models\Activity\Source;
use Illuminate\Database\Seeder;

class ActivitySourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Source::factory(5)->create();
    }
}
