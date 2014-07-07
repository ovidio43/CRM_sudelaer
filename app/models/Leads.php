<?php

class Leads extends Eloquent {

    protected $table = 'leads';

    public function carType() {
        return $this->hasMany('CarType');
    }

    public function contacts() {
        return $this->belongsTo('Contacts','id_leads');
    }

}
