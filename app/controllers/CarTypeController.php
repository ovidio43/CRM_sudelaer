<?php

class CarTypeController extends BaseController {

    private $id_leads;

    public function save() {
        $input = Input::all();
        $this->id_leads = $input['id_leads'];
        $exception = DB::transaction(function() use ($input) {
                    $this->insert($input);
                });
        return is_null($exception) ? Redirect::to(Leads::find($this->id_leads)->type . '/list') : Redirect::back();
    }

    public function edit_save() {
        $input = Input::all();
        $this->id_leads = $input['id_leads'];
        $exception = DB::transaction(function() use ($input) {
                    $this->insertEdit($input);
                });
        return is_null($exception) ? Redirect::to(Leads::find($this->id_leads)->type . '/list') : Redirect::back();
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

    private function insertEdit($input) {
        $ind = explode(',', trim($input['rows'], ','));
        foreach ($ind as $i) {
            if (!empty($input['make' . $i]) || !empty($input['year' . $i]) || !empty($input['stock' . $i]) || !empty($input['budget' . $i]) || !empty($input['model' . $i])) {
                if (isset($input['id_carType' . $i])) {
                    $ObjCarType = CarType::find($input['id_carType' . $i]);
                } else {
                    $ObjCarType = new CarType();
                }
                $this->setAttr($ObjCarType, $input, $i);
            }
        }
    }

    private function setAttr($ObjCarType, $input, $i) {

        $ObjCarType->make = $input['make' . $i];
        $ObjCarType->year = $input['year' . $i];
        $ObjCarType->stock = $input['stock' . $i];
        $ObjCarType->model = $input['model' . $i];
        $ObjCarType->budget = $input['budget' . $i];
        $ObjCarType->id_leads = $this->id_leads;
        $ObjCarType->save();
    }

}
