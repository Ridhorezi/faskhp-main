<?php

namespace Database\Seeders;

use App\Models\KerjaKuliah;
use Illuminate\Database\Seeder;

class KerjaKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KerjaKuliah::factory(0)->create();
    }
}
