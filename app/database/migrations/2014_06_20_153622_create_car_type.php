<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarType extends Migration {

    public function up() {
        Schema::create('car_type', function($table) {
            $table->increments('id');
            $table->string('make', 20);
            $table->string('year', 20);
            $table->string('stock', 20);
            $table->string('model', 20);
            $table->string('budget', 20);
            $table->integer('id_leads')->unsigned();
            $table->foreign('id_leads')->references('id')->on('leads')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('car_type');
    }

}
