<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserHasRolesTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up(){

    Schema::create('UserHasRoles', function(Blueprint $table){

      $table->id();
      $table->foreignId('user_id')->references('id')->on('Users')->onUpdate('no action')->onDelete('cascade');
      $table->foreignId('role_id')->references('id')->on('Roles')->onUpdate('no action')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down(){
    Schema::dropIfExists('UserHasRoles');
  }
}
