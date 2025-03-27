<?php

namespace App\Http\Services;

use Exception; // Import Exception class

class UserService
{
    // Declare the repository property
    public UserRepository $repository;

    // Constructor with dependency injection
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new user.
     *
     * @param User $user
     * @return User
     * @throws Exception
     */
    public function create(User $user): User
    {
        // Check if the email already exists
        if ($this->repository->existsByEmail($user->getEmail())) {
            throw new Exception("Email already  deja exists.");
        }

        // Create the user in the repository
        return $this->repository->create($user);
    }
}