<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-4xl bg-white shadow-md rounded-md flex flex-wrap">
        <!-- Login Form -->
        <div class="w-full md:w-1/2 p-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6">Login dulu yuk!</h2>
            <p class="text-gray-500 mb-4">Akses lebih banyak fitur dengan login.</p>
            <!-- Laravel POST Form -->
            <form method="POST" action="{{ route('login.authenticate') }}" class="space-y-4">
                @csrf <!-- Laravel CSRF Token -->
                <div>
                    <label for="email" class="block text-gray-600 mb-1">Email atau Username</label>
                    <input id="email" name="email" type="email" placeholder="Masukkan Alamat Email atau Username anda" required
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
                <div>
                    <label for="password" class="block text-gray-600 mb-1">Password</label>
                    <input id="password" name="password" type="password" placeholder="Masukkan Password" required
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
                @if (session('success'))
                    <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-4 text-green-700 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-4 text-red-700 rounded-md">
                        <ul class="list-disc ml-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
               
                <button type="submit"
                    class="w-full bg-[#00CCDD] text-white py-2 rounded-md hover:bg-[#089FAC] transition">Login</button>
            </form> 
            <p class="text-sm text-center text-gray-500 mt-4">
                Belum punya akun? <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Daftar Sekarang</a>
            </p>
        </div>

        <!-- Illustration (Hidden on Mobile) -->
        <div class="hidden md:flex w-1/2 bg-blue-50 items-center justify-center">
            <img src="{{ asset('assets/images/login-image-ilustration.svg') }}" alt="Illustration" class="w-full h-auto">
        </div>
    </div>
</body>
</html>
