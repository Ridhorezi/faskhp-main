<?php

namespace Database\Seeders;

use App\Models\Kerja;
use Illuminate\Database\Seeder;

class KerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kerja::factory(0)->create();
    }
}
