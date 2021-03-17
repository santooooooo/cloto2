<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminsTableSeeder::class);
        $this->call(rooms\Room1Seeder::class);
        $this->call(rooms\Room2Seeder::class);
        $this->call(rooms\Room3Seeder::class);
        $this->call(rooms\Room4Seeder::class);
        $this->call(rooms\Room5Seeder::class);
        $this->call(rooms\Room6Seeder::class);
        $this->call(rooms\Room7Seeder::class);
	$this->call(UsersTableSeeder::class);
    }
}
