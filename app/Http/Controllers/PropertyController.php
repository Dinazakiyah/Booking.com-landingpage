<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PropertyController extends Controller
{
    public function index()
    {
        $featuredProperties = DB::table('properties')->orderByDesc('rating')->limit(8)->get();

        $popularDestinations = DB::table('properties')
            ->select('location', DB::raw('COUNT(*) as total'))
            ->groupBy('location')
            ->orderByDesc('total')
            ->limit(3)
            ->get();

        return view('welcome', compact('featuredProperties', 'popularDestinations'));
    }

    public function list()
    {
        $properties = DB::table('properties')->get();
        return view('Properties.index', compact('properties'));
    }

    public function create()
    {
        return view('Properties.create');
    }

    public function store(Request $request)
    {
        DB::table('properties')->insert([
            'name' => $request->name,
            'location' => $request->location,
            'price_per_night' => $request->price_per_night,
            'rating' => $request->rating,
            'total_reviews' => $request->total_reviews,
            'free_cancellation' => $request->has('free_cancellation'),
            'image_url' => $request->image_url,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('properties.index')->with('success', 'Properti berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $property = DB::table('properties')->where('id', $id)->first();
        return view('Properties.edit', compact('property'));
    }

    public function update(Request $request, $id)
    {
        DB::table('properties')->where('id', $id)->update([
            'name' => $request->name,
            'location' => $request->location,
            'price_per_night' => $request->price_per_night,
            'rating' => $request->rating,
            'total_reviews' => $request->total_reviews,
            'free_cancellation' => $request->has('free_cancellation'),
            'image_url' => $request->image_url,
            'updated_at' => now(),
        ]);

        return redirect()->route('properties.index')->with('success', 'Properti berhasil diperbarui.');
    }

    public function destroy($id)
    {
        DB::table('properties')->where('id', $id)->delete();
        return redirect()->route('properties.index')->with('success', 'Properti berhasil dihapus.');
    }

    public function show($id)
    {
        $property = DB::table('properties')->where('id', $id)->first();

        if (!$property) {
            abort(404, 'Properti tidak ditemukan');
        }

        return view('Properties.show', compact('property'));
    }

}
