<?php

namespace App\controller;

use App\core\Controller;
use App\services\FlashMessage;
use Exception;

class ErrorController extends Controller
{
    public function index(): string
    {
        try {
            return $this->render('error', ['title' => 'Erreur']);
        } catch (Exception $e) {
            FlashMessage::set("Error : " . $e->getMessage(), 'danger');
            return $this->render('error', ['title' => 'Erreur']);
        }
    }
}
