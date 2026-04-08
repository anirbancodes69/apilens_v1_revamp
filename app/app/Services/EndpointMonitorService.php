<?php

namespace App\Services;

use App\Models\Endpoint;
use Illuminate\Support\Facades\Http;

class EndpointMonitorService
{
    public function check(Endpoint $endpoint): array
    {
        $start = microtime(true);

        try {
            $response = Http::timeout($endpoint->timeout_ms / 1000)
                ->withHeaders($endpoint->headers ?? [])
                ->send($endpoint->method, $endpoint->url, [
                    'json' => $endpoint->body ?? []
                ]);

            $time = (microtime(true) - $start) * 1000;

            return [
                'status_code' => $response->status(),
                'response_time_ms' => (int)$time,
                'success' => $response->status() === $endpoint->expected_status,
                'error_message' => null
            ];
        } catch (\Throwable $e) {
            return [
                'status_code' => null,
                'response_time_ms' => null,
                'success' => false,
                'error_message' => $e->getMessage()
            ];
        }
    }
}