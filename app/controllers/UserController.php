<?php

class UserController extends BaseController {

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

}
