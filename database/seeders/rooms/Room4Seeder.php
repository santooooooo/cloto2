<?php

namespace Database\Seeders\rooms;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Section;
use App\Models\Seat;

class Room4Seeder extends Seeder
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
            'name' => '自習室',
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
        $seat = ['name' => '自習席', 'size' => 50, 'position' => ['x' => 1474, 'y' => 173], 'role' => 'study'];

        // 座席1作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席2データ ***//
        $seat = ['name' => '自習席', 'size' => 50, 'position' => ['x' => 1641, 'y' => 173], 'role' => 'study'];

        // 座席2作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席3データ ***//
        $seat = ['name' => '自習席', 'size' => 50, 'position' => ['x' => 1808, 'y' => 173], 'role' => 'study'];

        // 座席3作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席4データ ***//
        $seat = ['name' => '自習席', 'size' => 50, 'position' => ['x' => 1475, 'y' => 284], 'role' => 'study'];

        // 座席4作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席5データ ***//
        $seat = ['name' => '自習席', 'size' => 50, 'position' => ['x' => 1643, 'y' => 284], 'role' => 'study'];

        // 座席5作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席6データ ***//
        $seat = ['name' => '自習席', 'size' => 50, 'position' => ['x' => 1811, 'y' => 284], 'role' => 'study'];

        // 座席6作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席7データ ***//
        $seat = ['name' => '自習席', 'size' => 50, 'position' => ['x' => 1476, 'y' => 395], 'role' => 'study'];

        // 座席7作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席8データ ***//
        $seat = ['name' => '自習席', 'size' => 50, 'position' => ['x' => 1645, 'y' => 395], 'role' => 'study'];

        // 座席8作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席9データ ***//
        $seat = ['name' => '自習席', 'size' => 50, 'position' => ['x' => 1815, 'y' => 395], 'role' => 'study'];

        // 座席9作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席10データ ***//
        $seat = ['name' => '自習席', 'size' => 50, 'position' => ['x' => 1478, 'y' => 506], 'role' => 'study'];

        // 座席10作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席11データ ***//
        $seat = ['name' => '自習席', 'size' => 50, 'position' => ['x' => 1648, 'y' => 506], 'role' => 'study'];

        // 座席11作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席12データ ***//
        $seat = ['name' => '自習席', 'size' => 50, 'position' => ['x' => 1819, 'y' => 506], 'role' => 'study'];

        // 座席12作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画2作成-休憩室1
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '休憩室1']);


        //*** 座席13データ ***//
        $seat = ['name' => '休憩席', 'size' => 50, 'position' => ['x' => 1014, 'y' => 1004], 'role' => 'lounge'];

        // 座席13作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席14データ ***//
        $seat = ['name' => '休憩席', 'size' => 50, 'position' => ['x' => 1080, 'y' => 937], 'role' => 'lounge'];

        // 座席15作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席15データ ***//
        $seat = ['name' => '休憩席', 'size' => 50, 'position' => ['x' => 1146, 'y' => 1004], 'role' => 'lounge'];

        // 座席15作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席16データ ***//
        $seat = ['name' => '休憩席', 'size' => 50, 'position' => ['x' => 1080, 'y' => 1071], 'role' => 'lounge'];

        // 座席16作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画3作成-休憩室2
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '休憩室2']);


        //*** 座席17データ ***//
        $seat = ['name' => '休憩席', 'size' => 50, 'position' => ['x' => 1364, 'y' => 1004], 'role' => 'lounge'];

        // 座席17作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席18データ ***//
        $seat = ['name' => '休憩席', 'size' => 50, 'position' => ['x' => 1430, 'y' => 937], 'role' => 'lounge'];

        // 座席18作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席19データ ***//
        $seat = ['name' => '休憩席', 'size' => 50, 'position' => ['x' => 1497, 'y' => 1004], 'role' => 'lounge'];

        // 座席19作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席20データ ***//
        $seat = ['name' => '休憩席', 'size' => 50, 'position' => ['x' => 1431, 'y' => 1071], 'role' => 'lounge'];

        // 座席20作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画4作成-休憩室3
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '休憩室3']);


        //*** 座席21データ ***//
        $seat = ['name' => '休憩席', 'size' => 50, 'position' => ['x' => 1713, 'y' => 1004], 'role' => 'lounge'];

        // 座席21作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席22データ ***//
        $seat = ['name' => '休憩席', 'size' => 50, 'position' => ['x' => 1779, 'y' => 936], 'role' => 'lounge'];

        // 座席22作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席23データ ***//
        $seat = ['name' => '休憩席', 'size' => 50, 'position' => ['x' => 1848, 'y' => 1004], 'role' => 'lounge'];

        // 座席23作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席24データ ***//
        $seat = ['name' => '休憩席', 'size' => 50, 'position' => ['x' => 1782, 'y' => 1071], 'role' => 'lounge'];

        // 座席24作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画5作成-管理者雑談エリア
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '管理者雑談エリア']);


        //*** 座席25データ ***//
        $seat = ['name' => '管理者雑談席', 'size' => 50, 'position' => ['x' => 294, 'y' => 902], 'role' => 'mentor'];

        // 座席25作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席26データ ***//
        $seat = ['name' => '管理者雑談席', 'size' => 50, 'position' => ['x' => 491, 'y' => 868], 'role' => 'mentor'];

        // 座席26作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画6作成-管理者待機室
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '講師室']);


        //*** 座席27データ ***//
        $seat = ['name' => '講師席', 'size' => 50, 'position' => ['x' => 360, 'y' => 1001], 'role' => 'staff'];

        // 座席27作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席28データ ***//
        $seat = ['name' => '講師席', 'size' => 50, 'position' => ['x' => 447, 'y' => 1001], 'role' => 'staff'];

        // 座席28作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席29データ ***//
        $seat = ['name' => '講師席', 'size' => 50, 'position' => ['x' => 356, 'y' => 1124], 'role' => 'staff'];

        // 座席29作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席30データ ***//
        $seat = ['name' => '講師席', 'size' => 50, 'position' => ['x' => 443, 'y' => 1124], 'role' => 'staff'];

        // 座席30作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画7作成-2人席1
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '2人雑談スペース1']);


        //*** 座席31データ ***//
        $seat = ['name' => '雑談席', 'size' => 50, 'position' => ['x' => 356, 'y' => 203], 'role' => 'hangout'];

        // 座席31作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席32データ ***//
        $seat = ['name' => '雑談席', 'size' => 50, 'position' => ['x' => 455, 'y' => 203], 'role' => 'hangout'];

        // 座席32作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画8作成-2人席2
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '2人雑談スペース2']);


        //*** 座席33データ ***//
        $seat = ['name' => '雑談席', 'size' => 50, 'position' => ['x' => 350, 'y' => 371], 'role' => 'hangout'];

        // 座席33作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席34データ ***//
        $seat = ['name' => '雑談席', 'size' => 50, 'position' => ['x' => 452, 'y' => 371], 'role' => 'hangout'];

        // 座席34作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画9作成-2人席3
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '2人雑談スペース3']);


        //*** 座席35データ ***//
        $seat = ['name' => '雑談席', 'size' => 50, 'position' => ['x' => 346, 'y' => 540], 'role' => 'hangout'];

        // 座席35作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席36データ ***//
        $seat = ['name' => '雑談席', 'size' => 50, 'position' => ['x' => 447, 'y' => 540], 'role' => 'hangout'];

        // 座席36作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画10作成-カウンター1
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'カウンター1']);


        //*** 座席37データ ***//
        $seat = ['name' => 'カウンター席37', 'size' => 50, 'position' => ['x' => 602, 'y' => 195], 'role' => 'media'];

        // 座席37作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席38データ ***//
        $seat = ['name' => 'カウンター席38', 'size' => 50, 'position' => ['x' => 688, 'y' => 195], 'role' => 'media'];

        // 座席38作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席39データ ***//
        $seat = ['name' => 'カウンター席39', 'size' => 50, 'position' => ['x' => 800, 'y' => 195], 'role' => 'media'];

        // 座席39作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席40データ ***//
        $seat = ['name' => 'カウンター席40', 'size' => 50, 'position' => ['x' => 885, 'y' => 195], 'role' => 'media'];

        // 座席40作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画11作成-2人席4
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '2人雑談スペース4']);


        //*** 座席41データ ***//
        $seat = ['name' => '雑談席', 'size' => 50, 'position' => ['x' => 1032, 'y' => 78], 'role' => 'hangout'];

        // 座席41作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席42データ ***//
        $seat = ['name' => '雑談席', 'size' => 50, 'position' => ['x' => 1102, 'y' => 148], 'role' => 'hangout'];

        // 座席42作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画12作成-カウンター2
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'カウンター2']);


        //*** 座席43データ ***//
        $seat = ['name' => 'カウンター席43', 'size' => 50, 'position' => ['x' => 966, 'y' => 375], 'role' => 'media'];

        // 座席43作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席44データ ***//
        $seat = ['name' => 'カウンター席44', 'size' => 50, 'position' => ['x' => 966, 'y' => 485], 'role' => 'media'];

        // 座席44作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画13作成-トイレ
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'トイレ']);


        //*** 座席45データ ***//
        $seat = ['name' => '個室1', 'size' => 50, 'position' => ['x' => 1324, 'y' => 66], 'role' => 'media'];

        // 座席45作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席46データ ***//
        $seat = ['name' => '個室2', 'size' => 50, 'position' => ['x' => 1324, 'y' => 130], 'role' => 'media'];

        // 座席46作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席47データ ***//
        $seat = ['name' => '個室3', 'size' => 50, 'position' => ['x' => 1324, 'y' => 197], 'role' => 'media'];

        // 座席47作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席48データ ***//
        $seat = ['name' => '手洗い場', 'size' => 50, 'position' => ['x' => 1210, 'y' => 125], 'role' => 'media'];

        // 座席48作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席49データ ***//
        $seat = ['name' => 'トイレ入口', 'size' => 50, 'position' => ['x' => 1190, 'y' => 197], 'role' => 'media'];

        // 座席49作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画14作成-立話
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '立ち話スペース']);


        //*** 座席50データ ***//
        $seat = ['name' => '雑談席', 'size' => 50, 'position' => ['x' => 1110, 'y' => 465], 'role' => 'hangout'];

        // 座席50作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席51データ ***//
        $seat = ['name' => '雑談席', 'size' => 50, 'position' => ['x' => 1110, 'y' => 570], 'role' => 'hangout'];

        // 座席51作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席52データ ***//
        $seat = ['name' => '雑談席', 'size' => 50, 'position' => ['x' => 1220, 'y' => 465], 'role' => 'hangout'];

        // 座席52作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席53データ ***//
        $seat = ['name' => '雑談席', 'size' => 50, 'position' => ['x' => 1220, 'y' => 570], 'role' => 'hangout'];

        // 座席53作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画15作成-掲示板
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '掲示板エリア']);


        //*** 座席54データ ***//
        $seat = ['name' => '掲示板54', 'size' => 50, 'position' => ['x' => 660, 'y' => 632], 'role' => 'media'];

        // 座席54作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席55データ ***//
        $seat = ['name' => '掲示板55', 'size' => 50, 'position' => ['x' => 710, 'y' => 632], 'role' => 'media'];

        // 座席55作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席56データ ***//
        $seat = ['name' => '掲示板56', 'size' => 50, 'position' => ['x' => 760, 'y' => 632], 'role' => 'media'];

        // 座席56作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席57データ ***//
        $seat = ['name' => '掲示板57', 'size' => 50, 'position' => ['x' => 810, 'y' => 632], 'role' => 'media'];

        // 座席57作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画16作成-その他
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'その他']);


        //*** 座席58データ ***//
        $seat = ['name' => '建物入口', 'size' => 50, 'position' => ['x' => 735, 'y' => 875], 'role' => 'media'];

        // 座席58作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席59データ ***//
        $seat = ['name' => '自習席入口前', 'size' => 50, 'position' => ['x' => 1478, 'y' => 700], 'role' => 'media'];

        // 座席59作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席60データ ***//
        $seat = ['name' => '廊下突き当り', 'size' => 50, 'position' => ['x' => 1830, 'y' => 600], 'role' => 'media'];

        // 座席60作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席61データ ***//
        $seat = ['name' => '建物外', 'size' => 50, 'position' => ['x' => 830, 'y' => 1004], 'role' => 'media'];

        // 座席61作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);
    }
}
