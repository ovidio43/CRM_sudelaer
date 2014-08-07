<?php

class templatesController extends BaseController {

    private $rules = array(
        'name' => 'Required'
    );
    private $id;

    public function save() {
        $input = Input::all();
        $validation = Validator::make($input, $this->rules);
        if (!$validation->fails()) {
            $this->insert($input);
            return Redirect::to('system/alert#content-template');
        } else {
            return Redirect::back()->withErrors($validation)->withInput();
        }
    }

    public function edit_save($id) {
        $input = Input::all();
        $validation = Validator::make($input, $this->rules);
        if (!$validation->fails()) {
            $this->id = $id;
            $this->insertEdit($input);
            return Redirect::to('system/alert#content-template');
        } else {
            return Redirect::back()->withErrors($validation)->withInput();
        }
    }

    private function insert($input) {
        $objTemplate = new Templates();
        $objTemplate->name = $input['name'];
        $objTemplate->content = $input['content'];
        $objTemplate->save();
    }

    private function insertEdit($input) {
        $objTemplate = Templates::find($this->id);
        $objTemplate->name = $input['name'];
        $objTemplate->content = $input['content'];
        $objTemplate->save();
    }

}
