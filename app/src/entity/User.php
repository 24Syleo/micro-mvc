<?php

namespace App\entity;

use App\security\validations\UserValidator;

class User extends BaseEntity
{
    private int $id;
    private string $lastname;
    private string $firstname;
    private string $email;
    private string $password;
    private string $role;
    private string $created_at;

    // --- Getters / Setters ---

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        UserValidator::validateId($id);
        $this->id = $id;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
        UserValidator::validateLastname($lastname);
        $this->lastname = $lastname;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): void
    {
        UserValidator::validateFirstname($firstname);
        $this->firstname = $firstname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        UserValidator::validateEmail($email);
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Définit le mot de passe (peut être déjà hashé)
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        UserValidator::validateRole($role);
        $this->role = $role;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * Conversion de l'objet en tableau
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'lastname' => $this->getLastname(),
            'firstname' => $this->getFirstname(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'role' => $this->getRole(),
            'created_at' => $this->getCreatedAt(),
        ];
    }
}
