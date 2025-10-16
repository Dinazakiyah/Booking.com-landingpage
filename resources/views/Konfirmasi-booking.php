<?php

use Illuminate\Support\Facades\Route;

// Route untuk testing UI tanpa database
Route::get('/', function () {
    // Data dummy untuk testing UI
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
        (object)[
            'id' => 4,
            'name' => 'Bandung Heritage Apartment',
            'type' => 'apartment',
            'location' => 'Bandung',
            'description' => 'Apartemen modern di pusat kota Bandung',
            'price_per_night' => 450000,
            'rating' => 4.4,
            'total_reviews' => 876,
            'image_url' => null,
            'free_cancellation' => true,
        ],
        (object)[
            'id' => 5,
            'name' => 'Bromo View Hotel',
            'type' => 'hotel',
            'location' => 'Malang',
            'description' => 'Hotel dengan view gunung Bromo yang spektakuler',
            'price_per_night' => 650000,
            'rating' => 4.6,
            'total_reviews' => 1234,
            'image_url' => null,
            'free_cancellation' => true,
        ],
        (object)[
            'id' => 6,
            'name' => 'Lombok Beach Resort',
            'type' => 'resort',
            'location' => 'Lombok',
            'description' => 'Resort mewah dengan private beach',
            'price_per_night' => 2800000,
            'rating' => 4.8,
            'total_reviews' => 654,
            'image_url' => null,
            'free_cancellation' => true,
        ],
        (object)[
            'id' => 7,
            'name' => 'Yogyakarta Boutique Hotel',
            'type' => 'hotel',
            'location' => 'Yogyakarta',
            'description' => 'Hotel butik dekat Malioboro',
            'price_per_night' => 550000,
            'rating' => 4.7,
            'total_reviews' => 1432,
            'image_url' => null,
            'free_cancellation' => true,
        ],
        (object)[
            'id' => 8,
            'name' => 'Surabaya City Hotel',
            'type' => 'hotel',
            'location' => 'Surabaya',
            'description' => 'Hotel strategis di pusat kota Surabaya',
            'price_per_night' => 750000,
            'rating' => 4.5,
            'total_reviews' => 987,
            'image_url' => null,
            'free_cancellation' => true,
        ],
    ]);

    return view('welcome', compact('popularDestinations', 'featuredProperties'));
})->name('home');

// Route search (dummy - hanya redirect)
Route::post('/search', function () {
    return redirect()->route('home')->with('info', 'Fitur pencarian akan aktif setelah database dibuat');
})->name('search');

// Route property detail (dummy)
Route::get('/property/{id}', function ($id) {
    return redirect()->route('home')->with('info', 'Fitur detail properti akan aktif setelah database dibuat');
})->name('property.show');

// Route booking (dummy)
Route::post('/booking', function () {
    return redirect()->route('home')->with('info', 'Fitur booking akan aktif setelah database dibuat');
})->name('booking.store');

Route::get('/booking/{id}', function ($id) {
    return redirect()->route('home')->with('info', 'Fitur konfirmasi booking akan aktif setelah database dibuat');
})->name('booking.show');
