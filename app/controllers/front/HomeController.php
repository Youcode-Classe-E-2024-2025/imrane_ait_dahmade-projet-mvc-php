<?php

namespace app\controllers\front;

use app\core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $user = isset($_SESSION['user']) ? $_SESSION['user'] : null; // Vérifie si l'utilisateur est connecté

        $this->view('home');
        
    }
}

?>
