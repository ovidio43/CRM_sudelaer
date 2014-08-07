<?php

class Action extends Eloquent {

    protected $table = 'action';

    public function typeUser() {
        return $this->belongsToMany('TypeUser', 'action_type_user', 'id_action', 'id_type_user');
    }

}
