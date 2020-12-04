<?php

use Illuminate\Database\Seeder;
use App\Models\Task;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ダミータスクの作成
        Task::create(['user_id' => 1, 'project_id' => 1, 'body' => 'dummy']);
    }
}
