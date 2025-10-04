<?php

namespace App\middlewares;

use App\core\MiddlewareInterface;
use App\services\FlashMessage;
use App\entity\User;

class RoleMiddleware implements MiddlewareInterface
{
    private array $roles;

    public function __construct(array $roles = [])
    {
        $this->roles = $roles;
    }

    public function handle(): bool
    {
        if (!isset($_SESSION['user']) || !($_SESSION['user'] instanceof User)) {
            header('Location: /login');
            exit();
        }

        /** @var User $user */
        $user = $_SESSION['user'];

        if (!in_array($user->getRole(), $this->roles)) {
            FlashMessage::set("Vous n'avez pas la permission d'accéder à cette page.", 'error');
            http_response_code(403);
            header('Location: /error');
            return false;
        }

        return true;
    }
}
