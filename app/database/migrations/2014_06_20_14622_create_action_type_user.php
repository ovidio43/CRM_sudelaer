<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionTypeUser extends Migration {

    public function up() {
        Schema::create('action_type_user', function($table) {
            $table->increments('id');                       
            $table->integer('id_action')->unsigned();
            $table->foreign('id_action')->references('id')->on('action')->onDelete('cascade');
            $table->integer('id_type_user')->unsigned();
            $table->foreign('id_type_user')->references('id')->on('type_user')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('action_type_user');
    }

}
