<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityIdentifiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ActivityIdentifiers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->references('id')->on('Activities')->onUpdate('no action')->onDelete('cascade');
            $table->foreignId('source_id')->references('id')->on('ActivitySources')->onUpdate('no action')->onDelete('cascade');
            $table->string('value');
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
        Schema::dropIfExists('ActivityIdentifiers');
    }
}
