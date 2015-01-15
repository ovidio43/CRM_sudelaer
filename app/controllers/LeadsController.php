<?php

class LeadsController extends BaseController {

    private $rules = array(
        'first_name' => 'Required',
        'last_name' => 'Required',
        'id_employee' => 'Required',
        'mobile' => 'Required',
        'lead_type' => 'Required',
        'lead_source' => 'Required'
        //'opportunity' => 'Required',
        //'email_address' => 'Required|email'
    );
    private $id;

    public function save() {
               $input = Input::all();
        $validation = Validator::make($input, $this->rules);
        if (!$validation->fails()) {
            $this->insert($input);
            return Redirect::to('car-type/new/' . $this->id);
        } else {
            return Redirect::back()->withErrors($validation)->withInput();
        }
    }

    public function edit_save($id) {
        $input = Input::all();
        $validation = Validator::make($input, $this->rules);
        if (!$validation->fails()) {
            $this->insert_edit($input, $id);
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
        $ObjLeads = new Leads();
        $this->setAttr($ObjLeads, $input);
        $this->id = $ObjLeads->id;
    }

    private function insert_edit($input, $id) {
        $ObjLeads = Leads::find($id);
        $this->setAttr($ObjLeads, $input);
    }

    private function setAttr($ObjLeads, $input) {
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
        $ObjLeads->opportunity = $input['opportunity'];
        $ObjLeads->type = 'leads';
        $ObjLeads->active = 1;
        $ObjLeads->save();
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

}
