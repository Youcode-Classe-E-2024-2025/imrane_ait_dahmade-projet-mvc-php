<?php

namespace App\Core;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Controller {
    protected $twig;

    // Correct the constructor name to __construct
    public function __construct() {
        $loader = new FilesystemLoader(__DIR__ . '/../Views/Front');
        $this->twig = new Environment($loader);
    }

    public function view(string $view, array $data = [])
    {
        echo $this->twig->render($view . '.twig', $data); 
    }

    public function redirect(string $url)
    {
        header('Location: ' . $url);
        exit;
    }
}

?>


?>
