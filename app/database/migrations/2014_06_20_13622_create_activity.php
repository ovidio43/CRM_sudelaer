<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivity extends Migration {

    public function up() {
        Schema::create('activity', function($table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->string('prefix', 30);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('activity');
    }

}
