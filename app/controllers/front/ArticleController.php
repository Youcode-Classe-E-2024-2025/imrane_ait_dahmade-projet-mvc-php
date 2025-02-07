

<?php

namespace App\Controllers\Front;

use App\Core\Controller;
class ArticleController extends Controller
{
    public function index()
    {
        $user = isset($_SESSION['user']) ? $_SESSION['user'] : null; // Vérifie si l'utilisateur est connecté

        $this->view('article');
        
    }

    public function show($id)
    {
        $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;


        $this->view('article', ['id' => $id]);
    }

}