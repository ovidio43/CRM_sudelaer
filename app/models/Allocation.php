<?php

class Allocation extends Eloquent {

    protected $table = 'allocation';

    public function leads() {
        return $this->belongsTo('Leads', 'id_leads');
    }

    public function employee() {
        return $this->belongsTo('Employee', 'id_employee');
    }

}
