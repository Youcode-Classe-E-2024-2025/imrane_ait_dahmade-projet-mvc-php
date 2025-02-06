<?php

namespace App\Models;

use app\core\Database;
use PDO;

class User
{
    private $name;
    private $email;
    private $password;

    private  $conn;


    public function __construct()
    {
        $this->conn = Database::instance()->getConnection();
    }
    public  function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function register($name, $email, $password)
    {

        $password = $this->hashPassword($password);
        $requet = "INSERT INTO \"User\" (name, email, password)
VALUES (:name, :email, :password);";
        $stmt =  $this->conn->prepare($requet);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $password
        ]);
        return $stmt->rowCount();
    }

    public function selectUser(string $email)
    {
        // Prépare la requête
        $query = "SELECT * FROM \"User\" WHERE email  = :email";
        $stmt = $this->conn->prepare($query);
    
        // Exécute la requête avec le paramètre email
        $stmt->execute([':email' => $email]);
    
        // Récupère l'utilisateur si trouvé
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}
