<?php

use App\services\Config;
use App\services\Database;

require_once './vendor/autoload.php';


Config::getEnv();


try {
    $pdo = Database::connect();
    $sql = file_get_contents(__DIR__ . '/schema.sql');
    $pdo->exec($sql);
    echo "✅ Base de données créée avec succès !\n";
} catch (Exception $e) {
    echo "❌ Erreur : " . $e->getMessage();
}
