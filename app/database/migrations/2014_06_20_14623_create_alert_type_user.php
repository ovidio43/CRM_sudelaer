<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlertTypeUser extends Migration {

    public function up() {
        Schema::create('alert_type_user', function($table) {
            $table->increments('id');       
            $table->integer('id_alert')->unsigned();
            $table->foreign('id_alert')->references('id')->on('alert')->onDelete('cascade');
            $table->integer('id_type_user')->unsigned();
            $table->foreign('id_type_user')->references('id')->on('type_user')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('alert_type_user');
    }

}
