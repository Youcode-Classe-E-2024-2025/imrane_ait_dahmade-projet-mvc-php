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
        // Mock du modèle User
        $this->mockUser = $this->createMock(User::class);

        // Mock du validateur
        $this->mockValidator = $this->createMock(Validator::class);

        // Mock de la classe Auth
        $this->mockAuth = $this->createMock(Auth::class);

        // Instanciation du contrôleur avec les mocks
        $this->controller = new UserCotroller();

        // On injecte nos mocks dans le contrôleur si nécessaire.
        // Si tes classes sont instanciées à l'intérieur du contrôleur, il faudra peut-être
        // passer ces dépendances via un constructeur ou un setter.
    }

    public function testLoginWithValidCredentials()
    {
        // Données d'entrée pour le test
        $_POST['email'] = 'john.doe@example.com';
        $_POST['password'] = 'correctpassword';

        // Mocker la méthode isEmpty pour le validateur
        $this->mockValidator->method('isEmpty')->willReturn(false);

        // Mocker la méthode isValidEmail pour vérifier que l'email est valide
        $this->mockValidator->method('isValidEmail')->willReturn(true);

        // Mocker la méthode selectUser du modèle User
        $this->mockUser->method('selectUser')->willReturn([
            'id' => 1,
            'email' => 'john.doe@example.com',
            'password' => password_hash('correctpassword', PASSWORD_DEFAULT),
        ]);

        // Mocker la méthode password_verify
        $this->mockUser->method('password_verify')->willReturn(true);

        // Mocker la méthode Auth::login
        $this->mockAuth->expects($this->once())->method('login')->with($this->anything());

        // Appel de la méthode Login du contrôleur
        $this->controller->Login();

        // Aucun output n'est attendu ici, mais tu pourrais tester si la méthode Auth::login a été appelée
    }

    public function testLoginWithInvalidCredentials()
    {
        // Données d'entrée pour le test
        $_POST['email'] = 'wrong.email@example.com';
        $_POST['password'] = 'wrongpassword';

        // Mocker la méthode isEmpty pour le validateur
        $this->mockValidator->method('isEmpty')->willReturn(false);

        // Mocker la méthode isValidEmail pour vérifier que l'email est valide
        $this->mockValidator->method('isValidEmail')->willReturn(true);

        // Mocker la méthode selectUser du modèle User pour simuler un utilisateur non trouvé
        $this->mockUser->method('selectUser')->willReturn(null);

        // Appel de la méthode Login du contrôleur
        $this->controller->Login();

        // Ici, tu peux tester que la réponse ou l'action est correcte, comme un message d'erreur.
        // Par exemple, on pourrait vérifier que le message 'non trouve' est affiché.
        // Cette partie nécessite un peu de réflexion sur la manière dont tu gères les erreurs.
    }
}
