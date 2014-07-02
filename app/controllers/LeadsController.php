<?php

class LeadsController extends BaseController {

    private $rules = array(
        'first_name' => 'Required',
        'last_name' => 'Required',
        'id_employee' => 'Required',
        'email_address' => 'Required|email|unique:leads'
    );
    private $id;
    private $action;

    public function save() {
        $input = Input::all();
        $validation = Validator::make($input, $this->rules);
        if (!$validation->fails()) {
            DB::transaction(function() use ($input) {
                $this->insert($input);
                $this->insertCarType($input);
            });
            return Redirect::to('leads/list');
        } else {
            return Redirect::back()->withErrors($validation)->withInput();
        }
    }

    public function edit_save($id) {
        $input = Input::all();
        $this->id = $id;
        $this->action = $input['action'];
        $this->rules['email_address'] = '';
        $input = Input::all();
        $validation = Validator::make($input, $this->rules);
        if (!$validation->fails()) {
            $this->insert($input);
            return Redirect::to('leads/list');
        } else {
            return Redirect::back()->withErrors($validation)->withInput();
        }
    }

    public function delete($id) {
        $ObjLeads = Leads::find($id);
        if ($ObjLeads->delete()) {
            return 'ok';
        } else {
            return 'error';
        }
    }

    private function insert($input) {
        if (isset($this->action)) {
            $ObjLeads = Leads::find($this->id);
        } else {
            $ObjLeads = new Leads();
        }

        $ObjLeads->salutation = $input['salutation'];
        $ObjLeads->first_name = $input['first_name'];
        $ObjLeads->last_name = $input['last_name'];
        $ObjLeads->account_name = $input['account_name'];
        $ObjLeads->home_phone = $input['home_phone'];
        $ObjLeads->office_phone = $input['office_phone'];
        $ObjLeads->mobile = $input['mobile'];
        $ObjLeads->fax = $input['fax'];
        $ObjLeads->primary_address_street = $input['primary_address_street'];
        $ObjLeads->primary_address_city = $input['primary_address_city'];
        $ObjLeads->primary_address_state = $input['primary_address_state'];
        $ObjLeads->primary_address_zipcode = $input['primary_address_zipcode'];
        $ObjLeads->alt_address_street = $input['alt_address_street'];
        $ObjLeads->alt_address_city = $input['alt_address_city'];
        $ObjLeads->alt_address_state = $input['alt_address_state'];
        $ObjLeads->alt_address_zipcode = $input['alt_address_zipcode'];
        $ObjLeads->date_entered = date('Y-m-d H:i:s');
        $ObjLeads->email_address = $input['email_address'];
        $ObjLeads->note = $input['note'];
        $ObjLeads->status = $input['status'];
        $ObjLeads->status_description = $input['status_description'];
        $ObjLeads->opportunity_amount = $input['opportunity_amount'];
        $ObjLeads->id_campaign = $input['id_campaign'];
        $ObjLeads->lead_type = $input['lead_type'];
        $ObjLeads->lead_source = $input['lead_source'];
        $ObjLeads->lead_source_description = $input['lead_source_description'];
        $ObjLeads->referred_by = $input['referred_by'];
        $ObjLeads->do_not_call = isset($input['do_not_call']) ? $input['do_not_call'] : 'F';
        $ObjLeads->id_employee = $input['id_employee'];
        $ObjLeads->type = 'leads';
        $ObjLeads->active = 1;
        $ObjLeads->save();
        if (!isset($this->action)) {
            $this->id = $ObjLeads->id;
        }
    }

    public function migrate_to_contact($id_leads) {
        $exception = DB::transaction(function() use ($id_leads) {
                    $ObjLeads = Leads::find($id_leads);
                    $ObjLeads->type = 'contacts';
                    $ObjLeads->save();
                    $objContact = new Contacts();
                    $objContact->id_leads = $id_leads;
                    $objContact->save();
                });
        return is_null($exception) ? 'ok' : 'error';
    }

    private function insertCarType($input) {
        for ($i = 0; $i <= 2; $i++) {
            if ($input['make' . $i] || $input['year' . $i] || $input['stock' . $i] || $input['budget' . $i] !== '') {
                $args = [
                    'make' => $input['make' . $i],
                    'year' => $input['year' . $i],
                    'stock' => $input['stock' . $i],
                    'budget' => $input['budget' . $i],
                    'id_leads' => $this->id
                ];
                $this->newCarType($args);
            }
        }
    }

    private function newCarType($args) {
        $ObjCarType = new CarType();
        $ObjCarType->make = $args['make'];
        $ObjCarType->year = $args['year'];
        $ObjCarType->stock = $args['stock'];
        $ObjCarType->budget = $args['budget'];
        $ObjCarType->id_leads = $args['id_leads'];
        $ObjCarType->save();
    }

}
