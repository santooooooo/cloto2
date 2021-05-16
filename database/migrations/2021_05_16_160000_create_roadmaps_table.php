<?php

use Illuminate\Database\Migrations\Migration;
use App\Database\Blueprint;
use App\Facades\Schema;

class CreateRoadmapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roadmaps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();                // ユーザーID
            $table->foreignId('road_id')
                ->constrained()
                ->cascadeOnDelete();                // ロードID
            $table->unsignedInteger('in_progress'); // 取り組み中のクラス
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
        Schema::dropIfExists('roadmaps');
    }
}
