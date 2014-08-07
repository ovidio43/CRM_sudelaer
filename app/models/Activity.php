<?php

class Activity extends Eloquent {

    protected $table = 'activity';

    public function logs() {
        return $this->belongsToMany('Logs', 'activity_logs', 'id_activity', 'id_logs');
    }

}
