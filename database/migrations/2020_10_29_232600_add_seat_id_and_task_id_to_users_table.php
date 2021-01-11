<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeatIdAndTaskIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 外部キー制約のため，それぞれのテーブル作成後にしかカラムを追加できない
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('seat_id')->after('in_progress')->nullable()->constrained();  // 着席している座席ID
            $table->foreignId('task_id')->after('seat_id')->nullable()->constrained();      // 進行中のタスクID
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_task_id_foreign');
            $table->dropForeign('users_seat_id_foreign');
        });
    }
}
