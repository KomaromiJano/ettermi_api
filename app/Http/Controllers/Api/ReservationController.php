<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Reservation;
use App\Models\Restaurant;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::with('restaurant')->get();
        return response()->json($reservations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'reservation_date' => 'required|date|after:now',
            'guest_count' => 'required|integer|min:1',
        ]);

        $restaurant = Restaurant::findOrFail($validatedData['restaurant_id']);

        $existingReservations = $restaurant->reservations()
            ->where('reservation_date', $validatedData['reservation_date'])
            ->sum('guest_count');

        if ($existingReservations + $validatedData['guest_count'] > $restaurant->capacity) {
            return response()->json(['error' => 'Not enough capacity for this reservation'], 400);
        }

        $reservation = Reservation::create($validatedData);
        return response()->json($reservation, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reservation = Reservation::with('restaurant')->findOrFail($id);
        return response()->json($reservation);
    }

    public function restaurantReservations($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $reservations = $restaurant->reservations;
        return response()->json($reservations);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reservation = Reservation::findOrFail($id);

        $validatedData = $request->validate([
            'restaurant_id' => 'sometimes|required|exists:restaurants,id',
            'customer_name' => 'sometimes|required|string|max:255',
            'customer_email' => 'sometimes|required|email',
            'reservation_date' => 'sometimes|required|date|after:now',
            'guest_count' => 'sometimes|required|integer|min:1',
        ]);

        if (isset($validatedData['restaurant_id']) || isset($validatedData['reservation_date']) || isset($validatedData['guest_count'])) {
            $restaurant = Restaurant::findOrFail($validatedData['restaurant_id'] ?? $reservation->restaurant_id);

            $reservationDate = $validatedData['reservation_date'] ?? $reservation->reservation_date;
            $guestCount = $validatedData['guest_count'] ?? $reservation->guest_count;

            $existingReservations = $restaurant->reservations()
                ->where('reservation_date', $reservationDate)
                ->where('id', '!=', $reservation->id)
                ->sum('guest_count');

            if ($existingReservations + $guestCount > $restaurant->capacity) {
                return response()->json(['error' => 'Not enough capacity for this reservation update'], 400);
            }
        }

        $reservation->update($validatedData);

        return response()->json($reservation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return response()->json(null, 204);
    }
}
