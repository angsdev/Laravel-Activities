<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity\Attention;

class ActivityAttentionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Attention::factory(5)->create();
    }
}
