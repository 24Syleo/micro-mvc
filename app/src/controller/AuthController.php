<?php

namespace App\controller;

use App\core\Controller;
use App\services\FlashMessage;
use Exception;

class AuthController extends Controller
{
    public function login(): string
    {
        try {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            return $this->render('auth/login', ['title' => 'Connexion']);
        } catch (Exception $e) {
            FlashMessage::set("Error: " . $e->getMessage(), 'danger');
            return $this->render('error', ['title' => 'Erreur']);
        }
    }
}
