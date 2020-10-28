<?php

use Illuminate\Database\Seeder;
use App\Models\Technology;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['C', 'C++', 'C#', 'Java', 'PHP', 'Ruby', 'JavaScript', 'TypeScript', 'Python', 'Kotlin'];
        foreach ($names as $name) {
            Technology::create(['name' => $name]);
        }
    }
}
