<?php

class TypeUserController extends BaseController {

    private $rules = array(
        'name' => 'Required',
        'description' => 'Required',
    );
    private $id;

    public function save() {
        $input = Input::all();
        $validation = Validator::make($input, $this->rules);
        if (!$validation->fails()) {
            DB::transaction(function() use ($input) {
                $this->insert($input);
                $this->insertActions($input);
                $this->insertModules($input);
            });
            return Redirect::to('system/type-user');
        } else {
            return Redirect::back()->withErrors($validation)->withInput();
        }
    }

    public function edit_save($id) {
        $this->id = $id;
        $input = Input::all();
        $validation = Validator::make($input, $this->rules);
        if (!$validation->fails()) {
            DB::transaction(function() use ($input) {
                $this->insertEdit($input);
                $this->insertActions($input);
                $this->insertModules($input);
            });
            return Redirect::to('system/type-user');
        } else {
            return Redirect::back()->withErrors($validation)->withInput();
        }
    }

    private function insertActions($input) {
        $ObjTypeUser = TypeUser::find($this->id);
        $ObjTypeUser->action()->detach();
        if (!empty($input['id_action'])) {
            $ObjTypeUser->action()->sync($input['id_action']);
        }
    }

    private function insertModules($input) {
        $ObjTypeUser = TypeUser::find($this->id);
        $ObjTypeUser->module()->detach();
        if (!empty($input['id_module'])) {
            $ObjTypeUser->module()->sync($input['id_module']);
        }
    }

    private function insertEdit($input) {
        $ObjTypeUser = TypeUser::find($this->id);
        $this->setAttr($ObjTypeUser, $input);
    }

    private function insert($input) {
        $ObjTypeUser = new TypeUser();
        $this->setAttr($ObjTypeUser, $input);
        $this->id = $ObjTypeUser->id;
    }

    public function delete($id) {
        $ObjTypeUser = TypeUser::find($id);
        if ($ObjTypeUser->delete()) {
            return 'ok';
        } else {
            return 'error';
        }
    }

    private function setAttr($ObjTypeUser, $input) {
        $ObjTypeUser->name = $input['name'];
        $ObjTypeUser->description = $input['description'];
        $ObjTypeUser->save();
    }

}
