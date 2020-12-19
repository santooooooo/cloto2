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
                'name' => '無限休憩',
                'timetable' =>
                [
                    '00:00' => 'break',
                    '23:59' => 'break',
                ]
            ],
            [
                'name' => '時間割テスト',
                'timetable' =>
                [
                    '00:00' => 'study', '00:05' => 'break',
                    '00:10' => 'study', '00:15' => 'break',
                    '00:20' => 'study', '00:25' => 'break',
                    '00:30' => 'study', '00:35' => 'break',
                    '00:40' => 'study', '00:45' => 'break',
                    '00:50' => 'study', '00:55' => 'break',
                    '00:00' => 'study', '00:05' => 'break',
                    '00:10' => 'study', '00:15' => 'break',
                    '00:20' => 'study', '00:25' => 'break',
                    '00:30' => 'study', '00:35' => 'break',
                    '00:40' => 'study', '00:45' => 'break',
                    '00:50' => 'study', '00:55' => 'break',
                    '01:00' => 'study', '01:05' => 'break',
                    '01:10' => 'study', '01:15' => 'break',
                    '01:20' => 'study', '01:25' => 'break',
                    '01:30' => 'study', '01:35' => 'break',
                    '01:40' => 'study', '01:45' => 'break',
                    '01:50' => 'study', '01:55' => 'break',
                    '02:00' => 'study', '02:05' => 'break',
                    '02:10' => 'study', '02:15' => 'break',
                    '02:20' => 'study', '02:25' => 'break',
                    '02:30' => 'study', '02:35' => 'break',
                    '02:40' => 'study', '02:45' => 'break',
                    '02:50' => 'study', '02:55' => 'break',
                    '03:00' => 'study', '03:05' => 'break',
                    '03:10' => 'study', '03:15' => 'break',
                    '03:20' => 'study', '03:25' => 'break',
                    '03:30' => 'study', '03:35' => 'break',
                    '03:40' => 'study', '03:45' => 'break',
                    '03:50' => 'study', '03:55' => 'break',
                    '04:00' => 'study', '04:05' => 'break',
                    '04:10' => 'study', '04:15' => 'break',
                    '04:20' => 'study', '04:25' => 'break',
                    '04:30' => 'study', '04:35' => 'break',
                    '04:40' => 'study', '04:45' => 'break',
                    '04:50' => 'study', '04:55' => 'break',
                    '05:00' => 'study', '05:05' => 'break',
                    '05:10' => 'study', '05:15' => 'break',
                    '05:20' => 'study', '05:25' => 'break',
                    '05:30' => 'study', '05:35' => 'break',
                    '05:40' => 'study', '05:45' => 'break',
                    '05:50' => 'study', '05:55' => 'break',
                    '06:00' => 'study', '06:05' => 'break',
                    '06:10' => 'study', '06:15' => 'break',
                    '06:20' => 'study', '06:25' => 'break',
                    '06:30' => 'study', '06:35' => 'break',
                    '06:40' => 'study', '06:45' => 'break',
                    '06:50' => 'study', '06:55' => 'break',
                    '07:00' => 'study', '07:05' => 'break',
                    '07:10' => 'study', '07:15' => 'break',
                    '07:20' => 'study', '07:25' => 'break',
                    '07:30' => 'study', '07:35' => 'break',
                    '07:40' => 'study', '07:45' => 'break',
                    '07:50' => 'study', '07:55' => 'break',
                    '08:00' => 'study', '08:05' => 'break',
                    '08:10' => 'study', '08:15' => 'break',
                    '08:20' => 'study', '08:25' => 'break',
                    '08:30' => 'study', '08:35' => 'break',
                    '08:40' => 'study', '08:45' => 'break',
                    '08:50' => 'study', '08:55' => 'break',
                    '09:00' => 'study', '09:05' => 'break',
                    '09:10' => 'study', '09:15' => 'break',
                    '09:20' => 'study', '09:25' => 'break',
                    '09:30' => 'study', '09:35' => 'break',
                    '09:40' => 'study', '09:45' => 'break',
                    '09:50' => 'study', '09:55' => 'break',
                    '10:00' => 'study', '10:05' => 'break',
                    '10:10' => 'study', '10:15' => 'break',
                    '10:20' => 'study', '10:25' => 'break',
                    '10:30' => 'study', '10:35' => 'break',
                    '10:40' => 'study', '10:45' => 'break',
                    '10:50' => 'study', '10:55' => 'break',
                    '11:00' => 'study', '11:05' => 'break',
                    '11:10' => 'study', '11:15' => 'break',
                    '11:20' => 'study', '11:25' => 'break',
                    '11:30' => 'study', '11:35' => 'break',
                    '11:40' => 'study', '11:45' => 'break',
                    '11:50' => 'study', '11:55' => 'break',
                    '12:00' => 'study', '12:05' => 'break',
                    '12:10' => 'study', '12:15' => 'break',
                    '12:20' => 'study', '12:25' => 'break',
                    '12:30' => 'study', '12:35' => 'break',
                    '12:40' => 'study', '12:45' => 'break',
                    '12:50' => 'study', '12:55' => 'break',
                    '13:00' => 'study', '13:05' => 'break',
                    '13:10' => 'study', '13:15' => 'break',
                    '13:20' => 'study', '13:25' => 'break',
                    '13:30' => 'study', '13:35' => 'break',
                    '13:40' => 'study', '13:45' => 'break',
                    '13:50' => 'study', '13:55' => 'break',
                    '14:00' => 'study', '14:05' => 'break',
                    '14:10' => 'study', '14:15' => 'break',
                    '14:20' => 'study', '14:25' => 'break',
                    '14:30' => 'study', '14:35' => 'break',
                    '14:40' => 'study', '14:45' => 'break',
                    '14:50' => 'study', '14:55' => 'break',
                    '15:00' => 'study', '15:05' => 'break',
                    '15:10' => 'study', '15:15' => 'break',
                    '15:20' => 'study', '15:25' => 'break',
                    '15:30' => 'study', '15:35' => 'break',
                    '15:40' => 'study', '15:45' => 'break',
                    '15:50' => 'study', '15:55' => 'break',
                    '16:00' => 'study', '16:05' => 'break',
                    '16:10' => 'study', '16:15' => 'break',
                    '16:20' => 'study', '16:25' => 'break',
                    '16:30' => 'study', '16:35' => 'break',
                    '16:40' => 'study', '16:45' => 'break',
                    '16:50' => 'study', '16:55' => 'break',
                    '17:00' => 'study', '17:05' => 'break',
                    '17:10' => 'study', '17:15' => 'break',
                    '17:20' => 'study', '17:25' => 'break',
                    '17:30' => 'study', '17:35' => 'break',
                    '17:40' => 'study', '17:45' => 'break',
                    '17:50' => 'study', '17:55' => 'break',
                    '18:00' => 'study', '18:05' => 'break',
                    '18:10' => 'study', '18:15' => 'break',
                    '18:20' => 'study', '18:25' => 'break',
                    '18:30' => 'study', '18:35' => 'break',
                    '18:40' => 'study', '18:45' => 'break',
                    '18:50' => 'study', '18:55' => 'break',
                    '19:00' => 'study', '19:05' => 'break',
                    '19:10' => 'study', '19:15' => 'break',
                    '19:20' => 'study', '19:25' => 'break',
                    '19:30' => 'study', '19:35' => 'break',
                    '19:40' => 'study', '19:45' => 'break',
                    '19:50' => 'study', '19:55' => 'break',
                    '20:00' => 'study', '20:05' => 'break',
                    '20:10' => 'study', '20:15' => 'break',
                    '20:20' => 'study', '20:25' => 'break',
                    '20:30' => 'study', '20:35' => 'break',
                    '20:40' => 'study', '20:45' => 'break',
                    '20:50' => 'study', '20:55' => 'break',
                    '21:00' => 'study', '21:05' => 'break',
                    '21:10' => 'study', '21:15' => 'break',
                    '21:20' => 'study', '21:25' => 'break',
                    '21:30' => 'study', '21:35' => 'break',
                    '21:40' => 'study', '21:45' => 'break',
                    '21:50' => 'study', '21:55' => 'break',
                    '22:00' => 'study', '22:05' => 'break',
                    '22:10' => 'study', '22:15' => 'break',
                    '22:20' => 'study', '22:25' => 'break',
                    '22:30' => 'study', '22:35' => 'break',
                    '22:40' => 'study', '22:45' => 'break',
                    '22:50' => 'study', '22:55' => 'break',
                    '23:00' => 'study', '23:05' => 'break',
                    '23:10' => 'study', '23:15' => 'break',
                    '23:20' => 'study', '23:25' => 'break',
                    '23:30' => 'study', '23:35' => 'break',
                    '23:40' => 'study', '23:45' => 'break',
                    '23:50' => 'study', '23:55' => 'break',
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
