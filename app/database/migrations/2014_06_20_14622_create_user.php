<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUser extends Migration {

    public function up() {
        Schema::create('user', function($table) {
            $table->increments('id');
            $table->string('user', 255)->unique();
            $table->string('password', 255);
            $table->string('remember_token', 100);
            $table->string('active', 1);
            $table->integer('id_employee')->unsigned();
            $table->foreign('id_employee')->references('id')->on('employee')->onDelete('cascade');
            $table->integer('id_type_user')->unsigned();
            $table->foreign('id_type_user')->references('id')->on('type_user')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('user');
    }

}
