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
        $result = $this->user->register("John Doe", "john.doe@example.com", "password123");

        // Vérification que le résultat retourné correspond bien à 1 ligne affectée
        $this->assertEquals(1, $result);
    }
}
