<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CarController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', except: ['index', 'show'])
        ];
    }

    /**
     * Display a listing of the resource.
     * GET /api/cars
     */
    public function index()
    {
        return response()->json(Car::all());
    }

    /**
     * Store a newly created resource in storage.
     * POST /api/cars
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'external_id'     => 'required|unique:cars,external_id',
            'type'            => 'nullable|string',
            'brand'           => 'nullable|string',
            'model'           => 'nullable|string',
            'version'         => 'nullable|string',
            'year_model'      => 'nullable|string',
            'year_build'      => 'nullable|string',
            'optionals'       => 'nullable|array',
            'doors'           => 'nullable|integer',
            'board'           => 'nullable|string',
            'chassi'          => 'nullable|string',
            'transmission'    => 'nullable|string',
            'km'              => 'nullable|integer',
            'description'     => 'nullable|string',
            'created_at_api'  => 'nullable|date',
            'updated_at_api'  => 'nullable|date',
            'sold'            => 'nullable|boolean',
            'category'        => 'nullable|string',
            'url_car'         => 'nullable|string',
            'old_price'       => 'nullable|numeric',
            'price'           => 'nullable|numeric',
            'color'           => 'nullable|string',
            'fuel'            => 'nullable|string',
            'fotos'           => 'nullable|array',
        ]);

        $car = Car::create($data);

        return response()->json($car, 201);
    }

    /**
     * Display the specified resource.
     * GET /api/cars/{id}
     */
    public function show(Car $car)
    {
        return response()->json($car);
    }

    /**
     * Update the specified resource in storage.
     * PUT/PATCH /api/cars/{id}
     */
    public function update(Request $request, Car $car)
    {
        $data = $request->validate([
            'type'            => 'nullable|string',
            'brand'           => 'nullable|string',
            'model'           => 'nullable|string',
            'version'         => 'nullable|string',
            'year_model'      => 'nullable|string',
            'year_build'      => 'nullable|string',
            'optionals'       => 'nullable|array',
            'doors'           => 'nullable|integer',
            'board'           => 'nullable|string',
            'chassi'          => 'nullable|string',
            'transmission'    => 'nullable|string',
            'km'              => 'nullable|integer',
            'description'     => 'nullable|string',
            'created_at_api'  => 'nullable|date',
            'updated_at_api'  => 'nullable|date',
            'sold'            => 'nullable|boolean',
            'category'        => 'nullable|string',
            'url_car'         => 'nullable|string',
            'old_price'       => 'nullable|numeric',
            'price'           => 'nullable|numeric',
            'color'           => 'nullable|string',
            'fuel'            => 'nullable|string',
            'fotos'           => 'nullable|array',
        ]);

        $car->update($data);

        return response()->json($car);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /api/cars/{id}
     */
    public function destroy(Car $car)
    {
        $car->delete();

        return response()->json(null, 204);
    }
}
