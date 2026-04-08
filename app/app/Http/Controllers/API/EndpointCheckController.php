<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\EndpointCheckResource;
use App\Services\EndpointCheckService;
use Illuminate\Support\Facades\Auth;

class EndpointCheckController extends Controller
{
    public function __construct(
        protected EndpointCheckService $service
    ) {}

    public function logs($endpointId)
    {
        return EndpointCheckResource::collection(
            $this->service->logs(Auth::user(), $endpointId)
        );
    }

    public function stats($endpointId)
    {
        return response()->json(
            $this->service->stats(Auth::user(), $endpointId)
        );
    }

}
