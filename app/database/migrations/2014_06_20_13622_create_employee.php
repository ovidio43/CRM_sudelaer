<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployee extends Migration {

    public function up() {
        Schema::create('employee', function($table) {
            $table->increments('id');
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->string('phone', 255);
            $table->string('cellphone', 255);
            $table->string('address', 255);
            $table->string('email', 255);
            $table->string('active', 1);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('employee');
    }

}
