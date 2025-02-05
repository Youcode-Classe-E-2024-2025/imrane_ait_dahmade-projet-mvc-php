<?php

namespace app\core;
use PDO;
use PDOException;

require_once __DIR__ . '/../config/config.php'; 
class Database
{
    private  static ?Database $instance = null;
    private ?PDO $connection = null;

    private function __construct()
    {
        $this->Connection();
    }
    public function Connection()
    {
        $dsn = 'pgsql:host=' . DB_HOST . ';dbname=' . DB_NAME;
        try {
            $this->connection = new PDO($dsn, DB_USER, DB_PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo 'connected';
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }
    public static function Instantante() {
        return self::$instance ?? new self();
    }
}
