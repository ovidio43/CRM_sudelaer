<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleTypeUser extends Migration {

    public function up() {
        Schema::create('module_type_user', function($table) {
            $table->increments('id');                       
            $table->integer('id_module')->unsigned();
            $table->foreign('id_module')->references('id')->on('module')->onDelete('cascade');
            $table->integer('id_type_user')->unsigned();
            $table->foreign('id_type_user')->references('id')->on('type_user')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('module_type_user');
    }

}
