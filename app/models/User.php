<?php 

namespace App\Models;

class User{
    private $name ;
    private $email ;
    private $password ;

    public function __construct($name,$email) {
        $this->name = $name ;
        $this->email = $email;
    }

    
    public function register($name , $eamil , $password){
            $requet = "INSERT INTO cars (brand, model, year)
VALUES ('Ford', 'Mustang', 1964);"


    }




}






?>