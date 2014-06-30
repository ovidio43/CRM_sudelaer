<?php

class TypeUserController extends BaseController {

    private $rules = array(
        'name' => 'Required',
        'description' => 'Required',
    );

    public function save() {
        $input = Input::all();
        $validation = Validator::make($input, $this->rules);
        if (!$validation->fails()) {
            $this->insert($input);
            return Redirect::to('system/type-user');
        } else {
            return Redirect::back()->withErrors($validation)->withInput();
        }
    }

    private function insert($input) {
        $ObjTypeUser = new TypeUser();
        $ObjTypeUser->name = $input['name'];
        $ObjTypeUser->description = $input['description'];
        $ObjTypeUser->save();
    }

    public function edit_save($id) {
        $input = Input::all();
        $validation = Validator::make($input, $this->rules);
        if (!$validation->fails()) {
            $ObjTypeUser = TypeUser::find($id);
            $ObjTypeUser->name = $input['name'];
            $ObjTypeUser->description = $input['description'];
            $ObjTypeUser->save();
            return Redirect::to('system/type-user');
        } else {
            return Redirect::back()->withErrors($validation)->withInput();
        }
    }

    public function delete($id) {
        $ObjTypeUser = TypeUser::find($id);
        if ($ObjTypeUser->delete()) {
            return 'ok';
        } else {
            return 'error';
        }
    }

}
