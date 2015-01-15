<?php

class Logs extends Eloquent {

    protected $table = 'logs';

    public function activities() {
        return $this->belongsToMany('Activity', 'activity_logs', 'id_logs', 'id_activity')->withPivot('date_entered', 'time_start', 'time_end','description');
    }

    public function leads() {
        return $this->belongsTo('Leads', 'id');
    }

}
