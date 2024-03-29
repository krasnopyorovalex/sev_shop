<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnSliderIdToPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', static function (Blueprint $table) {
            $table->unsignedBigInteger('slider_id')->nullable()->after('id');

            $table->foreign('slider_id')->references('id')->on('sliders')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {

            $table->dropForeign(['slider_id']);
            $table->dropColumn(['slider_id']);
        });
    }
}
