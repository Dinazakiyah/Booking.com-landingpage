<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('property')->orderBy('created_at', 'desc')->get();
        return view('bookings.index', compact('bookings'));
    }

    public function create($propertyId)
    {
        $property = Property::findOrFail($propertyId);
        return view('bookings.create', compact('property'));
    }

    public function store(Request $request, $propertyId)
    {
        $property = Property::findOrFail($propertyId);

        $request->validate([
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
        ]);

        $days = (new \DateTime($request->check_in_date))
            ->diff(new \DateTime($request->check_out_date))
            ->days;

        $totalPrice = $property->price_per_night * $days;

        Booking::create([
            'user_id' => Auth::id() ?? 1, // sementara 1 kalau belum login
            'property_id' => $property->id,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        return redirect()->route('bookings.index')->with('success', 'Pemesanan berhasil disimpan!');
    }

    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        return view('bookings.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $booking->update($request->all());
        return redirect()->route('bookings.index')->with('success', 'Booking berhasil diperbarui!');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dihapus.');
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $booking->status = $request->status;
        $booking->save();

        return redirect()->route('bookings.show', $booking->id)->with('success', 'Status booking diperbarui!');
    }
}
