<?php 

namespace App\Core;

use phpDocumentor\Reflection\Types\Self_;
class  Auth{

    
    public static function startSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); 
        }
    }
    public static function login($user){
        Self::startSession();
        $_SESSION['id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];
    }
    public static function isAuthentification(){
        return isset($_SESSION['id']);
    }
    public static function getUser(){
        if(self::isAuthentification()){
            return [
                'id' => $_SESSION['id'],
                'name' => $_SESSION['name'],
                'email' => $_SESSION['email']
            ];
        }
        return null ;
    }
    public static function logout(){
        self::startSession();
        session_unset();

        session_destroy();

    }
}

?>