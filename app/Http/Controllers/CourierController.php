<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Courier\CourierStoreRequest;
use App\Http\Requests\Courier\CourierUpdateRequest;

use App\Http\Responses\Courier\CourierShowResponse;
use App\Http\Responses\Courier\CourierStoreResponse;
use App\Http\Responses\Courier\CourierUpdateResponse;
use App\Http\Responses\NotFoundResponse;

class CourierController extends Controller
{
    public function store(CourierStoreRequest $request): CourierStoreResponse
    {
        $couriers = collect($request->input('data'))
            ->map(fn($courier) => Courier::create($courier))
            ->all();

        return new CourierStoreResponse($couriers);
    }

    public function show(int $id): CourierShowResponse | NotFoundResponse 
    {
        $courier = Courier::find($id);

        if (!$courier) {
            return new NotFoundResponse();
        }

        return new CourierShowResponse($courier);
    }

    public function update(CourierUpdateRequest $request, int $id): CourierUpdateResponse | NotFoundResponse
    {
        $courier = Courier::find($id);

        if (!$courier) {
            return new NotFoundResponse();
        }

        $validated = $request->validated(); 
        $courier->update($validated); 

        return new CourierUpdateResponse($courier);
    }
}
  