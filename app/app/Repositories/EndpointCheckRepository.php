<?php

namespace App\Repositories;

use App\Models\EndpointCheck;

class EndpointCheckRepository
{
    public function create(array $data)
    {
        return EndpointCheck::create($data);
    }
}