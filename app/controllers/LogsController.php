<?php

class LogsController extends BaseController {

    private $rules = array(
        'id_logs' => 'Required',
        'description' => 'Required'
    );

    public function EdnVisit() {
        $input = Input::all();
        $validation = Validator::make($input, $this->rules);
        if (!$validation->fails()) {
            $this->updateStatus($input);
            return 'ok';
        } else {
            return 'Required Fields';
        }
    }

    private function updateStatus($input) {
        $objLogs = Logs::find($input['id_logs']);
        $objLogs->status = 0;
        $objLogs->description = $input['description'];
        $objLogs->save();
    }

}
