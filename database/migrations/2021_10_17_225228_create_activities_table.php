<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

      Schema::create('Activities', function (Blueprint $table) {
        $table->id();
        $table->foreignId('type_id')->nullable()->references('id')->on('ActivityTypes')->onUpdate('no action')->onDelete('cascade');
        $table->foreignId('attention_id')->nullable()->references('id')->on('ActivityAttentions')->onUpdate('no action')->onDelete('cascade');
        $table->foreignId('process_id')->nullable()->references('id')->on('ActivityProcesses')->onUpdate('no action')->onDelete('cascade');
        $table->string('description')->nullable();
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
        Schema::dropIfExists('Activities');
    }
}
