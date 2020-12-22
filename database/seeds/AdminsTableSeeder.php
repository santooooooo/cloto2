<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usernames = ['admin', 'admin2', 'admin3'];
        foreach ($usernames as $username) {
            Admin::create([
                'email' => $username . '@cloto.jp',
                'password' => Hash::make('password'),
                'handlename' => $username,
            ]);
        }
    }
}
