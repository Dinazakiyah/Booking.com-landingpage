@extends('layouts.app')

@section('content')

<div class="container py-5">
    <h3>Hasil Pencarian: {{ $validated['destination'] ?? 'Semua Lokasi' }}</h3>
    <p>
        Check-in: {{ $validated['check_in'] ?? '-' }} |
        Check-out: {{ $validated['check_out'] ?? '-' }} |
        Dewasa: {{ $validated['adults'] ?? 1 }} |
        Anak-anak: {{ $validated['children'] ?? 0 }} |
        Kamar: {{ $validated['rooms'] ?? 1 }}
    </p>

    <div class="row mt-4">
        @forelse ($properties as $property)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <img src="{{ $property->image_url ?? 'https://via.placeholder.com/300x200' }}"
                         class="card-img-top"
                         alt="{{ $property->name }}">
                    <div class="card-body">
                        <h5>{{ $property->name }}</h5>
                        <p class="text-muted mb-1">{{ ucfirst($property->type) }} • {{ $property->location }}</p>
                        <p class="small text-secondary">{{ Str::limit($property->description, 80) }}</p>
                        <p class="fw-bold text-success">Rp {{ number_format($property->price_per_night, 0, ',', '.') }} / malam</p>
                        <a href="{{ route('property.show', $property->id) }}" class="btn btn-primary w-100">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center mt-5">
                <h5>Tidak ada properti ditemukan untuk "{{ $validated['destination'] ?? '-' }}"</h5>
            </div>
        @endforelse
    </div>
    

</div>
@endsection

