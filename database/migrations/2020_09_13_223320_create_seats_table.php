<?php

use Illuminate\Database\Migrations\Migration;
use App\Database\Blueprint;
use App\Facades\Schema;

class CreateSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained();             // 所属する区画ID
            $table->unsignedInteger('size')->default(30);               // サイズ
            $table->json('position');                                   // 座標
            $table->string('background')->nullable();                   // 背景画像
            $table->string('status')->nullable();                       // 座席状態
            $table->unsignedInteger('reservation_user_id')->nullable(); // 予約ID
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seats');
    }
}
