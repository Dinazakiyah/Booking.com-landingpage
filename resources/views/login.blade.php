<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Booking.id</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 flex items-center justify-center h-screen">
    <form action="{{ url('/login') }}" method="POST" class="bg-white shadow-lg p-8 rounded-lg w-96">
        @csrf
        <h2 class="text-2xl font-bold text-center mb-6">Login ke Booking.id</h2>

        @if(session('error'))
        <div class="text-red-600 text-center mb-4">{{ session('error') }}</div>
        @endif

        <label>Email</label>
        <input type="email" name="email" class="w-full border p-3 rounded mb-4" required>

        <label>Password</label>
        <input type="password" name="password" class="w-full border p-3 rounded mb-4" required>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white p-3 rounded">Login</button>

        <p class="text-center text-sm mt-4">Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar</a>
        </p>
    </form>
</body>
</html>
