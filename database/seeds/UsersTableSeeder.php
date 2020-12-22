<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
                'peer_id' => uniqid(substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3)),
                'username' => $username,
                'email' => $username . '@cloto.jp',
                'password' => Hash::make('password'),
                'handlename' => $username,
                'icon' => 'default.jpg',
                'sns' => [],
            ]);
        }

        $usernames = ['atsuhiro', 'yoshihito', 'shuto', 'sayuki'];
        foreach ($usernames as $username) {
            User::create([
                'peer_id' => uniqid(substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3)),
                'username' => $username,
                'email' => $username . '@cloto.jp',
                'password' => Hash::make($username),
                'handlename' => $username,
                'icon' => 'default.jpg',
                'sns' => [],
            ]);
        }
    }
}
