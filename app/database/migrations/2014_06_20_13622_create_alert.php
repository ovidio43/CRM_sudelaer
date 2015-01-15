<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlert extends Migration {

    public function up() {
        Schema::create('alert', function($table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->integer('id_template')->unsigned();
            $table->foreign('id_template')->references('id')->on('templates')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('alert');
    }

}
