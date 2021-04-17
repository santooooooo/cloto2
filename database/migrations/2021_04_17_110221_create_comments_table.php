<?php

use Illuminate\Database\Migrations\Migration;
use App\Database\Blueprint;
use App\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();            // ユーザーID
            $table->foreignId('karte_id')
                ->constrained()
                ->cascadeOnDelete()
                ->nullable();                   // カルテID
            $table->foreignId('post_id')
                ->constrained()
                ->cascadeOnDelete()
                ->nullable();                   // 投稿ID
            $table->text('body');               // 内容
            $table->json('media')->nullable();  // メディア
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
        Schema::dropIfExists('comments');
    }
}
