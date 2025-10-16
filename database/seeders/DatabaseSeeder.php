<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // USERS
        DB::table('users')->insert([
            [
                'name' => 'Admin Booking',
                'email' => 'admin@booking.com',
                'password' => Hash::make('admin123'),
                'phone' => '081234567890',
                'role' => 'admin',
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Dina Zakiyah',
                'email' => 'dina@example.com',
                'password' => Hash::make('password'),
                'phone' => '089876543210',
                'role' => 'user',
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        //PROPERTIES
        DB::table('properties')->insert([
            [
                'name' => 'Hotel Mawar Indah',
                'type' => 'Hotel',
                'location' => 'Jakarta',
                'description' => 'Hotel bintang 4 dengan fasilitas lengkap di pusat kota.',
                'price_per_night' => 750000,
                'rating' => 4.5,
                'total_reviews' => 320,
                'free_cancellation' => true,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Villa Puncak Asri',
                'type' => 'Villa',
                'location' => 'Bogor',
                'description' => 'Villa nyaman dengan pemandangan gunung dan udara sejuk.',
                'price_per_night' => 1250000,
                'rating' => 4.8,
                'total_reviews' => 150,
                'free_cancellation' => false,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Apartment City View',
                'type' => 'Apartment',
                'location' => 'Surabaya',
                'description' => 'Apartemen modern dengan akses langsung ke mall.',
                'price_per_night' => 600000,
                'rating' => 4.2,
                'total_reviews' => 210,
                'free_cancellation' => true,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        //SEARCHES
        DB::table('searches')->insert([
            [
                'user_id' => 2, // Dina
                'destination' => 'Bogor',
                'check_in' => '2025-11-01',
                'check_out' => '2025-11-03',
                'adults' => 2,
                'children' => 1,
                'rooms' => 1,
                'ip_address' => '192.168.1.100',
                'created_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'destination' => 'Surabaya',
                'check_in' => '2025-12-05',
                'check_out' => '2025-12-10',
                'adults' => 1,
                'children' => 0,
                'rooms' => 1,
                'ip_address' => '192.168.1.101',
                'created_at' => Carbon::now(),
            ],
        ]);

        // BOOKINGS
        DB::table('bookings')->insert([
            [
                'user_id' => 2,
                'property_id' => 2, // Villa Puncak Asri
                'guest_name' => 'Dina Zakiyah',
                'guest_email' => 'dina@example.com',
                'guest_phone' => '089876543210',
                'check_in' => '2025-11-01',
                'check_out' => '2025-11-03',
                'adults' => 2,
                'children' => 1,
                'rooms' => 1,
                'total_price' => 2500000,
                'status' => 'confirmed',
                'notes' => 'Ingin kamar dekat kolam renang.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'property_id' => 3, // Apartment City View
                'guest_name' => 'Dina Zakiyah',
                'guest_email' => 'dina@example.com',
                'guest_phone' => '089876543210',
                'check_in' => '2025-12-05',
                'check_out' => '2025-12-10',
                'adults' => 1,
                'children' => 0,
                'rooms' => 1,
                'total_price' => 3000000,
                'status' => 'pending',
                'notes' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
