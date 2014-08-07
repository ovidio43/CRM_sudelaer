<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAction extends Migration {

    public function up() {
        Schema::create('action', function($table) {
            $table->increments('id');
            $table->string('name', 30);            
            $table->string('suffix', 30);            
            $table->char('active', 1)->default('1');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('action');
    }

}
