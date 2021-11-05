<?php

namespace Database\Seeders;

use App\Models\Activity\Process;
use Illuminate\Database\Seeder;

class ActivityProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Process::factory(5)->create();
    }
}
