@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2>{{ $property->name }}</h2>
    <img src="{{ $property->image_url ?? 'https://via.placeholder.com/600x400' }}" class="img-fluid mb-4" alt="{{ $property->name }}">
    <p><strong>Lokasi:</strong> {{ $property->location }}</p>
    <p><strong>Harga per malam:</strong> Rp {{ number_format($property->price_per_night, 0, ',', '.') }}</p>
    <p><strong>Rating:</strong> {{ $property->rating }} / 5 ({{ $property->total_reviews }} ulasan)</p>
    <p><strong>Deskripsi:</strong> Properti ini menawarkan kenyamanan dan fasilitas terbaik.</p>
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
