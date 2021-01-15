<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usernames = ['test', 'test2', 'test3', 'test4', 'test5'];
        foreach ($usernames as $username) {
            User::create([
                'username' => $username,
                'email' => $username . '@cloto.jp',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password'),
                'handlename' => $username,
                'icon' => 'default.jpg',
                'sns' => json_decode('{}'),
            ]);
        }

        $usernames = ['atsuhiro', 'yoshihito', 'shuto', 'sayuki', 'hikaru', 'riku'];
        foreach ($usernames as $username) {
            User::create([
                'username' => $username,
                'email' => $username . '@cloto.jp',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make($username),
                'handlename' => $username,
                'icon' => 'default.jpg',
                'sns' => json_decode('{}'),
            ]);
        }
    }
}
