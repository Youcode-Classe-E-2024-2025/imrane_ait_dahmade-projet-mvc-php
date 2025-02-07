<?php

namespace App\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View
{
    public $twig;

    public function __construct()
    {
        // Définir le chemin vers le dossier contenant les fichiers Twig
        $loader = new FilesystemLoader(__DIR__ . '/../views/');
        $this->twig = new Environment($loader);
    }

    /**
     * Rendre une vue Twig.
     * 
     * @param string $view Nom du fichier Twig (par exemple : 'front/home.twig')
     * @param array $data Données à transmettre à la vue
     */
    public function render(string $view, $data = [])
    {
        echo $this->twig->render($view, $data);
    }
}
