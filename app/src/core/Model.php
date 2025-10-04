<?php

namespace App\core;

use App\services\Database;

class Model
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }
}
