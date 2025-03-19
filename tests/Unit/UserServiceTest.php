<?php

namespace Tests\Unit;

use App\Http\Services\User;
use App\Http\Services\UserRepository;
use App\Http\Services\UserService;
use PHPUnit\Framework\TestCase;
use Exception; // Import the Exception class

class UserServiceTest extends TestCase
{
    /**
     * Test successful user creation.
     *
     * @return void
     */
    public function testSuccessCreate()
    {
        // Create a mock of the UserRepository
        $mockRepository = $this->createMock(UserRepository::class);

        // Mock the existsByEmail method to return false (email does not exist)
        $mockRepository->method('existsByEmail')
            ->with('john@example.com') // Specify the expected parameter
            ->willReturn(false);

        // Create a User object
        $user = new User('john@example.com', 'password123');

        // Mock the create method to return the user
        $mockRepository->method('create')
            ->with($user) // Ensure the correct user is passed
            ->willReturn($user);

        // Create an instance of UserService with the mocked repository
        $service = new UserService($mockRepository);

        // Call the create method
        $newUser = $service->create($user);

        // Assert that the returned user matches the expected user
        $this->assertEquals($user->getEmail(), $newUser->getEmail());
        $this->assertEquals($user->getPassword(), $newUser->getPassword());
    }

    /**
     * Test that creating a user with an existing email throws an exception.
     *
     * @return void
     */
    public function testCreateUserWithExistingEmailThrowsException()
    {
        // Create a mock of the UserRepository
        $mockRepository = $this->createMock(UserRepository::class);

        // Mock the existsByEmail method to return true (email already exists)
        $mockRepository->method('existsByEmail')
            ->with('john@example.com') // Specify the expected parameter
            ->willReturn(true);

        // Create a User object
        $user = new User('john@example.com', 'password123');

        // Create an instance of UserService with the mocked repository
        $service = new UserService($mockRepository);

        // Expect an exception to be thrown
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Email already exists.');

        // Call the create method (should throw an exception)
        $service->create($user);
    }
}