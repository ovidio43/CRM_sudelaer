<?php

class FileManagementCsvController extends BaseController {

    private $tableName = 'leads_import_data_from_csv';
    private $nameInput = 'file';
    private $fileName = 'imported-file.csv';
    private $folderName = '/imports/';

    public function upload() {
        if ($this->uploadFile()) {
            $this->readfile();
        } else {
            echo 'error';
        }
    }

    private function readfile() {
        Excel::load(base_path() . $this->folderName . $this->fileName, function($reader) {
            $results = $reader->get();
            $c = 0;
            foreach ($results as $key => $value) {
                echo $key . '->' . $value;
                $c++;
                if ($c == 10) {
                    break;
                }
            }
        });
    }

    private function uploadFile() {
        if ($this->validateFile()) {
            $file = Input::file($this->nameInput);
            $file->move(base_path() . $this->folderName, $this->fileName);
            return true;
        }
        return false;
    }

    private function validateFile() {
        if (Input::hasFile($this->nameInput) && Input::file($this->nameInput)->getClientOriginalExtension() === 'csv') {
            return true;
        }
        return false;
    }

    private function stringInsert($fields = [], $values = []) {
        $queryString = $queryStringfields = $queryStringValues = '';
        foreach ($fields as $field) {
            $queryStringfields.=$field . ',';
        }
        $queryStringfields = '(' . substr($queryStringfields, 0, -1) . ')';
        foreach ($values as $val) {
            $queryStringValues.='(';
            foreach ($val as $v) {
                $queryStringValues.='\'' . $v . '\',';
            }
            $queryStringValues = substr($queryStringValues, 0, -1);
            $queryStringValues.='),';
        }
        $queryStringValues = substr($queryStringValues, 0, -1);
        $queryString .= 'INSERT INTO `' . $this->tableName . '` VALUES ' . $queryStringfields . $queryStringValues;
        return $queryString;
    }

    private function stringCreateTable($field = []) {
        $queryString = 'CREATE TABLE ' . $this->tableName;
        $queryString.='('
                . 'id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,';
        foreach ($field as $val) {
            $queryString.= $val . ' VARCHAR(255) NOT NULL,';
        }
        $queryString = substr($queryString, 0, -1);
        $queryString.=')ENGINE = InnoDB';
        return $queryString;
    }

    private function stringDropTable() {
        $queryString = 'DROP TABLE ' . $this->tableName;
        return $queryString;
    }

}
