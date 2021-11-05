<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity\Identifier;

class ActivityIdentifierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Identifier::factory(5)->create();
    }
}
