<?php

use Illuminate\Database\Migrations\Migration;
use App\Database\Blueprint;
use App\Facades\Schema;

class CreateKartesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kartes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();                // ユーザーID
            $table->foreignId('task_id')
                ->constrained()
                ->cascadeOnDelete();                // タスクID
            $table->text('body')->nullable();       // やったこと
            $table->text('achieve')->nullable();    // 達成できたこと
            $table->text('challenge')->nullable();  // 次の課題
            $table->text('reference')->nullable();  // 参考文献
            $table->json('image')->nullable();      // 画像
            $table->time('activity_time');          // 活動時間
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
        Schema::dropIfExists('kartes');
    }
}
