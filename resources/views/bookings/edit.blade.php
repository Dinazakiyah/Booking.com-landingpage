@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">
    <h2 class="text-3xl font-bold mb-6">Edit Pemesanan #{{ $booking->id }}</h2>

    <form action="{{ route('bookings.update', $booking->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
        @csrf
        @method('PUT')

        <h3 class="text-xl font-semibold mb-4">Informasi Tamu</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block font-semibold mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" name="customer_name" value="{{ old('customer_name', $booking->customer_name) }}"
                       class="w-full border px-4 py-2 rounded @error('customer_name') border-red-500 @enderror" required>
                @error('customer_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-2">Email <span class="text-red-500">*</span></label>
                <input type="email" name="customer_email" value="{{ old('customer_email', $booking->customer_email) }}"
                       class="w-full border px-4 py-2 rounded @error('customer_email') border-red-500 @enderror" required>
                @error('customer_email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <h3 class="text-xl font-semibold mb-4 mt-6">Detail Pemesanan</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block font-semibold mb-2">Check-in <span class="text-red-500">*</span></label>
                <input type="date" name="check_in" value="{{ old('check_in', $booking->check_in->format('Y-m-d')) }}"
                       class="w-full border px-4 py-2 rounded @error('check_in') border-red-500 @enderror" required>
                @error('check_in')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-2">Check-out <span class="text-red-500">*</span></label>
                <input type="date" name="check_out" value="{{ old('check_out', $booking->check_out->format('Y-m-d')) }}"
                       class="w-full border px-4 py-2 rounded @error('check_out') border-red-500 @enderror" required>
                @error('check_out')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-2">Dewasa <span class="text-red-500">*</span></label>
                <input type="number" name="adults" value="{{ old('adults', $booking->adults) }}"
                       class="w-full border px-4 py-2 rounded" min="1" required>
            </div>

            <div>
                <label class="block font-semibold mb-2">Anak-anak</label>
                <input type="number" name="children" value="{{ old('children', $booking->children) }}"
                       class="w-full border px-4 py-2 rounded" min="0">
            </div>

            <div>
                <label class="block font-semibold mb-2">Jumlah Kamar <span class="text-red-500">*</span></label>
                <input type="number" name="rooms" value="{{ old('rooms', $booking->rooms) }}"
                       class="w-full border px-4 py-2 rounded" min="1" required>
            </div>

            <div>
                <label class="block font-semibold mb-2">Status <span class="text-red-500">*</span></label>
                <select name="status" class="w-full border px-4 py-2 rounded" required>
                    <option value="pending" {{ old('status', $booking->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ old('status', $booking->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="cancelled" {{ old('status', $booking->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
        </div>

        <div class="mt-4">
            <label class="block font-semibold mb-2">Catatan Tambahan</label>
            <textarea name="notes" rows="3" class="w-full border px-4 py-2 rounded">{{ old('notes', $booking->notes) }}</textarea>
        </div>

        <!-- Info Properti -->
        <div class="mt-6 bg-gray-50 p-4 rounded">
            <h4 class="font-semibold mb-2">Properti: {{ $booking->property->name }}</h4>
            <p class="text-sm text-gray-600">{{ $booking->property->address }}</p>
            <p class="text-sm text-gray-600 mt-2">Harga per malam: Rp {{ number_format($booking->property->price, 0, ',', '.') }}</p>
        </div>

        <div class="mt-6 flex gap-4">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Simpan Perubahan
            </button>
            <a href="{{ route('bookings.show', $booking->id) }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded hover:bg-gray-300">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
