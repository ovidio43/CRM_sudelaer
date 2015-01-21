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
            DB::transaction(function() use ($input) {
                $this->insert($input);
                $this->saveLogs();
                $this->saveAllocation($input);
                $this->sendMail($input);
            });
            return Redirect::to('leads/car-type/new/' . $this->id);
        } else {
            return Redirect::back()->withErrors($validation)->withInput();
        }
    }

    public function edit_save($id) {
        $input = Input::all();
        $this->rules['mobile'] = 'Required';
        $this->rules['email_address'] = 'email';
        $validation = Validator::make($input, $this->rules);
        if (!$validation->fails()) {
            $this->id = $id;
            DB::transaction(function() use ($input) {
                $this->insert_edit($input);
                $this->saveEditAllocation($input);
            });
            return Redirect::to('leads/mylist');
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

    public function edit_memo($id) {
        $ObjLeads = Leads::find($id);
        $input = Input::all();
        $ObjLeads->memo_short = $input['memo_short'];
        if ($ObjLeads->save()) {
            return 'ok';
        } else {
            return 'error';
        }
    }

    private function insert($input) {
        $ObjLeads = new Leads();
        $this->setAttr($ObjLeads, $input);
        $ObjLeads->create_by = Auth::user()->employee->id;
        $ObjLeads->date_entered = date('Y-m-d H:i:s');
        $ObjLeads->active = 1;
        $ObjLeads->save();
        $this->id = $ObjLeads->id;
    }

    private function insert_edit($input) {
        $ObjLeads = Leads::find($this->id);
        $this->setAttr($ObjLeads, $input);
        $ObjLeads->save();
    }

    private function setAttr($ObjLeads, $input) {
        $ObjLeads->salutation = $input['salutation'];
        $ObjLeads->first_name = $input['first_name'];
        $ObjLeads->last_name = $input['last_name'];
        $ObjLeads->home_phone = $input['home_phone'];
        $ObjLeads->mobile = $input['mobile'];
        $ObjLeads->primary_address_street = $input['primary_address_street'];
        $ObjLeads->primary_address_city = $input['primary_address_city'];
        $ObjLeads->primary_address_state = $input['primary_address_state'];
        $ObjLeads->primary_address_zipcode = $input['primary_address_zipcode'];
        $ObjLeads->alt_address_street = $input['alt_address_street'];
        $ObjLeads->alt_address_city = $input['alt_address_city'];
        $ObjLeads->alt_address_state = $input['alt_address_state'];
        $ObjLeads->alt_address_zipcode = $input['alt_address_zipcode'];
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
    }

    private function saveLogs() {
        $objLogs = new Logs();
        $objLogs->id_leads = $this->id;
        $objLogs->save();
    }

    private function saveAllocation($input) {
        if ($input['id_employee'] > 0) {
            $objAllocation = new Allocation();
            $this->setAttrAllocation($objAllocation, $input);
            $objAllocation->save();
            Mail::send('emails.newassign', [], function($message) use ($input) {
                $objemp = Employee::find($input['id_employee']);
                $message->to($objemp->email, $objemp->first_name . ' ' . $objemp->last_name)->subject('New Leads assigned!');
            });
        }
    }

    private function saveEditAllocation($input) {
        if (!isset($input['id_allocation'])) {
            $this->saveAllocation($input);
        } else {
            if ($input['id_employee'] > 0) {
                $objAllocation = Allocation::find($input['id_allocation']);
                $this->setAttrAllocation($objAllocation, $input);
                $objAllocation->save();
            } else {
                $objAllocation = Allocation::find($input['id_allocation']);
                $objAllocation->delete();
            }
        }
    }

    private function setAttrAllocation($objAllocation, $input) {
        $objAllocation->id_employee = $input['id_employee'];
        $objAllocation->id_leads = $this->id;
    }

    private function sendMail($input) {
        $objAlert = Alert::find(1);
        $data = ['id_leads' => $this->id, 'id_template' => $objAlert->id_template, 'send_client' => false];
        foreach ($objAlert->typeUser as $rTU) {
            foreach ($rTU->user as $rU) {
                if ($rU->employee->id > 1) {
                    Mail::send('emails.newleads', $data, function($message) use ($rU) {
                        $message->to($rU->employee->email, $rU->employee->first_name . ' ' . $rU->employee->last_name)->subject('New Leads Entry!!!');
                    });
                }
            }
        }
        if ($objAlert->id_template_ext > 0 && !empty($input['email_address'])) {
            $this->sendMaiilCliente($input, $objAlert->id_template_ext);
        }
    }

    private function sendMaiilCliente($input, $id_template) {
        Mail::send('emails.newleads', ['send_client' => true, 'id_template' => $id_template], function($message) use ($input) {
            $message->from('crmalerts@sudealeramigo.com', 'sudealeramigo.com');
            $message->to($input['email_address'], $input['first_name'] . ' ' . $input['last_name'])->subject('Bienvenido a C&G Imports Su Dealer Amigo');
        });
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
