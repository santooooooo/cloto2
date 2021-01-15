<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagsTableSeeder extends Seeder
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
            Tag::create(['name' => $name]);
        }
    }
}
