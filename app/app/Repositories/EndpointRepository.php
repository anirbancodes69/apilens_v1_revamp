<?php

namespace App\Repositories;

use App\Models\Endpoint;

class EndpointRepository
{
    public function getAllByUser(int $userId)
    {
        return Endpoint::whereHas('project', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->latest()->get();
    }

    public function findByIdForUser(int $id, int $userId)
    {
        return Endpoint::where('id', $id)
            ->whereHas('project', fn($q) => $q->where('user_id', $userId))
            ->firstOrFail();
    }

    public function create(array $data)
    {
        return Endpoint::create($data);
    }

    public function update(Endpoint $endpoint, array $data)
    {
        $endpoint->update($data);
        return $endpoint;
    }

    public function delete(Endpoint $endpoint)
    {
        return $endpoint->delete();
    }
}