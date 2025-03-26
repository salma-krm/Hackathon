<?php

namespace Tests\Unit;

use App\Http\Services\User; // Importer la classe User
use App\Http\Services\UserRepository; // Importer la classe UserRepository
use App\Http\Services\UserService; // Importer la classe UserService
use PHPUnit\Framework\TestCase; // Importer la classe de base TestCase de PHPUnit
use Exception; // Importer la classe Exception pour gérer les erreurs

class UserServiceTest extends TestCase
{
    /**
     * Tester la création réussie d'un utilisateur.
     *
     * Ce test simule la création réussie d'un nouvel utilisateur.
     * Il s'assure que le service utilisateur crée correctement un utilisateur si
     * l'utilisateur n'existe pas déjà dans le référentiel.
     *
     * @return void
     */
    public function testSuccessCreate()
    {
        // Créer un mock pour la classe UserRepository

        
        $mockRepository = $this->createMock(UserRepository::class);
        // Définir le comportement de la méthode 'existsByEmail' du mock.
        // Cela simule la vérification si un utilisateur avec l'email donné existe déjà.
        // Dans ce cas, cela retourne false (ce qui signifie que l'email n'existe pas).
        $mockRepository->method('existsByEmail')
            ->with('john@example.com') // Vérifier pour l'email spécifique 'john@example.com'
            ->willReturn(false); // Simuler que cet email n'existe pas dans le référentiel.

        // Créer un nouvel objet User avec l'email et le mot de passe.
        $user = new User('john@example.com', 'password123');

        // Définir le comportement de la méthode 'create' du mock.
        // Lorsque 'create' est appelé avec l'objet $user, retourner l'objet $user lui-même.
        $mockRepository->method('create')
            ->with($user) // Vérifier que le bon utilisateur est passé à la méthode create.
            ->willReturn($user); // Simuler la création de l'utilisateur et retourner l'utilisateur créé.

        // Créer une instance de UserService, en passant le mock du repository.
        $service = new UserService($mockRepository);

        // Appeler la méthode 'create' sur le service pour simuler le processus de création de l'utilisateur.
        $newUser = $service->create($user);

        // Vérifier que l'email du nouvel utilisateur est le même que celui de l'utilisateur original.
        $this->assertEquals($user->getEmail(), $newUser->getEmail());

        // Vérifier que le mot de passe du nouvel utilisateur est le même que celui de l'utilisateur original.
        $this->assertEquals($user->getPassword(), $newUser->getPassword());
    }

    /**
     * Tester qu'un utilisateur avec un email existant lance une exception.
     *
     * Ce test s'assure que si un utilisateur avec le même email existe déjà,
     * une exception est lancée, empêchant la création d'un utilisateur en doublon.
     *
     * @return void
     */
    public function testCreateUserWithExistingEmailThrowsException()
    {
        // Créer un mock pour la classe UserRepository
        $mockRepository = $this->createMock(UserRepository::class);

        // Définir le comportement de la méthode 'existsByEmail' du mock.
        // Cette fois, cela retourne true, ce qui signifie que l'email existe déjà dans le référentiel.
        $mockRepository->method('existsByEmail')
            ->with('john@example.com') // Vérifier pour l'email spécifique 'john@example.com'
            ->willReturn(true); // Simuler que cet email existe déjà.

        // Créer un nouvel objet User avec l'email et le mot de passe.
        $user = new User('john@example.com', 'password123');

        // Créer une instance de UserService, en passant le mock du repository.
        $service = new UserService($mockRepository);

        // S'attendre à ce qu'une exception soit lancée lors de l'appel de la méthode create.
        $this->expectException(Exception::class); // S'attendre à ce qu'une Exception soit lancée.
        $this->expectExceptionMessage('Email already exists.'); // S'attendre à ce que l'exception ait ce message précis.

        // Appeler la méthode 'create' sur le service, ce qui devrait lancer une exception
        // car l'email existe déjà.
        $service->create($user);
    }
}
