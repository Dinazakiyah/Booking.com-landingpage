<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Booking; // pastikan path ini sesuai dengan letak Booking modelmu

class Property extends Model
{
    protected $table = 'properties';

    protected $fillable = [
        'name',
        'type',
        'location',
        'description',
        'price_per_night',
        'rating',
        'total_reviews',
        'image_url',
        'free_cancellation',
    ];

    // Relasi ke Booking
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // Method untuk cek ketersediaan properti pada tanggal tertentu
    public function isAvailable($checkIn, $checkOut)
    {
        return !$this->bookings()
            ->where('status', '!=', 'cancelled')
            ->where(function($query) use ($checkIn, $checkOut) {
                $query->whereBetween('check_in', [$checkIn, $checkOut])
                      ->orWhereBetween('check_out', [$checkIn, $checkOut])
                      ->orWhere(function($q) use ($checkIn, $checkOut) {
                          $q->where('check_in', '<=', $checkIn)
                            ->where('check_out', '>=', $checkOut);
                      });
            })
            ->exists();
    }
}
