<?php

namespace App\services;

class Hydrator
{
    /**
     * Hydrate dynamiquement un objet avec les données d'un tableau
     */
    public static function hydrate(object $entity, array $data): void
    {
        foreach ($data as $key => $value) {
            $method = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
            if (method_exists($entity, $method)) {
                $entity->$method($value);
            }
        }
    }
}
