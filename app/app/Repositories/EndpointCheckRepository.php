<?php

namespace App\Repositories;

use App\Models\EndpointCheck;

class EndpointCheckRepository
{
    public function create(array $data)
    {
        return EndpointCheck::create($data);
    }

    public function getByEndpoint(int $endpointId)
    {
        return EndpointCheck::where('endpoint_id', $endpointId)
            ->latest('checked_at')
            ->paginate(20);
    }

    public function stats(int $endpointId)
    {
        return EndpointCheck::where('endpoint_id', $endpointId)
            ->selectRaw("
                COUNT(*) as total,
                SUM(CASE WHEN success = true THEN 1 ELSE 0 END) as success_count,
                AVG(response_time_ms) as avg_response_time
            ")
            ->first();
    }
}