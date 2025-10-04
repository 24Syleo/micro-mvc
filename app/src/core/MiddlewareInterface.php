<?php

namespace App\core;

interface MiddlewareInterface
{
    /**
     * Retourne true si la requête est autorisée, false sinon
     */
    public function handle(): bool;
}
