<?php

use Illuminate\Database\Migrations\Migration;
use App\Database\Blueprint;
use App\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('section_id');          // 所属する区画ID(どの部屋でのチャットか)
            $table->unsignedInteger('user_id')->nullable(); // ユーザーID
            $table->string('type');                         // メッセージタイプ
            $table->text('data');                           // メッセージ内容
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
        Schema::dropIfExists('chats');
    }
}
