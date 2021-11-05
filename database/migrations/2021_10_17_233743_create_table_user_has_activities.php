<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUserHasActivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('UserHasActivities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('Users')->onUpdate('no action')->onDelete('cascade');
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
        Schema::dropIfExists('UserHasActivities');
    }
}
