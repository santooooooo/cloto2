<?php

use Illuminate\Database\Migrations\Migration;
use App\Database\Blueprint;
use App\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');     // ユーザーID
            $table->unsignedInteger('project_id');  // プロジェクトID
            $table->string('body');                 // タスク内容
            $table->dateTimes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
