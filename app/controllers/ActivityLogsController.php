<?php

class ActivityLogsController extends BaseController {

    private $rules = array(
        'id_activity' => 'Required',
        'id_logs' => 'Required',     
        'date_entered' => 'Required',
//        'time_start' => 'Required',
//        'time_end' => 'Required'
    );

    public function save() {
        $input = Input::all();
        $validation = Validator::make($input, $this->rules);
        if (!$validation->fails()) {
            $this->insert($input);
            return 'ok';
        } else {
            return 'Activity and date is required!!!';
        }
    }

    private function insert($input) {
        $objLogs = Logs::find($input['id_logs']);
        $args = [
            'date_entered' => $input['date_entered'],
            'time_start' => $input['time_start'],
            'time_end' => $input['time_end'],
            'description' => $input['description']
        ];
        $objLogs->activities()->attach($input['id_activity'], $args);
    }

}
