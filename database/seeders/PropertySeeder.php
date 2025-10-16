<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        $properties = [
            [
                'name' => 'Grand Hyatt Jakarta',
                'type' => 'hotel',
                'location' => 'Jakarta',
                'description' => 'Hotel mewah di pusat kota Jakarta dengan fasilitas lengkap',
                'price_per_night' => 850000,
                'rating' => 4.5,
                'total_reviews' => 987,
                'free_cancellation' => true,
            ],
            [
                'name' => 'Villa Ubud Paradise',
                'type' => 'villa',
                'location' => 'Bali',
                'description' => 'Villa eksklusif dengan pemandangan sawah',
                'price_per_night' => 3200000,
                'rating' => 4.9,
                'total_reviews' => 543,
                'free_cancellation' => false,
            ],
            [
                'name' => 'Bromo View Hotel',
                'type' => 'hotel',
                'location' => 'Malang',
                'description' => 'Hotel dengan view gunung Bromo yang spektakuler',
                'price_per_night' => 650000,
                'rating' => 4.6,
                'total_reviews' => 1234,
                'free_cancellation' => true,
            ],
            [
                'name' => 'Bandung Heritage Apartment',
                'type' => 'apartment',
                'location' => 'Bandung',
                'description' => 'Apartemen modern di pusat kota Bandung',
                'price_per_night' => 450000,
                'rating' => 4.4,
                'total_reviews' => 876,
                'free_cancellation' => true,
            ],
            [
                'name' => 'Lombok Beach Resort',
                'type' => 'resort',
                'location' => 'Lombok',
                'description' => 'Resort mewah dengan private beach',
                'price_per_night' => 2800000,
                'rating' => 4.8,
                'total_reviews' => 654,
                'free_cancellation' => true,
            ],
            [
                'name' => 'Yogyakarta Boutique Hotel',
                'type' => 'hotel',
                'location' => 'Yogyakarta',
                'description' => 'Hotel butik dekat Malioboro',
                'price_per_night' => 550000,
                'rating' => 4.7,
                'total_reviews' => 1432,
                'free_cancellation' => true,
            ],
        ];

        foreach ($properties as $property) {
            Property::create($property);
        }
    }
}
