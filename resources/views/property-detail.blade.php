<?php

use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', function () {
    // Data dummy untuk testing UI tanpa database
    $popularDestinations = collect([
        (object)['location' => 'Jakarta', 'total' => 450],
        (object)['location' => 'Bali', 'total' => 890],
        (object)['location' => 'Bandung', 'total' => 320],
        (object)['location' => 'Yogyakarta', 'total' => 540],
        (object)['location' => 'Surabaya', 'total' => 380],
        (object)['location' => 'Lombok', 'total' => 210],
    ]);

    $featuredProperties = collect([
        (object)[
            'id' => 1,
            'name' => 'Grand Hyatt Jakarta',
            'type' => 'hotel',
            'location' => 'Jakarta',
            'price_per_night' => 1500000,
            'rating' => 4.8,
            'total_reviews' => 2543,
            'image_url' => null,
            'free_cancellation' => true,
        ],
        (object)[
            'id' => 2,
            'name' => 'Kuta Seaview Resort',
            'type' => 'resort',
            'location' => 'Bali',
            'price_per_night' => 2500000,
            'rating' => 4.9,
            'total_reviews' => 1872,
            'image_url' => null,
            'free_cancellation' => true,
        ],
        // ... tambahkan property lainnya sesuai kebutuhan
    ]);

    return view('welcome', compact('popularDestinations', 'featuredProperties'));
})->name('home'); // Jangan lupa nama route

// Route untuk property detail (dummy)
Route::get('/property/{id}', function ($id) {
    // Data dummy property untuk testing
    $properties = [
        1 => (object)[
            'id' => 1,
            'name' => 'Grand Hyatt Jakarta',
            'type' => 'hotel',
            'location' => 'Jakarta',
            'description' => 'Hotel mewah di pusat kota Jakarta dengan fasilitas lengkap dan pelayanan terbaik. Terletak di kawasan bisnis yang strategis dengan akses mudah ke berbagai tempat wisata dan pusat perbelanjaan.',
            'price_per_night' => 1500000,
            'rating' => 4.8,
            'total_reviews' => 2543,
            'image_url' => null,
            'free_cancellation' => true,
        ],
        2 => (object)[
            'id' => 2,
            'name' => 'Kuta Seaview Resort',
            'type' => 'resort',
            'location' => 'Bali',
            'description' => 'Resort tepi pantai dengan pemandangan laut yang menakjubkan. Menawarkan pengalaman menginap yang tak terlupakan dengan private beach dan fasilitas spa yang lengkap.',
            'price_per_night' => 2500000,
            'rating' => 4.9,
            'total_reviews' => 1872,
            'image_url' => null,
            'free_cancellation' => true,
        ]
    ];

    $property = $properties[$id] ?? $properties[1]; // Fallback ke property pertama

    return view('Konfirmasi-booking', compact('property'));
})->name('property.show');

// Route untuk booking (dummy)
Route::post('/booking', function () {
    return redirect()->route('home')->with('success', 'Booking berhasil! Silakan tunggu konfirmasi melalui email.');
})->name('booking.store');

// Route untuk search (dummy)
Route::post('/search', function () {
    return redirect()->back()->with('message', 'Fitur pencarian akan aktif setelah database dibuat');
})->name('search');
