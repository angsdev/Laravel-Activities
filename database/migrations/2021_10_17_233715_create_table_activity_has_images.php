<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableActivityHasImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ActivityHasImages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('image_id')->references('id')->on('Images')->onUpdate('no action')->onDelete('cascade');
            $table->foreignId('activity_id')->references('id')->on('Activities')->onUpdate('no action')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ActivityHasImages');
    }
}
