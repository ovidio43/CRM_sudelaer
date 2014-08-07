<?php

class Leads extends Eloquent {

    protected $table = 'leads';

    public function carType() {
        return $this->hasMany('CarType');
    }

    public function contacts() {
        return $this->belongsTo('Contacts', 'id_leads');
    }

    public function logs() {
        return $this->hasOne('Logs', 'id_leads');
    }

    public function allocation() {
        return $this->hasOne('Allocation', 'id_leads');
    }

}
