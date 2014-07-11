<?php

class Module extends Eloquent {

    protected $table = 'module';

    public function typeUser() {
        return $this->belongsToMany('TypeUser', 'module_type_user', 'id_module', 'id_type_user');
    }

}
