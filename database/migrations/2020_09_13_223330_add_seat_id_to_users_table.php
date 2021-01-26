<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeatIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 外部キー制約のため，seatsテーブル作成後にカラムを追加
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('seat_id')->after('role')->nullable()->constrained(); // 着席している座席ID
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
            $table->dropForeign('users_seat_id_foreign');
        });
    }
}
