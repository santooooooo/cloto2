<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Room;
use App\Models\Section;
use App\Models\Seat;
use App\Models\Chat;

class RoomsTableUpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Room::truncate();
        Section::truncate();
        Seat::truncate();
        Chat::truncate();

        $this->call(rooms\Room1Seeder::class);
        $this->call(rooms\Room2Seeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
