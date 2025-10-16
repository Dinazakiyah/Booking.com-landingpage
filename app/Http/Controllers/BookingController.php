<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Property;
use Illuminate\Http\Request;

class BookingController 
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'required|email',
            'guest_phone' => 'required|string|max:20',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'adults' => 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'rooms' => 'required|integer|min:1',
        ]);

        $property = Property::findOrFail($validated['property_id']);

        // Calculate total nights
        $checkIn = new \DateTime($validated['check_in']);
        $checkOut = new \DateTime($validated['check_out']);
        $nights = $checkIn->diff($checkOut)->days;

        // Calculate total price
        $totalPrice = $property->price_per_night * $nights * $validated['rooms'];

        $booking = Booking::create([
            'property_id' => $validated['property_id'],
            'guest_name' => $validated['guest_name'],
            'guest_email' => $validated['guest_email'],
            'guest_phone' => $validated['guest_phone'],
            'check_in' => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'adults' => $validated['adults'],
            'children' => $validated['children'] ?? 0,
            'rooms' => $validated['rooms'],
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        return redirect()->route('booking.show', $booking)
            ->with('success', 'Booking berhasil dibuat!');
    }

    public function show(Booking $booking)
    {
        $booking->load('property');
        return view('booking-confirmation', compact('booking'));
    }
}
