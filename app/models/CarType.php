<?php

class CarType extends Eloquent {

    protected $table = 'car_type';

    public function leads() {
        return $this->belongsTo('Leads', 'id_leads');
    }

}
