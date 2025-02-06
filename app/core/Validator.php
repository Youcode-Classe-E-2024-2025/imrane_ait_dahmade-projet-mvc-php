<?php

namespace app\core;
use phpDocumentor\Reflection\Types\False_;

class Validator{

    public function isEmpty($value){
        return empty($value);
    }

    public function isValidEmail($email){
        return filter_input($email,FILTER_VALIDATE_EMAIL) !== False;
    }

}

?>