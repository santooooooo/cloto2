<?php

namespace Database\Seeders\rooms;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Section;
use App\Models\Seat;

class Room6Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //*** 部屋データ ***//
        $room = [
            'name' => '401号室',
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
        ];


        // 部屋作成
        $created_room = Room::create(['name' => $room['name'], 'timetable' => $room['timetable']]);



        // 区画1作成-イベント待ち合い席中央エリア
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'イベント待ち合い席中央エリア']);


        //*** 座席1データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 796, 'y' => 483], 'role' => 'study'];

        // 座席1作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席2データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 832, 'y' => 483], 'role' => 'study'];

        // 座席2作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席3データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 871, 'y' => 483], 'role' => 'study'];

        // 座席3作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席4データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 908, 'y' => 483], 'role' => 'study'];

        // 座席4作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席5データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 1020, 'y' => 483], 'role' => 'study'];

        // 座席5作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席6データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 1060, 'y' => 483], 'role' => 'study'];

        // 座席6作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席7データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 1098, 'y' => 483], 'role' => 'study'];

        // 座席7作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席8データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 1135, 'y' => 483], 'role' => 'study'];

        // 座席8作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席9データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 1248, 'y' => 483], 'role' => 'study'];

        // 座席9作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席10データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 1287, 'y' => 483], 'role' => 'study'];

        // 座席10作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席11データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 1322, 'y' => 483], 'role' => 'study'];

        // 座席11作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席12データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 1362, 'y' => 484], 'role' => 'study'];

        // 座席12作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席13データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 795, 'y' => 556], 'role' => 'study'];

        // 座席13作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席14データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 831, 'y' => 556], 'role' => 'study'];

        // 座席14作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席15データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 870, 'y' => 556], 'role' => 'study'];

        // 座席15作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席16データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 909, 'y' => 556], 'role' => 'study'];

        // 座席16作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席17データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 1019, 'y' => 556], 'role' => 'study'];

        // 座席17作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席18データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 1060, 'y' => 556], 'role' => 'study'];

        // 座席18作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席19データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 1097, 'y' => 556], 'role' => 'study'];

        // 座席19作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席20データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 1134, 'y' => 556], 'role' => 'study'];

        // 座席20作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席21データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 1249, 'y' => 556], 'role' => 'study'];

        // 座席21作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席22データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 1286, 'y' => 556], 'role' => 'study'];

        // 座席22作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席23データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 1321, 'y' => 556], 'role' => 'study'];

        // 座席23作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席24データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 1361, 'y' => 556], 'role' => 'study'];

        // 座席24作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画2作成-イベント待ち合い席左エリア
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'イベント待ち合い席左エリア']);


        //*** 座席25データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 184, 'y' => 708], 'role' => 'study'];

        // 座席25作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席26データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 223, 'y' => 708], 'role' => 'study'];

        // 座席26作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席27データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 260, 'y' => 708], 'role' => 'study'];

        // 座席27作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席28データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 296, 'y' => 708], 'role' => 'study'];

        // 座席28作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席29データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 375, 'y' => 708], 'role' => 'study'];

        // 座席29作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席30データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 413, 'y' => 708], 'role' => 'study'];

        // 座席30作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席31データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 449, 'y' => 708], 'role' => 'study'];

        // 座席31作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席32データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 489, 'y' => 708], 'role' => 'study'];

        // 座席32作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席33データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 565, 'y' => 708], 'role' => 'study'];

        // 座席33作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席34データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 604, 'y' => 708], 'role' => 'study'];

        // 座席34作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席35データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 641, 'y' => 708], 'role' => 'study'];

        // 座席35作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席36データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 677, 'y' => 708], 'role' => 'study'];

        // 座席36作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席37データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 181, 'y' => 783], 'role' => 'study'];

        // 座席37作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席38データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 220, 'y' => 783], 'role' => 'study'];

        // 座席38作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席39データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 258, 'y' => 783], 'role' => 'study'];

        // 座席39作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席40データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 294, 'y' => 783], 'role' => 'study'];

        // 座席40作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席41データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 372, 'y' => 783], 'role' => 'study'];

        // 座席41作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席42データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 412, 'y' => 783], 'role' => 'study'];

        // 座席42作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席43データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 448, 'y' => 783], 'role' => 'study'];

        // 座席43作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席44データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 487, 'y' => 783], 'role' => 'study'];

        // 座席44作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席45データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 563, 'y' => 783], 'role' => 'study'];

        // 座席45作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席46データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 603, 'y' => 783], 'role' => 'study'];

        // 座席46作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席47データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 640, 'y' => 783], 'role' => 'study'];

        // 座席47作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席48データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 675, 'y' => 783], 'role' => 'study'];

        // 座席48作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席49データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 178, 'y' => 863], 'role' => 'study'];

        // 座席49作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席50データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 217, 'y' => 863], 'role' => 'study'];

        // 座席50作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席51データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 257, 'y' => 863], 'role' => 'study'];

        // 座席51作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席52データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 292, 'y' => 863], 'role' => 'study'];

        // 座席52作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席53データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 371, 'y' => 863], 'role' => 'study'];

        // 座席53作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席54データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 410, 'y' => 863], 'role' => 'study'];

        // 座席54作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席55データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 446, 'y' => 863], 'role' => 'study'];

        // 座席55作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席56データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 486, 'y' => 863], 'role' => 'study'];

        // 座席56作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席57データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 562, 'y' => 863], 'role' => 'study'];

        // 座席57作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席58データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 602, 'y' => 863], 'role' => 'study'];

        // 座席58作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席59データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 639, 'y' => 863], 'role' => 'study'];

        // 座席59作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席60データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 676, 'y' => 863], 'role' => 'study'];

        // 座席60作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席61データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 175, 'y' => 933], 'role' => 'study'];

        // 座席61作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席62データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 214, 'y' => 933], 'role' => 'study'];

        // 座席62作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席63データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 255, 'y' => 933], 'role' => 'study'];

        // 座席63作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席64データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 291, 'y' => 933], 'role' => 'study'];

        // 座席64作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席65データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 370, 'y' => 933], 'role' => 'study'];

        // 座席65作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席66データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 408, 'y' => 933], 'role' => 'study'];

        // 座席66作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席67データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 446, 'y' => 933], 'role' => 'study'];

        // 座席67作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席68データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 485, 'y' => 933], 'role' => 'study'];

        // 座席68作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席69データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 561, 'y' => 933], 'role' => 'study'];

        // 座席69作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席70データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 601, 'y' => 933], 'role' => 'study'];

        // 座席70作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席71データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 638, 'y' => 933], 'role' => 'study'];

        // 座席71作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席72データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 676, 'y' => 933], 'role' => 'study'];

        // 座席72作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席73データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 173, 'y' => 1016], 'role' => 'study'];

        // 座席73作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席74データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 213, 'y' => 1016], 'role' => 'study'];

        // 座席74作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席75データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 252, 'y' => 1016], 'role' => 'study'];

        // 座席75作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席76データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 289, 'y' => 1016], 'role' => 'study'];

        // 座席76作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席77データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 369, 'y' => 1016], 'role' => 'study'];

        // 座席77作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席78データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 407, 'y' => 1016], 'role' => 'study'];

        // 座席78作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席79データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 443, 'y' => 1016], 'role' => 'study'];

        // 座席79作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席80データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 483, 'y' => 1016], 'role' => 'study'];

        // 座席80作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席81データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 560, 'y' => 1016], 'role' => 'study'];

        // 座席81作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席82データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 600, 'y' => 1016], 'role' => 'study'];

        // 座席82作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席83データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 637, 'y' => 1016], 'role' => 'study'];

        // 座席83作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席84データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 675, 'y' => 1016], 'role' => 'study'];

        // 座席84作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席85データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 169, 'y' => 1094], 'role' => 'study'];

        // 座席85作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席86データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 209, 'y' => 1094], 'role' => 'study'];

        // 座席86作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席87データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 249, 'y' => 1094], 'role' => 'study'];

        // 座席87作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席88データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 287, 'y' => 1094], 'role' => 'study'];

        // 座席88作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席89データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 368, 'y' => 1094], 'role' => 'study'];

        // 座席89作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席90データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 405, 'y' => 1094], 'role' => 'study'];

        // 座席90作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席91データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 440, 'y' => 1094], 'role' => 'study'];

        // 座席91作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席92データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 481, 'y' => 1094], 'role' => 'study'];

        // 座席92作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席93データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 558, 'y' => 1094], 'role' => 'study'];

        // 座席93作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席94データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 598, 'y' => 1094], 'role' => 'study'];

        // 座席94作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席95データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 636, 'y' => 1094], 'role' => 'study'];

        // 座席95作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席96データ ***//
        $seat = ['name' => '待ち合い席', 'size' => 30, 'position' => ['x' => 672, 'y' => 1094], 'role' => 'study'];

        // 座席96作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画3作成-雑談スペース1
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '雑談スペース1']);


        //*** 座席97データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 780, 'y' => 79], 'role' => 'hangout'];

        // 座席97作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席98データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 748, 'y' => 110], 'role' => 'hangout'];

        // 座席98作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席99データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 780, 'y' => 142], 'role' => 'hangout'];

        // 座席99作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席100データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 813, 'y' => 110], 'role' => 'hangout'];

        // 座席100作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画4作成-雑談スペース2
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '雑談スペース2']);


        //*** 座席101データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 927, 'y' => 79], 'role' => 'hangout'];

        // 座席101作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席102データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 897, 'y' => 111], 'role' => 'hangout'];

        // 座席102作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席103データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 928, 'y' => 142], 'role' => 'hangout'];

        // 座席103作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席104データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 961, 'y' => 111], 'role' => 'hangout'];

        // 座席104作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画5作成-雑談スペース3
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '雑談スペース3']);


        //*** 座席105データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1078, 'y' => 79], 'role' => 'hangout'];

        // 座席105作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席106データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1044, 'y' => 112], 'role' => 'hangout'];

        // 座席106作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席107データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1078, 'y' => 142], 'role' => 'hangout'];

        // 座席107作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席108データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1111, 'y' => 110], 'role' => 'hangout'];

        // 座席108作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画6作成-雑談スペース4
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '雑談スペース4']);


        //*** 座席109データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1228, 'y' => 79], 'role' => 'hangout'];

        // 座席109作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席110データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1197, 'y' => 110], 'role' => 'hangout'];

        // 座席110作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席111データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1228, 'y' => 142], 'role' => 'hangout'];

        // 座席111作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席112データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1260, 'y' => 110], 'role' => 'hangout'];

        // 座席112作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画7作成-雑談スペース5
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '雑談スペース5']);


        //*** 座席113データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1376, 'y' => 79], 'role' => 'hangout'];

        // 座席113作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席114データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1349, 'y' => 111], 'role' => 'hangout'];

        // 座席114作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席115データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1377, 'y' => 142], 'role' => 'hangout'];

        // 座席115作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席116データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1409, 'y' => 110], 'role' => 'hangout'];

        // 座席116作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画8作成-2人雑談スペース1
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '2人雑談スペース1']);


        //*** 座席117データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 816, 'y' => 670], 'role' => 'hangout'];

        // 座席117作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席118データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 882, 'y' => 670], 'role' => 'hangout'];

        // 座席118作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画9作成-2人雑談スペース2
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '2人雑談スペース2']);


        //*** 座席119データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 968, 'y' => 670], 'role' => 'hangout'];

        // 座席119作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席120データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1034, 'y' => 670], 'role' => 'hangout'];

        // 座席120作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画10作成-2人雑談スペース3
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '2人雑談スペース3']);


        //*** 座席121データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1122, 'y' => 670], 'role' => 'hangout'];

        // 座席121作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席122データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1189, 'y' => 669], 'role' => 'hangout'];

        // 座席122作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画11作成-2人雑談スペース4
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '2人雑談スペース4']);


        //*** 座席123データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1275, 'y' => 670], 'role' => 'hangout'];

        // 座席123作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席124データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1339, 'y' => 669], 'role' => 'hangout'];

        // 座席124作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画12作成-小ホール
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '小ホール']);


        //*** 座席125データ ***//
        $seat = ['name' => '登壇席', 'size' => 30, 'position' => ['x' => 381, 'y' => 75], 'role' => 'speak'];

        // 座席125作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席126データ ***//
        $seat = ['name' => '司会席', 'size' => 30, 'position' => ['x' => 575, 'y' => 90], 'role' => 'speak'];

        // 座席126作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席127データ ***//
        $seat = ['name' => '質疑席', 'size' => 30, 'position' => ['x' => 390, 'y' => 207], 'role' => 'speak'];

        // 座席127作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席128データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 179, 'y' => 270], 'role' => 'view'];

        // 座席128作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席129データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 250, 'y' => 270], 'role' => 'view'];

        // 座席129作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席130データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 327, 'y' => 270], 'role' => 'view'];

        // 座席130作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席131データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 442, 'y' => 270], 'role' => 'view'];

        // 座席131作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席132データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 516, 'y' => 270], 'role' => 'view'];

        // 座席132作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席133データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 587, 'y' => 270], 'role' => 'view'];

        // 座席133作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席134データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 170, 'y' => 341], 'role' => 'view'];

        // 座席134作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席135データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 240, 'y' => 341], 'role' => 'view'];

        // 座席135作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席136データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 320, 'y' => 341], 'role' => 'view'];

        // 座席136作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席137データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 433, 'y' => 341], 'role' => 'view'];

        // 座席137作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席138データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 508, 'y' => 341], 'role' => 'view'];

        // 座席138作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席139データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 584, 'y' => 341], 'role' => 'view'];

        // 座席139作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席140データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 161, 'y' => 415], 'role' => 'view'];

        // 座席140作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席141データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 235, 'y' => 415], 'role' => 'view'];

        // 座席141作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席142データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 314, 'y' => 415], 'role' => 'view'];

        // 座席142作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席143データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 427, 'y' => 415], 'role' => 'view'];

        // 座席143作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席144データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 503, 'y' => 415], 'role' => 'view'];

        // 座席144作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席145データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 582, 'y' => 415], 'role' => 'view'];

        // 座席145作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席146データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 153, 'y' => 489], 'role' => 'view'];

        // 座席146作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席147データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 229, 'y' => 489], 'role' => 'view'];

        // 座席147作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席148データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 307, 'y' => 489], 'role' => 'view'];

        // 座席148作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席149データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 423, 'y' => 489], 'role' => 'view'];

        // 座席149作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席150データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 499, 'y' => 489], 'role' => 'view'];

        // 座席150作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席151データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 574, 'y' => 489], 'role' => 'view'];

        // 座席151作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席152データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 143, 'y' => 546], 'role' => 'view'];

        // 座席152作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席153データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 222, 'y' => 545], 'role' => 'view'];

        // 座席153作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席154データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 299, 'y' => 547], 'role' => 'view'];

        // 座席154作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席155データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 417, 'y' => 547], 'role' => 'view'];

        // 座席155作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席156データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 495, 'y' => 547], 'role' => 'view'];

        // 座席156作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席157データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 572, 'y' => 546], 'role' => 'view'];

        // 座席157作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画13作成-大ホール
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '大ホール']);


        //*** 座席158データ ***//
        $seat = ['name' => '登壇席', 'size' => 30, 'position' => ['x' => 1995, 'y' => 592], 'role' => 'speak'];

        // 座席158作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席159データ ***//
        $seat = ['name' => '司会席', 'size' => 30, 'position' => ['x' => 1983, 'y' => 429], 'role' => 'speak'];

        // 座席159作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席160データ ***//
        $seat = ['name' => '質疑席', 'size' => 30, 'position' => ['x' => 1813, 'y' => 596], 'role' => 'speak'];

        // 座席160作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席161データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1689, 'y' => 48], 'role' => 'view'];

        // 座席161作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席162データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1760, 'y' => 48], 'role' => 'view'];

        // 座席162作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席163データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1837, 'y' => 49], 'role' => 'view'];

        // 座席163作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席164データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1913, 'y' => 49], 'role' => 'view'];

        // 座席164作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席165データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1988, 'y' => 46], 'role' => 'view'];

        // 座席165作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席166データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1721, 'y' => 127], 'role' => 'view'];

        // 座席166作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席167データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1749, 'y' => 125], 'role' => 'view'];

        // 座席167作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席168データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1873, 'y' => 125], 'role' => 'view'];

        // 座席168作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席169データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1948, 'y' => 125], 'role' => 'view'];

        // 座席169作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席170データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1833, 'y' => 201], 'role' => 'view'];

        // 座席170作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席171データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1911, 'y' => 201], 'role' => 'view'];

        // 座席171作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席172データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1985, 'y' => 201], 'role' => 'view'];

        // 座席172作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席173データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1872, 'y' => 278], 'role' => 'view'];

        // 座席173作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席174データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1944, 'y' => 278], 'role' => 'view'];

        // 座席174作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席175データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1530, 'y' => 133], 'role' => 'view'];

        // 座席175作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席176データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1602, 'y' => 173], 'role' => 'view'];

        // 座席176作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席177データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1532, 'y' => 207], 'role' => 'view'];

        // 座席177作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席178データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1602, 'y' => 248], 'role' => 'view'];

        // 座席178作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席179データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1536, 'y' => 289], 'role' => 'view'];

        // 座席179作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席180データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1675, 'y' => 268], 'role' => 'view'];

        // 座席180作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席181データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1602, 'y' => 322], 'role' => 'view'];

        // 座席181作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席182データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1748, 'y' => 327], 'role' => 'view'];

        // 座席182作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席183データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1536, 'y' => 360], 'role' => 'view'];

        // 座席183作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席184データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1677, 'y' => 360], 'role' => 'view'];

        // 座席184作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席185データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1603, 'y' => 400], 'role' => 'view'];

        // 座席185作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席186データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1744, 'y' => 400], 'role' => 'view'];

        // 座席186作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席187データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1536, 'y' => 436], 'role' => 'view'];

        // 座席187作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席188データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1678, 'y' => 436], 'role' => 'view'];

        // 座席188作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席189データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1823, 'y' => 442], 'role' => 'view'];

        // 座席189作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席190データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1605, 'y' => 476], 'role' => 'view'];

        // 座席190作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席191データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1751, 'y' => 476], 'role' => 'view'];

        // 座席191作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席192データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1536, 'y' => 515], 'role' => 'view'];

        // 座席192作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席193データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1680, 'y' => 515], 'role' => 'view'];

        // 座席193作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席194データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1825, 'y' => 515], 'role' => 'view'];

        // 座席194作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席195データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1540, 'y' => 668], 'role' => 'view'];

        // 座席195作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席196データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1684, 'y' => 669], 'role' => 'view'];

        // 座席196作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席197データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1829, 'y' => 669], 'role' => 'view'];

        // 座席197作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席198データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1611, 'y' => 708], 'role' => 'view'];

        // 座席198作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席199データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1757, 'y' => 708], 'role' => 'view'];

        // 座席199作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席200データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1542, 'y' => 747], 'role' => 'view'];

        // 座席200作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席201データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1684, 'y' => 747], 'role' => 'view'];

        // 座席201作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席202データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1831, 'y' => 747], 'role' => 'view'];

        // 座席202作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席203データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1611, 'y' => 786], 'role' => 'view'];

        // 座席203作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席204データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1760, 'y' => 786], 'role' => 'view'];

        // 座席204作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席205データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1544, 'y' => 827], 'role' => 'view'];

        // 座席205作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席206データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1686, 'y' => 827], 'role' => 'view'];

        // 座席206作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席207データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1613, 'y' => 865], 'role' => 'view'];

        // 座席207作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席208データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1762, 'y' => 865], 'role' => 'view'];

        // 座席208作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席209データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1544, 'y' => 906], 'role' => 'view'];

        // 座席209作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席210データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1687, 'y' => 905], 'role' => 'view'];

        // 座席210作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席211データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1615, 'y' => 996], 'role' => 'view'];

        // 座席211作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席212データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1544, 'y' => 987], 'role' => 'view'];

        // 座席212作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席213データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1616, 'y' => 1024], 'role' => 'view'];

        // 座席213作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席214データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1547, 'y' => 1066], 'role' => 'view'];

        // 座席214作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席215データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1889, 'y' => 914], 'role' => 'view'];

        // 座席215作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席216データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1966, 'y' => 914], 'role' => 'view'];

        // 座席216作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席217データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1855, 'y' => 994], 'role' => 'view'];

        // 座席217作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席218データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1934, 'y' => 994], 'role' => 'view'];

        // 座席218作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席219データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 2012, 'y' => 994], 'role' => 'view'];

        // 座席219作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席220データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1744, 'y' => 1075], 'role' => 'view'];

        // 座席220作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席191データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1823, 'y' => 1075], 'role' => 'view'];

        // 座席221作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席222データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1902, 'y' => 1075], 'role' => 'view'];

        // 座席222作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席223データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1981, 'y' => 1075], 'role' => 'view'];

        // 座席223作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席224データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1710, 'y' => 1157], 'role' => 'view'];

        // 座席224作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席225データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1790, 'y' => 1157], 'role' => 'view'];

        // 座席225作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席226データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1869, 'y' => 1157], 'role' => 'view'];

        // 座席226作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席227データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1947, 'y' => 1157], 'role' => 'view'];

        // 座席227作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席228データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 2027, 'y' => 1157], 'role' => 'view'];

        // 座席228作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画14作成-掲示板1
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '掲示板1']);


        //*** 座席229データ ***//
        $seat = ['name' => '上', 'size' => 30, 'position' => ['x' => 1443, 'y' => 351], 'role' => 'media'];

        // 座席229作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席230データ ***//
        $seat = ['name' => '下', 'size' => 30, 'position' => ['x' => 1443, 'y' => 411], 'role' => 'media'];

        // 座席230作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画15作成-その他
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'その他']);


        //*** 座席231データ ***//
        $seat = ['name' => '大ホール前上', 'size' => 30, 'position' => ['x' => 1401, 'y' => 692], 'role' => 'media'];

        // 座席231作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席232データ ***//
        $seat = ['name' => '大ホール前下', 'size' => 30, 'position' => ['x' => 1439, 'y' => 1026], 'role' => 'media'];

        // 座席232作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画16作成-その他
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'その他']);


        //*** 座席233データ ***//
        $seat = ['name' => '掲示板前', 'size' => 30, 'position' => ['x' => 1324, 'y' => 300], 'role' => 'media'];

        // 座席233作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席234データ ***//
        $seat = ['name' => '階段前', 'size' => 30, 'position' => ['x' => 1155, 'y' => 372], 'role' => 'media'];

        // 座席234作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画17作成-掲示板2
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '掲示板2']);


        //*** 座席235データ ***//
        $seat = ['name' => '上', 'size' => 30, 'position' => ['x' => 909, 'y' => 277], 'role' => 'media'];

        // 座席235作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席236データ ***//
        $seat = ['name' => '下', 'size' => 30, 'position' => ['x' => 909, 'y' => 339], 'role' => 'media'];

        // 座席236作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画18作成-その他
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'その他']);


        //*** 座席237データ ***//
        $seat = ['name' => '小ホール前', 'size' => 30, 'position' => ['x' => 721, 'y' => 646], 'role' => 'media'];

        // 座席237作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画19作成-その他
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'その他']);


        //*** 座席238データ ***//
        $seat = ['name' => 'イベント待ち合い席左エリア右上', 'size' => 30, 'position' => ['x' => 754, 'y' => 690], 'role' => 'media'];

        // 座席238作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席239データ ***//
        $seat = ['name' => 'イベント待ち合い席左エリア右中央', 'size' => 30, 'position' => ['x' => 739, 'y' => 867], 'role' => 'media'];

        // 座席239作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席240データ ***//
        $seat = ['name' => 'イベント待ち合い席左エリア右下', 'size' => 30, 'position' => ['x' => 713, 'y' => 1135], 'role' => 'media'];

        // 座席240作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);
    }
}
