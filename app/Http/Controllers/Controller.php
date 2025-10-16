<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Search;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController
{
    public function index()
    {
        $popularDestinations = Property::select('location', DB::raw('count(*) as total'))
            ->groupBy('location')
            ->orderBy('total', 'desc')
            ->limit(6)
            ->get();

        $featuredProperties = Property::where('rating', '>=', 4.5)
            ->orderBy('rating', 'desc')
            ->limit(8)
            ->get();

        return view('welcome', compact('popularDestinations', 'featuredProperties'));
    }

    public function search(Request $request)
    {
        $validated = $request->validate([
            'destination' => 'required|string|max:255',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'adults' => 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'rooms' => 'required|integer|min:1',
        ]);

        // Save search to database
        Search::create([
            'destination' => $validated['destination'],
            'check_in' => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'adults' => $validated['adults'],
            'children' => $validated['children'] ?? 0,
            'rooms' => $validated['rooms'],
            'ip_address' => $request->ip(),
        ]);

        // Search properties
        $properties = Property::where('location', 'like', '%' . $validated['destination'] . '%')
            ->orderBy('rating', 'desc')
            ->paginate(20);

        return view('search', compact('properties', 'validated'));
    }

    public function show(Property $property)
    {
        return view('property-detail', compact('property'));
    }
}
