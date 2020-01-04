<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 20);
            $table->string('description', 500)->nullable();
            $table->integer('price');
            $table->boolean('is_recommended')->default(0);
            $table->string('image', 20)->nullable();
            $table->integer('position')->default(0);
            $table->unsignedBigInteger('stall_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('stall_id')->references('id')->on('stalls');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
