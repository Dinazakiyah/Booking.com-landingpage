@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-white shadow p-6 rounded">
    <h2 class="text-xl font-semibold mb-4">Form Booking - {{ $property->name }}</h2>

    <form action="{{ route('bookings.store', $property->id) }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Check-in</label>
        <input type="date" name="check_in_date" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Check-out</label>
        <input type="date" name="check_out_date" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Konfirmasi Booking</button>
</form>

</div>
@endsection
