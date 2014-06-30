<?php

class UserController extends BaseController {

    private $rules = array(
        'user' => 'required',
        'password' => 'required|alphaNum|min:3',
        'id_employee' => 'required',
        'id_type_user' => 'required'
    );

    public function doLogin() {
        $rules = array(
            'user' => 'required',
            'password' => 'required|alphaNum|min:3'
        );

        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails()) {
            return Redirect::back()->withErrors($validation)->withInput();
        } else {
            $userdata = array(
                'user' => Input::get('user'),
                'password' => Input::get('password')
            );

            if (Auth::attempt($userdata)) {
                return Redirect::to('dashboard');
            } else {
                return Redirect::back()->withErrors($validation)->withInput();
            }
        }
    }

    public function logOut() {
        Auth::logout();
        return Redirect::to('/');
    }

    public function save() {
        $input = Input::all();
        $validation = Validator::make($input, $this->rules);
        if (!$validation->fails()) {
            $this->insert($input);
            return Redirect::to('system/user');
        } else {
            return Redirect::back()->withErrors($validation)->withInput();
        }
    }

    private function insert($input) {
        $ObjUser = new User();
        $ObjUser->user = $input['user'];
        $ObjUser->password = Hash::make($input['password']);
        $ObjUser->id_employee = $input['id_employee'];
        $ObjUser->id_type_user = $input['id_type_user'];
        $ObjUser->active = 1;
        $ObjUser->save();
    }

    public function edit_save($id) {
        $this->rules['user'] = '';
        $this->rules['password'] = '';
        $input = Input::all();
        $validation = Validator::make($input, $this->rules);
        if (!$validation->fails()) {
            $ObjUser = User::find($id);
//            $ObjUser->user = $input['user'];
            if (isset($input['password'])) {
                $ObjUser->password = Hash::make ($input['password']);
            }
            $ObjUser->id_employee = $input['id_employee'];
            $ObjUser->id_type_user = $input['id_type_user'];
            $ObjUser->active = 1;
            $ObjUser->save();
            return Redirect::to('system/user');
        } else {
            return Redirect::back()->withErrors($validation)->withInput();
        }
    }

    public function delete($id) {
        $ObjUser = User::find($id);
        if ($ObjUser->delete()) {
            return 'ok';
        } else {
            return 'error';
        }
    }

}
