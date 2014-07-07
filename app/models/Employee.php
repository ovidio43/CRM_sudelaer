<?php

class Employee extends Eloquent {

    protected $table = 'employee';

    public function user() {
        return $this->hasOne('User','id');
    }

}
