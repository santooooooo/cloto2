<?php

use Illuminate\Database\Migrations\Migration;
use App\Database\Blueprint;
use App\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();               // ユーザー名
            $table->string('email')->unique();                  // メール
            $table->dateTime('email_verified_at')->nullable();  // メール認証日時
            $table->string('password');                         // パスワード
            $table->string('handlename');                       // 表示名
            $table->string('icon');                             // アイコン
            $table->json('sns')->nullable();                    // SNS
            $table->string('web')->nullable();                  // Webページ
            $table->text('introduction')->nullable();           // 自己紹介
            $table->string('type')->default('free');            // アカウントタイプ
            $table->string('role')->default('user');            // 役割
            // foreignId('seat_id')                             // 着席している座席ID
            $table->string('in_progress')->nullable();          // 取り組み中のタスク
            // string('vision')                                 // 目標
            // unsignedInteger('sitting_time')                  // 累計着席時間
            $table->rememberToken();
            $table->dateTimes();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
