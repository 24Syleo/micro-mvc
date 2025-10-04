<?php

namespace App\services;

class FlashMessage
{
    const FLASH_KEY = 'flash_message';

    // Définir un message flash avec un type
    public static function set(string $message, string $type = 'info')
    {
        // Vérification pour ne permettre que 'info' 'danger' ou 'success' comme types
        if (!in_array($type, ['info', 'success', 'danger'])) {
            $type = 'info';  // Valeur par défaut 'success'
        }

        // Enregistrement du message et du type dans la session
        $_SESSION[self::FLASH_KEY] = ['message' => $message, 'type' => $type];
    }

    // Récupérer le message flash et le supprimer de la session
    public static function get()
    {
        if (isset($_SESSION[self::FLASH_KEY])) {
            $flash = $_SESSION[self::FLASH_KEY];
            unset($_SESSION[self::FLASH_KEY]); // Suppression après lecture
            return $flash;
        }
        return null;
    }
}
