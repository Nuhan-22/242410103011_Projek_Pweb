<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-5xl bg-white shadow-md rounded-md flex flex-wrap">
        <!-- Registration Form -->
        <div class="w-full md:w-1/2 p-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6">Daftar dulu yuk!</h2>
            <p class="text-gray-500 mb-4">Akses lebih banyak fitur dengan daftar.</p>
            <form action="{{ route('register.store') }}" method="POST" class="space-y-4">
                @csrf
                <!-- Username Field -->
                <div>
                    <label for="username" class="block text-gray-600 mb-1">Username</label>
                    <input id="username" name="username" type="text" placeholder="Masukkan Username"
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 @error('username') border-red-500 @enderror"
                        value="{{ old('username') }}">
                    @error('username')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-gray-600 mb-1">Email</label>
                    <input id="email" name="email" type="email" placeholder="Masukkan Alamat Email"
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- First Name Field -->
                <div>
                    <label for="nama_depan" class="block text-gray-600 mb-1">Nama Depan</label>
                    <input id="nama_depan" name="nama_depan" type="text" placeholder="Masukkan Nama Depan"
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 @error('nama_depan') border-red-500 @enderror"
                        value="{{ old('nama_depan') }}">
                    @error('nama_depan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Last Name Field -->
                <div>
                    <label for="nama_belakang" class="block text-gray-600 mb-1">Nama Belakang (Optional)</label>
                    <input id="nama_belakang" name="nama_belakang" type="text" placeholder="Masukkan Nama Belakang (Optional)"
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                        value="{{ old('nama_belakang') }}">
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-gray-600 mb-1">Password</label>
                    <input id="password" name="password" type="password" placeholder="Masukkan Password"
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label for="password_confirmation" class="block text-gray-600 mb-1">Konfirmasi Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Masukkan Konfirmasi Password"
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-[#00CCDD] text-white py-2 rounded-md hover:bg-[#089FAC] transition">
                    Daftar
                </button>
            </form>
            <p class="text-sm text-center text-gray-500 mt-4">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login Sekarang</a>
            </p>
        </div>

        <!-- Illustration (Hidden on Mobile) -->
        <div class="hidden md:flex md:w-1/2 items-center justify-center bg-blue-50">
            <img src="{{ asset('assets/images/register-image-ilustration.svg') }}" alt="Illustration" class="w-full h-auto contain-center">
        </div>
    </div>
</body>
</html>
