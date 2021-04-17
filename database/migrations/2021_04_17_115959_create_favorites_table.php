<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();        // ユーザーID
            $table->foreignId('karte_id')
                ->constrained()
                ->cascadeOnDelete()
                ->nullable();               // カルテID
            $table->foreignId('post_id')
                ->constrained()
                ->cascadeOnDelete()
                ->nullable();               // 投稿ID
            $table->foreignId('comment_id')
                ->constrained()
                ->cascadeOnDelete()
                ->nullable();               // コメントID
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorites');
    }
}
