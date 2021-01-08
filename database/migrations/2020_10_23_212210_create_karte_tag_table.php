<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKarteTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karte_tag', function (Blueprint $table) {
            $table->foreignId('karte_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('tag_id')
                ->constrained()
                ->onDelete('cascade');

            $table->primary(['karte_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karte_tag');
    }
}
