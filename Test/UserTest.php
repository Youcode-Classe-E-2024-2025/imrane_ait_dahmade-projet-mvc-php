// tests/UserTest.php
<?php
use app\models\User;

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase {
    private $mockDb;
    private $user;

    protected function setUp(): void {
        // Création d'un mock pour la connexion PDO
        $this->mockDb = $this->createMock(PDO::class);
        
        // Création de l'instance User avec le mock de la connexion
        $this->user = new User($this->mockDb);
    }

    public function testRegister() {
        // Configuration du mock pour que la méthode execute() retourne 1 ligne affectée
        $mockStmt = $this->createMock(PDOStatement::class);
        $mockStmt->method('execute')->willReturn(true);
        $mockStmt->method('rowCount')->willReturn(1);
        
        // Configuration du mock de la connexion pour retourner notre mock de la requête
        $this->mockDb->method('prepare')->willReturn($mockStmt);

        // Appel de la méthode register
        $result = $this->user->register("Jo Doe", "jo.doe@example.com", "passwo123");

        // Vérification que le résultat retourné correspond bien à 1 ligne affectée
        $this->assertEquals(1, $result);
    }
    public function TestSelectUser(){
           // Exemple de mock pour simuler une requête de sélection d'un utilisateur
           $mockStmt = $this->createMock(PDOStatement::class);
           $mockStmt->method('fetch')->willReturn([
               'id' => 1,
               'name' => 'John Doe',
               'email' => 'john.doe@example.com',
               'password' => 'hashed_password'
           ]);
   
           // Configuration du mock de la connexion pour retourner le mock de la requête
           $this->mockDb->method('prepare')->willReturn($mockStmt);
   
           // Appel de la méthode selectUser (il faut que cette méthode existe dans la classe User)
           $result = $this->user->selectUser('john.doe@example.com');
   
           // Vérification du résultat retourné
           $this->assertNotEmpty($result);
           $this->assertEquals('John Doe', $result['name']);
       
    }
}
