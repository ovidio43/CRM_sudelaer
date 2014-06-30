<?php

class EmployeeController extends BaseController {

    private $rules = array(
        'first_name' => 'Required',
        'last_name' => 'Required',
        'phone' => 'Required|Numeric',
        'cellphone' => 'Required|Numeric',
        'address' => 'Required',
//        'email' => 'email|unique:employee'
        'email' => 'email'
    );

    public function save() {
        $input = Input::all();
        $validation = Validator::make($input, $this->rules);
        if (!$validation->fails()) {
            $this->insert($input);
            return Redirect::to('system/employee');
        } else {
            return Redirect::back()->withErrors($validation)->withInput();
        }
    }

    private function insert($input) {
        $ObjEmployee = new Employee();
        $ObjEmployee->first_name = $input['first_name'];
        $ObjEmployee->last_name = $input['last_name'];
        $ObjEmployee->phone = $input['phone'];
        $ObjEmployee->cellphone = $input['cellphone'];
        $ObjEmployee->address = $input['address'];
        $ObjEmployee->email = $input['email'];
        $ObjEmployee->active = 1;
        $ObjEmployee->save();
    }

    public function edit_save($id) {
        $input = Input::all();
        $validation = Validator::make($input, $this->rules);
        if (!$validation->fails()) {
            $ObjEmployee = Employee::find($id);
            $ObjEmployee->first_name = $input['first_name'];
            $ObjEmployee->last_name = $input['last_name'];
            $ObjEmployee->phone = $input['phone'];
            $ObjEmployee->cellphone = $input['cellphone'];
            $ObjEmployee->address = $input['address'];
            $ObjEmployee->email = $input['email'];
            $ObjEmployee->active = 1;
            $ObjEmployee->save();
            return Redirect::to('system/employee');
        } else {
            return Redirect::back()->withErrors($validation)->withInput();
        }
    }

    public function delete($id) {
        $ObjEmployee = Employee::find($id);
        if ($ObjEmployee->delete()) {
            return 'ok';
        } else {
            return 'error';
        }
    }

}
