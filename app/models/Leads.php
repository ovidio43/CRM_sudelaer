<?php

class Leads extends Eloquent {

    protected $table = 'leads';
     public function carType() {
        return $this->hasMany('CarType');
    }

}
