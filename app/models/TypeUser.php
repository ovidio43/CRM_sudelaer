<?php

class TypeUser extends Eloquent {

    protected $table = 'type_user';

    public function user() {
        return $this->hasMany('User','id_type_user');
    }

    public function module() {
        return $this->belongsToMany('Module', 'module_type_user', 'id_type_user', 'id_module');
    }
    public function action() {
        return $this->belongsToMany('Action', 'action_type_user', 'id_type_user', 'id_action');
    }
    public function alert() {
        return $this->belongsToMany('Alert', 'alert_type_user', 'id_type_user', 'id_alert');
    }

}
