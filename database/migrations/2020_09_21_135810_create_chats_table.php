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
            $table->foreignId('section_id')->constrained();             // 所属する区画ID(どのグループでのチャットか)
            $table->foreignId('user_id')->nullable()->constrained();    // ユーザーID
            $table->string('type');                                     // メッセージタイプ
            $table->json('data');                                       // メッセージ内容
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
