<?php

class Employee extends Eloquent {

    protected $table = 'employee';

    public function user() {
        return $this->hasOne('User', 'id_employee');
    }

    public function allocation() {
        return $this->hasMany('Allocation','id_employee');
    }

}
