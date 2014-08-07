<?php

class AlertController extends BaseController {

    private $rules = array(
        'title' => 'Required',
        'id_template' => 'Required'
    );
    private $id;

    public function edit_save($id) {
        $input = Input::all();
        $validation = Validator::make($input, $this->rules);
        if (!$validation->fails()) {
            $this->id = $id;
            $this->insertEdit($input);
            return Redirect::to('system/alert');
        } else {
            return Redirect::back()->withErrors($validation)->withInput();
        }
    }

    private function insertEdit($input) {
        $objTemplate = Alert::find($this->id);
        $objTemplate->title = $input['title'];
        $objTemplate->id_template = $input['id_template'];
        $objTemplate->id_template_ext = (isset($input['is_checked']) && ($input['id_template_ext'] > 0)) ? $input['id_template_ext'] : 0;
        $objTemplate->save();
    }

}
