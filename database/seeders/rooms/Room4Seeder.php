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
            'name' => '202号室',
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
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1315, 'y' => 857], 'role' => 'study'];

        // 座席1作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席2データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1367, 'y' => 857], 'role' => 'study'];

        // 座席2作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席3データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1449, 'y' => 857], 'role' => 'study'];

        // 座席3作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席4データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1500, 'y' => 857], 'role' => 'study'];

        // 座席4作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席5データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1553, 'y' => 857], 'role' => 'study'];

        // 座席5作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席6データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1315, 'y' => 931], 'role' => 'study'];

        // 座席6作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席7データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1369, 'y' => 931], 'role' => 'study'];

        // 座席7作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席8データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1449, 'y' => 931], 'role' => 'study'];

        // 座席8作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席9データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1500, 'y' => 931], 'role' => 'study'];

        // 座席9作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席10データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1553, 'y' => 931], 'role' => 'study'];

        // 座席10作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席11データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1315, 'y' => 1007], 'role' => 'study'];

        // 座席11作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席12データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1367, 'y' => 1007], 'role' => 'study'];

        // 座席12作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席13データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1449, 'y' => 1007], 'role' => 'study'];

        // 座席13作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席14データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1500, 'y' => 1007], 'role' => 'study'];

        // 座席15作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席15データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1554, 'y' => 1007], 'role' => 'study'];

        // 座席15作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席16データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1315, 'y' => 1083], 'role' => 'study'];

        // 座席16作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席17データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1367, 'y' => 1083], 'role' => 'study'];

        // 座席17作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席18データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1449, 'y' => 1083], 'role' => 'study'];

        // 座席18作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席19データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1500, 'y' => 1083], 'role' => 'study'];

        // 座席19作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席20データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1554, 'y' => 1083], 'role' => 'study'];

        // 座席20作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画2作成-Staff荷物置き場
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'Staff荷物置き場']);


        //*** 座席21データ ***//
        $seat = ['name' => 'Staff席', 'size' => 30, 'position' => ['x' => 834, 'y' => 526], 'role' => 'staff'];

        // 座席21作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席22データ ***//
        $seat = ['name' => 'Staff席', 'size' => 30, 'position' => ['x' => 890, 'y' => 526], 'role' => 'staff'];

        // 座席22作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席23データ ***//
        $seat = ['name' => 'Staff席', 'size' => 30, 'position' => ['x' => 931, 'y' => 560], 'role' => 'staff'];

        // 座席23作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席24データ ***//
        $seat = ['name' => 'Staff席', 'size' => 30, 'position' => ['x' => 889, 'y' => 595], 'role' => 'staff'];

        // 座席24作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画3作成-Staff談話スペース
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'Staff談話スペース']);


        //*** 座席25データ ***//
        $seat = ['name' => 'Staff談話席', 'size' => 30, 'position' => ['x' => 817, 'y' => 630], 'role' => 'mentor'];

        // 座席25作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席26データ ***//
        $seat = ['name' => 'Staff談話席', 'size' => 30, 'position' => ['x' => 817, 'y' => 657], 'role' => 'mentor'];

        // 座席26作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席27データ ***//
        $seat = ['name' => 'Staff談話席', 'size' => 30, 'position' => ['x' => 817, 'y' => 687], 'role' => 'mentor'];

        // 座席27作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席28データ ***//
        $seat = ['name' => 'Staff談話席', 'size' => 30, 'position' => ['x' => 847, 'y' => 686], 'role' => 'mentor'];

        // 座席28作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画4作成-休憩室A
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '休憩室A']);


        //*** 座席29データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1221, 'y' => 97], 'role' => 'lounge'];

        // 座席29作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席30データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1171, 'y' => 139], 'role' => 'lounge'];

        // 座席30作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席31データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1221, 'y' => 180], 'role' => 'lounge'];

        // 座席31作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席32データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1263, 'y' => 139], 'role' => 'lounge'];

        // 座席32作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画5作成-休憩室B
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '休憩室B']);


        //*** 座席33データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1514, 'y' => 98], 'role' => 'lounge'];

        // 座席33作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席34データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1470, 'y' => 139], 'role' => 'lounge'];

        // 座席34作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席35データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1514, 'y' => 180], 'role' => 'lounge'];

        // 座席35作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席36データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1556, 'y' => 139], 'role' => 'lounge'];

        // 座席36作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画6作成-休憩室C
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '休憩室C']);


        //*** 座席37データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1516, 'y' => 279], 'role' => 'lounge'];

        // 座席37作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席38データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1472, 'y' => 321], 'role' => 'lounge'];

        // 座席38作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席39データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1516, 'y' => 361], 'role' => 'lounge'];

        // 座席39作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席40データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1557, 'y' => 320], 'role' => 'lounge'];

        // 座席40作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画7作成-休憩室D
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '休憩室D']);


        //*** 座席41データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1516, 'y' => 461], 'role' => 'lounge'];

        // 座席41作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席42データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1474, 'y' => 505], 'role' => 'lounge'];

        // 座席42作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席43データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1518, 'y' => 545], 'role' => 'lounge'];

        // 座席43作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席44データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1562, 'y' => 504], 'role' => 'lounge'];

        // 座席44作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画8作成-休憩室E
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '休憩室E']);


        //*** 座席45データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1518, 'y' => 645], 'role' => 'lounge'];

        // 座席45作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席46データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1474, 'y' => 690], 'role' => 'lounge'];

        // 座席46作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席47データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1518, 'y' => 733], 'role' => 'lounge'];

        // 座席47作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席48データ ***//
        $seat = ['name' => '休憩席', 'size' => 30, 'position' => ['x' => 1562, 'y' => 690], 'role' => 'lounge'];

        // 座席48作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画9作成-登壇会場
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '登壇会場']);


        //*** 座席49データ ***//
        $seat = ['name' => '登壇席', 'size' => 30, 'position' => ['x' => 1221, 'y' => 374], 'role' => 'speak'];

        // 座席49作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席50データ ***//
        $seat = ['name' => '司会席', 'size' => 30, 'position' => ['x' => 1103, 'y' => 380], 'role' => 'speak'];

        // 座席50作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席51データ ***//
        $seat = ['name' => '質疑席', 'size' => 30, 'position' => ['x' => 1201, 'y' => 475], 'role' => 'speak'];

        // 座席51作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席52データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1128, 'y' => 465], 'role' => 'view'];

        // 座席52作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席53データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1165, 'y' => 465], 'role' => 'view'];

        // 座席53作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席54データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1241, 'y' => 465], 'role' => 'view'];

        // 座席54作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席55データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1274, 'y' => 465], 'role' => 'view'];

        // 座席55作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席56データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1317, 'y' => 465], 'role' => 'view'];

        // 座席56作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席57データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1128, 'y' => 538], 'role' => 'view'];

        // 座席57作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席58データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1165, 'y' => 538], 'role' => 'view'];

        // 座席58作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席59データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1241, 'y' => 538], 'role' => 'view'];

        // 座席59作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席60データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1279, 'y' => 538], 'role' => 'view'];

        // 座席60作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席61データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1317, 'y' => 538], 'role' => 'view'];

        // 座席61作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席62データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1128, 'y' => 611], 'role' => 'view'];

        // 座席62作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席63データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1165, 'y' => 611], 'role' => 'view'];

        // 座席63作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席64データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1241, 'y' => 611], 'role' => 'view'];

        // 座席64作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席65データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1279, 'y' => 611], 'role' => 'view'];

        // 座席65作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席66データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1317, 'y' => 611], 'role' => 'view'];

        // 座席66作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席67データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1128, 'y' => 671], 'role' => 'view'];

        // 座席67作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席68データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1165, 'y' => 671], 'role' => 'view'];

        // 座席68作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席69データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1241, 'y' => 671], 'role' => 'view'];

        // 座席69作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席70データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1279, 'y' => 671], 'role' => 'view'];

        // 座席70作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席71データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1317, 'y' => 671], 'role' => 'view'];

        // 座席71作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画10作成-2人雑談スペース上
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '2人雑談スペース上']);


        //*** 座席72データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 840, 'y' => 122], 'role' => 'hangout'];

        // 座席72作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席73データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 905, 'y' => 122], 'role' => 'hangout'];

        // 座席73作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画11作成-2人雑談スペース中央
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '2人雑談スペース中央']);


        //*** 座席74データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 840, 'y' => 266], 'role' => 'hangout'];

        // 座席74作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席75データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 904, 'y' => 266], 'role' => 'hangout'];

        // 座席75作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画12作成-2人雑談スペース下
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '2人雑談スペース下']);


        //*** 座席76データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 839, 'y' => 412], 'role' => 'hangout'];

        // 座席76作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席77データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 904, 'y' => 412], 'role' => 'hangout'];

        // 座席77作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画13作成-その他
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'その他']);

        //*** 座席78データ ***//
        $seat = ['name' => '自習室前', 'size' => 30, 'position' => ['x' => 1089, 'y' => 91], 'role' => 'media'];

        // 座席78作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画14作成-カウンター
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'カウンター']);

        //*** 座席79データ ***//
        $seat = ['name' => 'カウンター席左', 'size' => 30, 'position' => ['x' => 998, 'y' => 189], 'role' => 'media'];

        // 座席79作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席80データ ***//
        $seat = ['name' => 'カウンター席右', 'size' => 30, 'position' => ['x' => 1043, 'y' => 189], 'role' => 'media'];

        // 座席80作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画15作成-その他
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'その他']);

        //*** 座席81データ ***//
        $seat = ['name' => '左上角付近', 'size' => 30, 'position' => ['x' => 841, 'y' => 194], 'role' => 'media'];

        // 座席81作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画16作成-その他
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'その他']);

        //*** 座席82データ ***//
        $seat = ['name' => '休憩室C前', 'size' => 30, 'position' => ['x' => 1376, 'y' => 282], 'role' => 'media'];

        // 座席82作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画17作成-その他
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'その他']);

        //*** 座席83データ ***//
        $seat = ['name' => '自習室前', 'size' => 30, 'position' => ['x' => 678, 'y' => 565], 'role' => 'media'];

        // 座席83作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画18作成-掲示板エリア
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '掲示板エリア']);


        //*** 座席84データ ***//
        $seat = ['name' => '上', 'size' => 30, 'position' => ['x' => 1010, 'y' => 557], 'role' => 'media'];

        // 座席84作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席85データ ***//
        $seat = ['name' => '中央', 'size' => 30, 'position' => ['x' => 1010, 'y' => 601], 'role' => 'media'];

        // 座席85作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席86データ ***//
        $seat = ['name' => '下', 'size' => 30, 'position' => ['x' => 1010, 'y' => 644], 'role' => 'media'];

        // 座席86作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画19作成-その他
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'その他']);

        //*** 座席87データ ***//
        $seat = ['name' => '自習室前', 'size' => 30, 'position' => ['x' => 1379, 'y' => 750], 'role' => 'media'];

        // 座席87作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画20作成-その他
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'その他']);

        //*** 座席88データ ***//
        $seat = ['name' => '中央下', 'size' => 30, 'position' => ['x' => 965, 'y' => 748], 'role' => 'media'];

        // 座席88作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画21作成-その他
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'その他']);

        //*** 座席89データ ***//
        $seat = ['name' => 'エスカレーター前', 'size' => 30, 'position' => ['x' => 702, 'y' => 745], 'role' => 'media'];

        // 座席89作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画22作成-その他
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'その他']);

        //*** 座席90データ ***//
        $seat = ['name' => '左下角付近', 'size' => 30, 'position' => ['x' => 892, 'y' => 854], 'role' => 'media'];

        // 座席90作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画23作成-トイレ
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'トイレ']);


        //*** 座席91データ ***//
        $seat = ['name' => '手洗い場', 'size' => 30, 'position' => ['x' => 1196, 'y' => 812], 'role' => 'media'];

        // 座席91作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席92データ ***//
        $seat = ['name' => '個室上', 'size' => 30, 'position' => ['x' => 1226, 'y' => 852], 'role' => 'media'];

        // 座席92作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席93データ ***//
        $seat = ['name' => '個室中央', 'size' => 30, 'position' => ['x' => 1226, 'y' => 898], 'role' => 'media'];

        // 座席93作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席94データ ***//
        $seat = ['name' => '個室下', 'size' => 30, 'position' => ['x' => 1226, 'y' => 943], 'role' => 'media'];

        // 座席94作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画24作成-掲示板エリア
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '掲示板エリア']);


        //*** 座席95データ ***//
        $seat = ['name' => '上', 'size' => 30, 'position' => ['x' => 1191, 'y' => 1045], 'role' => 'media'];

        // 座席95作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席96データ ***//
        $seat = ['name' => '下', 'size' => 30, 'position' => ['x' => 1191, 'y' => 1090], 'role' => 'media'];

        // 座席96作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画25作成-その他
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'その他']);

        //*** 座席97データ ***//
        $seat = ['name' => '自習室右下', 'size' => 30, 'position' => ['x' => 1547, 'y' => 1126], 'role' => 'media'];

        // 座席97作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);
    }
}
