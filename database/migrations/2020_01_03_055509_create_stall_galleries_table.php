<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStallGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image', 20);
            $table->string('caption', 50)->nullable();
            $table->integer('position');
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
        Schema::dropIfExists('stall_galleries');
    }
}
