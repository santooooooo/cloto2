<?php

use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 12; $i++) {
            Section::insert(['room_id' => '1', 'role' => 'study']);
        }
        for ($i = 0; $i < 10; $i++) {
            Section::insert(['room_id' => '1', 'role' => 'lounge']);
        }
    }
}
