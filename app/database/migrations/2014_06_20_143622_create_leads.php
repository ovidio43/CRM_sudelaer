<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeads extends Migration {

    public function up() {
        Schema::create('leads', function($table) {
            $table->increments('id');
            $table->char('salutation', 10);
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('account_name', 255);
            $table->string('home_phone', 100);
            $table->string('office_phone', 100);
            $table->string('mobile', 100);
            $table->string('fax', 100);
            $table->text('primary_address_street');
            $table->string('primary_address_city', 100);
            $table->string('primary_address_state', 100);
            $table->char('primary_address_zipcode', 100);
            $table->text('alt_address_street');
            $table->string('alt_address_city', 100);
            $table->string('alt_address_state', 100);
            $table->char('alt_address_zipcode', 20);
            $table->dateTime('date_entered');
            $table->string('email_address', 255);
            $table->text('note');
            $table->string('status', 100);
            $table->text('status_description');
            $table->string('opportunity_amount', 50);
            $table->integer('id_campaign'); //ojojojoj
            $table->string('lead_type', 100);
            $table->string('lead_source', 100);
            $table->text('lead_source_description');
            $table->string('referred_by', 100);
            $table->char('do_not_call', 1);
            $table->integer('id_employee');
            $table->integer('create_by');
            $table->string('opportunity', 20);
            $table->string('type', 20);
            $table->char('active', 1);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('leads');
    }

}
