<?php

class ContactsController extends BaseController {

    private $rules = array(
        'first_name' => 'Required',
        'last_name' => 'Required',
        'email_address' => 'Required|email|unique:leads'
    );

    public function save() {
        $input = Input::all();
        $validation = Validator::make($input, $this->rules);
        if (!$validation->fails()) {
            DB::transaction(function() use ($input) {
                $id_leads = $this->insertLeads($input);
                $this->insertContact($input, $id_leads);
            });
            return Redirect::to('contacts/list');
        } else {
            return Redirect::back()->withErrors($validation)->withInput();
        }
    }

    private function insertLeads($input) {
        $ObjLeads = new Leads();
        $ObjLeads->salutation = $input['salutation'];
        $ObjLeads->first_name = $input['first_name'];
        $ObjLeads->last_name = $input['last_name'];
//        $ObjLeads->title = $input['title'];
//        $ObjLeads->department = $input['department'];
        $ObjLeads->account_name = $input['account_name'];
        $ObjLeads->home_phone = $input['home_phone'];
        $ObjLeads->office_phone = $input['office_phone'];
        $ObjLeads->mobile = $input['mobile'];
        $ObjLeads->fax = $input['fax'];
//        $ObjLeads->website = $input['website'];
        $ObjLeads->primary_address_street = $input['primary_address_street'];
        $ObjLeads->primary_address_city = $input['primary_address_city'];
        $ObjLeads->primary_address_state = $input['primary_address_state'];
        $ObjLeads->primary_address_zipcode = $input['primary_address_zipcode'];
//        $ObjLeads->primary_address_country = $input['primary_address_country'];
        $ObjLeads->alt_address_street = $input['alt_address_street'];
        $ObjLeads->alt_address_city = $input['alt_address_city'];
        $ObjLeads->alt_address_state = $input['alt_address_state'];
        $ObjLeads->alt_address_zipcode = $input['alt_address_zipcode'];
//        $ObjLeads->alt_address_country = $input['alt_address_country'];
        $ObjLeads->date_entered = date('Y-m-d H:i:s');
        $ObjLeads->email_address = $input['email_address'];
        $ObjLeads->note = $input['note'];
//        $ObjLeads->status = $input['status'];
//        $ObjLeads->status_description = $input['status_description'];
//        $ObjLeads->opportunity_amount = $input['opportunity_amount'];
        $ObjLeads->id_campaign = $input['id_campaign'];
        $ObjLeads->lead_type = $input['lead_type'];
        $ObjLeads->lead_source = $input['lead_source'];
//        $ObjLeads->lead_source_description = $input['lead_source_description'];
//        $ObjLeads->referred_by = $input['referred_by'];
        $ObjLeads->do_not_call = isset($input['do_not_call']) ? $input['do_not_call'] : 'F';
        $ObjLeads->id_employee = $input['id_employee'];
        $ObjLeads->type = 'contacts';
        $ObjLeads->active = 1;
        $ObjLeads->save();
        return $ObjLeads->id;
    }

    private function insertContact($input, $id_leads) {
        $ObjConatct = new Contacts();
        $ObjConatct->reports_to = $input['reports_to'];
        $ObjConatct->sync_to_outlook = $input['sync_to_outlook'];
        $ObjConatct->active = 1;
        $ObjConatct->id_leads = $id_leads;
        $ObjConatct->save();
    }

}
