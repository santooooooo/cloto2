<?php

namespace Database\Seeders\rooms;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Section;
use App\Models\Seat;

class Room2Seeder extends Seeder
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
            'name' => '2号室',
            'timetable' => ['00:00' => 'break', '23:59' => 'break']
        ];


        // 部屋作成
        $created_room = Room::create(['name' => $room['name'], 'timetable' => $room['timetable']]);




        // 区画1作成-Staff荷物置き場
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'Staff荷物置き場']);



        //*** 座席1データ ***//
        $seat = ['name' => 'Staff席', 'size' => 30, 'position' => ['x' => 1320, 'y' => 840], 'role' => 'staff'];

        // 座席1作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);


        //*** 座標2データ ***//
        $seat = ['name' => 'Staff席', 'size' => 30, 'position' => ['x' => 1375, 'y' => 840], 'role' => 'staff'];

        // 座席2作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);


        //*** 座席3データ ***//
        $seat = ['name' => 'Staff席', 'size' => 30, 'position' => ['x' => 1431, 'y' => 840], 'role' => 'staff'];

        // 座席3作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);


        //*** 座席4データ ***//
        $seat = ['name' => 'Staff席', 'size' => 30, 'position' => ['x' => 1320, 'y' => 920], 'role' => 'staff'];

        // 座席4作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);


        //*** 座席5データ ***//
        $seat = ['name' => 'Staff席', 'size' => 30, 'position' => ['x' => 1375, 'y' => 920], 'role' => 'staff'];

        // 座席5作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);


        //*** 座席6データ ***//
        $seat = ['name' => 'Staff席', 'size' => 30, 'position' => ['x' => 1431, 'y' => 920], 'role' => 'staff'];

        // 座席6作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        // 区画2作成-Staff談話スペース
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'Staff談話スペース']);



        //*** 座席7データ ***//
        $seat = ['name' => 'Staff談話席', 'size' => 30, 'position' => ['x' => 1349, 'y' => 958], 'role' => 'mentor'];

        // 座席7作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席8データ ***//
        $seat = ['name' => 'Staff談話席', 'size' => 30, 'position' => ['x' => 1349, 'y' => 984], 'role' => 'mentor'];

        // 座席8作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席9データ ***//
        $seat = ['name' => 'Staff談話席', 'size' => 30, 'position' => ['x' => 1349, 'y' => 1009], 'role' => 'mentor'];

        // 座席9作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席10データ ***//
        $seat = ['name' => 'Staff談話席', 'size' => 30, 'position' => ['x' => 1420, 'y' => 958], 'role' => 'mentor'];

        // 座席10作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席11データ ***//
        $seat = ['name' => 'Staff談話席', 'size' => 30, 'position' => ['x' => 1420, 'y' => 984], 'role' => 'mentor'];

        // 座席11作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席12データ ***//
        $seat = ['name' => 'Staff談話席', 'size' => 30, 'position' => ['x' => 1420, 'y' => 1009], 'role' => 'mentor'];

        // 座席12作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画3作成-作業場1
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '作業場1']);



        //*** 座席13データ ***//
        $seat = ['name' => '作業場', 'size' => 30, 'position' => ['x' => 1868, 'y' => 230], 'role' => 'lounge'];

        // 座席13作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席14データ ***//
        $seat = ['name' => '作業場', 'size' => 30, 'position' => ['x' => 1909, 'y' => 266], 'role' => 'lounge'];

        // 座席14作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席15データ ***//
        $seat = ['name' => '作業場', 'size' => 30, 'position' => ['x' => 1870, 'y' => 303], 'role' => 'lounge'];

        // 座席15作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席16データ ***//
        $seat = ['name' => '作業場', 'size' => 30, 'position' => ['x' => 1835, 'y' => 268], 'role' => 'lounge'];

        // 座席16作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画4作成-作業場2
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '作業場2']);



        //*** 座席17データ ***//
        $seat = ['name' => '作業場', 'size' => 30, 'position' => ['x' => 1872, 'y' => 368], 'role' => 'lounge'];

        // 座席17作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席18データ ***//
        $seat = ['name' => '作業場', 'size' => 30, 'position' => ['x' => 1910, 'y' => 406], 'role' => 'lounge'];

        // 座席18作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席19データ ***//
        $seat = ['name' => '作業場', 'size' => 30, 'position' => ['x' => 1875, 'y' => 441], 'role' => 'lounge'];

        // 座席19作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席20データ ***//
        $seat = ['name' => '作業場', 'size' => 30, 'position' => ['x' => 1837, 'y' => 406], 'role' => 'lounge'];

        // 座席20作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画5作成-作業場3
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '作業場3']);



        //*** 座席21データ ***//
        $seat = ['name' => '作業場', 'size' => 30, 'position' => ['x' => 1876, 'y' => 511], 'role' => 'lounge'];

        // 座席21作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席22データ ***//
        $seat = ['name' => '作業場', 'size' => 30, 'position' => ['x' => 1914, 'y' => 549], 'role' => 'lounge'];

        // 座席22作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席23データ ***//
        $seat = ['name' => '作業場', 'size' => 30, 'position' => ['x' => 1878, 'y' => 584], 'role' => 'lounge'];

        // 座席23作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席24データ ***//
        $seat = ['name' => '作業場', 'size' => 30, 'position' => ['x' => 1840, 'y' => 547], 'role' => 'lounge'];

        // 座席24作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画6作成-作業場4
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '作業場4']);



        //*** 座席25データ ***//
        $seat = ['name' => '作業場', 'size' => 30, 'position' => ['x' => 1881, 'y' => 653], 'role' => 'lounge'];

        // 座席25作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席26データ ***//
        $seat = ['name' => '作業場', 'size' => 30, 'position' => ['x' => 1919, 'y' => 691], 'role' => 'lounge'];

        // 座席26作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席27データ ***//
        $seat = ['name' => '作業場', 'size' => 30, 'position' => ['x' => 1883, 'y' => 729], 'role' => 'lounge'];

        // 座席27作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席28データ ***//
        $seat = ['name' => '作業場', 'size' => 30, 'position' => ['x' => 1845, 'y' => 692], 'role' => 'lounge'];

        // 座席28作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画7作成-作業場5
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '作業場5']);



        //*** 座席29データ ***//
        $seat = ['name' => '作業場', 'size' => 30, 'position' => ['x' => 1885, 'y' => 801], 'role' => 'lounge'];

        // 座席29作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席30データ ***//
        $seat = ['name' => '作業場', 'size' => 30, 'position' => ['x' => 1926, 'y' => 839], 'role' => 'lounge'];

        // 座席30作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席31データ ***//
        $seat = ['name' => '作業場', 'size' => 30, 'position' => ['x' => 1887, 'y' => 877], 'role' => 'lounge'];

        // 座席31作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席32データ ***//
        $seat = ['name' => '作業場', 'size' => 30, 'position' => ['x' => 1848, 'y' => 839], 'role' => 'lounge'];

        // 座席32作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画8作成-4人雑談スペース左
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '4人雑談スペース左']);



        //*** 座席33データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1444, 'y' => 622], 'role' => 'hangout'];

        // 座席33作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席34データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1505, 'y' => 622], 'role' => 'hangout'];

        // 座席34作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席35データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1445, 'y' => 690], 'role' => 'hangout'];

        // 座席35作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席36データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1506, 'y' => 690], 'role' => 'hangout'];

        // 座席36作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画9作成-4人雑談スペース右
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '4人雑談スペース右']);



        //*** 座席37データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1627, 'y' => 622], 'role' => 'hangout'];

        // 座席37作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席38データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1687, 'y' => 622], 'role' => 'hangout'];

        // 座席38作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席39データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1627, 'y' => 690], 'role' => 'hangout'];

        // 座席39作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席40データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1687, 'y' => 690], 'role' => 'hangout'];

        // 座席40作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画10作成-3人雑談スペース左
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '3人雑談スペース左']);



        //*** 座席41データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1407, 'y' => 495], 'role' => 'hangout'];

        // 座席41作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席42データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1464, 'y' => 495], 'role' => 'hangout'];

        // 座席42作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席43データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1437, 'y' => 543], 'role' => 'hangout'];

        // 座席43作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画11作成-3人雑談スペース中
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '3人雑談スペース中']);



        //*** 座席44データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1522, 'y' => 499], 'role' => 'hangout'];

        // 座席44作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席45データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1575, 'y' => 499], 'role' => 'hangout'];

        // 座席45作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席46データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1547, 'y' => 544], 'role' => 'hangout'];

        // 座席46作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画12作成-3人雑談スペース右
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '3人雑談スペース右']);



        //*** 座席47データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1626, 'y' => 495], 'role' => 'hangout'];

        // 座席47作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席48データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1683, 'y' => 495], 'role' => 'hangout'];

        // 座席48作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席49データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 1657, 'y' => 595], 'role' => 'hangout'];

        // 座席49作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画13作成-集中ゾーン
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '集中ゾーン']);



        //*** 座席50データ ***//
        $seat = ['name' => '作業場', 'size' => 30, 'position' => ['x' => 1375, 'y' => 374], 'role' => 'hangout'];

        // 座席50作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席51データ ***//
        $seat = ['name' => '作業場', 'size' => 30, 'position' => ['x' => 1437, 'y' => 374], 'role' => 'hangout'];

        // 座席51作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席52データ ***//
        $seat = ['name' => '作業場', 'size' => 30, 'position' => ['x' => 1509, 'y' => 374], 'role' => 'hangout'];

        // 座席52作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席53データ ***//
        $seat = ['name' => '作業場', 'size' => 30, 'position' => ['x' => 1570, 'y' => 374], 'role' => 'hangout'];

        // 座席53作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画14作成-メディア
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'メディア']);


        //*** 座席54データ ***//
        $seat = ['name' => '左上', 'size' => 30, 'position' => ['x' => 1668, 'y' => 254], 'role' => 'media'];

        // 座席54作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席55データ ***//
        $seat = ['name' => '左下', 'size' => 30, 'position' => ['x' => 1669, 'y' => 309], 'role' => 'media'];

        // 座席55作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席56データ ***//
        $seat = ['name' => '右上', 'size' => 30, 'position' => ['x' => 1745, 'y' => 254], 'role' => 'media'];

        // 座席56作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席57データ ***//
        $seat = ['name' => '右下', 'size' => 30, 'position' => ['x' => 1745, 'y' => 309], 'role' => 'media'];

        // 座席57作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画15作成-掲示板
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '掲示板']);


        //*** 座席58データ ***//
        $seat = ['name' => '上', 'size' => 30, 'position' => ['x' => 1326, 'y' => 700], 'role' => 'media'];

        // 座席58作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席59データ ***//
        $seat = ['name' => '下', 'size' => 30, 'position' => ['x' => 1326, 'y' => 752], 'role' => 'media'];

        // 座席59作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席60データ ***//
        $seat = ['name' => '左', 'size' => 30, 'position' => ['x' => 1366, 'y' => 764], 'role' => 'media'];

        // 座席60作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席61データ ***//
        $seat = ['name' => '右', 'size' => 30, 'position' => ['x' => 1427, 'y' => 764], 'role' => 'media'];

        // 座席61作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画16作成-資料庫
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '資料庫']);


        //*** 座席62データ ***//
        $seat = ['name' => '上', 'size' => 30, 'position' => ['x' => 1081, 'y' => 444], 'role' => 'media'];

        // 座席62作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席63データ ***//
        $seat = ['name' => '中', 'size' => 30, 'position' => ['x' => 1081, 'y' => 484], 'role' => 'media'];

        // 座席63作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席64データ ***//
        $seat = ['name' => '下', 'size' => 30, 'position' => ['x' => 1081, 'y' => 523], 'role' => 'media'];

        // 座席64作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画17作成-自習室1(右)
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '自習室1(右)']);


        //*** 座席65データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1252, 'y' => 730], 'role' => 'study'];

        // 座席65作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席66データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1251, 'y' => 803], 'role' => 'study'];

        // 座席66作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席67データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1251, 'y' => 877], 'role' => 'study'];

        // 座席67作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席68データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1251, 'y' => 952], 'role' => 'study'];

        // 座席68作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席69データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1185, 'y' => 730], 'role' => 'study'];

        // 座席69作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席70データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1184, 'y' => 803], 'role' => 'study'];

        // 座席70作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席71データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1184, 'y' => 877], 'role' => 'study'];

        // 座席71作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席72データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1184, 'y' => 952], 'role' => 'study'];

        // 座席72作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席73データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1141, 'y' => 730], 'role' => 'study'];

        // 座席73作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席74データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1141, 'y' => 803], 'role' => 'study'];

        // 座席74作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席75データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1140, 'y' => 877], 'role' => 'study'];

        // 座席75作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席76データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1138, 'y' => 952], 'role' => 'study'];

        // 座席76作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画18作成-自習室2
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '自習室2']);


        //*** 座席77データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1067, 'y' => 730], 'role' => 'study'];

        // 座席77作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席78データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1067, 'y' => 803], 'role' => 'study'];

        // 座席78作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席79データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1065, 'y' => 877], 'role' => 'study'];

        // 座席79作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席80データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1063, 'y' => 952], 'role' => 'study'];

        // 座席80作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席81データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1000, 'y' => 730], 'role' => 'study'];

        // 座席81作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席82データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 1000, 'y' => 803], 'role' => 'study'];

        // 座席82作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席83データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 999, 'y' => 877], 'role' => 'study'];

        // 座席83作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席84データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 997, 'y' => 952], 'role' => 'study'];

        // 座席84作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席85データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 955, 'y' => 730], 'role' => 'study'];

        // 座席85作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席86データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 955, 'y' => 803], 'role' => 'study'];

        // 座席86作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席87データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 953, 'y' => 877], 'role' => 'study'];

        // 座席87作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席88データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 951, 'y' => 952], 'role' => 'study'];

        // 座席88作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画19作成-自習室3
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '自習室3']);


        //*** 座席89データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 881, 'y' => 730], 'role' => 'study'];

        // 座席89作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席90データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 880, 'y' => 803], 'role' => 'study'];

        // 座席90作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席91データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 878, 'y' => 877], 'role' => 'study'];

        // 座席91作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席92データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 876, 'y' => 952], 'role' => 'study'];

        // 座席92作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席93データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 814, 'y' => 730], 'role' => 'study'];

        // 座席93作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席94データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 813, 'y' => 803], 'role' => 'study'];

        // 座席94作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席95データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 811, 'y' => 877], 'role' => 'study'];

        // 座席95作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席96データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 809, 'y' => 952], 'role' => 'study'];

        // 座席96作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席97データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 770, 'y' => 730], 'role' => 'study'];

        // 座席97作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席98データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 769, 'y' => 803], 'role' => 'study'];

        // 座席98作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席99データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 767, 'y' => 877], 'role' => 'study'];

        // 座席99作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席100データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 765, 'y' => 952], 'role' => 'study'];

        // 座席100作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画20作成-自習室4
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '自習室4']);


        //*** 座席101データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 695, 'y' => 730], 'role' => 'study'];

        // 座席101作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席102データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 694, 'y' => 803], 'role' => 'study'];

        // 座席102作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席103データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 692, 'y' => 877], 'role' => 'study'];

        // 座席103作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席104データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 689, 'y' => 952], 'role' => 'study'];

        // 座席104作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席105データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 629, 'y' => 730], 'role' => 'study'];

        // 座席105作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席106データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 627, 'y' => 803], 'role' => 'study'];

        // 座席106作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席107データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 626, 'y' => 877], 'role' => 'study'];

        // 座席107作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席108データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 622, 'y' => 952], 'role' => 'study'];

        // 座席108作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席109データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 583, 'y' => 730], 'role' => 'study'];

        // 座席109作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席110データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 581, 'y' => 803], 'role' => 'study'];

        // 座席110作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席111データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 579, 'y' => 877], 'role' => 'study'];

        // 座席111作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席112データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 575, 'y' => 952], 'role' => 'study'];

        // 座席112作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画21作成-自習室5
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '自習室3']);


        //*** 座席113データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 509, 'y' => 730], 'role' => 'study'];

        // 座席113作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席114データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 508, 'y' => 803], 'role' => 'study'];

        // 座席114作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席115データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 506, 'y' => 877], 'role' => 'study'];

        // 座席115作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席116データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 503, 'y' => 952], 'role' => 'study'];

        // 座席116作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席117データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 441, 'y' => 730], 'role' => 'study'];

        // 座席117作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席118データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 440, 'y' => 803], 'role' => 'study'];

        // 座席118作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席119データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 437, 'y' => 877], 'role' => 'study'];

        // 座席119作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席120データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 435, 'y' => 952], 'role' => 'study'];

        // 座席120作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席121データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 399, 'y' => 730], 'role' => 'study'];

        // 座席121作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席122データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 397, 'y' => 803], 'role' => 'study'];

        // 座席122作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席123データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 394, 'y' => 877], 'role' => 'study'];

        // 座席123作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席124データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 391, 'y' => 952], 'role' => 'study'];

        // 座席124作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画22作成-自習室6(左)
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '自習室6(左)']);


        //*** 座席125データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 324, 'y' => 730], 'role' => 'study'];

        // 座席125作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席126データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 321, 'y' => 803], 'role' => 'study'];

        // 座席126作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席127データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 318, 'y' => 877], 'role' => 'study'];

        // 座席127作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席128データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 314, 'y' => 952], 'role' => 'study'];

        // 座席128作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席129データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 256, 'y' => 730], 'role' => 'study'];

        // 座席129作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席130データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 255, 'y' => 803], 'role' => 'study'];

        // 座席130作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席131データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 252, 'y' => 877], 'role' => 'study'];

        // 座席131作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席132データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 248, 'y' => 952], 'role' => 'study'];

        // 座席132作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席133データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 212, 'y' => 730], 'role' => 'study'];

        // 座席133作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席134データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 211, 'y' => 803], 'role' => 'study'];

        // 座席134作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席135データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 208, 'y' => 877], 'role' => 'study'];

        // 座席135作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席136データ ***//
        $seat = ['name' => '自習席', 'size' => 30, 'position' => ['x' => 205, 'y' => 952], 'role' => 'study'];

        // 座席136作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画23作成-登壇会場(大)
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '登壇会場(大)']);


        //*** 座席137データ ***//
        $seat = ['name' => '登壇席(左)', 'size' => 30, 'position' => ['x' => 335, 'y' => 511], 'role' => 'speak'];

        // 座席137作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席138データ ***//
        $seat = ['name' => '登壇席(右)', 'size' => 30, 'position' => ['x' => 409, 'y' => 511], 'role' => 'speak'];

        // 座席138作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席139データ ***//
        $seat = ['name' => '司会席', 'size' => 30, 'position' => ['x' => 217, 'y' => 513], 'role' => 'speak'];

        // 座席139作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席140データ ***//
        $seat = ['name' => '質疑席', 'size' => 30, 'position' => ['x' => 366, 'y' => 401], 'role' => 'speak'];

        // 座席140作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        //*** 座席141データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 241, 'y' => 214], 'role' => 'view'];

        // 座席141作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席142データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 277, 'y' => 214], 'role' => 'view'];

        // 座席142作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席143データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 314, 'y' => 214], 'role' => 'view'];

        // 座席143作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席144データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 348, 'y' => 214], 'role' => 'view'];

        // 座席144作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席145データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 386, 'y' => 214], 'role' => 'view'];

        // 座席145作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席146データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 423, 'y' => 214], 'role' => 'view'];

        // 座席146作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席147データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 458, 'y' => 214], 'role' => 'view'];

        // 座席147作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席148データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 495, 'y' => 214], 'role' => 'view'];

        // 座席148作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席149データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 241, 'y' => 286], 'role' => 'view'];

        // 座席149作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席150データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 277, 'y' => 286], 'role' => 'view'];

        // 座席150作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席151データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 313, 'y' => 286], 'role' => 'view'];

        // 座席151作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席152データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 349, 'y' => 286], 'role' => 'view'];

        // 座席152作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席153データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 386, 'y' => 286], 'role' => 'view'];

        // 座席153作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席154データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 422, 'y' => 286], 'role' => 'view'];

        // 座席154作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席155データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 458, 'y' => 286], 'role' => 'view'];

        // 座席155作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席156データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 494, 'y' => 286], 'role' => 'view'];

        // 座席156作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席157データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 241, 'y' => 356], 'role' => 'view'];

        // 座席157作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席158データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 277, 'y' => 356], 'role' => 'view'];

        // 座席158作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席159データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 313, 'y' => 356], 'role' => 'view'];

        // 座席159作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席160データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 349, 'y' => 356], 'role' => 'view'];

        // 座席160作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席161データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 386, 'y' => 356], 'role' => 'view'];

        // 座席161作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席162データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 422, 'y' => 356], 'role' => 'view'];

        // 座席162作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席163データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 458, 'y' => 356], 'role' => 'view'];

        // 座席163作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席164データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 499, 'y' => 356], 'role' => 'view'];

        // 座席164作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画24作成-登壇会場(小)
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '登壇会場(小)']);


        //*** 座席165データ ***//
        $seat = ['name' => '登壇席(左)', 'size' => 30, 'position' => ['x' => 684, 'y' => 511], 'role' => 'speak'];

        // 座席165作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席166データ ***//
        $seat = ['name' => '司会席', 'size' => 30, 'position' => ['x' => 582, 'y' => 513], 'role' => 'speak'];

        // 座席166作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席167データ ***//
        $seat = ['name' => '質疑席', 'size' => 30, 'position' => ['x' => 691, 'y' => 399], 'role' => 'speak'];

        // 座席167作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        //*** 座席168データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 603, 'y' => 214], 'role' => 'view'];

        // 座席168作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席169データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 640, 'y' => 214], 'role' => 'view'];

        // 座席169作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席170データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 675, 'y' => 214], 'role' => 'view'];

        // 座席170作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席171データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 712, 'y' => 214], 'role' => 'view'];

        // 座席171作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席172データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 748, 'y' => 214], 'role' => 'view'];

        // 座席172作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席173データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 784, 'y' => 214], 'role' => 'view'];

        // 座席173作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席174データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 603, 'y' => 286], 'role' => 'view'];

        // 座席174作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席175データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 640, 'y' => 286], 'role' => 'view'];

        // 座席175作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席176データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 675, 'y' => 286], 'role' => 'view'];

        // 座席176作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席177データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 712, 'y' => 286], 'role' => 'view'];

        // 座席177作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席178データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 748, 'y' => 286], 'role' => 'view'];

        // 座席178作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席179データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 784, 'y' => 286], 'role' => 'view'];

        // 座席179作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席180データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 603, 'y' => 356], 'role' => 'view'];

        // 座席180作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席181データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 640, 'y' => 356], 'role' => 'view'];

        // 座席181作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席182データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 675, 'y' => 356], 'role' => 'view'];

        // 座席182作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席183データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 712, 'y' => 356], 'role' => 'view'];

        // 座席183作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席184データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 748, 'y' => 356], 'role' => 'view'];

        // 座席184作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席185データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 784, 'y' => 356], 'role' => 'view'];

        // 座席185作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画25作成-面談ゾーン上
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '面談ゾーン上']);


        //*** 座席186データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 902, 'y' => 267], 'role' => 'hangout'];

        // 座席186作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席187データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 964, 'y' => 267], 'role' => 'hangout'];

        // 座席187作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画26作成-面談ゾーン中上
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '面談ゾーン中上']);


        //*** 座席188データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 899, 'y' => 337], 'role' => 'hangout'];

        // 座席188作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席189データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 962, 'y' => 337], 'role' => 'hangout'];

        // 座席189作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画27作成-面談ゾーン中下
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '面談ゾーン中下']);


        //*** 座席190データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 899, 'y' => 406], 'role' => 'hangout'];

        // 座席190作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席191データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 960, 'y' => 406], 'role' => 'hangout'];

        // 座席191作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画28作成-面談ゾーン下
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '面談ゾーン下']);


        //*** 座席192データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 895, 'y' => 477], 'role' => 'hangout'];

        // 座席192作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席193データ ***//
        $seat = ['name' => '雑談席', 'size' => 30, 'position' => ['x' => 957, 'y' => 477], 'role' => 'hangout'];

        // 座席193作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画29作成-雑談カフェ
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '雑談カフェ']);


        //*** 座席194データ ***//
        $seat = ['name' => 'マスター', 'size' => 30, 'position' => ['x' => 1093, 'y' => 285], 'role' => 'speak'];

        // 座席194作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席195データ ***//
        $seat = ['name' => 'カウンター上', 'size' => 30, 'position' => ['x' => 1166, 'y' => 247], 'role' => 'speak'];

        // 座席195作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席196データ ***//
        $seat = ['name' => 'カウンター中', 'size' => 30, 'position' => ['x' => 1165, 'y' => 286], 'role' => 'speak'];

        // 座席196作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席197データ ***//
        $seat = ['name' => 'カウンター下', 'size' => 30, 'position' => ['x' => 1165, 'y' => 326], 'role' => 'speak'];

        // 座席197作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        //*** 座席198データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1238, 'y' => 254], 'role' => 'view'];

        // 座席198作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席199データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1274, 'y' => 254], 'role' => 'view'];

        // 座席199作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席200データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1238, 'y' => 315], 'role' => 'view'];

        // 座席200作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席201データ ***//
        $seat = ['name' => '視聴席', 'size' => 30, 'position' => ['x' => 1274, 'y' => 315], 'role' => 'view'];

        // 座席201作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画30作成-御手洗
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => '御手洗']);


        //*** 座席202データ ***//
        $seat = ['name' => '手洗い場', 'size' => 30, 'position' => ['x' => 1787, 'y' => 960], 'role' => 'media'];

        // 座席202作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席203データ ***//
        $seat = ['name' => '左', 'size' => 30, 'position' => ['x' => 1850, 'y' => 934], 'role' => 'media'];

        // 座席203作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席204データ ***//
        $seat = ['name' => '中', 'size' => 30, 'position' => ['x' => 1895, 'y' => 934], 'role' => 'media'];

        // 座席204作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席205データ ***//
        $seat = ['name' => '右', 'size' => 30, 'position' => ['x' => 1940, 'y' => 934], 'role' => 'media'];

        // 座席205作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席206データ ***//
        $seat = ['name' => '外', 'size' => 30, 'position' => ['x' => 1938, 'y' => 1003], 'role' => 'media'];

        // 座席206作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画31作成-その他
        $created_section = Section::create(['room_id' => $created_room->id, 'name' => 'その他']);


        //*** 座席207データ ***//
        $seat = ['name' => '作業場2横', 'size' => 30, 'position' => ['x' => 1772, 'y' => 415], 'role' => 'media'];

        // 座席207作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席208データ ***//
        $seat = ['name' => 'トイレ前', 'size' => 30, 'position' => ['x' => 1770, 'y' => 880], 'role' => 'media'];

        // 座席208作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席209データ ***//
        $seat = ['name' => '雑談カフェ前', 'size' => 30, 'position' => ['x' => 1286, 'y' => 427], 'role' => 'media'];

        // 座席209作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席210データ ***//
        $seat = ['name' => '面談ゾーン前', 'size' => 30, 'position' => ['x' => 986, 'y' => 586], 'role' => 'media'];

        // 座席210作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席211データ ***//
        $seat = ['name' => '登壇会場2前', 'size' => 30, 'position' => ['x' => 839, 'y' => 570], 'role' => 'media'];

        // 座席211作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席212データ ***//
        $seat = ['name' => '登壇会場1前', 'size' => 30, 'position' => ['x' => 228, 'y' => 570], 'role' => 'media'];

        // 座席212作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席213データ ***//
        $seat = ['name' => '自習室左上', 'size' => 30, 'position' => ['x' => 214, 'y' => 675], 'role' => 'media'];

        // 座席213作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席214データ ***//
        $seat = ['name' => '自習室右上', 'size' => 30, 'position' => ['x' => 1259, 'y' => 671], 'role' => 'media'];

        // 座席214作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席215データ ***//
        $seat = ['name' => '玄関前近', 'size' => 30, 'position' => ['x' => 1680, 'y' => 990], 'role' => 'media'];

        // 座席215作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席216データ ***//
        $seat = ['name' => '玄関前遠', 'size' => 30, 'position' => ['x' => 1680, 'y' => 1173], 'role' => 'media'];

        // 座席216作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席217データ ***//
        $seat = ['name' => '右下', 'size' => 30, 'position' => ['x' => 2116, 'y' => 1151], 'role' => 'media'];

        // 座席217作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席218データ ***//
        $seat = ['name' => '右上', 'size' => 30, 'position' => ['x' => 2106, 'y' => 38], 'role' => 'media'];

        // 座席218作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席219データ ***//
        $seat = ['name' => '左上', 'size' => 30, 'position' => ['x' => 45, 'y' => 37], 'role' => 'media'];

        // 座席219作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席220データ ***//
        $seat = ['name' => '左下', 'size' => 30, 'position' => ['x' => 41, 'y' => 1152], 'role' => 'media'];

        // 座席220作成
        Seat::create(['section_id' => $created_section->id, 'name' => $seat['name'], 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);
    }
}
