<?php

namespace App\Http\Services;

class User
{
    // Declare properties with visibility and type
    private string $email;
    private string $password;

    // Constructor with type declarations
    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    // Optional: Add getters and setters for better encapsulation
    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}