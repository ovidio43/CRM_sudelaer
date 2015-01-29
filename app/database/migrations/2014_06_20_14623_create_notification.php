<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotification extends Migration {

    public function up() {
        Schema::create('notification', function($table) {
            $table->increments('id');
            $table->string('subject', 255);
            $table->longText('message');
            $table->char('read', 1)->default('0');
            $table->char('status', 1)->default('1');
            $table->dateTime('date_entered');
            $table->integer('id_user_source')->unsigned();
            $table->foreign('id_user_source')->references('id')->on('user')->onDelete('cascade');
            $table->integer('id_user_destination')->unsigned();
            $table->foreign('id_user_destination')->references('id')->on('user')->onDelete('cascade');
            $table->integer('id_leads')->unsigned();
            $table->foreign('id_leads')->references('id')->on('leads')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('notification');
    }

}
