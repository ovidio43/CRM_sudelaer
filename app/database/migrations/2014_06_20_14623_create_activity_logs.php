<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityLogs extends Migration {

    public function up() {
        Schema::create('activity_logs', function($table) {
            $table->increments('id');
            $table->date('date_entered');
            $table->char('time_start',6);
            $table->char('time_end',6);
            $table->text('description');
            $table->integer('id_activity')->unsigned();
            $table->foreign('id_activity')->references('id')->on('activity')->onDelete('cascade');
            $table->integer('id_logs')->unsigned();
            $table->foreign('id_logs')->references('id')->on('logs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('activity_logs');
    }

}
