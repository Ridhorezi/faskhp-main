<?php

namespace Database\Seeders;

use App\Models\Teams;
use Illuminate\Database\Seeder;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teams::create([
            'name'         => 'Ridho',
            'desc'         => 'Developer',
            'link_twitter' => 'https://twitter.com/',
            'link_ig'      => 'https://instagram.com/',
            'link_fb'      => 'https://www.facebook.com/',
            'link_in'      => 'https://www.linkedin.com/',
            'photo'        => 'ridho.jpg',
        ]);
    }
}
