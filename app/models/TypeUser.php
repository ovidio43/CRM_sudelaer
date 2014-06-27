<?php

class TypeUser extends Eloquent {

    protected $table = 'type_user';

    public function user() {
        return $this->hasMany('User');
    }

}
