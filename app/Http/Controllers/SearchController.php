<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'destination' => 'nullable|string|max:255',
            'check_in' => 'nullable|date',
            'check_out' => 'nullable|date',
            'adults' => 'nullable|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'rooms' => 'nullable|integer|min:1',
        ]);

        // Query dasar ke tabel properties
        $query = Property::query();

        // Jika pengguna memasukkan lokasi/destinasi
        if (!empty($validated['destination'])) {
            $query->where('location', 'ILIKE', "%{$validated['destination']}%");
        }

        // Contoh filter tambahan (opsional, tergantung kolom di tabelmu)
        // if (!empty($validated['price_min'])) {
        //     $query->where('price_per_night', '>=', $validated['price_min']);
        // }
        // if (!empty($validated['price_max'])) {
        //     $query->where('price_per_night', '<=', $validated['price_max']);
        // }

        // Ambil hasil pencarian
        $properties = $query->orderBy('rating', 'desc')->get();

        // Kirim data ke view
        return view('search', compact('validated', 'properties'));
    }
}
