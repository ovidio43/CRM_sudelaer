<?php

class Contacts extends Eloquent {

    protected $table = 'contact';

    public function leads() {
        return $this->hasOne('Leads', 'id');
    }

}
