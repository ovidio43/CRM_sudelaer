<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeUser extends Migration {

    public function up() {
        Schema::create('type_user', function($table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('type_user');
    }

}
