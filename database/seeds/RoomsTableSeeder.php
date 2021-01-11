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
        /*
        |--------------------------------------------------------------------------
        | 1階作成
        |--------------------------------------------------------------------------
        */
        //*** 部屋1データ ***//
        $room = [
            'name' => '無限休憩',
            'timetable' =>
            [
                '00:00' => 'break',
            ]
        ];

        // 部屋1作成
        $created_room = Room::create(['name' => $room['name'], 'timetable' => $room['timetable']]);



        // 区画1作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席1データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 563, 'y' => 90], 'role' => 'study'];

        // 座席1作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席2データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 599, 'y' => 90], 'role' => 'study'];

        // 座席2作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席3データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 635, 'y' => 90], 'role' => 'study'];

        // 座席3作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席4データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 694, 'y' => 90], 'role' => 'study'];

        // 座席4作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席5データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 730, 'y' => 90], 'role' => 'study'];

        // 座席5作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画2作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席6データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 812, 'y' => 90], 'role' => 'study'];

        // 座席6作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席7データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 848, 'y' => 90], 'role' => 'study'];

        // 座席7作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席8データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 906, 'y' => 90], 'role' => 'study'];

        // 座席8作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席9データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 942, 'y' => 90], 'role' => 'study'];

        // 座席9作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席10データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 978, 'y' => 90], 'role' => 'study'];

        // 座席10作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画3作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席11データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 563, 'y' => 142], 'role' => 'study'];

        // 座席11作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席12データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 600, 'y' => 142], 'role' => 'study'];

        // 座席12作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席13データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 636, 'y' => 142], 'role' => 'study'];

        // 座席13作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席14データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 696, 'y' => 142], 'role' => 'study'];

        // 座席15作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席15データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 732, 'y' => 142], 'role' => 'study'];

        // 座席15作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画4作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席16データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 815, 'y' => 142], 'role' => 'study'];

        // 座席16作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席17データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 850, 'y' => 142], 'role' => 'study'];

        // 座席17作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席18データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 910, 'y' => 142], 'role' => 'study'];

        // 座席18作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席19データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 946, 'y' => 142], 'role' => 'study'];

        // 座席19作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席20データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 982, 'y' => 142], 'role' => 'study'];

        // 座席20作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画5作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席21データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 564, 'y' => 200], 'role' => 'study'];

        // 座席21作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席22データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 601, 'y' => 200], 'role' => 'study'];

        // 座席22作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席23データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 637, 'y' => 200], 'role' => 'study'];

        // 座席23作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席24データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 697, 'y' => 200], 'role' => 'study'];

        // 座席24作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席25データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 737, 'y' => 200], 'role' => 'study'];

        // 座席25作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画6作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席26データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 818, 'y' => 200], 'role' => 'study'];

        // 座席26作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席27データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 855, 'y' => 200], 'role' => 'study'];

        // 座席27作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席28データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 914, 'y' => 200], 'role' => 'study'];

        // 座席28作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席29データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 951, 'y' => 200], 'role' => 'study'];

        // 座席29作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席30データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 988, 'y' => 200], 'role' => 'study'];

        // 座席30作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画7作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席31データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 564, 'y' => 255], 'role' => 'study'];

        // 座席31作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席32データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 602, 'y' => 255], 'role' => 'study'];

        // 座席32作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席33データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 638, 'y' => 255], 'role' => 'study'];

        // 座席33作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席34データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 699, 'y' => 255], 'role' => 'study'];

        // 座席34作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席35データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 737, 'y' => 255], 'role' => 'study'];

        // 座席35作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画8作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席36データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 821, 'y' => 255], 'role' => 'study'];

        // 座席36作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席37データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 859, 'y' => 255], 'role' => 'study'];

        // 座席37作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席38データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 919, 'y' => 255], 'role' => 'study'];

        // 座席38作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席39データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 961, 'y' => 255], 'role' => 'study'];

        // 座席39作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席40データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 996, 'y' => 255], 'role' => 'study'];

        // 座席40作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画9作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席41データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 564, 'y' => 318], 'role' => 'study'];

        // 座席41作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席42データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 603, 'y' => 318], 'role' => 'study'];

        // 座席42作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席43データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 639, 'y' => 318], 'role' => 'study'];

        // 座席43作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席44データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 702, 'y' => 318], 'role' => 'study'];

        // 座席44作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席45データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 740, 'y' => 318], 'role' => 'study'];

        // 座席45作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画10作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席46データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 825, 'y' => 318], 'role' => 'study'];

        // 座席46作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席47データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 864, 'y' => 318], 'role' => 'study'];

        // 座席47作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席48データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 925, 'y' => 318], 'role' => 'study'];

        // 座席48作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席49データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 963, 'y' => 318], 'role' => 'study'];

        // 座席49作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席50データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 1000, 'y' => 318], 'role' => 'study'];

        // 座席50作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画11作成-グループ学習室①
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席51データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 423, 'y' => 503], 'role' => 'lounge'];

        // 座席51作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席52データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 455, 'y' => 469], 'role' => 'lounge'];

        // 座席52作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席53データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 489, 'y' => 503], 'role' => 'lounge'];

        // 座席53作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席54データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 455, 'y' => 538], 'role' => 'lounge'];

        // 座席54作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画12作成-グループ学習室②
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席55データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 590, 'y' => 503], 'role' => 'lounge'];

        // 座席55作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席56データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 623, 'y' => 469], 'role' => 'lounge'];

        // 座席56作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席57データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 656, 'y' => 503], 'role' => 'lounge'];

        // 座席57作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席58データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 624, 'y' => 538], 'role' => 'lounge'];

        // 座席58作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画13作成-グループ学習室③
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席59データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 760, 'y' => 791], 'role' => 'lounge'];

        // 座席59作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席60データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 791, 'y' => 469], 'role' => 'lounge'];

        // 座席60作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席61データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 824, 'y' => 503], 'role' => 'lounge'];

        // 座席61作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席62データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 793, 'y' => 538], 'role' => 'lounge'];

        // 座席62作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画14作成-グループ学習室④
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席63データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 928, 'y' => 503], 'role' => 'lounge'];

        // 座席63作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席64データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 957, 'y' => 469], 'role' => 'lounge'];

        // 座席64作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席65データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 994, 'y' => 503], 'role' => 'lounge'];

        // 座席65作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席66データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 963, 'y' => 538], 'role' => 'lounge'];

        // 座席66作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画15作成-休憩室①
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席67データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 212, 'y' => 245], 'role' => 'lounge'];

        // 座席67作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席68データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 239, 'y' => 220], 'role' => 'lounge'];

        // 座席68作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席69データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 262, 'y' => 245], 'role' => 'lounge'];

        // 座席69作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席70データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 237, 'y' => 270], 'role' => 'lounge'];

        // 座席70作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画16作成-休憩室②
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席71データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 274, 'y' => 301], 'role' => 'lounge'];

        // 座席71作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席72データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 301, 'y' => 273], 'role' => 'lounge'];

        // 座席72作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席73データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 324, 'y' => 301], 'role' => 'lounge'];

        // 座席73作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席74データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 300, 'y' => 326], 'role' => 'lounge'];

        // 座席74作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画17作成-休憩室③
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席75データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 205, 'y' => 357], 'role' => 'lounge'];

        // 座席75作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席76データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 230, 'y' => 332], 'role' => 'lounge'];

        // 座席76作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席77データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 255, 'y' => 357], 'role' => 'lounge'];

        // 座席77作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席78データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 227, 'y' => 382], 'role' => 'lounge'];

        // 座席78作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画18作成-メンタリングルーム-ユーザー側
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席79データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 85], 'role' => 'user'];

        // 座席79作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席80データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 136], 'role' => 'user'];

        // 座席80作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席81データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 189], 'role' => 'user'];

        // 座席81作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席82データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 242], 'role' => 'user'];

        // 座席82作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席83データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 299], 'role' => 'user'];

        // 座席83作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画19作成-メンタリングルーム-メンター側
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席84データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 438, 'y' => 85], 'role' => 'mentor'];

        // 座席84作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席85データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 436, 'y' => 136], 'role' => 'mentor'];

        // 座席85作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席86データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 435, 'y' => 189], 'role' => 'mentor'];

        // 座席86作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席87データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 435, 'y' => 242], 'role' => 'mentor'];

        // 座席87作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席88データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 434, 'y' => 299], 'role' => 'mentor'];

        // 座席88作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画20作成-ビデオ視聴ルーム
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席89データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 103, 'y' => 202], 'role' => 'lounge'];

        // 座席89作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席90データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 100, 'y' => 261], 'role' => 'lounge'];

        // 座席90作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席91データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 94, 'y' => 317], 'role' => 'lounge'];

        // 座席91作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席92データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 87, 'y' => 375], 'role' => 'lounge'];

        // 座席92作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画21作成-職員室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席93データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 70, 'y' => 456], 'role' => 'staff'];

        // 座席93作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席94データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 65, 'y' => 488], 'role' => 'staff'];

        // 座席94作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席95データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 62, 'y' => 520], 'role' => 'staff'];

        // 座席95作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席96データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 58, 'y' => 550], 'role' => 'staff'];

        // 座席96作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画22作成-応接室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席97データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 131, 'y' => 510], 'role' => 'hangout'];

        // 座席97作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席98データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 158, 'y' => 510], 'role' => 'hangout'];

        // 座席98作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席99データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 128, 'y' => 558], 'role' => 'hangout'];

        // 座席99作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席100データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 154, 'y' => 558], 'role' => 'hangout'];

        // 座席100作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画23作成-空き部屋
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席101データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 350, 'y' => 97], 'role' => 'study'];

        // 座席101作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席102データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 290, 'y' => 72], 'role' => 'study'];

        // 座席102作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席103データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 287, 'y' => 97], 'role' => 'study'];

        // 座席103作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席104データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 285, 'y' => 123], 'role' => 'study'];

        // 座席104作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席105データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 212, 'y' => 72], 'role' => 'study'];

        // 座席105作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席106データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 209, 'y' => 97], 'role' => 'study'];

        // 座席106作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席107データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 207, 'y' => 123], 'role' => 'study'];

        // 座席107作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席108データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 135, 'y' => 72], 'role' => 'study'];

        // 座席108作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席109データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 132, 'y' => 97], 'role' => 'study'];

        // 座席109作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席110データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 130, 'y' => 123], 'role' => 'study'];

        // 座席110作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        /*
        |--------------------------------------------------------------------------
        | 2階作成
        |--------------------------------------------------------------------------
        */
        //*** 部屋2データ ***//
        $room = [
            'name' => 'Webアプリ部屋',
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

        // 部屋2作成
        $created_room = Room::create(['name' => $room['name'], 'timetable' => $room['timetable']]);



        // 区画1作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席1データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 563, 'y' => 90], 'role' => 'study'];

        // 座席1作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席2データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 599, 'y' => 90], 'role' => 'study'];

        // 座席2作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席3データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 635, 'y' => 90], 'role' => 'study'];

        // 座席3作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席4データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 694, 'y' => 90], 'role' => 'study'];

        // 座席4作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席5データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 730, 'y' => 90], 'role' => 'study'];

        // 座席5作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画2作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席6データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 812, 'y' => 90], 'role' => 'study'];

        // 座席6作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席7データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 848, 'y' => 90], 'role' => 'study'];

        // 座席7作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席8データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 906, 'y' => 90], 'role' => 'study'];

        // 座席8作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席9データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 942, 'y' => 90], 'role' => 'study'];

        // 座席9作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席10データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 978, 'y' => 90], 'role' => 'study'];

        // 座席10作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画3作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席11データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 563, 'y' => 142], 'role' => 'study'];

        // 座席11作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席12データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 600, 'y' => 142], 'role' => 'study'];

        // 座席12作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席13データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 636, 'y' => 142], 'role' => 'study'];

        // 座席13作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席14データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 696, 'y' => 142], 'role' => 'study'];

        // 座席15作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席15データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 732, 'y' => 142], 'role' => 'study'];

        // 座席15作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画4作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席16データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 815, 'y' => 142], 'role' => 'study'];

        // 座席16作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席17データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 850, 'y' => 142], 'role' => 'study'];

        // 座席17作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席18データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 910, 'y' => 142], 'role' => 'study'];

        // 座席18作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席19データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 946, 'y' => 142], 'role' => 'study'];

        // 座席19作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席20データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 982, 'y' => 142], 'role' => 'study'];

        // 座席20作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画5作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席21データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 564, 'y' => 200], 'role' => 'study'];

        // 座席21作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席22データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 601, 'y' => 200], 'role' => 'study'];

        // 座席22作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席23データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 637, 'y' => 200], 'role' => 'study'];

        // 座席23作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席24データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 697, 'y' => 200], 'role' => 'study'];

        // 座席24作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席25データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 737, 'y' => 200], 'role' => 'study'];

        // 座席25作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画6作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席26データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 818, 'y' => 200], 'role' => 'study'];

        // 座席26作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席27データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 855, 'y' => 200], 'role' => 'study'];

        // 座席27作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席28データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 914, 'y' => 200], 'role' => 'study'];

        // 座席28作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席29データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 951, 'y' => 200], 'role' => 'study'];

        // 座席29作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席30データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 988, 'y' => 200], 'role' => 'study'];

        // 座席30作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画7作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席31データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 564, 'y' => 255], 'role' => 'study'];

        // 座席31作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席32データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 602, 'y' => 255], 'role' => 'study'];

        // 座席32作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席33データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 638, 'y' => 255], 'role' => 'study'];

        // 座席33作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席34データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 699, 'y' => 255], 'role' => 'study'];

        // 座席34作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席35データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 737, 'y' => 255], 'role' => 'study'];

        // 座席35作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画8作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席36データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 821, 'y' => 255], 'role' => 'study'];

        // 座席36作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席37データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 859, 'y' => 255], 'role' => 'study'];

        // 座席37作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席38データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 919, 'y' => 255], 'role' => 'study'];

        // 座席38作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席39データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 961, 'y' => 255], 'role' => 'study'];

        // 座席39作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席40データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 996, 'y' => 255], 'role' => 'study'];

        // 座席40作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画9作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席41データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 564, 'y' => 318], 'role' => 'study'];

        // 座席41作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席42データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 603, 'y' => 318], 'role' => 'study'];

        // 座席42作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席43データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 639, 'y' => 318], 'role' => 'study'];

        // 座席43作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席44データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 702, 'y' => 318], 'role' => 'study'];

        // 座席44作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席45データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 740, 'y' => 318], 'role' => 'study'];

        // 座席45作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画10作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席46データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 825, 'y' => 318], 'role' => 'study'];

        // 座席46作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席47データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 864, 'y' => 318], 'role' => 'study'];

        // 座席47作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席48データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 925, 'y' => 318], 'role' => 'study'];

        // 座席48作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席49データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 963, 'y' => 318], 'role' => 'study'];

        // 座席49作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席50データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 1000, 'y' => 318], 'role' => 'study'];

        // 座席50作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画11作成-グループ学習室①
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席51データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 423, 'y' => 503], 'role' => 'lounge'];

        // 座席51作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席52データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 455, 'y' => 469], 'role' => 'lounge'];

        // 座席52作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席53データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 489, 'y' => 503], 'role' => 'lounge'];

        // 座席53作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席54データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 455, 'y' => 538], 'role' => 'lounge'];

        // 座席54作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画12作成-グループ学習室②
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席55データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 590, 'y' => 503], 'role' => 'lounge'];

        // 座席55作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席56データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 623, 'y' => 469], 'role' => 'lounge'];

        // 座席56作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席57データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 656, 'y' => 503], 'role' => 'lounge'];

        // 座席57作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席58データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 624, 'y' => 538], 'role' => 'lounge'];

        // 座席58作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画13作成-グループ学習室③
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席59データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 760, 'y' => 791], 'role' => 'lounge'];

        // 座席59作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席60データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 791, 'y' => 469], 'role' => 'lounge'];

        // 座席60作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席61データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 824, 'y' => 503], 'role' => 'lounge'];

        // 座席61作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席62データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 793, 'y' => 538], 'role' => 'lounge'];

        // 座席62作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画14作成-グループ学習室④
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席63データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 928, 'y' => 503], 'role' => 'lounge'];

        // 座席63作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席64データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 957, 'y' => 469], 'role' => 'lounge'];

        // 座席64作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席65データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 994, 'y' => 503], 'role' => 'lounge'];

        // 座席65作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席66データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 963, 'y' => 538], 'role' => 'lounge'];

        // 座席66作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画15作成-休憩室①
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席67データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 212, 'y' => 245], 'role' => 'lounge'];

        // 座席67作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席68データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 239, 'y' => 220], 'role' => 'lounge'];

        // 座席68作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席69データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 262, 'y' => 245], 'role' => 'lounge'];

        // 座席69作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席70データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 237, 'y' => 270], 'role' => 'lounge'];

        // 座席70作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画16作成-休憩室②
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席71データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 274, 'y' => 301], 'role' => 'lounge'];

        // 座席71作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席72データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 301, 'y' => 273], 'role' => 'lounge'];

        // 座席72作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席73データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 324, 'y' => 301], 'role' => 'lounge'];

        // 座席73作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席74データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 300, 'y' => 326], 'role' => 'lounge'];

        // 座席74作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画17作成-休憩室③
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席75データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 205, 'y' => 357], 'role' => 'lounge'];

        // 座席75作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席76データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 230, 'y' => 332], 'role' => 'lounge'];

        // 座席76作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席77データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 255, 'y' => 357], 'role' => 'lounge'];

        // 座席77作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席78データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 227, 'y' => 382], 'role' => 'lounge'];

        // 座席78作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画18作成-メンタリングルーム-ユーザー側
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席79データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 85], 'role' => 'user'];

        // 座席79作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席80データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 136], 'role' => 'user'];

        // 座席80作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席81データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 189], 'role' => 'user'];

        // 座席81作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席82データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 242], 'role' => 'user'];

        // 座席82作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席83データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 299], 'role' => 'user'];

        // 座席83作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画19作成-メンタリングルーム-メンター側
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席84データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 438, 'y' => 85], 'role' => 'mentor'];

        // 座席84作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席85データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 436, 'y' => 136], 'role' => 'mentor'];

        // 座席85作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席86データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 435, 'y' => 189], 'role' => 'mentor'];

        // 座席86作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席87データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 435, 'y' => 242], 'role' => 'mentor'];

        // 座席87作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席88データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 434, 'y' => 299], 'role' => 'mentor'];

        // 座席88作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画20作成-ビデオ視聴ルーム
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席89データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 103, 'y' => 202], 'role' => 'lounge'];

        // 座席89作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席90データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 100, 'y' => 261], 'role' => 'lounge'];

        // 座席90作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席91データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 94, 'y' => 317], 'role' => 'lounge'];

        // 座席91作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席92データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 87, 'y' => 375], 'role' => 'lounge'];

        // 座席92作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画21作成-職員室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席93データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 70, 'y' => 456], 'role' => 'staff'];

        // 座席93作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席94データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 65, 'y' => 488], 'role' => 'staff'];

        // 座席94作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席95データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 62, 'y' => 520], 'role' => 'staff'];

        // 座席95作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席96データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 58, 'y' => 550], 'role' => 'staff'];

        // 座席96作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画22作成-応接室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席97データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 131, 'y' => 510], 'role' => 'hangout'];

        // 座席97作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席98データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 158, 'y' => 510], 'role' => 'hangout'];

        // 座席98作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席99データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 128, 'y' => 558], 'role' => 'hangout'];

        // 座席99作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席100データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 154, 'y' => 558], 'role' => 'hangout'];

        // 座席100作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画23作成-空き部屋
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席101データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 350, 'y' => 97], 'role' => 'study'];

        // 座席101作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席102データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 290, 'y' => 72], 'role' => 'study'];

        // 座席102作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席103データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 287, 'y' => 97], 'role' => 'study'];

        // 座席103作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席104データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 285, 'y' => 123], 'role' => 'study'];

        // 座席104作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席105データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 212, 'y' => 72], 'role' => 'study'];

        // 座席105作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席106データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 209, 'y' => 97], 'role' => 'study'];

        // 座席106作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席107データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 207, 'y' => 123], 'role' => 'study'];

        // 座席107作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席108データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 135, 'y' => 72], 'role' => 'study'];

        // 座席108作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席109データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 132, 'y' => 97], 'role' => 'study'];

        // 座席109作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席110データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 130, 'y' => 123], 'role' => 'study'];

        // 座席110作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        /*
        |--------------------------------------------------------------------------
        | 3階作成
        |--------------------------------------------------------------------------
        */
        //*** 部屋3データ ***//
        $room = [
            'name' => '機械学習部屋',
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

        // 部屋3作成
        $created_room = Room::create(['name' => $room['name'], 'timetable' => $room['timetable']]);



        // 区画1作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席1データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 563, 'y' => 90], 'role' => 'study'];

        // 座席1作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席2データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 599, 'y' => 90], 'role' => 'study'];

        // 座席2作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席3データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 635, 'y' => 90], 'role' => 'study'];

        // 座席3作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席4データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 694, 'y' => 90], 'role' => 'study'];

        // 座席4作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席5データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 730, 'y' => 90], 'role' => 'study'];

        // 座席5作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画2作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席6データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 812, 'y' => 90], 'role' => 'study'];

        // 座席6作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席7データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 848, 'y' => 90], 'role' => 'study'];

        // 座席7作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席8データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 906, 'y' => 90], 'role' => 'study'];

        // 座席8作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席9データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 942, 'y' => 90], 'role' => 'study'];

        // 座席9作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席10データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 978, 'y' => 90], 'role' => 'study'];

        // 座席10作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画3作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席11データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 563, 'y' => 142], 'role' => 'study'];

        // 座席11作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席12データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 600, 'y' => 142], 'role' => 'study'];

        // 座席12作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席13データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 636, 'y' => 142], 'role' => 'study'];

        // 座席13作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席14データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 696, 'y' => 142], 'role' => 'study'];

        // 座席15作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席15データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 732, 'y' => 142], 'role' => 'study'];

        // 座席15作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画4作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席16データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 815, 'y' => 142], 'role' => 'study'];

        // 座席16作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席17データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 850, 'y' => 142], 'role' => 'study'];

        // 座席17作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席18データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 910, 'y' => 142], 'role' => 'study'];

        // 座席18作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席19データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 946, 'y' => 142], 'role' => 'study'];

        // 座席19作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席20データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 982, 'y' => 142], 'role' => 'study'];

        // 座席20作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画5作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席21データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 564, 'y' => 200], 'role' => 'study'];

        // 座席21作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席22データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 601, 'y' => 200], 'role' => 'study'];

        // 座席22作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席23データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 637, 'y' => 200], 'role' => 'study'];

        // 座席23作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席24データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 697, 'y' => 200], 'role' => 'study'];

        // 座席24作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席25データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 737, 'y' => 200], 'role' => 'study'];

        // 座席25作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画6作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席26データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 818, 'y' => 200], 'role' => 'study'];

        // 座席26作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席27データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 855, 'y' => 200], 'role' => 'study'];

        // 座席27作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席28データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 914, 'y' => 200], 'role' => 'study'];

        // 座席28作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席29データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 951, 'y' => 200], 'role' => 'study'];

        // 座席29作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席30データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 988, 'y' => 200], 'role' => 'study'];

        // 座席30作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画7作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席31データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 564, 'y' => 255], 'role' => 'study'];

        // 座席31作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席32データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 602, 'y' => 255], 'role' => 'study'];

        // 座席32作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席33データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 638, 'y' => 255], 'role' => 'study'];

        // 座席33作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席34データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 699, 'y' => 255], 'role' => 'study'];

        // 座席34作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席35データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 737, 'y' => 255], 'role' => 'study'];

        // 座席35作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画8作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席36データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 821, 'y' => 255], 'role' => 'study'];

        // 座席36作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席37データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 859, 'y' => 255], 'role' => 'study'];

        // 座席37作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席38データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 919, 'y' => 255], 'role' => 'study'];

        // 座席38作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席39データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 961, 'y' => 255], 'role' => 'study'];

        // 座席39作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席40データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 996, 'y' => 255], 'role' => 'study'];

        // 座席40作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画9作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席41データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 564, 'y' => 318], 'role' => 'study'];

        // 座席41作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席42データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 603, 'y' => 318], 'role' => 'study'];

        // 座席42作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席43データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 639, 'y' => 318], 'role' => 'study'];

        // 座席43作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席44データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 702, 'y' => 318], 'role' => 'study'];

        // 座席44作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席45データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 740, 'y' => 318], 'role' => 'study'];

        // 座席45作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画10作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席46データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 825, 'y' => 318], 'role' => 'study'];

        // 座席46作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席47データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 864, 'y' => 318], 'role' => 'study'];

        // 座席47作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席48データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 925, 'y' => 318], 'role' => 'study'];

        // 座席48作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席49データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 963, 'y' => 318], 'role' => 'study'];

        // 座席49作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席50データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 1000, 'y' => 318], 'role' => 'study'];

        // 座席50作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画11作成-グループ学習室①
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席51データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 423, 'y' => 503], 'role' => 'lounge'];

        // 座席51作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席52データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 455, 'y' => 469], 'role' => 'lounge'];

        // 座席52作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席53データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 489, 'y' => 503], 'role' => 'lounge'];

        // 座席53作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席54データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 455, 'y' => 538], 'role' => 'lounge'];

        // 座席54作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画12作成-グループ学習室②
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席55データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 590, 'y' => 503], 'role' => 'lounge'];

        // 座席55作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席56データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 623, 'y' => 469], 'role' => 'lounge'];

        // 座席56作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席57データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 656, 'y' => 503], 'role' => 'lounge'];

        // 座席57作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席58データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 624, 'y' => 538], 'role' => 'lounge'];

        // 座席58作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画13作成-グループ学習室③
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席59データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 760, 'y' => 791], 'role' => 'lounge'];

        // 座席59作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席60データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 791, 'y' => 469], 'role' => 'lounge'];

        // 座席60作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席61データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 824, 'y' => 503], 'role' => 'lounge'];

        // 座席61作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席62データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 793, 'y' => 538], 'role' => 'lounge'];

        // 座席62作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画14作成-グループ学習室④
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席63データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 928, 'y' => 503], 'role' => 'lounge'];

        // 座席63作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席64データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 957, 'y' => 469], 'role' => 'lounge'];

        // 座席64作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席65データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 994, 'y' => 503], 'role' => 'lounge'];

        // 座席65作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席66データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 963, 'y' => 538], 'role' => 'lounge'];

        // 座席66作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画15作成-休憩室①
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席67データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 212, 'y' => 245], 'role' => 'lounge'];

        // 座席67作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席68データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 239, 'y' => 220], 'role' => 'lounge'];

        // 座席68作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席69データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 262, 'y' => 245], 'role' => 'lounge'];

        // 座席69作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席70データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 237, 'y' => 270], 'role' => 'lounge'];

        // 座席70作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画16作成-休憩室②
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席71データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 274, 'y' => 301], 'role' => 'lounge'];

        // 座席71作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席72データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 301, 'y' => 273], 'role' => 'lounge'];

        // 座席72作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席73データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 324, 'y' => 301], 'role' => 'lounge'];

        // 座席73作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席74データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 300, 'y' => 326], 'role' => 'lounge'];

        // 座席74作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画17作成-休憩室③
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席75データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 205, 'y' => 357], 'role' => 'lounge'];

        // 座席75作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席76データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 230, 'y' => 332], 'role' => 'lounge'];

        // 座席76作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席77データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 255, 'y' => 357], 'role' => 'lounge'];

        // 座席77作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席78データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 227, 'y' => 382], 'role' => 'lounge'];

        // 座席78作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画18作成-メンタリングルーム-ユーザー側
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席79データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 85], 'role' => 'user'];

        // 座席79作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席80データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 136], 'role' => 'user'];

        // 座席80作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席81データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 189], 'role' => 'user'];

        // 座席81作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席82データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 242], 'role' => 'user'];

        // 座席82作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席83データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 299], 'role' => 'user'];

        // 座席83作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画19作成-メンタリングルーム-メンター側
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席84データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 438, 'y' => 85], 'role' => 'mentor'];

        // 座席84作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席85データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 436, 'y' => 136], 'role' => 'mentor'];

        // 座席85作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席86データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 435, 'y' => 189], 'role' => 'mentor'];

        // 座席86作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席87データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 435, 'y' => 242], 'role' => 'mentor'];

        // 座席87作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席88データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 434, 'y' => 299], 'role' => 'mentor'];

        // 座席88作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画20作成-ビデオ視聴ルーム
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席89データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 103, 'y' => 202], 'role' => 'lounge'];

        // 座席89作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席90データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 100, 'y' => 261], 'role' => 'lounge'];

        // 座席90作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席91データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 94, 'y' => 317], 'role' => 'lounge'];

        // 座席91作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席92データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 87, 'y' => 375], 'role' => 'lounge'];

        // 座席92作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画21作成-職員室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席93データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 70, 'y' => 456], 'role' => 'staff'];

        // 座席93作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席94データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 65, 'y' => 488], 'role' => 'staff'];

        // 座席94作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席95データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 62, 'y' => 520], 'role' => 'staff'];

        // 座席95作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席96データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 58, 'y' => 550], 'role' => 'staff'];

        // 座席96作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画22作成-応接室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席97データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 131, 'y' => 510], 'role' => 'hangout'];

        // 座席97作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席98データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 158, 'y' => 510], 'role' => 'hangout'];

        // 座席98作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席99データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 128, 'y' => 558], 'role' => 'hangout'];

        // 座席99作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席100データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 154, 'y' => 558], 'role' => 'hangout'];

        // 座席100作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画23作成-空き部屋
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席101データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 350, 'y' => 97], 'role' => 'study'];

        // 座席101作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席102データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 290, 'y' => 72], 'role' => 'study'];

        // 座席102作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席103データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 287, 'y' => 97], 'role' => 'study'];

        // 座席103作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席104データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 285, 'y' => 123], 'role' => 'study'];

        // 座席104作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席105データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 212, 'y' => 72], 'role' => 'study'];

        // 座席105作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席106データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 209, 'y' => 97], 'role' => 'study'];

        // 座席106作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席107データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 207, 'y' => 123], 'role' => 'study'];

        // 座席107作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席108データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 135, 'y' => 72], 'role' => 'study'];

        // 座席108作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席109データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 132, 'y' => 97], 'role' => 'study'];

        // 座席109作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席110データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 130, 'y' => 123], 'role' => 'study'];

        // 座席110作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        /*
        |--------------------------------------------------------------------------
        | 4階作成
        |--------------------------------------------------------------------------
        */
        //*** 部屋4データ ***//
        $room = [
            'name' => 'マイコン部屋',
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

        // 部屋4作成
        $created_room = Room::create(['name' => $room['name'], 'timetable' => $room['timetable']]);



        // 区画1作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席1データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 563, 'y' => 90], 'role' => 'study'];

        // 座席1作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席2データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 599, 'y' => 90], 'role' => 'study'];

        // 座席2作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席3データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 635, 'y' => 90], 'role' => 'study'];

        // 座席3作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席4データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 694, 'y' => 90], 'role' => 'study'];

        // 座席4作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席5データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 730, 'y' => 90], 'role' => 'study'];

        // 座席5作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画2作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席6データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 812, 'y' => 90], 'role' => 'study'];

        // 座席6作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席7データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 848, 'y' => 90], 'role' => 'study'];

        // 座席7作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席8データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 906, 'y' => 90], 'role' => 'study'];

        // 座席8作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席9データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 942, 'y' => 90], 'role' => 'study'];

        // 座席9作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席10データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 978, 'y' => 90], 'role' => 'study'];

        // 座席10作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画3作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席11データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 563, 'y' => 142], 'role' => 'study'];

        // 座席11作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席12データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 600, 'y' => 142], 'role' => 'study'];

        // 座席12作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席13データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 636, 'y' => 142], 'role' => 'study'];

        // 座席13作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席14データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 696, 'y' => 142], 'role' => 'study'];

        // 座席15作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席15データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 732, 'y' => 142], 'role' => 'study'];

        // 座席15作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画4作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席16データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 815, 'y' => 142], 'role' => 'study'];

        // 座席16作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席17データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 850, 'y' => 142], 'role' => 'study'];

        // 座席17作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席18データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 910, 'y' => 142], 'role' => 'study'];

        // 座席18作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席19データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 946, 'y' => 142], 'role' => 'study'];

        // 座席19作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席20データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 982, 'y' => 142], 'role' => 'study'];

        // 座席20作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画5作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席21データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 564, 'y' => 200], 'role' => 'study'];

        // 座席21作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席22データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 601, 'y' => 200], 'role' => 'study'];

        // 座席22作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席23データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 637, 'y' => 200], 'role' => 'study'];

        // 座席23作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席24データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 697, 'y' => 200], 'role' => 'study'];

        // 座席24作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席25データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 737, 'y' => 200], 'role' => 'study'];

        // 座席25作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画6作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席26データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 818, 'y' => 200], 'role' => 'study'];

        // 座席26作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席27データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 855, 'y' => 200], 'role' => 'study'];

        // 座席27作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席28データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 914, 'y' => 200], 'role' => 'study'];

        // 座席28作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席29データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 951, 'y' => 200], 'role' => 'study'];

        // 座席29作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席30データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 988, 'y' => 200], 'role' => 'study'];

        // 座席30作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画7作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席31データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 564, 'y' => 255], 'role' => 'study'];

        // 座席31作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席32データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 602, 'y' => 255], 'role' => 'study'];

        // 座席32作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席33データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 638, 'y' => 255], 'role' => 'study'];

        // 座席33作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席34データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 699, 'y' => 255], 'role' => 'study'];

        // 座席34作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席35データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 737, 'y' => 255], 'role' => 'study'];

        // 座席35作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画8作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席36データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 821, 'y' => 255], 'role' => 'study'];

        // 座席36作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席37データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 859, 'y' => 255], 'role' => 'study'];

        // 座席37作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席38データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 919, 'y' => 255], 'role' => 'study'];

        // 座席38作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席39データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 961, 'y' => 255], 'role' => 'study'];

        // 座席39作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席40データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 996, 'y' => 255], 'role' => 'study'];

        // 座席40作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画9作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席41データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 564, 'y' => 318], 'role' => 'study'];

        // 座席41作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席42データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 603, 'y' => 318], 'role' => 'study'];

        // 座席42作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席43データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 639, 'y' => 318], 'role' => 'study'];

        // 座席43作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席44データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 702, 'y' => 318], 'role' => 'study'];

        // 座席44作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席45データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 740, 'y' => 318], 'role' => 'study'];

        // 座席45作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画10作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席46データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 825, 'y' => 318], 'role' => 'study'];

        // 座席46作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席47データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 864, 'y' => 318], 'role' => 'study'];

        // 座席47作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席48データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 925, 'y' => 318], 'role' => 'study'];

        // 座席48作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席49データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 963, 'y' => 318], 'role' => 'study'];

        // 座席49作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席50データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 1000, 'y' => 318], 'role' => 'study'];

        // 座席50作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画11作成-グループ学習室①
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席51データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 423, 'y' => 503], 'role' => 'lounge'];

        // 座席51作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席52データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 455, 'y' => 469], 'role' => 'lounge'];

        // 座席52作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席53データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 489, 'y' => 503], 'role' => 'lounge'];

        // 座席53作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席54データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 455, 'y' => 538], 'role' => 'lounge'];

        // 座席54作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画12作成-グループ学習室②
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席55データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 590, 'y' => 503], 'role' => 'lounge'];

        // 座席55作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席56データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 623, 'y' => 469], 'role' => 'lounge'];

        // 座席56作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席57データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 656, 'y' => 503], 'role' => 'lounge'];

        // 座席57作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席58データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 624, 'y' => 538], 'role' => 'lounge'];

        // 座席58作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画13作成-グループ学習室③
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席59データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 760, 'y' => 791], 'role' => 'lounge'];

        // 座席59作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席60データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 791, 'y' => 469], 'role' => 'lounge'];

        // 座席60作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席61データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 824, 'y' => 503], 'role' => 'lounge'];

        // 座席61作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席62データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 793, 'y' => 538], 'role' => 'lounge'];

        // 座席62作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画14作成-グループ学習室④
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席63データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 928, 'y' => 503], 'role' => 'lounge'];

        // 座席63作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席64データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 957, 'y' => 469], 'role' => 'lounge'];

        // 座席64作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席65データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 994, 'y' => 503], 'role' => 'lounge'];

        // 座席65作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席66データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 963, 'y' => 538], 'role' => 'lounge'];

        // 座席66作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画15作成-休憩室①
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席67データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 212, 'y' => 245], 'role' => 'lounge'];

        // 座席67作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席68データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 239, 'y' => 220], 'role' => 'lounge'];

        // 座席68作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席69データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 262, 'y' => 245], 'role' => 'lounge'];

        // 座席69作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席70データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 237, 'y' => 270], 'role' => 'lounge'];

        // 座席70作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画16作成-休憩室②
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席71データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 274, 'y' => 301], 'role' => 'lounge'];

        // 座席71作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席72データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 301, 'y' => 273], 'role' => 'lounge'];

        // 座席72作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席73データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 324, 'y' => 301], 'role' => 'lounge'];

        // 座席73作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席74データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 300, 'y' => 326], 'role' => 'lounge'];

        // 座席74作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画17作成-休憩室③
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席75データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 205, 'y' => 357], 'role' => 'lounge'];

        // 座席75作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席76データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 230, 'y' => 332], 'role' => 'lounge'];

        // 座席76作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席77データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 255, 'y' => 357], 'role' => 'lounge'];

        // 座席77作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席78データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 227, 'y' => 382], 'role' => 'lounge'];

        // 座席78作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画18作成-メンタリングルーム-ユーザー側
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席79データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 85], 'role' => 'user'];

        // 座席79作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席80データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 136], 'role' => 'user'];

        // 座席80作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席81データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 189], 'role' => 'user'];

        // 座席81作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席82データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 242], 'role' => 'user'];

        // 座席82作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席83データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 299], 'role' => 'user'];

        // 座席83作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画19作成-メンタリングルーム-メンター側
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席84データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 438, 'y' => 85], 'role' => 'mentor'];

        // 座席84作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席85データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 436, 'y' => 136], 'role' => 'mentor'];

        // 座席85作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席86データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 435, 'y' => 189], 'role' => 'mentor'];

        // 座席86作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席87データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 435, 'y' => 242], 'role' => 'mentor'];

        // 座席87作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席88データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 434, 'y' => 299], 'role' => 'mentor'];

        // 座席88作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画20作成-ビデオ視聴ルーム
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席89データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 103, 'y' => 202], 'role' => 'lounge'];

        // 座席89作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席90データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 100, 'y' => 261], 'role' => 'lounge'];

        // 座席90作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席91データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 94, 'y' => 317], 'role' => 'lounge'];

        // 座席91作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席92データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 87, 'y' => 375], 'role' => 'lounge'];

        // 座席92作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画21作成-職員室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席93データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 70, 'y' => 456], 'role' => 'staff'];

        // 座席93作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席94データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 65, 'y' => 488], 'role' => 'staff'];

        // 座席94作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席95データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 62, 'y' => 520], 'role' => 'staff'];

        // 座席95作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席96データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 58, 'y' => 550], 'role' => 'staff'];

        // 座席96作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画22作成-応接室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席97データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 131, 'y' => 510], 'role' => 'hangout'];

        // 座席97作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席98データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 158, 'y' => 510], 'role' => 'hangout'];

        // 座席98作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席99データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 128, 'y' => 558], 'role' => 'hangout'];

        // 座席99作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席100データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 154, 'y' => 558], 'role' => 'hangout'];

        // 座席100作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画23作成-空き部屋
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席101データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 350, 'y' => 97], 'role' => 'study'];

        // 座席101作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席102データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 290, 'y' => 72], 'role' => 'study'];

        // 座席102作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席103データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 287, 'y' => 97], 'role' => 'study'];

        // 座席103作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席104データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 285, 'y' => 123], 'role' => 'study'];

        // 座席104作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席105データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 212, 'y' => 72], 'role' => 'study'];

        // 座席105作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席106データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 209, 'y' => 97], 'role' => 'study'];

        // 座席106作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席107データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 207, 'y' => 123], 'role' => 'study'];

        // 座席107作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席108データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 135, 'y' => 72], 'role' => 'study'];

        // 座席108作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席109データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 132, 'y' => 97], 'role' => 'study'];

        // 座席109作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席110データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 130, 'y' => 123], 'role' => 'study'];

        // 座席110作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);





        /*
        |--------------------------------------------------------------------------
        | 5階作成
        |--------------------------------------------------------------------------
        */
        //*** 部屋5データ ***//
        $room = [
            'name' => 'イベントホール',
            'timetable' =>
            [
                '00:00' => 'study',
            ]
        ];

        // 部屋5作成
        $created_room = Room::create(['name' => $room['name'], 'timetable' => $room['timetable']]);



        // 区画1作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席1データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 563, 'y' => 90], 'role' => 'study'];

        // 座席1作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席2データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 599, 'y' => 90], 'role' => 'study'];

        // 座席2作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席3データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 635, 'y' => 90], 'role' => 'study'];

        // 座席3作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席4データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 694, 'y' => 90], 'role' => 'study'];

        // 座席4作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席5データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 730, 'y' => 90], 'role' => 'study'];

        // 座席5作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画2作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席6データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 812, 'y' => 90], 'role' => 'study'];

        // 座席6作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席7データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 848, 'y' => 90], 'role' => 'study'];

        // 座席7作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席8データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 906, 'y' => 90], 'role' => 'study'];

        // 座席8作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席9データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 942, 'y' => 90], 'role' => 'study'];

        // 座席9作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席10データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 978, 'y' => 90], 'role' => 'study'];

        // 座席10作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画3作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席11データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 563, 'y' => 142], 'role' => 'study'];

        // 座席11作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席12データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 600, 'y' => 142], 'role' => 'study'];

        // 座席12作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席13データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 636, 'y' => 142], 'role' => 'study'];

        // 座席13作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席14データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 696, 'y' => 142], 'role' => 'study'];

        // 座席15作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席15データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 732, 'y' => 142], 'role' => 'study'];

        // 座席15作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画4作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席16データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 815, 'y' => 142], 'role' => 'study'];

        // 座席16作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席17データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 850, 'y' => 142], 'role' => 'study'];

        // 座席17作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席18データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 910, 'y' => 142], 'role' => 'study'];

        // 座席18作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席19データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 946, 'y' => 142], 'role' => 'study'];

        // 座席19作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席20データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 982, 'y' => 142], 'role' => 'study'];

        // 座席20作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画5作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席21データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 564, 'y' => 200], 'role' => 'study'];

        // 座席21作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席22データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 601, 'y' => 200], 'role' => 'study'];

        // 座席22作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席23データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 637, 'y' => 200], 'role' => 'study'];

        // 座席23作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席24データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 697, 'y' => 200], 'role' => 'study'];

        // 座席24作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席25データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 737, 'y' => 200], 'role' => 'study'];

        // 座席25作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画6作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席26データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 818, 'y' => 200], 'role' => 'study'];

        // 座席26作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席27データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 855, 'y' => 200], 'role' => 'study'];

        // 座席27作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席28データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 914, 'y' => 200], 'role' => 'study'];

        // 座席28作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席29データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 951, 'y' => 200], 'role' => 'study'];

        // 座席29作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席30データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 988, 'y' => 200], 'role' => 'study'];

        // 座席30作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画7作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席31データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 564, 'y' => 255], 'role' => 'study'];

        // 座席31作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席32データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 602, 'y' => 255], 'role' => 'study'];

        // 座席32作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席33データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 638, 'y' => 255], 'role' => 'study'];

        // 座席33作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席34データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 699, 'y' => 255], 'role' => 'study'];

        // 座席34作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席35データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 737, 'y' => 255], 'role' => 'study'];

        // 座席35作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画8作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席36データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 821, 'y' => 255], 'role' => 'study'];

        // 座席36作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席37データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 859, 'y' => 255], 'role' => 'study'];

        // 座席37作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席38データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 919, 'y' => 255], 'role' => 'study'];

        // 座席38作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席39データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 961, 'y' => 255], 'role' => 'study'];

        // 座席39作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席40データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 996, 'y' => 255], 'role' => 'study'];

        // 座席40作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画9作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席41データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 564, 'y' => 318], 'role' => 'study'];

        // 座席41作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席42データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 603, 'y' => 318], 'role' => 'study'];

        // 座席42作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席43データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 639, 'y' => 318], 'role' => 'study'];

        // 座席43作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席44データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 702, 'y' => 318], 'role' => 'study'];

        // 座席44作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席45データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 740, 'y' => 318], 'role' => 'study'];

        // 座席45作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画10作成-自習室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席46データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 825, 'y' => 318], 'role' => 'study'];

        // 座席46作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席47データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 864, 'y' => 318], 'role' => 'study'];

        // 座席47作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席48データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 925, 'y' => 318], 'role' => 'study'];

        // 座席48作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席49データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 963, 'y' => 318], 'role' => 'study'];

        // 座席49作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席50データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 1000, 'y' => 318], 'role' => 'study'];

        // 座席50作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画11作成-グループ学習室①
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席51データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 423, 'y' => 503], 'role' => 'lounge'];

        // 座席51作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席52データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 455, 'y' => 469], 'role' => 'lounge'];

        // 座席52作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席53データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 489, 'y' => 503], 'role' => 'lounge'];

        // 座席53作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席54データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 455, 'y' => 538], 'role' => 'lounge'];

        // 座席54作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画12作成-グループ学習室②
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席55データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 590, 'y' => 503], 'role' => 'lounge'];

        // 座席55作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席56データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 623, 'y' => 469], 'role' => 'lounge'];

        // 座席56作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席57データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 656, 'y' => 503], 'role' => 'lounge'];

        // 座席57作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席58データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 624, 'y' => 538], 'role' => 'lounge'];

        // 座席58作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画13作成-グループ学習室③
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席59データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 760, 'y' => 791], 'role' => 'lounge'];

        // 座席59作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席60データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 791, 'y' => 469], 'role' => 'lounge'];

        // 座席60作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席61データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 824, 'y' => 503], 'role' => 'lounge'];

        // 座席61作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席62データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 793, 'y' => 538], 'role' => 'lounge'];

        // 座席62作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画14作成-グループ学習室④
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席63データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 928, 'y' => 503], 'role' => 'lounge'];

        // 座席63作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席64データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 957, 'y' => 469], 'role' => 'lounge'];

        // 座席64作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席65データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 994, 'y' => 503], 'role' => 'lounge'];

        // 座席65作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席66データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 963, 'y' => 538], 'role' => 'lounge'];

        // 座席66作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画15作成-休憩室①
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席67データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 212, 'y' => 245], 'role' => 'lounge'];

        // 座席67作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席68データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 239, 'y' => 220], 'role' => 'lounge'];

        // 座席68作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席69データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 262, 'y' => 245], 'role' => 'lounge'];

        // 座席69作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席70データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 237, 'y' => 270], 'role' => 'lounge'];

        // 座席70作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画16作成-休憩室②
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席71データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 274, 'y' => 301], 'role' => 'lounge'];

        // 座席71作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席72データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 301, 'y' => 273], 'role' => 'lounge'];

        // 座席72作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席73データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 324, 'y' => 301], 'role' => 'lounge'];

        // 座席73作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席74データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 300, 'y' => 326], 'role' => 'lounge'];

        // 座席74作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画17作成-休憩室③
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席75データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 205, 'y' => 357], 'role' => 'lounge'];

        // 座席75作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席76データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 230, 'y' => 332], 'role' => 'lounge'];

        // 座席76作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席77データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 255, 'y' => 357], 'role' => 'lounge'];

        // 座席77作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席78データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 227, 'y' => 382], 'role' => 'lounge'];

        // 座席78作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画18作成-メンタリングルーム-ユーザー側
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席79データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 85], 'role' => 'user'];

        // 座席79作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席80データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 136], 'role' => 'user'];

        // 座席80作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席81データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 189], 'role' => 'user'];

        // 座席81作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席82データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 242], 'role' => 'user'];

        // 座席82作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席83データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 299], 'role' => 'user'];

        // 座席83作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画19作成-メンタリングルーム-メンター側
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席84データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 438, 'y' => 85], 'role' => 'mentor'];

        // 座席84作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席85データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 436, 'y' => 136], 'role' => 'mentor'];

        // 座席85作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席86データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 435, 'y' => 189], 'role' => 'mentor'];

        // 座席86作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席87データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 435, 'y' => 242], 'role' => 'mentor'];

        // 座席87作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席88データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 434, 'y' => 299], 'role' => 'mentor'];

        // 座席88作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画20作成-ビデオ視聴ルーム
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席89データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 103, 'y' => 202], 'role' => 'lounge'];

        // 座席89作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席90データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 100, 'y' => 261], 'role' => 'lounge'];

        // 座席90作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席91データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 94, 'y' => 317], 'role' => 'lounge'];

        // 座席91作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席92データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 87, 'y' => 375], 'role' => 'lounge'];

        // 座席92作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画21作成-職員室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席93データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 70, 'y' => 456], 'role' => 'staff'];

        // 座席93作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席94データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 65, 'y' => 488], 'role' => 'staff'];

        // 座席94作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席95データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 62, 'y' => 520], 'role' => 'staff'];

        // 座席95作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席96データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 58, 'y' => 550], 'role' => 'staff'];

        // 座席96作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画22作成-応接室
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席97データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 131, 'y' => 510], 'role' => 'hangout'];

        // 座席97作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席98データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 158, 'y' => 510], 'role' => 'hangout'];

        // 座席98作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席99データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 128, 'y' => 558], 'role' => 'hangout'];

        // 座席99作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席100データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 154, 'y' => 558], 'role' => 'hangout'];

        // 座席100作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);




        // 区画23作成-空き部屋
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);

        //*** 座席101データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 350, 'y' => 97], 'role' => 'study'];

        // 座席101作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席102データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 290, 'y' => 72], 'role' => 'study'];

        // 座席102作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席103データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 287, 'y' => 97], 'role' => 'study'];

        // 座席103作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席104データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 285, 'y' => 123], 'role' => 'study'];

        // 座席104作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席105データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 212, 'y' => 72], 'role' => 'study'];

        // 座席105作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席106データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 209, 'y' => 97], 'role' => 'study'];

        // 座席106作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席107データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 207, 'y' => 123], 'role' => 'study'];

        // 座席107作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席108データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 135, 'y' => 72], 'role' => 'study'];

        // 座席108作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席109データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 132, 'y' => 97], 'role' => 'study'];

        // 座席109作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席110データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 130, 'y' => 123], 'role' => 'study'];

        // 座席110作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);
    }
}
