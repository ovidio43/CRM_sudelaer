<?php

class Alert extends Eloquent {

    protected $table = 'alert';

    public function typeUser() {
        return $this->belongsToMany('TypeUser', 'alert_type_user', 'id_alert', 'id_type_user');
    }
  
}
