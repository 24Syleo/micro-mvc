<?php

namespace App\entity;

use App\Services\Hydrator;

class BaseEntity
{
    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            Hydrator::hydrate($this, $data);
        }
    }
}
