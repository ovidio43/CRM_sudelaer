<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModule extends Migration {

    public function up() {
        Schema::create('module', function($table) {
            $table->increments('id');
            $table->string('name', 30);            
            $table->char('active', 1)->default('1');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('module');
    }

}
