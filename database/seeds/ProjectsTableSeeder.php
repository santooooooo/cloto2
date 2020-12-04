<?php

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ダミープロジェクトの作成
        Project::create(['user_id' => 1, 'name' => 'dummy']);
    }
}
