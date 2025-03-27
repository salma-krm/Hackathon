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

        $mockRepository = $this->createMock(UserRepository::class);

 
        $mockRepository->method('existsByEmail')
            ->with('john@example.com') 
            ->willReturn(false);

        $user = new User('john@example.com', 'password123');

 
        $mockRepository->method('create')
            ->with($user)
            ->willReturn($user);

      
        $service = new UserService($mockRepository);

        $newUser = $service->create($user);

       
        $this->assertEquals($user->getEmail(), $newUser->getEmail());
        $this->assertEquals($user->getPassword(), $newUser->getPassword());
    }

   
    public function testCreateUserWithExistingEmailThrowsException()
    {
        
  
        $mockRepository = $this->createMock(UserRepository::class);

       
        $mockRepository->method('existsByEmail')
            ->with('john@example.com')
            ->willReturn(true);


        $user = new User('john@example.com', 'password123');

  
        $service = new UserService($mockRepository);
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Email already exists.');
        $service->create($user);
    }
}
