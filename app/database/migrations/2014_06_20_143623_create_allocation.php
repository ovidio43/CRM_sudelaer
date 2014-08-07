<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllocation extends Migration {

    public function up() {
        Schema::create('allocation', function($table) {
            $table->increments('id');
            $table->dateTime('date_entered')->default(date('Y-m-d H:i:s'));
            $table->time('time_entered')->default(date('H:i:s'));
            $table->char('status',1)->default('1');
            $table->integer('id_employee')->unsigned();
            $table->foreign('id_employee')->references('id')->on('employee')->onDelete('cascade');
            $table->integer('id_leads')->unsigned();
            $table->foreign('id_leads')->references('id')->on('leads')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('allocation');
    }

}
