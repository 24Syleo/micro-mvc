<?php

namespace App\controller;

use App\core\Controller;
use App\model\UserModel;
use App\security\validations\UserValidator;
use App\services\FlashMessage;
use Exception;

class AuthController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    /**
     * Summary page login
     * @return string
     */
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

    /**
     * Summary page register create user
     * @return array
     */
    public function create(): array
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $data['role'] = 'user';
            if (!UserValidator::validateRegister($data)['success']) {
                throw new Exception(implode(", ", UserValidator::validateRegister($data)['message']));
            }

            $passwordHash = password_hash($data['password'], PASSWORD_BCRYPT);
            $data['password'] = $passwordHash;

            $user = $this->userModel->save($data);

            return ['success' => true, 'user' => $user];
        } catch (Exception $e) {
            FlashMessage::set("Error: " . $e->getMessage(), 'danger');
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
