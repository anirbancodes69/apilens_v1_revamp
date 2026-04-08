<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EndpointCheckResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status' => $this->success,
            'status_code' => $this->status_code,
            'response_time' => $this->response_time_ms,
            'checked_at' => $this->checked_at,
            'error' => $this->error_message
        ];
    }
}
