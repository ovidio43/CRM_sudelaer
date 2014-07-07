<?php

class ContactsController extends BaseController {

    private $rules = array(
        'first_name' => 'Required',
        'last_name' => 'Required',
        'id_employee' => 'Required',
        'email_address' => 'Required|email|unique:leads'
    );
    private $id;

    public function save() {
        $input = Input::all();
        $validation = Validator::make($input, $this->rules);
        if (!$validation->fails()) {
            DB::transaction(function() use ($input) {
                $this->insertLeads($input);
                $this->insertContact($input);
            });
            return Redirect::to('contacts/list');
        } else {
            return Redirect::back()->withErrors($validation)->withInput();
        }
    }

    private function insertLeads($input) {
        $ObjLeads = new Leads();
        $this->setAttrLeads($ObjLeads, $input);
        $this->id = $ObjLeads->id;
    }

    private function insertContact($input) {
        $ObjConatct = new Contacts();
        $this->setAttrContact($ObjConatct, $input);
    }

    private function setAttrLeads($ObjLeads, $input) {
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
        $ObjLeads->id_campaign = $input['id_campaign'];
        $ObjLeads->lead_type = $input['lead_type'];
        $ObjLeads->lead_source = $input['lead_source'];
        $ObjLeads->do_not_call = isset($input['do_not_call']) ? $input['do_not_call'] : 'F';
        $ObjLeads->id_employee = $input['id_employee'];
        $ObjLeads->type = 'contacts';
        $ObjLeads->active = 1;
        $ObjLeads->save();
    }

    private function setAttrContact($ObjConatct, $input) {
        $ObjConatct->reports_to = $input['reports_to'];
        $ObjConatct->sync_to_outlook = $input['sync_to_outlook'];
        $ObjConatct->active = 1;
        $ObjConatct->id_leads = $this->id;
        $ObjConatct->save();
    }

}
