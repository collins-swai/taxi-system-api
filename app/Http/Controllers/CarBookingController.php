<?php

namespace App\Http\Controllers;

use App\Models\Booking; // Ensure you import the Booking model
use App\Models\Car; // Ensure you import the Car model
use Illuminate\Http\Request;

class CarBookingController extends Controller
{
    // Create a booking
    public function create(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'user_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $booking = Booking::create($request->all());

        return response()->json($booking, 201);
    }

    // Get all bookings
    public function index()
    {
        $bookings = Booking::with(['car', 'user'])->get();
        return response()->json($bookings);
    }

    // Get booking by ID
    public function show($id)
    {
        $booking = Booking::with(['car', 'user'])->findOrFail($id);
        return response()->json($booking);
    }

    // Update booking
    public function update(Request $request, $id)
    {
        $request->validate([
            'car_id' => 'sometimes|exists:cars,id',
            'user_id' => 'sometimes|exists:users,id',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after:start_date',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update($request->all());

        return response()->json($booking);
    }

    // Delete booking
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return response()->json(null, 204);
    }
}