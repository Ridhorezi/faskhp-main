<?php

namespace Database\Seeders;

use App\Models\Kuliah;
use Illuminate\Database\Seeder;

class KuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kuliah::factory(0)->create();
    }
}
