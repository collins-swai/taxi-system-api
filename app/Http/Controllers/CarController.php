<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Events\CarAdded;
use App\Events\CarUpdated;
use App\Events\CarDeleted;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $cars = Car::all();
        return response()->json(['data' => $cars], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'car_name' => 'required|string',
            'color' => 'required|string', // Validate color here
            'model' => 'required|string',
            'price' => 'required|numeric',
            'availability_status' => 'required|boolean',
            'vin' => 'required|string|unique:cars,vin', // Add vin validation here
        ]);

        $car = Car::create($validatedData);
        event(new CarAdded($car)); // Trigger CarAdded event

        return response()->json(['data' => $car], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $car = Car::findOrFail($id);
        return response()->json(['data' => $car], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $car = Car::findOrFail($id);

        $validatedData = $request->validate([
            'car_name' => 'sometimes|required|string',
            'color' => 'sometimes|required|string', // Validate color here
            'model' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric',
            'availability_status' => 'sometimes|required|boolean',
            'vin' => 'sometimes|required|string|unique:cars,vin,' . $id, // Allow current car's vin
        ]);

        if (empty($validatedData)) {
            return response()->json(['error' => 'No data provided to update'], 400);
        }

        $car->update($validatedData);
        event(new CarUpdated($car)); // Trigger CarUpdated event

        return response()->json(['data' => $car], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $car = Car::findOrFail($id);
        $car->delete();

        event(new CarDeleted($car->id)); // Trigger CarDeleted event

        return response()->json(['message' => 'Car deleted successfully'], 204);
    }
}
