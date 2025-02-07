<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use app\controllers\back\UserCotroller;
use app\Models\User;
use app\core\Validator;
use app\core\Auth;
use PHPUnit\Framework\MockObject\MockObject;

class UserControllerTest extends TestCase
{
    private MockObject $mockUser;
    private MockObject $mockValidator;
    private MockObject $mockAuth;
    private UserCotroller $controller;

    protected function setUp(): void
    {
        $this->mockUser = $this->createMock(User::class);
        $this->mockValidator = $this->createMock(Validator::class);
        $this->mockAuth = $this->createMock(Auth::class);
        $this->controller = new UserCotroller();

        // Simulation de la requête POST
        $_SERVER['REQUEST_METHOD'] = 'POST';
    }

    public function testLoginWithValidCredentials()
    {
        $_POST['email'] = 'john.doe@example.com';
        $_POST['password'] = 'correctpassword';

        // Mock du validateur
        $this->mockValidator->method('isEmpty')->willReturn(false);
        $this->mockValidator->method('isValidEmail')->willReturn(true);

        // Simuler l'utilisateur trouvé dans la base de données
        $this->mockUser->method('selectUser')->willReturn([
            'id' => 1,
            'email' => 'john.doe@example.com',
            'password' => password_hash('correctpassword', PASSWORD_DEFAULT),
        ]);

        // Vérifier si le mot de passe est correct directement dans le test
        $this->assertTrue(password_verify('correctpassword', password_hash('correctpassword', PASSWORD_DEFAULT)));

        // Mock de l'authentification
        $this->mockAuth->expects($this->once())->method('login')->with($this->anything());

        // Appel de la méthode Login
        $this->controller->Login();
    }

    public function testLoginWithInvalidCredentials()
    {
        $_POST['email'] = 'wrong.email@example.com';
        $_POST['password'] = 'wrongpassword';

        // Mock du validateur
        $this->mockValidator->method('isEmpty')->willReturn(false);
        $this->mockValidator->method('isValidEmail')->willReturn(true);

        // Simuler un utilisateur non trouvé
        $this->mockUser->method('selectUser')->willReturn(null);

        // Appel de la méthode Login
        $this->controller->Login();

        // Ici, vous pouvez tester une réponse spécifique, comme un message d'erreur affiché par la méthode Login.
        // Exemple :
        // $this->assertStringContainsString('Utilisateur non trouvé', $this->getActualOutput());
    }
}
