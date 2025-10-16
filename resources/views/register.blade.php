<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - Booking.id</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-yellow-50 flex items-center justify-center h-screen">
    <form action="{{ url('/register') }}" method="POST" class="bg-white shadow-lg p-8 rounded-lg w-96">
        @csrf
        <h2 class="text-2xl font-bold text-center mb-6">Daftar Akun Baru</h2>

        @if ($errors->any())
        <div class="text-red-600 mb-4 text-sm">
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <label>Nama Lengkap</label>
        <input type="text" name="name" class="w-full border p-3 rounded mb-4" required>

        <label>Email</label>
        <input type="email" name="email" class="w-full border p-3 rounded mb-4" required>

        <label>Password</label>
        <input type="password" name="password" class="w-full border p-3 rounded mb-4" required>

        <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white p-3 rounded">Daftar</button>

        <p class="text-center text-sm mt-4">Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
        </p>
    </form>
</body>
</html>
