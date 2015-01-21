<?php

class UserController extends BaseController {

    private $rules = array(
        'user' => 'required|unique:user',
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
                $this->setModules();
                $this->setActions();
                if (Session::has('uri_src')) {
                    return Redirect::to(Session::get('uri_src'));
                }
                return Redirect::to('dashboard');
            } else {
                return Redirect::back()->withErrors($validation)->withInput();
            }
        }
    }

    public function logOut() {
        Auth::logout();
        Session::flush();
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

    private function setModules() {
        $module = Auth::user()->typeuser->module;
        foreach ($module as $m) {
            Session::put($m->name, $m->name);
        }
    }

    private function setActions() {
        $action = Auth::user()->typeuser->action;
        foreach ($action as $a) {
            Session::put($a->name, $a->suffix);
        }
    }

    public function edit_save($id) {
        $this->rules['user'] = '';
        $this->rules['password'] = '';
        $input = Input::all();
        $validation = Validator::make($input, $this->rules);
        if (!$validation->fails()) {
            $ObjUser = User::find($id);
            if (!empty($input['password'])) {
                $ObjUser->password = Hash::make($input['password']);
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

    public function editMyProfile($id) {
        $input = Input::all();
        $rules = array(
            'first_name' => 'Required',
            'last_name' => 'Required',
            'email' => 'Required|email'
        );
        $validation = Validator::make($input, $rules);
        if (!$validation->fails()) {
            $ObjEmployee = Employee::find($id);
            $ObjEmployee->first_name = $input['first_name'];
            $ObjEmployee->last_name = $input['last_name'];
            $ObjEmployee->phone = $input['phone'];
            $ObjEmployee->cellphone = $input['cellphone'];
            $ObjEmployee->address = $input['address'];
            $ObjEmployee->email = $input['email'];
            $ObjEmployee->save();
            if (!empty($input['password'])) {
                $ObjUser = User::find(Auth::user()->id);
                $ObjUser->password = Hash::make($input['password']);

//                echo 'kokokokokok';
//                exit();
                $ObjUser->save();
            }

            return Redirect::to('my-profile');
        } else {
            return Redirect::back()->withErrors($validation)->withInput();
        }
    }

}
