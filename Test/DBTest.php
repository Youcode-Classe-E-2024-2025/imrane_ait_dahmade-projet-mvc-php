<?php

use PHPUnit\Framework\TestCase;
use app\core\Database;

class DBTest extends TestCase
{
    public function testConnection()
    {
        // Utilise la méthode instance() pour obtenir l'instance de la classe Database
        $db = Database::instance();

        // Vérifie que l'objet Database n'est pas null
        $this->assertNotNull($db);
    }
}
