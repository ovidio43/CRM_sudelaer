<?php

class CarTypeController extends BaseController {

    private $rules = array(
//        'make' => 'Required',
//        'year' => 'Required',
//        'stock' => 'Required'
//        'budget' => 'Required'
    );

    public function save() {
        $input = Input::all();
        $exception = DB::transaction(function() use ($input) {
                    $this->insert($input);
                });
        return is_null($exception) ? Redirect::to('leads/list') : Redirect::back();
    }

    public function edit_save($id) {
        $input = Input::all();
        $validation = Validator::make($input, $this->rules);
        if (!$validation->fails()) {
            $this->insertEdit($id, $input);
            return 'ok';
        } else {
            return 'error';
        }
    }

    public function delete($id) {
        $ObjCarType = CarType::find($id);
        if ($ObjCarType->delete()) {
            return 'ok';
        } else {
            return 'error';
        }
    }

    private function insert($input) {
        $ind = explode(',', trim($input['rows'], ','));
        foreach ($ind as $i) {
            if (!empty($input['make' . $i]) || !empty($input['year' . $i]) || !empty($input['stock' . $i]) || !empty($input['budget' . $i])) {
                $ObjCarType = new CarType();
                $this->setAttr($ObjCarType, $input, $i);
            }
        }
    }

    private function insertEdit($id, $input) {
        $ObjCarType = CarType::find($id);
        $this->setAttr($ObjCarType, $input);
    }

    private function setAttr($ObjCarType, $input, $i) {

        $ObjCarType->make = $input['make' . $i];
        $ObjCarType->year = $input['year' . $i];
        $ObjCarType->stock = $input['stock' . $i];
        $ObjCarType->budget = $input['budget' . $i];
        $ObjCarType->id_leads = $input['id_leads'];
        $ObjCarType->save();
    }

}
