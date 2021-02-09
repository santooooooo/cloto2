<?php

namespace Database\Seeders\rooms;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Section;
use App\Models\Seat;

class Room5Seeder extends Seeder
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
            'name' => '301号室',
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



        // 区画1作成-自習室
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '自習室']);


        //*** 座席1データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 187, 'y' => 705], 'role' => 'study'];

        // 座席1作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席2データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 243, 'y' => 705], 'role' => 'study'];

        // 座席2作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席3データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 296, 'y' => 705], 'role' => 'study'];

        // 座席3作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席4データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 408, 'y' => 705], 'role' => 'study'];

        // 座席4作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席5データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 460, 'y' => 705], 'role' => 'study'];

        // 座席5作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席6データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 515, 'y' => 705], 'role' => 'study'];

        // 座席6作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席7データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 185, 'y' => 778], 'role' => 'study'];

        // 座席7作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席8データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 241, 'y' => 778], 'role' => 'study'];

        // 座席8作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席9データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 295, 'y' => 778], 'role' => 'study'];

        // 座席9作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席10データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 407, 'y' => 778], 'role' => 'study'];

        // 座席10作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席11データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 459, 'y' => 778], 'role' => 'study'];

        // 座席11作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席12データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 513, 'y' => 778], 'role' => 'study'];

        // 座席12作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席13データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 182, 'y' => 821], 'role' => 'study'];

        // 座席13作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席14データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 236, 'y' => 821], 'role' => 'study'];

        // 座席14作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席15データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 292, 'y' => 821], 'role' => 'study'];

        // 座席15作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席16データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 404, 'y' => 821], 'role' => 'study'];

        // 座席16作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席17データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 456, 'y' => 821], 'role' => 'study'];

        // 座席17作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席18データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 512, 'y' => 821], 'role' => 'study'];

        // 座席18作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席19データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 181, 'y' => 895], 'role' => 'study'];

        // 座席19作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席20データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 235, 'y' => 895], 'role' => 'study'];

        // 座席20作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席21データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 291, 'y' => 895], 'role' => 'study'];

        // 座席21作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席22データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 403, 'y' => 895], 'role' => 'study'];

        // 座席22作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席23データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 455, 'y' => 895], 'role' => 'study'];

        // 座席23作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席24データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 511, 'y' => 895], 'role' => 'study'];

        // 座席24作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席25データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 180, 'y' => 939], 'role' => 'study'];

        // 座席25作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席26データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 234, 'y' => 939], 'role' => 'study'];

        // 座席26作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席27データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 290, 'y' => 939], 'role' => 'study'];

        // 座席27作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席28データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 402, 'y' => 939], 'role' => 'study'];

        // 座席28作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席29データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 454, 'y' => 939], 'role' => 'study'];

        // 座席29作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席30データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 510, 'y' => 939], 'role' => 'study'];

        // 座席30作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席31データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 178, 'y' => 1015], 'role' => 'study'];

        // 座席31作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席32データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 233, 'y' => 1015], 'role' => 'study'];

        // 座席32作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席33データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 288, 'y' => 1015], 'role' => 'study'];

        // 座席33作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席34データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 401, 'y' => 1015], 'role' => 'study'];

        // 座席34作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席35データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 453, 'y' => 1015], 'role' => 'study'];

        // 座席35作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席36データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 508, 'y' => 1015], 'role' => 'study'];

        // 座席36作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席37データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 178, 'y' => 1057], 'role' => 'study'];

        // 座席37作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席38データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 233, 'y' => 1057], 'role' => 'study'];

        // 座席38作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席39データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 288, 'y' => 1057], 'role' => 'study'];

        // 座席39作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席40データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 399, 'y' => 1057], 'role' => 'study'];

        // 座席40作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席41データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 452, 'y' => 1057], 'role' => 'study'];

        // 座席41作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席42データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 507, 'y' => 1057], 'role' => 'study'];

        // 座席42作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席43データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 177, 'y' => 1133], 'role' => 'study'];

        // 座席43作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席44データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 232, 'y' => 1133], 'role' => 'study'];

        // 座席44作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席45データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 287, 'y' => 1133], 'role' => 'study'];

        // 座席45作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席46データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 398, 'y' => 1133], 'role' => 'study'];

        // 座席46作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席47データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 450, 'y' => 1133], 'role' => 'study'];

        // 座席47作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席48データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 507, 'y' => 1133], 'role' => 'study'];

        // 座席48作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画2作成-Staff荷物置き場
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'Staff荷物置き場']);


        //*** 座席49データ ***//
        $seat = ['name' => 'Staff席', 'size' => 30, 'position' => ['x' => 651, 'y' => 952], 'role' => 'staff'];

        // 座席49作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席50データ ***//
        $seat = ['name' => 'Staff席', 'size' => 30, 'position' => ['x' => 733, 'y' => 932], 'role' => 'staff'];

        // 座席50作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席51データ ***//
        $seat = ['name' => 'Staff席', 'size' => 30, 'position' => ['x' => 650, 'y' => 1015], 'role' => 'staff'];

        // 座席51作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席52データ ***//
        $seat = ['name' => 'Staff席', 'size' => 30, 'position' => ['x' => 732, 'y' => 1016], 'role' => 'staff'];

        // 座席52作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画3作成-Staff談話スペース
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'Staff談話スペース']);


        //*** 座席53データ ***//
        $seat = ['name' => 'Staff談話席', 'size' => 30, 'position' => ['x' => 629, 'y' => 1094], 'role' => 'mentor'];

        // 座席53作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席54データ ***//
        $seat = ['name' => 'Staff談話席', 'size' => 30, 'position' => ['x' => 629, 'y' => 1129], 'role' => 'mentor'];

        // 座席54作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席55データ ***//
        $seat = ['name' => 'Staff談話席', 'size' => 30, 'position' => ['x' => 714, 'y' => 1095], 'role' => 'mentor'];

        // 座席55作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席56データ ***//
        $seat = ['name' => 'Staff談話席', 'size' => 30, 'position' => ['x' => 714, 'y' => 1132], 'role' => 'mentor'];

        // 座席56作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画4作成-メンタリングスペース右
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'メンタリングスペース右']);


        //*** 座席57データ ***//
        $seat = ['name' => 'メンター席', 'size' => 30, 'position' => ['x' => 887, 'y' => 593], 'role' => 'mentor'];

        // 座席57作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席58データ ***//
        $seat = ['name' => 'ユーザー席', 'size' => 30, 'position' => ['x' => 888, 'y' => 657], 'role' => 'user'];

        // 座席58作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画5作成-メンタリングスペース左
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'メンタリングスペース左']);


        //*** 座席59データ ***//
        $seat = ['name' => 'メンター席', 'size' => 30, 'position' => ['x' => 811, 'y' => 593], 'role' => 'mentor'];

        // 座席59作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席60データ ***//
        $seat = ['name' => 'ユーザー席', 'size' => 30, 'position' => ['x' => 812, 'y' => 657], 'role' => 'user'];

        // 座席60作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画6作成-メンタリングスペース上
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'メンタリングスペース上']);


        //*** 座席61データ ***//
        $seat = ['name' => 'メンター席', 'size' => 30, 'position' => ['x' => 661, 'y' => 740], 'role' => 'mentor'];

        // 座席61作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席62データ ***//
        $seat = ['name' => 'ユーザー席', 'size' => 30, 'position' => ['x' => 727, 'y' => 740], 'role' => 'user'];

        // 座席62作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画7作成-メンタリングスペース下
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'メンタリングスペース下']);


        //*** 座席63データ ***//
        $seat = ['name' => 'メンター席', 'size' => 30, 'position' => ['x' => 660, 'y' => 819], 'role' => 'mentor'];

        // 座席63作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席64データ ***//
        $seat = ['name' => 'ユーザー席', 'size' => 30, 'position' => ['x' => 726, 'y' => 819], 'role' => 'user'];

        // 座席64作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画8作成-登壇会場
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '登壇会場']);


        //*** 座席65データ ***//
        $seat = ['name' => '登壇席', 'size' => 30, 'position' => ['x' => 312, 'y' => 476], 'role' => 'speak'];

        // 座席65作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席66データ ***//
        $seat = ['name' => '司会席', 'size' => 30, 'position' => ['x' => 450, 'y' => 476], 'role' => 'speak'];

        // 座席66作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席67データ ***//
        $seat = ['name' => '質疑席', 'size' => 30, 'position' => ['x' => 322, 'y' => 352], 'role' => 'speak'];

        // 座席67作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席68データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 158, 'y' => 37], 'role' => 'view'];

        // 座席68作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席69データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 197, 'y' => 37], 'role' => 'view'];

        // 座席69作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席70データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 234, 'y' => 37], 'role' => 'view'];

        // 座席70作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席71データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 273, 'y' => 37], 'role' => 'view'];

        // 座席71作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席72データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 350, 'y' => 37], 'role' => 'view'];

        // 座席72作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席73データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 390, 'y' => 37], 'role' => 'view'];

        // 座席73作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席74データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 429, 'y' => 37], 'role' => 'view'];

        // 座席74作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席75データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 468, 'y' => 37], 'role' => 'view'];

        // 座席75作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席76データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 161, 'y' => 114], 'role' => 'view'];

        // 座席76作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席77データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 198, 'y' => 114], 'role' => 'view'];

        // 座席77作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席78データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 236, 'y' => 114], 'role' => 'view'];

        // 座席78作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席79データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 274, 'y' => 114], 'role' => 'view'];

        // 座席79作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席80データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 351, 'y' => 114], 'role' => 'view'];

        // 座席80作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席81データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 390, 'y' => 114], 'role' => 'view'];

        // 座席81作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席82データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 429, 'y' => 114], 'role' => 'view'];

        // 座席82作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席83データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 468, 'y' => 114], 'role' => 'view'];

        // 座席83作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席84データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 163, 'y' => 190], 'role' => 'view'];

        // 座席84作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席85データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 199, 'y' => 190], 'role' => 'view'];

        // 座席85作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席86データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 237, 'y' => 190], 'role' => 'view'];

        // 座席86作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席87データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 276, 'y' => 190], 'role' => 'view'];

        // 座席87作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席88データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 353, 'y' => 190], 'role' => 'view'];

        // 座席88作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席89データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 391, 'y' => 190], 'role' => 'view'];

        // 座席89作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席90データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 430, 'y' => 190], 'role' => 'view'];

        // 座席90作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席91データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 468, 'y' => 190], 'role' => 'view'];

        // 座席91作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席92データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 165, 'y' => 267], 'role' => 'view'];

        // 座席92作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席93データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 200, 'y' => 267], 'role' => 'view'];

        // 座席93作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席94データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 238, 'y' => 267], 'role' => 'view'];

        // 座席94作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席95データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 278, 'y' => 267], 'role' => 'view'];

        // 座席95作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席96データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 354, 'y' => 267], 'role' => 'view'];

        // 座席96作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席97データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 392, 'y' => 267], 'role' => 'view'];

        // 座席97作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席98データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 430, 'y' => 267], 'role' => 'view'];

        // 座席98作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席99データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 468, 'y' => 267], 'role' => 'view'];

        // 座席99作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席100データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 168, 'y' => 344], 'role' => 'view'];

        // 座席100作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席101データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 202, 'y' => 344], 'role' => 'view'];

        // 座席101作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席102データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 240, 'y' => 344], 'role' => 'view'];

        // 座席102作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席103データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 279, 'y' => 344], 'role' => 'view'];

        // 座席103作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席104データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 355, 'y' => 344], 'role' => 'view'];

        // 座席104作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席105データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 393, 'y' => 344], 'role' => 'view'];

        // 座席105作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席106データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 431, 'y' => 344], 'role' => 'view'];

        // 座席106作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席107データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 468, 'y' => 344], 'role' => 'view'];

        // 座席107作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画9作成-2人雑談スペース左側左
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '2人雑談スペース左側左']);


        //*** 座席108データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 591, 'y' => 64], 'role' => 'hangout'];

        // 座席108作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席109データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 591, 'y' => 128], 'role' => 'hangout'];

        // 座席109作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画10作成-2人雑談スペース左側中央
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '2人雑談スペース左側中央']);


        //*** 座席110データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 740, 'y' => 66], 'role' => 'hangout'];

        // 座席110作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席111データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 741, 'y' => 128], 'role' => 'hangout'];

        // 座席111作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画11作成-2人雑談スペース左側右
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '2人雑談スペース左側右']);


        //*** 座席112データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 840, 'y' => 63], 'role' => 'hangout'];

        // 座席112作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席113データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 890, 'y' => 128], 'role' => 'hangout'];

        // 座席113作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画12作成-2人雑談スペース右側左
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '2人雑談スペース右側左']);


        //*** 座席114データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1264, 'y' => 65], 'role' => 'hangout'];

        // 座席114作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席115データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1265, 'y' => 128], 'role' => 'hangout'];

        // 座席115作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画13作成-2人雑談スペース右側中央
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '2人雑談スペース右側中央']);


        //*** 座席116データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1415, 'y' => 67], 'role' => 'hangout'];

        // 座席116作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席117データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1417, 'y' => 128], 'role' => 'hangout'];

        // 座席117作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画14作成-2人雑談スペース右側右
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '2人雑談スペース右側右']);


        //*** 座席118データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1563, 'y' => 65], 'role' => 'hangout'];

        // 座席118作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席119データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1565, 'y' => 128], 'role' => 'hangout'];

        // 座席119作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画15作成-雑談スペース
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '雑談スペース']);


        //*** 座席120データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 741, 'y' => 372], 'role' => 'hangout'];

        // 座席120作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席121データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 809, 'y' => 372], 'role' => 'hangout'];

        // 座席121作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席122データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 740, 'y' => 499], 'role' => 'hangout'];

        // 座席122作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席123データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 809, 'y' => 499], 'role' => 'hangout'];

        // 座席123作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画16作成-雑談スペース
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '雑談スペース']);


        //*** 座席124データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1542, 'y' => 435], 'role' => 'hangout'];

        // 座席124作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席125データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1542, 'y' => 515], 'role' => 'hangout'];

        // 座席125作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席126データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1675, 'y' => 437], 'role' => 'hangout'];

        // 座席126作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席127データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1675, 'y' => 517], 'role' => 'hangout'];

        // 座席127作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画17作成-2人雑談スペース下側左
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '2人雑談スペース下側左']);


        //*** 座席128データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1269, 'y' => 593], 'role' => 'hangout'];

        // 座席128作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席129データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1271, 'y' => 657], 'role' => 'hangout'];

        // 座席129作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画18作成-2人雑談スペース下側右
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '2人雑談スペース下側右']);


        //*** 座席130データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1344, 'y' => 592], 'role' => 'hangout'];

        // 座席130作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席131データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1346, 'y' => 656], 'role' => 'hangout'];

        // 座席131作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画19作成-2人雑談スペース下側上
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '2人雑談スペース下側上']);


        //*** 座席132データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1430, 'y' => 741], 'role' => 'hangout'];

        // 座席132作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席133データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1495, 'y' => 738], 'role' => 'hangout'];

        // 座席133作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画20作成-2人雑談スペース下側下
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '2人雑談スペース下側下']);


        //*** 座席134データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1431, 'y' => 818], 'role' => 'hangout'];

        // 座席134作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席135データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1495, 'y' => 818], 'role' => 'hangout'];

        // 座席135作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画21作成-休憩室A
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '休憩室A']);


        //*** 座席136データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1920, 'y' => 70], 'role' => 'lounge'];

        // 座席136作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席137データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1879, 'y' => 114], 'role' => 'lounge'];

        // 座席137作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席138データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1920, 'y' => 155], 'role' => 'lounge'];

        // 座席138作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席139データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1964, 'y' => 116], 'role' => 'lounge'];

        // 座席139作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画22作成-休憩室B
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '休憩室B']);


        //*** 座席140データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1927, 'y' => 257], 'role' => 'lounge'];

        // 座席140作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席141データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1886, 'y' => 300], 'role' => 'lounge'];

        // 座席141作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席142データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1930, 'y' => 342], 'role' => 'lounge'];

        // 座席142作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席143データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1974, 'y' => 300], 'role' => 'lounge'];

        // 座席143作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画23作成-休憩室C
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '休憩室C']);


        //*** 座席144データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1932, 'y' => 446], 'role' => 'lounge'];

        // 座席144作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席145データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1890, 'y' => 490], 'role' => 'lounge'];

        // 座席145作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席146データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1935, 'y' => 531], 'role' => 'lounge'];

        // 座席146作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席147データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1478, 'y' => 489], 'role' => 'lounge'];

        // 座席147作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画24作成-休憩室D
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '休憩室D']);


        //*** 座席148データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1939, 'y' => 636], 'role' => 'lounge'];

        // 座席148作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席149データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1898, 'y' => 682], 'role' => 'lounge'];

        // 座席149作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席150データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1940, 'y' => 724], 'role' => 'lounge'];

        // 座席150作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席151データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1986, 'y' => 681], 'role' => 'lounge'];

        // 座席151作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画25作成-休憩室E
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '休憩室E']);


        //*** 座席152データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1946, 'y' => 830], 'role' => 'lounge'];

        // 座席152作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席153データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1903, 'y' => 876], 'role' => 'lounge'];

        // 座席153作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席154データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1947, 'y' => 918], 'role' => 'lounge'];

        // 座席154作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席155データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1993, 'y' => 895], 'role' => 'lounge'];

        // 座席155作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画26作成-休憩室F
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '休憩室F']);


        //*** 座席156データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1952, 'y' => 1027], 'role' => 'lounge'];

        // 座席156作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席157データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1910, 'y' => 1074], 'role' => 'lounge'];

        // 座席157作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席158データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1954, 'y' => 1117], 'role' => 'lounge'];

        // 座席158作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席159データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1999, 'y' => 1074], 'role' => 'lounge'];

        // 座席159作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画27作成-休憩室G
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '休憩室G']);


        //*** 座席160データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1680, 'y' => 1029], 'role' => 'lounge'];

        // 座席160作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席161データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1637, 'y' => 1073], 'role' => 'lounge'];

        // 座席161作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席162データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1682, 'y' => 1118], 'role' => 'lounge'];

        // 座席162作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席163データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1727, 'y' => 1072], 'role' => 'lounge'];

        // 座席163作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画28作成-休憩室H
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '休憩室H']);


        //*** 座席164データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1487, 'y' => 1029], 'role' => 'lounge'];

        // 座席164作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席165データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1445, 'y' => 1073], 'role' => 'lounge'];

        // 座席165作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席166データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1489, 'y' => 1119], 'role' => 'lounge'];

        // 座席166作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席167データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1533, 'y' => 1073], 'role' => 'lounge'];

        // 座席167作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画29作成-トイレ
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'トイレ']);


        //*** 座席168データ ***//
        $seat = ['name' => '個室上', 'size' => 30, 'position' => ['x' => 1730, 'y' => 42], 'role' => 'media'];

        // 座席168作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席169データ ***//
        $seat = ['name' => '個室中央', 'size' => 30, 'position' => ['x' => 1731, 'y' => 88], 'role' => 'media'];

        // 座席169作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席170データ ***//
        $seat = ['name' => '個室下', 'size' => 30, 'position' => ['x' => 1732, 'y' => 133], 'role' => 'media'];

        // 座席170作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席171データ ***//
        $seat = ['name' => '手洗い場', 'size' => 30, 'position' => ['x' => 1706, 'y' => 192], 'role' => 'media'];

        // 座席171作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画30作成-カウンター右側左
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'カウンター右側左']);


        //*** 座席172データ ***//
        $seat = ['name' => 'カウンター席上', 'size' => 30, 'position' => ['x' => 1341, 'y' => 231], 'role' => 'media'];

        // 座席172作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席173データ ***//
        $seat = ['name' => 'カウンター席下', 'size' => 30, 'position' => ['x' => 1341, 'y' => 268], 'role' => 'media'];

        // 座席173作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画31作成-カウンター右側右
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'カウンター右側右']);


        //*** 座席174データ ***//
        $seat = ['name' => 'カウンター席上', 'size' => 30, 'position' => ['x' => 1492, 'y' => 230], 'role' => 'media'];

        // 座席174作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席175データ ***//
        $seat = ['name' => 'カウンター席下', 'size' => 30, 'position' => ['x' => 1492, 'y' => 266], 'role' => 'media'];

        // 座席175作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画32作成-掲示板1
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '掲示板1']);


        //*** 座席176データ ***//
        $seat = ['name' => '左上', 'size' => 30, 'position' => ['x' => 1655, 'y' => 740], 'role' => 'media'];

        // 座席176作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席177データ ***//
        $seat = ['name' => '左下', 'size' => 30, 'position' => ['x' => 1655, 'y' => 819], 'role' => 'media'];

        // 座席177作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席178データ ***//
        $seat = ['name' => '右上', 'size' => 30, 'position' => ['x' => 1758, 'y' => 741], 'role' => 'media'];

        // 座席178作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席179データ ***//
        $seat = ['name' => '右下', 'size' => 30, 'position' => ['x' => 1758, 'y' => 820], 'role' => 'media'];

        // 座席179作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画33作成-その他
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'その他']);


        //*** 座席180データ ***//
        $seat = ['name' => '休憩室F前', 'size' => 30, 'position' => ['x' => 1830, 'y' => 1117], 'role' => 'media'];

        // 座席180作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画34作成-その他
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'その他']);


        //*** 座席181データ ***//
        $seat = ['name' => '休憩室H前', 'size' => 30, 'position' => ['x' => 1420, 'y' => 862], 'role' => 'media'];

        // 座席181作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画35作成-その他
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'その他']);


        //*** 座席182データ ***//
        $seat = ['name' => '中央左上', 'size' => 30, 'position' => ['x' => 1000, 'y' => 240], 'role' => 'media'];

        // 座席182作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席183データ ***//
        $seat = ['name' => '中央左下', 'size' => 30, 'position' => ['x' => 998, 'y' => 357], 'role' => 'media'];

        // 座席183作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席184データ ***//
        $seat = ['name' => '中央右上', 'size' => 30, 'position' => ['x' => 1155, 'y' => 244], 'role' => 'media'];

        // 座席184作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席185データ ***//
        $seat = ['name' => '中央右下', 'size' => 30, 'position' => ['x' => 1147, 'y' => 354], 'role' => 'media'];

        // 座席185作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画36作成-その他
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'その他']);


        //*** 座席186データ ***//
        $seat = ['name' => 'エスカレーター下り踊り場', 'size' => 30, 'position' => ['x' => 1105, 'y' => 420], 'role' => 'media'];

        // 座席186作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席187データ ***//
        $seat = ['name' => 'エスカレーター上り踊り場', 'size' => 30, 'position' => ['x' => 1052, 'y' => 428], 'role' => 'media'];

        // 座席187作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席188データ ***//
        $seat = ['name' => 'エスカレーター下り', 'size' => 30, 'position' => ['x' => 1104, 'y' => 629], 'role' => 'media'];

        // 座席188作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画37作成-カウンター左側左
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'カウンター左側左']);


        //*** 座席189データ ***//
        $seat = ['name' => 'カウンター席上', 'size' => 30, 'position' => ['x' => 662, 'y' => 229], 'role' => 'media'];

        // 座席189作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席190データ ***//
        $seat = ['name' => 'カウンター席下', 'size' => 30, 'position' => ['x' => 662, 'y' => 267], 'role' => 'media'];

        // 座席190作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画38作成-カウンター左側右
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'カウンター左側右']);


        //*** 座席191データ ***//
        $seat = ['name' => 'カウンター席上', 'size' => 30, 'position' => ['x' => 817, 'y' => 229], 'role' => 'media'];

        // 座席191作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席192データ ***//
        $seat = ['name' => 'カウンター席下', 'size' => 30, 'position' => ['x' => 815, 'y' => 266], 'role' => 'media'];

        // 座席192作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画39作成-掲示板2
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '掲示板2']);


        //*** 座席193データ ***//
        $seat = ['name' => '左', 'size' => 30, 'position' => ['x' => 229, 'y' => 547], 'role' => 'media'];

        // 座席193作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席194データ ***//
        $seat = ['name' => '中央', 'size' => 30, 'position' => ['x' => 298, 'y' => 548], 'role' => 'media'];

        // 座席194作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席195データ ***//
        $seat = ['name' => '右', 'size' => 30, 'position' => ['x' => 367, 'y' => 548], 'role' => 'media'];

        // 座席195作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画40作成-その他
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'その他']);

        //*** 座席196データ ***//
        $seat = ['name' => 'メンタリングスペース中央', 'size' => 30, 'position' => ['x' => 752, 'y' => 680], 'role' => 'media'];

        // 座席196作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);
    }
}
