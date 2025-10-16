<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Clone - Cari Hotel & Akomodasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-[#003B95] text-white">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-2xl font-bold">Booking.id</a>
                    <div class="hidden md:flex space-x-6">
                        <a href="#" class="hover:bg-[#0057B8] px-3 py-2 rounded">Menginap</a>
                        <a href="#" class="hover:bg-[#0057B8] px-3 py-2 rounded">Penerbangan</a>
                        <a href="#" class="hover:bg-[#0057B8] px-3 py-2 rounded">Rental Mobil</a>
                        <a href="#" class="hover:bg-[#0057B8] px-3 py-2 rounded">Atraksi</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="hover:bg-[#0057B8] px-3 py-2 rounded">IDR</button>
                    <button class="hover:bg-[#0057B8] px-3 py-2 rounded"><i class="fas fa-user-circle"></i></button>
                </div>
            </div>
        </nav>

        <!-- Hero Section with Search Form -->
        <div class="container mx-auto px-4 py-12">
            <h2 class="text-4xl font-bold mb-2">Cari penawaran untuk hotel, rumah, dan masih banyak lagi...</h2>
            <p class="text-xl mb-8">Dari penginapan yang nyaman hingga rumah mewah</p>

            <!-- Search Form -->
            <form action="{{ route('search.results') }}" method="POST" class="bg-yellow-400 p-1 rounded-lg shadow-lg">
                @csrf
                <div class="bg-white rounded-lg p-4">
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                        <!-- Destination -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold mb-2">
                                <i class="fas fa-bed text-gray-600"></i> Tujuan/nama properti
                            </label>
                            <input type="text"
                                   name="destination"
                                   placeholder="Mau ke mana?"
                                   required
                                   class="w-full px-4 py-3 border-2 border-yellow-400 rounded focus:outline-none focus:border-blue-600">
                        </div>

                        <!-- Check-in Date -->
                        <div>
                            <label class="block text-sm font-semibold mb-2">
                                <i class="fas fa-calendar text-gray-600"></i> Check-in
                            </label>
                            <input type="date"
                                   name="check_in"
                                   required
                                   min="{{ date('Y-m-d') }}"
                                   class="w-full px-4 py-3 border-2 border-gray-300 rounded focus:outline-none focus:border-blue-600">
                        </div>

                        <!-- Check-out Date -->
                        <div>
                            <label class="block text-sm font-semibold mb-2">
                                <i class="fas fa-calendar text-gray-600"></i> Check-out
                            </label>
                            <input type="date"
                                   name="check_out"
                                   required
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                   class="w-full px-4 py-3 border-2 border-gray-300 rounded focus:outline-none focus:border-blue-600">
                        </div>

                        <!-- Guests -->
                        <div>
                            <label class="block text-sm font-semibold mb-2">
                                <i class="fas fa-user text-gray-600"></i> Tamu & Kamar
                            </label>
                            <div class="relative">
                                <button type="button"
                                        id="guestBtn"
                                        class="w-full px-4 py-3 border-2 border-gray-300 rounded text-left focus:outline-none focus:border-blue-600">
                                    <span id="guestDisplay">2 dewasa · 1 kamar</span>
                                </button>

                                <!-- Dropdown -->
                                <div id="guestDropdown" class="hidden absolute z-10 mt-2 w-80 bg-white border rounded-lg shadow-xl p-4">
                                    <div class="space-y-4">
                                        <div class="flex justify-between items-center">
                                            <span class="font-semibold">Dewasa</span>
                                            <div class="flex items-center space-x-3">
                                                <button type="button" onclick="changeGuest('adults', -1)" class="w-8 h-8 border-2 border-blue-600 text-blue-600 rounded-full">-</button>
                                                <span id="adultsDisplay" class="w-8 text-center">2</span>
                                                <button type="button" onclick="changeGuest('adults', 1)" class="w-8 h-8 border-2 border-blue-600 text-blue-600 rounded-full">+</button>
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="font-semibold">Anak-anak</span>
                                            <div class="flex items-center space-x-3">
                                                <button type="button" onclick="changeGuest('children', -1)" class="w-8 h-8 border-2 border-blue-600 text-blue-600 rounded-full">-</button>
                                                <span id="childrenDisplay" class="w-8 text-center">0</span>
                                                <button type="button" onclick="changeGuest('children', 1)" class="w-8 h-8 border-2 border-blue-600 text-blue-600 rounded-full">+</button>
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="font-semibold">Kamar</span>
                                            <div class="flex items-center space-x-3">
                                                <button type="button" onclick="changeGuest('rooms', -1)" class="w-8 h-8 border-2 border-blue-600 text-blue-600 rounded-full">-</button>
                                                <span id="roomsDisplay" class="w-8 text-center">1</span>
                                                <button type="button" onclick="changeGuest('rooms', 1)" class="w-8 h-8 border-2 border-blue-600 text-blue-600 rounded-full">+</button>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" onclick="closeGuestDropdown()" class="mt-4 w-full bg-blue-600 text-white py-2 rounded font-semibold hover:bg-blue-700">Selesai</button>
                                </div>
                            </div>
                            <input type="hidden" name="adults" id="adults" value="2">
                            <input type="hidden" name="children" id="children" value="0">
                            <input type="hidden" name="rooms" id="rooms" value="1">
                        </div>
                    </div>

                    <div class="mt-4 flex items-center space-x-4">
                        <label class="flex items-center">
                            <input type="checkbox" class="mr-2 w-5 h-5">
                            <span class="text-sm">Saya mencari tempat untuk bekerja sambil liburan</span>
                        </label>
                    </div>

                    <button type="submit" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-12 py-3 rounded-lg font-bold text-lg">
                        Cari
                    </button>
                </div>
            </form>
        </div>
    </header>

    <!-- Popular Destinations -->
    <section class="container mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold mb-6">Destinasi yang sedang tren</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($popularDestinations as $dest)
            <div class="relative rounded-lg overflow-hidden shadow-lg cursor-pointer hover:shadow-xl transition group">
                <img src="https://picsum.photos/400/300?random={{ $loop->index }}"
                     alt="{{ $dest->location }}"
                     class="w-full h-64 object-cover group-hover:scale-105 transition duration-300">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <div class="absolute bottom-4 left-4 text-white">
                    <h3 class="text-2xl font-bold">{{ $dest->location }}</h3>
                    <p class="text-sm">{{ $dest->total }} properti</p>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-8 text-gray-500">
                Belum ada destinasi tersedia
            </div>
            @endforelse
        </div>
    </section>

    <!-- Property Types -->
    <section class="container mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold mb-6">Jelajahi berdasarkan jenis properti</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition cursor-pointer">
                <i class="fas fa-hotel text-4xl text-blue-600 mb-3"></i>
                <h3 class="font-bold text-lg">Hotel</h3>
                <p class="text-sm text-gray-600">Kenyamanan modern</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition cursor-pointer">
                <i class="fas fa-building text-4xl text-blue-600 mb-3"></i>
                <h3 class="font-bold text-lg">Apartemen</h3>
                <p class="text-sm text-gray-600">Seperti rumah sendiri</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition cursor-pointer">
                <i class="fas fa-home text-4xl text-blue-600 mb-3"></i>
                <h3 class="font-bold text-lg">Villa</h3>
                <p class="text-sm text-gray-600">Privasi maksimal</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition cursor-pointer">
                <i class="fas fa-umbrella-beach text-4xl text-blue-600 mb-3"></i>
                <h3 class="font-bold text-lg">Resort</h3>
                <p class="text-sm text-gray-600">Liburan mewah</p>
            </div>
        </div>
    </section>

    <!-- Featured Properties -->
    <section class="container mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold mb-6">Properti pilihan kami</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @forelse($featuredProperties as $property)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                <img src="{{ $property->image_url ?? 'https://picsum.photos/300/200?random=' . $property->id }}"
                     alt="{{ $property->name }}"
                     class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-1">{{ $property->name }}</h3>
                    <p class="text-sm text-gray-600 mb-2">{{ $property->location }}</p>
                    <div class="flex items-center mb-2">
                        <div class="bg-blue-800 text-white px-2 py-1 rounded text-sm font-bold">
                            {{ $property->rating }}
                        </div>
                        <span class="ml-2 text-sm text-gray-600">{{ $property->total_reviews }} ulasan</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-xl font-bold text-gray-900">Rp {{ number_format($property->price_per_night, 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-600">per malam</p>
                        </div>
                        @if($property->free_cancellation)
                        <span class="text-xs text-green-600 font-semibold">Gratis pembatalan</span>
                        @endif
                    </div>
                    <a href="{{ route('property.show', $property->id) }}"
                       class="mt-3 block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-2 rounded font-semibold">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-4 text-center py-8 text-gray-500">
                Belum ada properti tersedia
            </div>
            @endforelse
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#003B95] text-white mt-12">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="font-bold mb-4">Tentang Kami</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:underline">Cara kerja</a></li>
                        <li><a href="#" class="hover:underline">Karir</a></li>
                        <li><a href="#" class="hover:underline">Press</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold mb-4">Dukungan</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:underline">Pusat Bantuan</a></li>
                        <li><a href="#" class="hover:underline">Hubungi Kami</a></li>
                        <li><a href="#" class="hover:underline">Kebijakan Privasi</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold mb-4">Partner</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:underline">Daftarkan properti</a></li>
                        <li><a href="#" class="hover:underline">Program Afiliasi</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-4 text-2xl">
                        <a href="#" class="hover:text-blue-300"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="hover:text-blue-300"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="hover:text-blue-300"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-blue-800 mt-8 pt-8 text-center text-sm">
                <p>&copy; 2025 Booking Clone. Dibuat dengan Laravel 11 & PostgreSQL</p>
            </div>
        </div>
    </footer>

    <script>
        let adults = 2;
        let children = 0;
        let rooms = 1;

        document.getElementById('guestBtn').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('guestDropdown').classList.toggle('hidden');
        });

        function changeGuest(type, delta) {
            if (type === 'adults') {
                adults = Math.max(1, adults + delta);
                document.getElementById('adultsDisplay').textContent = adults;
                document.getElementById('adults').value = adults;
            } else if (type === 'children') {
                children = Math.max(0, children + delta);
                document.getElementById('childrenDisplay').textContent = children;
                document.getElementById('children').value = children;
            } else if (type === 'rooms') {
                rooms = Math.max(1, rooms + delta);
                document.getElementById('roomsDisplay').textContent = rooms;
                document.getElementById('rooms').value = rooms;
            }
            updateGuestDisplay();
        }

        function updateGuestDisplay() {
            let text = `${adults} dewasa`;
            if (children > 0) text += ` · ${children} anak`;
            text += ` · ${rooms} kamar`;
            document.getElementById('guestDisplay').textContent = text;
        }

        function closeGuestDropdown() {
            document.getElementById('guestDropdown').classList.add('hidden');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('#guestBtn') && !e.target.closest('#guestDropdown')) {
                closeGuestDropdown();
            }
        });
    </script>
</body>
</html>
