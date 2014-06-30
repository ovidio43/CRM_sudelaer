<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContact extends Migration {

    public function up() {
        Schema::create('contact', function($table) {
            $table->increments('id');
            $table->integer('reports_to');
            $table->char('sync_to_outlook', 1);
            $table->char('active', 1);
            $table->integer('id_leads')->unsigned();
            $table->foreign('id_leads')->references('id')->on('leads')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('contact');
    }

}
