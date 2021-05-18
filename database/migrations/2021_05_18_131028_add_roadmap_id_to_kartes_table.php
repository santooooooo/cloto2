<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoadmapIdToKartesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kartes', function (Blueprint $table) {
            $table->foreignId('roadmap_id')->after('user_id')->nullable()->constrained();   // ロードマップID
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kartes', function (Blueprint $table) {
            $table->dropForeign('kartes_roadmap_id_foreign');
            $table->dropColumn('roadmap_id');
        });
    }
}
