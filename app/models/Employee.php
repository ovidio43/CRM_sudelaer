<?php

class Employee extends Eloquent {

    protected $table = 'employee';

    public function phone() {
        return $this->hasOne('User');
    }

}
