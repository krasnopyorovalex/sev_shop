<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogs', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('name', 512);
            $table->string('title', 512);
            $table->string('description', 512)->nullable();
            $table->text('text')->nullable();
            $table->string('alias', 255)->unique();
            $table->unsignedTinyInteger('pos')->default(0);
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('catalogs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalogs');
    }
}
