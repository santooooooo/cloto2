<?php

namespace Database\Seeders\rooms;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Section;
use App\Models\Seat;

class Room1Seeder extends Seeder
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
            'name' => '101号室',
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
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 756, 'y' => 900], 'role' => 'study'];

        // 座席1作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席2データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 870, 'y' => 900], 'role' => 'study'];

        // 座席2作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席3データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 985, 'y' => 900], 'role' => 'study'];

        // 座席3作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席4データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 755, 'y' => 977], 'role' => 'study'];

        // 座席4作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席5データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 870, 'y' => 977], 'role' => 'study'];

        // 座席5作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席6データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 985, 'y' => 977], 'role' => 'study'];

        // 座席6作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席7データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 754, 'y' => 1057], 'role' => 'study'];

        // 座席7作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席8データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 869, 'y' => 1057], 'role' => 'study'];

        // 座席8作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席9データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 984, 'y' => 1057], 'role' => 'study'];

        // 座席9作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席10データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 753, 'y' => 1133], 'role' => 'study'];

        // 座席10作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席11データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 869, 'y' => 1133], 'role' => 'study'];

        // 座席11作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席12データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 984, 'y' => 1133], 'role' => 'study'];

        // 座席12作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画2作成-Staff荷物置き場
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'Staff荷物置き場']);


        //*** 座席13データ ***//
        $seat = ['name' => 'Staff席', 'size' => 30, 'position' => ['x' => 1101, 'y' => 1019], 'role' => 'staff'];

        // 座席13作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席14データ ***//
        $seat = ['name' => 'Staff席', 'size' => 30, 'position' => ['x' => 1182, 'y' => 1019], 'role' => 'staff'];

        // 座席15作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席15データ ***//
        $seat = ['name' => 'Staff席', 'size' => 30, 'position' => ['x' => 1100, 'y' => 1100], 'role' => 'staff'];

        // 座席15作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席16データ ***//
        $seat = ['name' => 'Staff席', 'size' => 30, 'position' => ['x' => 1182, 'y' => 1100], 'role' => 'staff'];

        // 座席16作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画3作成-Staff談話スペース
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'Staff談話スペース']);


        //*** 座席17データ ***//
        $seat = ['name' => 'Staff談話席', 'size' => 30, 'position' => ['x' => 1177, 'y' => 881], 'role' => 'staff'];

        // 座席17作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席18データ ***//
        $seat = ['name' => 'Staff談話席', 'size' => 30, 'position' => ['x' => 1178, 'y' => 913], 'role' => 'staff'];

        // 座席18作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席19データ ***//
        $seat = ['name' => 'Staff談話席', 'size' => 30, 'position' => ['x' => 1139, 'y' => 954], 'role' => 'staff'];

        // 座席19作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席20データ ***//
        $seat = ['name' => 'Staff談話席', 'size' => 30, 'position' => ['x' => 1106, 'y' => 955], 'role' => 'staff'];

        // 座席20作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画4作成-休憩室A
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '休憩室A']);


        //*** 座席21データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 759, 'y' => 304], 'role' => 'lounge'];

        // 座席21作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席22データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 715, 'y' => 348], 'role' => 'lounge'];

        // 座席22作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席23データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 758, 'y' => 392], 'role' => 'lounge'];

        // 座席23作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席24データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 803, 'y' => 350], 'role' => 'lounge'];

        // 座席24作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画5作成-休憩室B
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '休憩室B']);


        //*** 座席25データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 758, 'y' => 494], 'role' => 'lounge'];

        // 座席25作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席26データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 712, 'y' => 539], 'role' => 'lounge'];

        // 座席26作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席27データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 757, 'y' => 582], 'role' => 'lounge'];

        // 座席27作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席28データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 802, 'y' => 538], 'role' => 'lounge'];

        // 座席28作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画5作成-休憩室C
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '休憩室C']);


        //*** 座席29データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 757, 'y' => 683], 'role' => 'lounge'];

        // 座席29作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席30データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 711, 'y' => 729], 'role' => 'lounge'];

        // 座席30作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席31データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 756, 'y' => 772], 'role' => 'lounge'];

        // 座席31作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席32データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 802, 'y' => 729], 'role' => 'lounge'];

        // 座席32作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画8作成-2人雑談スペース1
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '2人雑談スペース1']);


        //*** 座席33データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1387, 'y' => 107], 'role' => 'hangout'];

        // 座席33作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席34データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1452, 'y' => 107], 'role' => 'hangout'];

        // 座席34作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画9作成-2人雑談スペース2
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '2人雑談スペース2']);


        //*** 座席35データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1389, 'y' => 256], 'role' => 'hangout'];

        // 座席35作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席36データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1452, 'y' => 256], 'role' => 'hangout'];

        // 座席36作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画10作成-2人雑談スペース3
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '2人雑談スペース3']);


        //*** 座席37データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1389, 'y' => 404], 'role' => 'hangout'];

        // 座席37作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席38データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1455, 'y' => 405], 'role' => 'hangout'];

        // 座席38作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画10作成-カウンター上側
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'カウンター上側']);

        //*** 座席39データ ***//
        $seat = ['name' => 'カウンター席右', 'size' => 30, 'position' => ['x' => 1308, 'y' => 142], 'role' => 'media'];

        // 座席39作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席40データ ***//
        $seat = ['name' => 'カウンター席左', 'size' => 30, 'position' => ['x' => 1232, 'y' => 142], 'role' => 'media'];

        // 座席40作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画11作成-カウンター左側
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'カウンター左側']);


        //*** 座席41データ ***//
        $seat = ['name' => 'カウンター席上', 'size' => 30, 'position' => ['x' => 1162, 'y' => 221], 'role' => 'media'];

        // 座席41作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席42データ ***//
        $seat = ['name' => 'カウンター席下', 'size' => 30, 'position' => ['x' => 1162, 'y' => 295], 'role' => 'media'];

        // 座席42作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画12作成-雑談スペース
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '雑談スペース']);


        //*** 座席43データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 863, 'y' => 85], 'role' => 'hangout'];

        // 座席43作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席44データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 916, 'y' => 85], 'role' => 'hangout'];

        // 座席44作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席45データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 863, 'y' => 213], 'role' => 'hangout'];

        // 座席45作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席46データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 916, 'y' => 213], 'role' => 'hangout'];

        // 座席46作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画13作成-雑談スペース
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '雑談スペース']);


        //*** 座席47データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1022, 'y' => 500], 'role' => 'hangout'];

        // 座席47作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席48データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1022, 'y' => 579], 'role' => 'hangout'];

        // 座席48作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席49データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1138, 'y' => 500], 'role' => 'hangout'];

        // 座席49作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席50データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1137, 'y' => 578], 'role' => 'hangout'];

        // 座席50作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画13作成-その他
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'その他']);


        //*** 座席51データ ***//
        $seat = ['name' => '左上角', 'size' => 30, 'position' => ['x' => 717, 'y' => 84], 'role' => 'media'];

        // 座席51作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画14作成-その他
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'その他']);


        //*** 座席52データ ***//
        $seat = ['name' => '自習室前', 'size' => 30, 'position' => ['x' => 904, 'y' => 782], 'role' => 'media'];

        // 座席52作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画15作成-その他
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'その他']);


        //*** 座席53データ ***//
        $seat = ['name' => '右上角', 'size' => 30, 'position' => ['x' => 1460, 'y' => 173], 'role' => 'media'];

        // 座席53作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画16作成-掲示板エリア
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '掲示板エリア']);


        //*** 座席54データ ***//
        $seat = ['name' => '左', 'size' => 30, 'position' => ['x' => 1227, 'y' => 369], 'role' => 'media'];

        // 座席54作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席55データ ***//
        $seat = ['name' => '中央', 'size' => 30, 'position' => ['x' => 1268, 'y' => 369], 'role' => 'media'];

        // 座席55作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席56データ ***//
        $seat = ['name' => '右', 'size' => 30, 'position' => ['x' => 1309, 'y' => 369], 'role' => 'media'];

        // 座席56作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画17作成-トイレ
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'トイレ']);


        //*** 座席57データ ***//
        $seat = ['name' => '手洗い場', 'size' => 30, 'position' => ['x' => 1341, 'y' => 523], 'role' => 'media'];

        // 座席57作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席58データ ***//
        $seat = ['name' => '個室左', 'size' => 30, 'position' => ['x' => 1383, 'y' => 499], 'role' => 'media'];

        // 座席58作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席59データ ***//
        $seat = ['name' => '個室中央', 'size' => 30, 'position' => ['x' => 1430, 'y' => 499], 'role' => 'media'];

        // 座席59作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席60データ ***//
        $seat = ['name' => '個室右', 'size' => 30, 'position' => ['x' => 1475, 'y' => 499], 'role' => 'media'];

        // 座席60作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席61データ ***//
        $seat = ['name' => '出入り口', 'size' => 30, 'position' => ['x' => 1348, 'y' => 569], 'role' => 'media'];

        // 座席61作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画18作成-掲示板エリア
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '掲示板エリア']);


        //*** 座席62データ ***//
        $seat = ['name' => '左', 'size' => 30, 'position' => ['x' => 1377, 'y' => 627], 'role' => 'media'];

        // 座席62作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席63データ ***//
        $seat = ['name' => '右', 'size' => 30, 'position' => ['x' => 1428, 'y' => 627], 'role' => 'media'];

        // 座席63作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画19作成-その他
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'その他']);

        //*** 座席64データ ***//
        $seat = ['name' => 'エスカレーター下', 'size' => 30, 'position' => ['x' => 1278, 'y' => 697], 'role' => 'media'];

        // 座席64作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画20作成-その他
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'その他']);

        //*** 座席65データ ***//
        $seat = ['name' => '右下角', 'size' => 30, 'position' => ['x' => 1401, 'y' => 781], 'role' => 'media'];

        // 座席65作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画21作成-その他
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'その他']);

        //*** 座席66データ ***//
        $seat = ['name' => 'エスカレーター', 'size' => 30, 'position' => ['x' => 1283, 'y' => 884], 'role' => 'media'];

        // 座席66作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画22作成-その他
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'その他']);

        //*** 座席67データ ***//
        $seat = ['name' => 'Staff右上', 'size' => 30, 'position' => ['x' => 1231, 'y' => 858], 'role' => 'media'];

        // 座席67作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画23作成-その他
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'その他']);

        //*** 座席68データ ***//
        $seat = ['name' => '自習室右下', 'size' => 30, 'position' => ['x' => 1049, 'y' => 1124], 'role' => 'media'];

        // 座席68作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);
    }
}
