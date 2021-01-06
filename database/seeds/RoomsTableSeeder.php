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



        // 区画1作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席1データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 412, 'y' => 117], 'role' => 'study'];

        // 座席1作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席2データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 452, 'y' => 117], 'role' => 'study'];

        // 座席2作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席3データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 117], 'role' => 'study'];

        // 座席3作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画2作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席4データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 546, 'y' => 117], 'role' => 'study'];

        // 座席4作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席5データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 587, 'y' => 117], 'role' => 'study'];

        // 座席5作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席6データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 628, 'y' => 117], 'role' => 'study'];

        // 座席6作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画3作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席7データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 721, 'y' => 117], 'role' => 'study'];

        // 座席7作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席8データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 762, 'y' => 117], 'role' => 'study'];

        // 座席8作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席9データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 803, 'y' => 117], 'role' => 'study'];

        // 座席9作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画4作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席10データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 858, 'y' => 117], 'role' => 'study'];

        // 座席10作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席11データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 898, 'y' => 117], 'role' => 'study'];

        // 座席11作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席12データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 939, 'y' => 117], 'role' => 'study'];

        // 座席12作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画5作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席13データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 412, 'y' => 172], 'role' => 'study'];

        // 座席13作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席14データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 452, 'y' => 172], 'role' => 'study'];

        // 座席15作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席15データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 172], 'role' => 'study'];

        // 座席15作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画6作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席16データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 546, 'y' => 172], 'role' => 'study'];

        // 座席16作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席17データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 587, 'y' => 172], 'role' => 'study'];

        // 座席17作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席18データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 628, 'y' => 172], 'role' => 'study'];

        // 座席18作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画7作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席19データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 722, 'y' => 172], 'role' => 'study'];

        // 座席19作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席20データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 763, 'y' => 172], 'role' => 'study'];

        // 座席20作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席21データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 804, 'y' => 172], 'role' => 'study'];

        // 座席21作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画8作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席22データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 859, 'y' => 172], 'role' => 'study'];

        // 座席22作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席23データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 899, 'y' => 172], 'role' => 'study'];

        // 座席23作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席24データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 940, 'y' => 172], 'role' => 'study'];

        // 座席24作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画9作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席25データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 413, 'y' => 227], 'role' => 'study'];

        // 座席25作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席26データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 453, 'y' => 227], 'role' => 'study'];

        // 座席26作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席27データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 493, 'y' => 227], 'role' => 'study'];

        // 座席27作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画10作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席28データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 547, 'y' => 227], 'role' => 'study'];

        // 座席28作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席29データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 588, 'y' => 227], 'role' => 'study'];

        // 座席29作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席30データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 629, 'y' => 227], 'role' => 'study'];

        // 座席30作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画11作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席31データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 723, 'y' => 227], 'role' => 'study'];

        // 座席31作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席32データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 764, 'y' => 228], 'role' => 'study'];

        // 座席32作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席33データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 805, 'y' => 228], 'role' => 'study'];

        // 座席33作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画12作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席34データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 860, 'y' => 228], 'role' => 'study'];

        // 座席34作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席35データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 900, 'y' => 228], 'role' => 'study'];

        // 座席35作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席36データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 942, 'y' => 228], 'role' => 'study'];

        // 座席36作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画13作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席37データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 410, 'y' => 286], 'role' => 'study'];

        // 座席37作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席38データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 451, 'y' => 286], 'role' => 'study'];

        // 座席38作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席39データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 491, 'y' => 286], 'role' => 'study'];

        // 座席39作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画14作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席40データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 548, 'y' => 286], 'role' => 'study'];

        // 座席40作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席41データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 589, 'y' => 286], 'role' => 'study'];

        // 座席41作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席42データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 630, 'y' => 286], 'role' => 'study'];

        // 座席42作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画15作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席43データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 723, 'y' => 285], 'role' => 'study'];

        // 座席43作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席44データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 764, 'y' => 285], 'role' => 'study'];

        // 座席44作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席45データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 805, 'y' => 285], 'role' => 'study'];

        // 座席45作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画16作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席46データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 861, 'y' => 285], 'role' => 'study'];

        // 座席46作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席47データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 902, 'y' => 285], 'role' => 'study'];

        // 座席47作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席48データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 943, 'y' => 285], 'role' => 'study'];

        // 座席48作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画17作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席49データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 100, 'y' => 80], 'role' => 'study'];

        // 座席49作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画18作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席50データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 235, 'y' => 80], 'role' => 'teacher'];

        // 座席50作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席51データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 299, 'y' => 80], 'role' => 'student'];

        // 座席51作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画19作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席52データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 231, 'y' => 161], 'role' => 'teacher'];

        // 座席52作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席53データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 295, 'y' => 161], 'role' => 'student'];

        // 座席53作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画20作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席54データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 228, 'y' => 245], 'role' => 'teacher'];

        // 座席54作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席55データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 291, 'y' => 245], 'role' => 'student'];

        // 座席55作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画21作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席56データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 225, 'y' => 332], 'role' => 'teacher'];

        // 座席56作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席57データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 290, 'y' => 332], 'role' => 'student'];

        // 座席57作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画22作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席58データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 212, 'y' => 462], 'role' => 'hangout'];

        // 座席58作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席59データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 237, 'y' => 436], 'role' => 'hangout'];

        // 座席59作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席60データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 270, 'y' => 436], 'role' => 'hangout'];

        // 座席60作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席61データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 295, 'y' => 463], 'role' => 'hangout'];

        // 座席61作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画23作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席62データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 364, 'y' => 496], 'role' => 'lounge'];

        // 座席62作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席63データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 397, 'y' => 464], 'role' => 'lounge'];

        // 座席63作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席64データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 429, 'y' => 496], 'role' => 'lounge'];

        // 座席64作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席65データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 396, 'y' => 528], 'role' => 'lounge'];

        // 座席65作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画24作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席66データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 506, 'y' => 496], 'role' => 'lounge'];

        // 座席66作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席67データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 539, 'y' => 465], 'role' => 'lounge'];

        // 座席67作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席68データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 572, 'y' => 496], 'role' => 'lounge'];

        // 座席68作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席69データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 539, 'y' => 528], 'role' => 'lounge'];

        // 座席69作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画25作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席70データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 644, 'y' => 496], 'role' => 'lounge'];

        // 座席70作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席71データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 677, 'y' => 465], 'role' => 'lounge'];

        // 座席71作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席72データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 709, 'y' => 496], 'role' => 'lounge'];

        // 座席72作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席73データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 677, 'y' => 528], 'role' => 'lounge'];

        // 座席73作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画26作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席74データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 783, 'y' => 496], 'role' => 'lounge'];

        // 座席74作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席71データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 815, 'y' => 464], 'role' => 'lounge'];

        // 座席75作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席75データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 848, 'y' => 496], 'role' => 'lounge'];

        // 座席76作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席77データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 817, 'y' => 528], 'role' => 'lounge'];

        // 座席77作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画27作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席78データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 921, 'y' => 496], 'role' => 'lounge'];

        // 座席78作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席79データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 954, 'y' => 464], 'role' => 'lounge'];

        // 座席79作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席80データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 988, 'y' => 496], 'role' => 'lounge'];

        // 座席80作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席81データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 956, 'y' => 528], 'role' => 'lounge'];

        // 座席81作成
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



        // 区画1作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席1データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 412, 'y' => 117], 'role' => 'study'];

        // 座席1作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席2データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 452, 'y' => 117], 'role' => 'study'];

        // 座席2作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席3データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 117], 'role' => 'study'];

        // 座席3作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画2作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席4データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 546, 'y' => 117], 'role' => 'study'];

        // 座席4作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席5データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 587, 'y' => 117], 'role' => 'study'];

        // 座席5作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席6データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 628, 'y' => 117], 'role' => 'study'];

        // 座席6作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画3作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席7データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 721, 'y' => 117], 'role' => 'study'];

        // 座席7作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席8データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 762, 'y' => 117], 'role' => 'study'];

        // 座席8作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席9データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 803, 'y' => 117], 'role' => 'study'];

        // 座席9作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画4作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席10データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 858, 'y' => 117], 'role' => 'study'];

        // 座席10作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席11データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 898, 'y' => 117], 'role' => 'study'];

        // 座席11作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席12データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 939, 'y' => 117], 'role' => 'study'];

        // 座席12作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画5作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席13データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 412, 'y' => 172], 'role' => 'study'];

        // 座席13作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席14データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 452, 'y' => 172], 'role' => 'study'];

        // 座席15作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席15データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 172], 'role' => 'study'];

        // 座席15作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画6作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席16データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 546, 'y' => 172], 'role' => 'study'];

        // 座席16作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席17データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 587, 'y' => 172], 'role' => 'study'];

        // 座席17作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席18データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 628, 'y' => 172], 'role' => 'study'];

        // 座席18作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画7作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席19データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 722, 'y' => 172], 'role' => 'study'];

        // 座席19作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席20データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 763, 'y' => 172], 'role' => 'study'];

        // 座席20作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席21データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 804, 'y' => 172], 'role' => 'study'];

        // 座席21作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画8作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席22データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 859, 'y' => 172], 'role' => 'study'];

        // 座席22作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席23データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 899, 'y' => 172], 'role' => 'study'];

        // 座席23作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席24データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 940, 'y' => 172], 'role' => 'study'];

        // 座席24作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画9作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席25データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 413, 'y' => 227], 'role' => 'study'];

        // 座席25作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席26データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 453, 'y' => 227], 'role' => 'study'];

        // 座席26作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席27データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 493, 'y' => 227], 'role' => 'study'];

        // 座席27作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画10作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席28データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 547, 'y' => 227], 'role' => 'study'];

        // 座席28作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席29データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 588, 'y' => 227], 'role' => 'study'];

        // 座席29作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席30データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 629, 'y' => 227], 'role' => 'study'];

        // 座席30作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画11作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席31データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 723, 'y' => 227], 'role' => 'study'];

        // 座席31作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席32データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 764, 'y' => 228], 'role' => 'study'];

        // 座席32作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席33データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 805, 'y' => 228], 'role' => 'study'];

        // 座席33作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画12作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席34データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 860, 'y' => 228], 'role' => 'study'];

        // 座席34作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席35データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 900, 'y' => 228], 'role' => 'study'];

        // 座席35作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席36データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 942, 'y' => 228], 'role' => 'study'];

        // 座席36作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画13作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席37データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 410, 'y' => 286], 'role' => 'study'];

        // 座席37作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席38データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 451, 'y' => 286], 'role' => 'study'];

        // 座席38作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席39データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 491, 'y' => 286], 'role' => 'study'];

        // 座席39作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画14作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席40データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 548, 'y' => 286], 'role' => 'study'];

        // 座席40作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席41データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 589, 'y' => 286], 'role' => 'study'];

        // 座席41作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席42データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 630, 'y' => 286], 'role' => 'study'];

        // 座席42作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画15作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席43データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 723, 'y' => 285], 'role' => 'study'];

        // 座席43作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席44データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 764, 'y' => 285], 'role' => 'study'];

        // 座席44作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席45データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 805, 'y' => 285], 'role' => 'study'];

        // 座席45作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画16作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席46データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 861, 'y' => 285], 'role' => 'study'];

        // 座席46作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席47データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 902, 'y' => 285], 'role' => 'study'];

        // 座席47作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席48データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 943, 'y' => 285], 'role' => 'study'];

        // 座席48作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画17作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席49データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 100, 'y' => 80], 'role' => 'study'];

        // 座席49作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画18作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席50データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 235, 'y' => 80], 'role' => 'teacher'];

        // 座席50作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席51データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 299, 'y' => 80], 'role' => 'student'];

        // 座席51作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画19作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席52データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 231, 'y' => 161], 'role' => 'teacher'];

        // 座席52作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席53データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 295, 'y' => 161], 'role' => 'student'];

        // 座席53作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画20作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席54データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 228, 'y' => 245], 'role' => 'teacher'];

        // 座席54作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席55データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 291, 'y' => 245], 'role' => 'student'];

        // 座席55作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画21作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席56データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 225, 'y' => 332], 'role' => 'teacher'];

        // 座席56作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席57データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 290, 'y' => 332], 'role' => 'student'];

        // 座席57作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画22作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席58データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 212, 'y' => 462], 'role' => 'hangout'];

        // 座席58作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席59データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 237, 'y' => 436], 'role' => 'hangout'];

        // 座席59作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席60データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 270, 'y' => 436], 'role' => 'hangout'];

        // 座席60作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席61データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 295, 'y' => 463], 'role' => 'hangout'];

        // 座席61作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画23作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席62データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 364, 'y' => 496], 'role' => 'lounge'];

        // 座席62作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席63データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 397, 'y' => 464], 'role' => 'lounge'];

        // 座席63作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席64データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 429, 'y' => 496], 'role' => 'lounge'];

        // 座席64作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席65データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 396, 'y' => 528], 'role' => 'lounge'];

        // 座席65作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画24作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席66データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 506, 'y' => 496], 'role' => 'lounge'];

        // 座席66作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席67データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 539, 'y' => 465], 'role' => 'lounge'];

        // 座席67作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席68データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 572, 'y' => 496], 'role' => 'lounge'];

        // 座席68作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席69データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 539, 'y' => 528], 'role' => 'lounge'];

        // 座席69作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画25作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席70データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 644, 'y' => 496], 'role' => 'lounge'];

        // 座席70作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席71データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 677, 'y' => 465], 'role' => 'lounge'];

        // 座席71作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席72データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 709, 'y' => 496], 'role' => 'lounge'];

        // 座席72作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席73データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 677, 'y' => 528], 'role' => 'lounge'];

        // 座席73作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画26作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席74データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 783, 'y' => 496], 'role' => 'lounge'];

        // 座席74作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席71データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 815, 'y' => 464], 'role' => 'lounge'];

        // 座席75作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席75データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 848, 'y' => 496], 'role' => 'lounge'];

        // 座席76作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席77データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 817, 'y' => 528], 'role' => 'lounge'];

        // 座席77作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画27作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席78データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 921, 'y' => 496], 'role' => 'lounge'];

        // 座席78作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席79データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 954, 'y' => 464], 'role' => 'lounge'];

        // 座席79作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席80データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 988, 'y' => 496], 'role' => 'lounge'];

        // 座席80作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席81データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 956, 'y' => 528], 'role' => 'lounge'];

        // 座席81作成
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



        // 区画1作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席1データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 412, 'y' => 117], 'role' => 'study'];

        // 座席1作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席2データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 452, 'y' => 117], 'role' => 'study'];

        // 座席2作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席3データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 117], 'role' => 'study'];

        // 座席3作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画2作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席4データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 546, 'y' => 117], 'role' => 'study'];

        // 座席4作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席5データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 587, 'y' => 117], 'role' => 'study'];

        // 座席5作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席6データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 628, 'y' => 117], 'role' => 'study'];

        // 座席6作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画3作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席7データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 721, 'y' => 117], 'role' => 'study'];

        // 座席7作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席8データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 762, 'y' => 117], 'role' => 'study'];

        // 座席8作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席9データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 803, 'y' => 117], 'role' => 'study'];

        // 座席9作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画4作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席10データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 858, 'y' => 117], 'role' => 'study'];

        // 座席10作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席11データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 898, 'y' => 117], 'role' => 'study'];

        // 座席11作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席12データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 939, 'y' => 117], 'role' => 'study'];

        // 座席12作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画5作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席13データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 412, 'y' => 172], 'role' => 'study'];

        // 座席13作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席14データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 452, 'y' => 172], 'role' => 'study'];

        // 座席15作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席15データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 172], 'role' => 'study'];

        // 座席15作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画6作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席16データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 546, 'y' => 172], 'role' => 'study'];

        // 座席16作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席17データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 587, 'y' => 172], 'role' => 'study'];

        // 座席17作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席18データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 628, 'y' => 172], 'role' => 'study'];

        // 座席18作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画7作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席19データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 722, 'y' => 172], 'role' => 'study'];

        // 座席19作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席20データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 763, 'y' => 172], 'role' => 'study'];

        // 座席20作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席21データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 804, 'y' => 172], 'role' => 'study'];

        // 座席21作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画8作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席22データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 859, 'y' => 172], 'role' => 'study'];

        // 座席22作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席23データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 899, 'y' => 172], 'role' => 'study'];

        // 座席23作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席24データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 940, 'y' => 172], 'role' => 'study'];

        // 座席24作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画9作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席25データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 413, 'y' => 227], 'role' => 'study'];

        // 座席25作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席26データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 453, 'y' => 227], 'role' => 'study'];

        // 座席26作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席27データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 493, 'y' => 227], 'role' => 'study'];

        // 座席27作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画10作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席28データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 547, 'y' => 227], 'role' => 'study'];

        // 座席28作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席29データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 588, 'y' => 227], 'role' => 'study'];

        // 座席29作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席30データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 629, 'y' => 227], 'role' => 'study'];

        // 座席30作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画11作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席31データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 723, 'y' => 227], 'role' => 'study'];

        // 座席31作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席32データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 764, 'y' => 228], 'role' => 'study'];

        // 座席32作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席33データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 805, 'y' => 228], 'role' => 'study'];

        // 座席33作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画12作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席34データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 860, 'y' => 228], 'role' => 'study'];

        // 座席34作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席35データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 900, 'y' => 228], 'role' => 'study'];

        // 座席35作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席36データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 942, 'y' => 228], 'role' => 'study'];

        // 座席36作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画13作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席37データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 410, 'y' => 286], 'role' => 'study'];

        // 座席37作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席38データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 451, 'y' => 286], 'role' => 'study'];

        // 座席38作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席39データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 491, 'y' => 286], 'role' => 'study'];

        // 座席39作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画14作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席40データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 548, 'y' => 286], 'role' => 'study'];

        // 座席40作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席41データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 589, 'y' => 286], 'role' => 'study'];

        // 座席41作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席42データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 630, 'y' => 286], 'role' => 'study'];

        // 座席42作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画15作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席43データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 723, 'y' => 285], 'role' => 'study'];

        // 座席43作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席44データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 764, 'y' => 285], 'role' => 'study'];

        // 座席44作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席45データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 805, 'y' => 285], 'role' => 'study'];

        // 座席45作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画16作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席46データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 861, 'y' => 285], 'role' => 'study'];

        // 座席46作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席47データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 902, 'y' => 285], 'role' => 'study'];

        // 座席47作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席48データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 943, 'y' => 285], 'role' => 'study'];

        // 座席48作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画17作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席49データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 100, 'y' => 80], 'role' => 'study'];

        // 座席49作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画18作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席50データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 235, 'y' => 80], 'role' => 'teacher'];

        // 座席50作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席51データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 299, 'y' => 80], 'role' => 'student'];

        // 座席51作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画19作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席52データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 231, 'y' => 161], 'role' => 'teacher'];

        // 座席52作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席53データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 295, 'y' => 161], 'role' => 'student'];

        // 座席53作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画20作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席54データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 228, 'y' => 245], 'role' => 'teacher'];

        // 座席54作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席55データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 291, 'y' => 245], 'role' => 'student'];

        // 座席55作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画21作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席56データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 225, 'y' => 332], 'role' => 'teacher'];

        // 座席56作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席57データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 290, 'y' => 332], 'role' => 'student'];

        // 座席57作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画22作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席58データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 212, 'y' => 462], 'role' => 'hangout'];

        // 座席58作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席59データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 237, 'y' => 436], 'role' => 'hangout'];

        // 座席59作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席60データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 270, 'y' => 436], 'role' => 'hangout'];

        // 座席60作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席61データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 295, 'y' => 463], 'role' => 'hangout'];

        // 座席61作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画23作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席62データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 364, 'y' => 496], 'role' => 'lounge'];

        // 座席62作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席63データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 397, 'y' => 464], 'role' => 'lounge'];

        // 座席63作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席64データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 429, 'y' => 496], 'role' => 'lounge'];

        // 座席64作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席65データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 396, 'y' => 528], 'role' => 'lounge'];

        // 座席65作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画24作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席66データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 506, 'y' => 496], 'role' => 'lounge'];

        // 座席66作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席67データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 539, 'y' => 465], 'role' => 'lounge'];

        // 座席67作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席68データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 572, 'y' => 496], 'role' => 'lounge'];

        // 座席68作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席69データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 539, 'y' => 528], 'role' => 'lounge'];

        // 座席69作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画25作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席70データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 644, 'y' => 496], 'role' => 'lounge'];

        // 座席70作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席71データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 677, 'y' => 465], 'role' => 'lounge'];

        // 座席71作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席72データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 709, 'y' => 496], 'role' => 'lounge'];

        // 座席72作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席73データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 677, 'y' => 528], 'role' => 'lounge'];

        // 座席73作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画26作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席74データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 783, 'y' => 496], 'role' => 'lounge'];

        // 座席74作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席71データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 815, 'y' => 464], 'role' => 'lounge'];

        // 座席75作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席75データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 848, 'y' => 496], 'role' => 'lounge'];

        // 座席76作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席77データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 817, 'y' => 528], 'role' => 'lounge'];

        // 座席77作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画27作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席78データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 921, 'y' => 496], 'role' => 'lounge'];

        // 座席78作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席79データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 954, 'y' => 464], 'role' => 'lounge'];

        // 座席79作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席80データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 988, 'y' => 496], 'role' => 'lounge'];

        // 座席80作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席81データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 956, 'y' => 528], 'role' => 'lounge'];

        // 座席81作成
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



        // 区画1作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席1データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 412, 'y' => 117], 'role' => 'study'];

        // 座席1作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席2データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 452, 'y' => 117], 'role' => 'study'];

        // 座席2作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席3データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 117], 'role' => 'study'];

        // 座席3作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画2作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席4データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 546, 'y' => 117], 'role' => 'study'];

        // 座席4作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席5データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 587, 'y' => 117], 'role' => 'study'];

        // 座席5作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席6データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 628, 'y' => 117], 'role' => 'study'];

        // 座席6作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画3作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席7データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 721, 'y' => 117], 'role' => 'study'];

        // 座席7作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席8データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 762, 'y' => 117], 'role' => 'study'];

        // 座席8作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席9データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 803, 'y' => 117], 'role' => 'study'];

        // 座席9作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画4作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席10データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 858, 'y' => 117], 'role' => 'study'];

        // 座席10作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席11データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 898, 'y' => 117], 'role' => 'study'];

        // 座席11作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席12データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 939, 'y' => 117], 'role' => 'study'];

        // 座席12作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画5作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席13データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 412, 'y' => 172], 'role' => 'study'];

        // 座席13作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席14データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 452, 'y' => 172], 'role' => 'study'];

        // 座席15作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席15データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 172], 'role' => 'study'];

        // 座席15作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画6作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席16データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 546, 'y' => 172], 'role' => 'study'];

        // 座席16作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席17データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 587, 'y' => 172], 'role' => 'study'];

        // 座席17作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席18データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 628, 'y' => 172], 'role' => 'study'];

        // 座席18作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画7作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席19データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 722, 'y' => 172], 'role' => 'study'];

        // 座席19作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席20データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 763, 'y' => 172], 'role' => 'study'];

        // 座席20作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席21データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 804, 'y' => 172], 'role' => 'study'];

        // 座席21作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画8作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席22データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 859, 'y' => 172], 'role' => 'study'];

        // 座席22作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席23データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 899, 'y' => 172], 'role' => 'study'];

        // 座席23作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席24データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 940, 'y' => 172], 'role' => 'study'];

        // 座席24作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画9作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席25データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 413, 'y' => 227], 'role' => 'study'];

        // 座席25作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席26データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 453, 'y' => 227], 'role' => 'study'];

        // 座席26作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席27データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 493, 'y' => 227], 'role' => 'study'];

        // 座席27作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画10作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席28データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 547, 'y' => 227], 'role' => 'study'];

        // 座席28作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席29データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 588, 'y' => 227], 'role' => 'study'];

        // 座席29作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席30データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 629, 'y' => 227], 'role' => 'study'];

        // 座席30作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画11作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席31データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 723, 'y' => 227], 'role' => 'study'];

        // 座席31作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席32データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 764, 'y' => 228], 'role' => 'study'];

        // 座席32作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席33データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 805, 'y' => 228], 'role' => 'study'];

        // 座席33作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画12作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席34データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 860, 'y' => 228], 'role' => 'study'];

        // 座席34作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席35データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 900, 'y' => 228], 'role' => 'study'];

        // 座席35作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席36データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 942, 'y' => 228], 'role' => 'study'];

        // 座席36作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画13作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席37データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 410, 'y' => 286], 'role' => 'study'];

        // 座席37作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席38データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 451, 'y' => 286], 'role' => 'study'];

        // 座席38作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席39データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 491, 'y' => 286], 'role' => 'study'];

        // 座席39作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画14作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席40データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 548, 'y' => 286], 'role' => 'study'];

        // 座席40作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席41データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 589, 'y' => 286], 'role' => 'study'];

        // 座席41作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席42データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 630, 'y' => 286], 'role' => 'study'];

        // 座席42作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画15作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席43データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 723, 'y' => 285], 'role' => 'study'];

        // 座席43作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席44データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 764, 'y' => 285], 'role' => 'study'];

        // 座席44作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席45データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 805, 'y' => 285], 'role' => 'study'];

        // 座席45作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画16作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席46データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 861, 'y' => 285], 'role' => 'study'];

        // 座席46作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席47データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 902, 'y' => 285], 'role' => 'study'];

        // 座席47作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席48データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 943, 'y' => 285], 'role' => 'study'];

        // 座席48作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画17作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席49データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 100, 'y' => 80], 'role' => 'study'];

        // 座席49作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画18作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席50データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 235, 'y' => 80], 'role' => 'teacher'];

        // 座席50作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席51データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 299, 'y' => 80], 'role' => 'student'];

        // 座席51作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画19作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席52データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 231, 'y' => 161], 'role' => 'teacher'];

        // 座席52作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席53データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 295, 'y' => 161], 'role' => 'student'];

        // 座席53作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画20作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席54データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 228, 'y' => 245], 'role' => 'teacher'];

        // 座席54作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席55データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 291, 'y' => 245], 'role' => 'student'];

        // 座席55作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画21作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席56データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 225, 'y' => 332], 'role' => 'teacher'];

        // 座席56作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席57データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 290, 'y' => 332], 'role' => 'student'];

        // 座席57作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画22作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席58データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 212, 'y' => 462], 'role' => 'hangout'];

        // 座席58作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席59データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 237, 'y' => 436], 'role' => 'hangout'];

        // 座席59作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席60データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 270, 'y' => 436], 'role' => 'hangout'];

        // 座席60作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席61データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 295, 'y' => 463], 'role' => 'hangout'];

        // 座席61作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画23作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席62データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 364, 'y' => 496], 'role' => 'lounge'];

        // 座席62作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席63データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 397, 'y' => 464], 'role' => 'lounge'];

        // 座席63作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席64データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 429, 'y' => 496], 'role' => 'lounge'];

        // 座席64作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席65データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 396, 'y' => 528], 'role' => 'lounge'];

        // 座席65作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画24作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席66データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 506, 'y' => 496], 'role' => 'lounge'];

        // 座席66作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席67データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 539, 'y' => 465], 'role' => 'lounge'];

        // 座席67作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席68データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 572, 'y' => 496], 'role' => 'lounge'];

        // 座席68作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席69データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 539, 'y' => 528], 'role' => 'lounge'];

        // 座席69作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画25作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席70データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 644, 'y' => 496], 'role' => 'lounge'];

        // 座席70作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席71データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 677, 'y' => 465], 'role' => 'lounge'];

        // 座席71作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席72データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 709, 'y' => 496], 'role' => 'lounge'];

        // 座席72作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席73データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 677, 'y' => 528], 'role' => 'lounge'];

        // 座席73作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画26作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席74データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 783, 'y' => 496], 'role' => 'lounge'];

        // 座席74作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席71データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 815, 'y' => 464], 'role' => 'lounge'];

        // 座席75作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席75データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 848, 'y' => 496], 'role' => 'lounge'];

        // 座席76作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席77データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 817, 'y' => 528], 'role' => 'lounge'];

        // 座席77作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画27作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席78データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 921, 'y' => 496], 'role' => 'lounge'];

        // 座席78作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席79データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 954, 'y' => 464], 'role' => 'lounge'];

        // 座席79作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席80データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 988, 'y' => 496], 'role' => 'lounge'];

        // 座席80作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席81データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 956, 'y' => 528], 'role' => 'lounge'];

        // 座席81作成
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



        // 区画1作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席1データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 412, 'y' => 117], 'role' => 'study'];

        // 座席1作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席2データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 452, 'y' => 117], 'role' => 'study'];

        // 座席2作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席3データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 117], 'role' => 'study'];

        // 座席3作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画2作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席4データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 546, 'y' => 117], 'role' => 'study'];

        // 座席4作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席5データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 587, 'y' => 117], 'role' => 'study'];

        // 座席5作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席6データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 628, 'y' => 117], 'role' => 'study'];

        // 座席6作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画3作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席7データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 721, 'y' => 117], 'role' => 'study'];

        // 座席7作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席8データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 762, 'y' => 117], 'role' => 'study'];

        // 座席8作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席9データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 803, 'y' => 117], 'role' => 'study'];

        // 座席9作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画4作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席10データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 858, 'y' => 117], 'role' => 'study'];

        // 座席10作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席11データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 898, 'y' => 117], 'role' => 'study'];

        // 座席11作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席12データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 939, 'y' => 117], 'role' => 'study'];

        // 座席12作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画5作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席13データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 412, 'y' => 172], 'role' => 'study'];

        // 座席13作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席14データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 452, 'y' => 172], 'role' => 'study'];

        // 座席15作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席15データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 492, 'y' => 172], 'role' => 'study'];

        // 座席15作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画6作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席16データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 546, 'y' => 172], 'role' => 'study'];

        // 座席16作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席17データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 587, 'y' => 172], 'role' => 'study'];

        // 座席17作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席18データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 628, 'y' => 172], 'role' => 'study'];

        // 座席18作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画7作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席19データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 722, 'y' => 172], 'role' => 'study'];

        // 座席19作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席20データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 763, 'y' => 172], 'role' => 'study'];

        // 座席20作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席21データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 804, 'y' => 172], 'role' => 'study'];

        // 座席21作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画8作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席22データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 859, 'y' => 172], 'role' => 'study'];

        // 座席22作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席23データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 899, 'y' => 172], 'role' => 'study'];

        // 座席23作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席24データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 940, 'y' => 172], 'role' => 'study'];

        // 座席24作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画9作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席25データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 413, 'y' => 227], 'role' => 'study'];

        // 座席25作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席26データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 453, 'y' => 227], 'role' => 'study'];

        // 座席26作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席27データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 493, 'y' => 227], 'role' => 'study'];

        // 座席27作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画10作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席28データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 547, 'y' => 227], 'role' => 'study'];

        // 座席28作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席29データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 588, 'y' => 227], 'role' => 'study'];

        // 座席29作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席30データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 629, 'y' => 227], 'role' => 'study'];

        // 座席30作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画11作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席31データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 723, 'y' => 227], 'role' => 'study'];

        // 座席31作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席32データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 764, 'y' => 228], 'role' => 'study'];

        // 座席32作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席33データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 805, 'y' => 228], 'role' => 'study'];

        // 座席33作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画12作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席34データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 860, 'y' => 228], 'role' => 'study'];

        // 座席34作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席35データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 900, 'y' => 228], 'role' => 'study'];

        // 座席35作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席36データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 942, 'y' => 228], 'role' => 'study'];

        // 座席36作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画13作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席37データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 410, 'y' => 286], 'role' => 'study'];

        // 座席37作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席38データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 451, 'y' => 286], 'role' => 'study'];

        // 座席38作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席39データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 491, 'y' => 286], 'role' => 'study'];

        // 座席39作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画14作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席40データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 548, 'y' => 286], 'role' => 'study'];

        // 座席40作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席41データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 589, 'y' => 286], 'role' => 'study'];

        // 座席41作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席42データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 630, 'y' => 286], 'role' => 'study'];

        // 座席42作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画15作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席43データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 723, 'y' => 285], 'role' => 'study'];

        // 座席43作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席44データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 764, 'y' => 285], 'role' => 'study'];

        // 座席44作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席45データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 805, 'y' => 285], 'role' => 'study'];

        // 座席45作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画16作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席46データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 861, 'y' => 285], 'role' => 'study'];

        // 座席46作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席47データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 902, 'y' => 285], 'role' => 'study'];

        // 座席47作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席48データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 943, 'y' => 285], 'role' => 'study'];

        // 座席48作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画17作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席49データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 100, 'y' => 80], 'role' => 'study'];

        // 座席49作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画18作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席50データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 235, 'y' => 80], 'role' => 'teacher'];

        // 座席50作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席51データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 299, 'y' => 80], 'role' => 'student'];

        // 座席51作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画19作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席52データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 231, 'y' => 161], 'role' => 'teacher'];

        // 座席52作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席53データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 295, 'y' => 161], 'role' => 'student'];

        // 座席53作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画20作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席54データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 228, 'y' => 245], 'role' => 'teacher'];

        // 座席54作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席55データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 291, 'y' => 245], 'role' => 'student'];

        // 座席55作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画21作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席56データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 225, 'y' => 332], 'role' => 'teacher'];

        // 座席56作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席57データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 290, 'y' => 332], 'role' => 'student'];

        // 座席57作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画22作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席58データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 212, 'y' => 462], 'role' => 'hangout'];

        // 座席58作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席59データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 237, 'y' => 436], 'role' => 'hangout'];

        // 座席59作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席60データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 270, 'y' => 436], 'role' => 'hangout'];

        // 座席60作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席61データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 295, 'y' => 463], 'role' => 'hangout'];

        // 座席61作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画23作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席62データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 364, 'y' => 496], 'role' => 'lounge'];

        // 座席62作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席63データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 397, 'y' => 464], 'role' => 'lounge'];

        // 座席63作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席64データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 429, 'y' => 496], 'role' => 'lounge'];

        // 座席64作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席65データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 396, 'y' => 528], 'role' => 'lounge'];

        // 座席65作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画24作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席66データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 506, 'y' => 496], 'role' => 'lounge'];

        // 座席66作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席67データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 539, 'y' => 465], 'role' => 'lounge'];

        // 座席67作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席68データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 572, 'y' => 496], 'role' => 'lounge'];

        // 座席68作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席69データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 539, 'y' => 528], 'role' => 'lounge'];

        // 座席69作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画25作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席70データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 644, 'y' => 496], 'role' => 'lounge'];

        // 座席70作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席71データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 677, 'y' => 465], 'role' => 'lounge'];

        // 座席71作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席72データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 709, 'y' => 496], 'role' => 'lounge'];

        // 座席72作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席73データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 677, 'y' => 528], 'role' => 'lounge'];

        // 座席73作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画26作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席74データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 783, 'y' => 496], 'role' => 'lounge'];

        // 座席74作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席71データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 815, 'y' => 464], 'role' => 'lounge'];

        // 座席75作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席75データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 848, 'y' => 496], 'role' => 'lounge'];

        // 座席76作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席77データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 817, 'y' => 528], 'role' => 'lounge'];

        // 座席77作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);



        // 区画27作成
        $created_section = Section::create(['uuid' => Str::uuid(), 'room_id' => $created_room->id, 'name' => $created_room->name . 'の区画']);


        //*** 座席78データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 921, 'y' => 496], 'role' => 'lounge'];

        // 座席78作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席79データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 954, 'y' => 464], 'role' => 'lounge'];

        // 座席79作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席80データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 988, 'y' => 496], 'role' => 'lounge'];

        // 座席80作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);

        //*** 座席81データ ***//
        $seat = ['size' => 25, 'position' => ['x' => 956, 'y' => 528], 'role' => 'lounge'];

        // 座席81作成
        Seat::create(['section_id' => $created_section->id, 'size' => $seat['size'], 'position' => $seat['position'], 'role' => $seat['role']]);
    }
}
