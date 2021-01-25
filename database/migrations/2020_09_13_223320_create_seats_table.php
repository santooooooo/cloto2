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
            $table->foreignId('section_id')
                ->constrained()
                ->cascadeOnDelete();                                    // 所属する区画ID
            $table->string('name');                                     // 座席名
            $table->unsignedInteger('size');                            // サイズ
            $table->json('position');                                   // 座標
            $table->string('role');                                     // 役割
            $table->json('media')->nullable();                          // メディア
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
