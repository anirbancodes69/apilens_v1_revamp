<?php

namespace App\Services;

use App\Repositories\EndpointCheckRepository;
use App\Repositories\EndpointRepository;

class EndpointCheckService
{
    public function __construct(
        protected EndpointCheckRepository $repo,
        protected EndpointRepository $endpointRepo
    ) {}

    public function logs($user, $endpointId)
    {
        $endpoint = $this->endpointRepo
            ->findByIdForUser($endpointId, $user->id);

        if (!$endpoint) {
            throw new \Exception('Unauthorized');
        }

        return $this->repo->getByEndpoint($endpointId);
    }

    public function stats($user, $endpointId)
    {
        $endpoint = $this->endpointRepo
            ->findByIdForUser($endpointId, $user->id);

        if (!$endpoint) {
            throw new \Exception('Unauthorized');
        }

        $data = $this->repo->stats($endpointId);

        return [
            'uptime_percentage' => $data->total > 0
                ? round(($data->success_count / $data->total) * 100, 2)
                : 0,
            'avg_response_time' => round($data->avg_response_time, 2),
            'total_checks' => $data->total
        ];
    }
}