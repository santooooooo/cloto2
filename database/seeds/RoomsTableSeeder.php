<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Room;
use App\Models\Section;
use App\Models\Seat;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 部屋名
        $rooms = [
            [
                'name' => 'チュートリアル部屋',
                'timetable' =>
                [
                    '00:00' => 'break'
                ]
            ],
            [
                'name' => '資格勉強部屋',
                'timetable' =>
                [
                    '00:00' => 'study', '00:50' => 'break',
                    '01:00' => 'study', '01:50' => 'break',
                    '02:00' => 'study', '02:50' => 'break',
                    '03:00' => 'study', '03:50' => 'break',
                    '04:00' => 'study', '04:50' => 'break',
                    '05:00' => 'study', '05:50' => 'break',
                    '06:00' => 'study', '06:50' => 'break',
                    '07:00' => 'study', '07:50' => 'break',
                    '08:00' => 'study', '08:50' => 'break',
                    '09:00' => 'study', '09:50' => 'break',
                    '10:00' => 'study', '10:50' => 'break',
                    '11:00' => 'study', '11:50' => 'break',
                    '12:00' => 'study', '12:50' => 'break',
                    '13:00' => 'study', '13:50' => 'break',
                    '14:00' => 'study', '14:50' => 'break',
                    '15:00' => 'study', '15:50' => 'break',
                    '16:00' => 'study', '16:50' => 'break',
                    '17:00' => 'study', '17:50' => 'break',
                    '18:00' => 'study', '18:50' => 'break',
                    '19:00' => 'study', '19:50' => 'break',
                    '20:00' => 'study', '20:50' => 'break',
                    '21:00' => 'study', '21:50' => 'break',
                    '22:00' => 'study', '22:50' => 'break',
                    '23:00' => 'study', '23:50' => 'break',
                ]
            ],
            [
                'name' => 'Web制作部屋',
                'timetable' =>
                [
                    '00:00' => 'study', '00:50' => 'break',
                    '01:00' => 'study', '01:50' => 'break',
                    '02:00' => 'study', '02:50' => 'break',
                    '03:00' => 'study', '03:50' => 'break',
                    '04:00' => 'study', '04:50' => 'break',
                    '05:00' => 'study', '05:50' => 'break',
                    '06:00' => 'study', '06:50' => 'break',
                    '07:00' => 'study', '07:50' => 'break',
                    '08:00' => 'study', '08:50' => 'break',
                    '09:00' => 'study', '09:50' => 'break',
                    '10:00' => 'study', '10:50' => 'break',
                    '11:00' => 'study', '11:50' => 'break',
                    '12:00' => 'study', '12:50' => 'break',
                    '13:00' => 'study', '13:50' => 'break',
                    '14:00' => 'study', '14:50' => 'break',
                    '15:00' => 'study', '15:50' => 'break',
                    '16:00' => 'study', '16:50' => 'break',
                    '17:00' => 'study', '17:50' => 'break',
                    '18:00' => 'study', '18:50' => 'break',
                    '19:00' => 'study', '19:50' => 'break',
                    '20:00' => 'study', '20:50' => 'break',
                    '21:00' => 'study', '21:50' => 'break',
                    '22:00' => 'study', '22:50' => 'break',
                    '23:00' => 'study', '23:50' => 'break',
                ]
            ],
            [
                'name' => 'アプリ開発部屋',
                'timetable' =>
                [
                    '00:00' => 'study', '00:50' => 'break',
                    '01:00' => 'study', '01:50' => 'break',
                    '02:00' => 'study', '02:50' => 'break',
                    '03:00' => 'study', '03:50' => 'break',
                    '04:00' => 'study', '04:50' => 'break',
                    '05:00' => 'study', '05:50' => 'break',
                    '06:00' => 'study', '06:50' => 'break',
                    '07:00' => 'study', '07:50' => 'break',
                    '08:00' => 'study', '08:50' => 'break',
                    '09:00' => 'study', '09:50' => 'break',
                    '10:00' => 'study', '10:50' => 'break',
                    '11:00' => 'study', '11:50' => 'break',
                    '12:00' => 'study', '12:50' => 'break',
                    '13:00' => 'study', '13:50' => 'break',
                    '14:00' => 'study', '14:50' => 'break',
                    '15:00' => 'study', '15:50' => 'break',
                    '16:00' => 'study', '16:50' => 'break',
                    '17:00' => 'study', '17:50' => 'break',
                    '18:00' => 'study', '18:50' => 'break',
                    '19:00' => 'study', '19:50' => 'break',
                    '20:00' => 'study', '20:50' => 'break',
                    '21:00' => 'study', '21:50' => 'break',
                    '22:00' => 'study', '22:50' => 'break',
                    '23:00' => 'study', '23:50' => 'break',
                ]
            ],
            [
                'name' => 'イベントホール',
                'timetable' =>
                [
                    '00:00' => 'study', '00:50' => 'break',
                    '01:00' => 'study', '01:50' => 'break',
                    '02:00' => 'study', '02:50' => 'break',
                    '03:00' => 'study', '03:50' => 'break',
                    '04:00' => 'study', '04:50' => 'break',
                    '05:00' => 'study', '05:50' => 'break',
                    '06:00' => 'study', '06:50' => 'break',
                    '07:00' => 'study', '07:50' => 'break',
                    '08:00' => 'study', '08:50' => 'break',
                    '09:00' => 'study', '09:50' => 'break',
                    '10:00' => 'study', '10:50' => 'break',
                    '11:00' => 'study', '11:50' => 'break',
                    '12:00' => 'study', '12:50' => 'break',
                    '13:00' => 'study', '13:50' => 'break',
                    '14:00' => 'study', '14:50' => 'break',
                    '15:00' => 'study', '15:50' => 'break',
                    '16:00' => 'study', '16:50' => 'break',
                    '17:00' => 'study', '17:50' => 'break',
                    '18:00' => 'study', '18:50' => 'break',
                    '19:00' => 'study', '19:50' => 'break',
                    '20:00' => 'study', '20:50' => 'break',
                    '21:00' => 'study', '21:50' => 'break',
                    '22:00' => 'study', '22:50' => 'break',
                    '23:00' => 'study', '23:50' => 'break',
                ]
            ]
        ];

        // 座席一覧
        // 自習室
        $study_positions = [
            ['x' => 335, 'y' => 35], ['x' => 525, 'y' => 35],
            ['x' => 725, 'y' => 35], ['x' => 915, 'y' => 35],
            ['x' => 335, 'y' => 165], ['x' => 525, 'y' => 165],
            ['x' => 725, 'y' => 165], ['x' => 915, 'y' => 165],
            ['x' => 335, 'y' => 295], ['x' => 525, 'y' => 295],
            ['x' => 725, 'y' => 295], ['x' => 915, 'y' => 295]
        ];

        // 三人がけ休憩室
        $lounge3_positions = [
            [['x' => 145, 'y' => 55], ['x' => 215, 'y' => 55], ['x' => 180, 'y' => 110]],
            [['x' => 145, 'y' => 175], ['x' => 215, 'y' => 175], ['x' => 180, 'y' => 230]]
        ];

        // 二人がけ休憩室
        $lounge2_positions = [
            ['x' => 135, 'y' => 295], ['x' => 135, 'y' => 355],
            ['x' => 135, 'y' => 495], ['x' => 135, 'y' => 555]
        ];

        // 四人がけ休憩室
        $lounge4_positions = [
            ['x' => 360, 'y' => 475], ['x' => 540, 'y' => 475], ['x' => 720, 'y' => 475]
        ];

        // 八人がけ休憩室
        $lounge8_positions = [
            ['x' => 945, 'y' => 475]
        ];

        // データ作成処理
        foreach ($rooms as $data) {
            // 部屋作成
            $room = Room::create(['name' => $data['name'], 'timetable' => $data['timetable']]);

            // 自習室の座席配置
            foreach ($study_positions as $base_position) {
                $section = Section::create(['uuid' => Str::uuid(), 'room_id' => $room->id, 'role' => 'study']);

                $x = $base_position['x'];
                $y = $base_position['y'];

                for ($i = 0; $i < 6; $i++) {
                    $position = ['x' => ($x + (50 * ($i % 3))), 'y' => $y];
                    Seat::create(['section_id' => $section->id, 'position' => $position]);

                    if ($i == 2) {
                        $x = $base_position['x'];
                        $y += 70;
                    }
                }
            }

            // 三人がけ休憩室の座席配置
            foreach ($lounge3_positions as $base_positions) {
                $section = Section::create(['uuid' => Str::uuid(), 'room_id' => $room->id, 'role' => 'lounge']);

                foreach ($base_positions as $base_position) {
                    $position = ['x' => $base_position['x'], 'y' => $base_position['y']];
                    Seat::create(['section_id' => $section->id, 'position' => $position]);
                }
            }

            // 二人がけ休憩室の座席配置
            foreach ($lounge2_positions as $base_position) {
                $section = Section::create(['uuid' => Str::uuid(), 'room_id' => $room->id, 'role' => 'lounge']);

                $x = $base_position['x'];
                $y = $base_position['y'];

                for ($i = 0; $i < 2; $i++) {
                    $position = ['x' => $x, 'y' => $y];
                    Seat::create(['section_id' => $section->id, 'position' => $position]);

                    $x += 90;
                }
            }

            // 四人がけ休憩室の座席配置
            foreach ($lounge4_positions as $base_position) {
                $section = Section::create(['uuid' => Str::uuid(), 'room_id' => $room->id, 'role' => 'lounge']);

                $x = $base_position['x'];
                $y = $base_position['y'];

                for ($i = 0; $i < 4; $i++) {
                    $position = ['x' => $x, 'y' => $y];
                    Seat::create(['section_id' => $section->id, 'position' => $position]);

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
            }

            // 八人がけ休憩室の座席配置
            foreach ($lounge8_positions as $base_position) {
                $section = Section::create(['uuid' => Str::uuid(), 'room_id' => $room->id, 'role' => 'lounge']);

                $x = $base_position['x'];
                $y = $base_position['y'];

                for ($i = 0; $i < 8; $i++) {
                    $position = ['x' => $x, 'y' => $y];
                    Seat::create(['section_id' => $section->id, 'position' => $position]);

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
