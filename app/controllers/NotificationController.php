<?php

class NotificationController extends BaseController {

    private $rules = array(
        'subject' => 'Required',
        'message' => 'Required'
    );

    public function save() {
        $input = Input::all();
        $validation = Validator::make($input, $this->rules);
        if (!$validation->fails()) {
            $ObjNotification = new Notification();
            $ObjNotification->subject = $input['subject'];
            $ObjNotification->message = $input['message'];
            $ObjNotification->date_entered = date('Y-m-d H:i:s');
            $ObjNotification->id_user_source = Auth::user()->id;
            $ObjNotification->id_user_destination = $input['id_user_destination'];
            $ObjNotification->id_leads = $input['id_leads'];
            $ObjNotification->save();
            return 'ok';
        } else {
            $errors = $validation->errors();
            $response = '<div class = "alert alert-danger" >' .
                    '<ul>';
            foreach ($errors->all() as $error) {
                $response.= '<li> ' . $error . '</li>';
            }
            $response.= '</ul>' .
                    '</div>';
            return $response;
        }
    }

    public function sendTrash() {
        $input = Input::all();

        DB::transaction(function() use ($input) {
            foreach ($input['id_notification'] as $notId) {
                $objNotification = Notification::find($notId);
                $objNotification->status = '0';
                $objNotification->save();
            }
        });
        return Redirect::to('/dashboard');
    }

}
