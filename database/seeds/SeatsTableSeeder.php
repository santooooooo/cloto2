<?php

use Illuminate\Database\Seeder;
use App\Models\Seat;

class SeatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'];

        $left = 300;
        $top = 50;
        foreach ($sections as $index => $section) {
            // 各セクションに5席ずつ用意
            for ($i = 0; $i < 5; $i++) {
                $position = json_encode(['left' => ($left + (50 * $i)), 'top' => $top]);
                Seat::insert(['section_id' => $section, 'position' => $position]);
            }

            if (($index % 2) == 0) {
                $left += 300;
            }
            if (($index % 2) == 1) {
                $left = 300;
                $top += 100;
            }
        }
    }
}
