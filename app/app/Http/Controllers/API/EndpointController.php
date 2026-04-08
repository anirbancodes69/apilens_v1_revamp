<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEndpointRequest;
use App\Http\Requests\UpdateEndpointRequest;
use App\Http\Resources\EndpointResource;
use App\Services\EndpointService;
use Illuminate\Support\Facades\Auth;

class EndpointController extends Controller
{
    public function __construct(
        protected EndpointService $service
    ) {}

    public function index()
    {
        return EndpointResource::collection(
            $this->service->list(Auth::user())
        );
    }

    public function store(StoreEndpointRequest $request)
    {
        $endpoint = $this->service->create(
            Auth::user(),
            $request->validated()
        );

        return new EndpointResource($endpoint);
    }

    public function update(UpdateEndpointRequest $request, $id)
    {
        $endpoint = $this->service->update(
            Auth::user(),
            $id,
            $request->validated()
        );

        return new EndpointResource($endpoint);
    }

    public function destroy($id)
    {
        $this->service->delete(Auth::user(), $id);

        return response()->json(['message' => 'Deleted']);
    }
}
