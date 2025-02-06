<?php

namespace app\core;

use PDO;
use PDOException;

require_once __DIR__ . '/../config/config.php'; 

class Database
{
    // Instance unique pour le Singleton
    private static ?Database $instance = null;

    // Connexion PDO
    private ?PDO $connection = null;

    // Constructeur privé pour empêcher l'instanciation directe
    private function __construct()
    {
        $this->connect();
    }

    // Connexion à la base de données
    private function connect()
    {
        $dsn = 'pgsql:host=' . DB_HOST . ';dbname=' . DB_NAME;
        
        try {
            // Tentative de connexion
            $this->connection = new PDO($dsn, DB_USER, DB_PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Enlever echo en production
            // echo 'connected'; // À remplacer par un log en production
        } catch (PDOException $e) {
            // Arrêter l'exécution si la connexion échoue et afficher une erreur
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    // Accès à l'instance unique de la classe (Singleton)
    public static function instance(): Database
    {
        // Créer une nouvelle instance si elle n'existe pas
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    // Retourner la connexion PDO
    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
