<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUserHasImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('UserHasImages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('Users')->onUpdate('no action')->onDelete('cascade');
            $table->foreignId('image_id')->references('id')->on('Images')->onUpdate('no action')->onDelete('cascade');
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
        Schema::dropIfExists('UserHasImages');
    }
}
