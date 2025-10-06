<?php

namespace App\security\validations;

use Exception;

class UserValidator
{
    public static function validateId(int $id): void
    {
        if ($id <= 0) {
            throw new Exception("L'identifiant doit être un entier positif.");
        }
    }

    public static function validateLastname(string $lastname): void
    {
        if (empty($lastname) || strlen($lastname) > 50) {
            throw new Exception("Le nom doit être une chaîne non vide de moins de 50 caractères.");
        }
    }

    public static function validateFirstname(string $firstname): void
    {
        if (empty($firstname) || strlen($firstname) > 50) {
            throw new Exception("Le prénom doit être une chaîne non vide de moins de 50 caractères.");
        }
    }

    public static function validateEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 100) {
            throw new Exception("L'email doit être une adresse valide de moins de 100 caractères.");
        }
    }

    public static function validatePassword(string $password): void
    {
        if (strlen($password) < 8) {
            throw new Exception("Le mot de passe doit contenir au moins 8 caractères.");
        }
    }

    public static function validateRole(string $role): void
    {
        $validRoles = ['user', 'admin'];
        if (!in_array($role, $validRoles)) {
            throw new Exception("Le rôle doit être 'user' ou 'admin'.");
        }
    }

    public static function validateRegister(array $data): array
    {
        try {

            self::validateLastname($data['lastname'] ?? '');
            self::validateFirstname($data['firstname'] ?? '');
            self::validateEmail($data['email'] ?? '');
            self::validatePassword($data['password'] ?? '');
            self::validateRole($data['role'] ?? '');
            return ['success' => true, 'message' => 'Validation  passed'];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => [$e->getMessage()]
            ];
        }
    }
}
