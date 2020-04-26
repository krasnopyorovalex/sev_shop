<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 512);
            $table->string('title', 512);
            $table->string('description', 512)->nullable();
            $table->text('preview');
            $table->text('text');
            $table->string('alias', 64)->unique();
            $table->enum('is_published',[0,1])->default(1);
            //$table->date('published_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->date('published_at')->default(now());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
