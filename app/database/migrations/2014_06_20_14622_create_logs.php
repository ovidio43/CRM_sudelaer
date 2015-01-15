<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogs extends Migration {

    public function up() {
        Schema::create('logs', function($table) {
            $table->increments('id');
            $table->string('description', 255);
            $table->char('status', 1)->default('1');
            $table->dateTime('date_entered')->default(date('Y-m-d'));
            $table->char('active', 1)->default('1');
            $table->integer('id_leads')->unsigned();
            $table->foreign('id_leads')->references('id')->on('leads')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('logs');
    }

}
