<?php

namespace App\Jobs;

use App\Models\Endpoint;
use App\Repositories\EndpointCheckRepository;
use App\Services\EndpointMonitorService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class CheckEndpointJob implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Endpoint $endpoint)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(EndpointMonitorService $service,
        EndpointCheckRepository $repo): void
    {
        $result = $service->check($this->endpoint);

        DB::transaction(function () use ($result, $repo) {

            $repo->create([
                'endpoint_id' => $this->endpoint->id,
                ...$result,
                'checked_at' => now()
            ]);

            $this->endpoint->update([
                'last_checked_at' => now(),
                'last_status' => $result['success'],
                'last_response_time' => $result['response_time_ms']
            ]);
        });
    }
}
