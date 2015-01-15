<?php

class AlertTypeUserController extends BaseController {

    public function save() {
        $input = Input::all();
        DB::transaction(function() use ($input) {
            $this->insert($input);
        });
        return Redirect::to('system/alert');
    }

    private function insert($input) {
        foreach (Alert::all() as $a) {
            $a->typeUser()->detach();
        }
//        TypeUser::all()->alert->detach();
        if (isset($input['id_alert_type_user'])) {
            foreach ($input['id_alert_type_user'] as $r) {
                $ids = explode('|', $r);
                $id_alert = $ids[0];
                $id_type_user = $ids[1];
                $objAlert = Alert::find($id_alert);
                $objAlert->typeUser()->attach($id_type_user);
            }
        }
    }

}
