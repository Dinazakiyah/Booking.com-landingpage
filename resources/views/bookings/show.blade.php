<!-- Informasi Tamu -->
                <div>
                    <h3 class="text-xl font-semibold mb-4 border-b pb-2">Informasi Pemesan</h3>
                    <div class="@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-blue-600 text-white px-6 py-4 flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold">Detail Pemesanan #{{ $booking->id }}</h2>
                <p class="text-blue-100">Dibuat: {{ $booking->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <div>
                <span class="px-4 py-2 rounded text-sm font-semibold
                    @if($booking->status == 'confirmed') bg-green-500
                    @elseif($booking->status == 'cancelled') bg-red-500
                    @else bg-yellow-500
                    @endif">
                    {{ strtoupper($booking->status) }}
                </span>
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Informasi Properti -->
                <div>
                    <h3 class="text-xl font-semibold mb-4 border-b pb-2">Informasi Properti</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-gray-600 text-sm">Nama Properti</p>
                            <p class="font-semibold">{{ $booking->property->name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Alamat</p>
                            <p>{{ $booking->property->address }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Tipe</p>
                            <p>{{ ucfirst($booking->property->type) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Informasi Tamu -->
                <div>
                    <h3 class="text-xl font-semibold mb-4 border-b pb-2">Informasi Tamu</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-gray-600 text-sm">Nama Lengkap</p>
                            <p class="font-semibold">{{ $booking->customer_name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Email</p>
                            <p>{{ $booking->customer_email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Pemesanan -->
            <div class="mt-6">
                <h3 class="text-xl font-semibold mb-4 border-b pb-2">Detail Pemesanan</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-gray-50 p-4 rounded">
                        <p class="text-gray-600 text-sm">Check-in</p>
                        <p class="font-semibold text-lg">{{ $booking->check_in->format('d/m/Y') }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded">
                        <p class="text-gray-600 text-sm">Check-out</p>
                        <p class="font-semibold text-lg">{{ $booking->check_out->format('d/m/Y') }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded">
                        <p class="text-gray-600 text-sm">Lama Menginap</p>
                        <p class="font-semibold text-lg">{{ $booking->total_nights }} Malam</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                    <div class="bg-gray-50 p-4 rounded">
                        <p class="text-gray-600 text-sm">Dewasa</p>
                        <p class="font-semibold">{{ $booking->adults }} Orang</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded">
                        <p class="text-gray-600 text-sm">Anak-anak</p>
                        <p class="font-semibold">{{ $booking->children }} Orang</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded">
                        <p class="text-gray-600 text-sm">Jumlah Kamar</p>
                        <p class="font-semibold">{{ $booking->rooms }} Kamar</p>
                    </div>
                </div>
            </div>

            @if($booking->notes)
            <div class="mt-6">
                <h3 class="text-xl font-semibold mb-4 border-b pb-2">Catatan</h3>
                <p class="bg-gray-50 p-4 rounded">{{ $booking->notes }}</p>
            </div>
            @endif

            <!-- Total Pembayaran -->
            <div class="mt-6 bg-blue-50 p-6 rounded-lg">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-600">Total Pembayaran</p>
                        <p class="text-sm text-gray-500">{{ $booking->rooms }} kamar × {{ $booking->total_nights }} malam × Rp {{ number_format($booking->property->price, 0, ',', '.') }}</p>
                    </div>
                    <p class="text-3xl font-bold text-blue-600">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Aksi -->
            <div class="mt-6 flex gap-4">
                <a href="{{ route('bookings.edit', $booking->id) }}"
                   class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                    Edit Pemesanan
                </a>

                @if($booking->status == 'pending')
                <form action="{{ route('bookings.updateStatus', $booking->id) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="confirmed">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                        Konfirmasi Pemesanan
                    </button>
                </form>
                @endif

                @if($booking->status != 'cancelled')
                <form action="{{ route('bookings.updateStatus', $booking->id) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="cancelled">
                    <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700"
                            onclick="return confirm('Yakin ingin membatalkan pemesanan ini?')">
                        Batalkan Pemesanan
                    </button>
                </form>
                @endif

                <a href="{{ route('bookings.index') }}"
                   class="bg-gray-200 text-gray-700 px-6 py-2 rounded hover:bg-gray-300">
                    Kembali
                </a>
            </div>
                        <a href="{{ route('bookings.create', ['property' => $property->id]) }}"
            class="bg-blue-600 text-white px-4 py-2 rounded">
            Pesan Sekarang
            </a>

        </div>
    </div>
</div>
@endsection
