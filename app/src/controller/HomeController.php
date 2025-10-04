<?php

namespace App\controller;

use App\core\Controller;
use App\services\FlashMessage;
use Exception;

class HomeController extends Controller
{
    public function index(): string
    {
        try {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            return $this->render('home/home', ['title' => 'Accueil']);
        } catch (Exception $e) {
            FlashMessage::set("Error: " . $e->getMessage(), 'danger');
            return $this->render('error', ['title' => 'Erreur']);
        }
    }
}
