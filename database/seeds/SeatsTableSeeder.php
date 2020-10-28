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
        $sections = [
            ['id' => 1, 'x' => 335, 'y' => 35], ['id' => 2, 'x' => 525, 'y' => 35],
            ['id' => 3, 'x' => 725, 'y' => 35], ['id' => 4, 'x' => 915, 'y' => 35],
            ['id' => 5, 'x' => 335, 'y' => 165], ['id' => 6, 'x' => 525, 'y' => 165],
            ['id' => 7, 'x' => 725, 'y' => 165], ['id' => 8, 'x' => 915, 'y' => 165],
            ['id' => 9, 'x' => 335, 'y' => 295], ['id' => 10, 'x' => 525, 'y' => 295],
            ['id' => 11, 'x' => 725, 'y' => 295], ['id' => 12, 'x' => 915, 'y' => 295],

            ['id' => 13, '1' => ['x' => 145, 'y' => 55], '2' => ['x' => 215, 'y' => 55], '3' => ['x' => 180, 'y' => 110]],
            ['id' => 14, '1' => ['x' => 145, 'y' => 175], '2' => ['x' => 215, 'y' => 175], '3' => ['x' => 180, 'y' => 230]],

            ['id' => 15, 'x' => 135, 'y' => 295], ['id' => 16, 'x' => 135, 'y' => 355],
            ['id' => 17, 'x' => 135, 'y' => 495], ['id' => 18, 'x' => 135, 'y' => 555],

            ['id' => 19, 'x' => 360, 'y' => 475], ['id' => 20, 'x' => 540, 'y' => 475],
            ['id' => 21, 'x' => 720, 'y' => 475], ['id' => 22, 'x' => 945, 'y' => 475],
        ];

        foreach ($sections as $section) {
            if ($section['id'] <= 12) {
                $x = $section['x'];
                $y = $section['y'];

                for ($i = 0; $i < 6; $i++) {
                    $position = ['x' => ($x + (50 * ($i % 3))), 'y' => $y];
                    Seat::create(['section_id' => $section['id'], 'position' => $position]);

                    if ($i == 2) {
                        $x = $section['x'];
                        $y += 70;
                    }
                }
            } else if (12 < $section['id'] && $section['id'] <= 14) {
                foreach ($section as $key => $val) {
                    if ($key == 'id') {
                        continue;
                    }

                    $x = $val['x'];
                    $y = $val['y'];

                    $position = ['x' => $x, 'y' => $y];
                    Seat::create(['section_id' => $section['id'], 'position' => $position]);
                }
            } else if (14 < $section['id'] && $section['id'] <= 18) {
                $x = $section['x'];
                $y = $section['y'];

                for ($i = 0; $i < 2; $i++) {
                    $position = ['x' => $x, 'y' => $y];
                    Seat::create(['section_id' => $section['id'], 'position' => $position]);

                    $x += 90;
                }
            } else if (18 < $section['id'] && $section['id'] <= 21) {
                $x = $section['x'];
                $y = $section['y'];

                for ($i = 0; $i < 4; $i++) {
                    $position = ['x' => $x, 'y' => $y];
                    Seat::create(['section_id' => $section['id'], 'position' => $position]);

                    if ($i == 0) {
                        $x -= 55;
                        $y += 50;
                    } else if ($i == 1) {
                        $x += 110;
                    } else if ($i == 2) {
                        $x -= 55;
                        $y += 50;
                    }
                }
            } else if (21 < $section['id']) {
                $x = $section['x'];
                $y = $section['y'];

                for ($i = 0; $i < 8; $i++) {
                    $position = ['x' => $x, 'y' => $y];
                    Seat::create(['section_id' => $section['id'], 'position' => $position]);

                    if ($i == 0) {
                        $x -= 50;
                        $y += 10;
                    } else if ($i == 1) {
                        $x += 100;
                    } else if ($i == 2) {
                        $x -= 130;
                        $y += 40;
                    } else if ($i == 3) {
                        $x += 160;
                    } else if ($i == 4) {
                        $x -= 130;
                        $y += 40;
                    } else if ($i == 5) {
                        $x += 100;
                    } else if ($i == 6) {
                        $x -= 50;
                        $y += 10;
                    }
                }
            }
        }
    }
}
