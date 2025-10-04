<?php

namespace App\middlewares;

use App\core\MiddlewareInterface;
use App\services\FlashMessage;

class CsrfMiddleware implements MiddlewareInterface
{
    public function handle(): bool
    {
        if (in_array($_SERVER['REQUEST_METHOD'], ['POST', 'PUT', 'DELETE'])) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $token = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? null;

            if (!$token || !isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $token)) {
                FlashMessage::set('Erreur : Requête CSRF invalide ou manquante', 'error');
                http_response_code(403);
                echo json_encode([
                    'success' => false,
                    'message' => 'Requête CSRF invalide ou manquante',
                ]);
                return false;
            }
        }
        return true;
    }
}
