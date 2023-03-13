<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Administrator1',
            'email' => 'admin@mail.com',
            'password' => bcrypt('admin12345'),
        ]);

        $admin->assignRole('SuperAdmin');

        $asep = User::create([
            'name' => 'User Example',
            'email' => 'user@mail.com',
            'password' => bcrypt('user12345'),
        ]);

        $asep->assignRole('user');

        // $riho = User::create([
        //     'name' => 'ridho',
        //     'email' => 'ridhosuhaebi01@gmail.com',
        //     'password' => bcrypt('12345678'),
        // ]);

        // $ridho->assignRole('user');

        // $user1 = User::create([
        //     'name' => 'user-1',
        //     'email' => 'admin1@mail.com',
        //     'password' => bcrypt('12345678'),
        // ]);

        // $user1->assignRole('user');

        // $user2 = User::create([
        //     'name' => 'user-2',
        //     'email' => 'admin2@mail.com',
        //     'password' => bcrypt('12345678'),
        // ]);

        // $user2->assignRole('user');

        // $user3 = User::create([
        //     'name' => 'user-3',
        //     'email' => 'user3@mail.com',
        //     'password' => bcrypt('12345678'),
        // ]);

        // $user3->assignRole('user');

        // $user4 = User::create([
        //     'name' => 'user-4',
        //     'email' => 'user4@mail.com',
        //     'password' => bcrypt('12345678'),
        // ]);

        // $user4->assignRole('user');

        // $user5 = User::create([
        //     'name' => 'user-5',
        //     'email' => 'user5@mail.com',
        //     'password' => bcrypt('12345678'),
        // ]);

        // $user5->assignRole('user');

        $asep->givePermissionTo('participate');
        // $ridho->givePermissionTo('participate');
        // $user1->givePermissionTo('participate');
        // $user2->givePermissionTo('participate');
        // $user3->givePermissionTo('participate');
        // $user4->givePermissionTo('participate');
        // $user5->givePermissionTo('participate');
    }
}
