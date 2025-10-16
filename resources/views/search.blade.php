<?php

use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', function () {
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
            'description' => 'Hotel mewah di pusat kota Jakarta dengan fasilitas lengkap',
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
            'description' => 'Resort tepi pantai dengan pemandangan laut yang menakjubkan',
            'price_per_night' => 2500000,
            'rating' => 4.9,
            'total_reviews' => 1872,
            'image_url' => null,
            'free_cancellation' => true,
        ],
        (object)[
            'id' => 3,
            'name' => 'Villa Ubud Paradise',
            'type' => 'villa',
            'location' => 'Bali',
            'description' => 'Villa eksklusif dengan pemandangan sawah',
            'price_per_night' => 3200000,
            'rating' => 4.9,
            'total_reviews' => 543,
            'image_url' => null,
            'free_cancellation' => false,
        ],
    ]);

    return view('welcome', compact('popularDestinations', 'featuredProperties'));
})->name('home');

// Route untuk search results (dummy)
Route::post('/search', function () {
    // Data dummy untuk hasil pencarian
    $validated = [
        'destination' => request('destination', 'Bali'),
        'check_in' => request('check_in', now()->format('Y-m-d')),
        'check_out' => request('check_out', now()->addDays(3)->format('Y-m-d')),
        'adults' => request('adults', 2),
        'children' => request('children', 0),
        'rooms' => request('rooms', 1)
    ];

    $properties = collect([
        (object)[
            'id' => 1,
            'name' => 'Grand Hyatt Jakarta',
            'type' => 'hotel',
            'location' => 'Jakarta',
            'description' => 'Hotel mewah di pusat kota Jakarta dengan fasilitas lengkap dan pelayanan terbaik.',
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
            'description' => 'Resort tepi pantai dengan pemandangan laut yang menakjubkan.',
            'price_per_night' => 2500000,
            'rating' => 4.9,
            'total_reviews' => 1872,
            'image_url' => null,
            'free_cancellation' => true,
        ],
        (object)[
            'id' => 3,
            'name' => 'Villa Ubud Paradise',
            'type' => 'villa',
            'location' => 'Bali',
            'description' => 'Villa eksklusif dengan pemandangan sawah yang menenangkan.',
            'price_per_night' => 3200000,
            'rating' => 4.9,
            'total_reviews' => 543,
            'image_url' => null,
            'free_cancellation' => false,
        ]
    ]);

    return view('search', compact('validated', 'properties'));
})->name('search.results');

// Route untuk property detail
Route::get('/property/{id}', function ($id) {
    $properties = [
        1 => (object)[
            'id' => 1,
            'name' => 'Grand Hyatt Jakarta',
            'type' => 'hotel',
            'location' => 'Jakarta',
            'description' => 'Hotel mewah di pusat kota Jakarta dengan fasilitas lengkap. Terletak di kawasan bisnis yang strategis dengan akses mudah ke berbagai tempat wisata dan pusat perbelanjaan.',
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
        ],
        3 => (object)[
            'id' => 3,
            'name' => 'Villa Ubud Paradise',
            'type' => 'villa',
            'location' => 'Bali',
            'description' => 'Villa eksklusif dengan pemandangan sawah yang menenangkan. Dilengkapi dengan kolam renang pribadi dan pelayanan butler 24 jam.',
            'price_per_night' => 3200000,
            'rating' => 4.9,
            'total_reviews' => 543,
            'image_url' => null,
            'free_cancellation' => false,
        ]
    ];

    $property = $properties[$id] ?? $properties[1];
    return view('property-detail', compact('property'));
})->name('property.show');

// Route untuk booking confirmation
Route::get('/booking-confirmation', function () {
    return view('Konfirmasi-booking');
})->name('booking.confirmation');

// Route untuk form booking (dummy)
Route::post('/booking', function () {
    return redirect()->route('booking.confirmation')->with('success', 'Booking berhasil dibuat!');
})->name('booking.store');
