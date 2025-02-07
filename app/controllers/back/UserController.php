<?php

namespace app\Controllers\Back;

use app\Core\Auth as CoreAuth;
use app\core\Controller;
use app\core\Validator;
use App\Models\User;
use app\core\Auth;

class UserController extends Controller

{

  public function index(){
    $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
    if($user){
     echo "vous etes connecter";
    }else{
      echo "vous n'etes pas connecter";
    }
  }

public function Login()
  {
   
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = $_POST['email'];
      $password = $_POST['password'];

      $valid = new Validator();
      if ($valid->isEmpty($email) || $valid->isEmpty($password)) {
        echo "error ";
        return;
      }
      if (!$valid->isValidEmail($email)) {
        echo "error";
        return;
      }
      $userClass = new  User;
      $user = $userClass->selectUser($email);

      if (!$user) {
        echo "non trouve ";
        return;
      }
      echo "trouve";

      if (password_verify($password, $user['password'])) {
        Auth::login($user);
      }
    }
  }


  
}
