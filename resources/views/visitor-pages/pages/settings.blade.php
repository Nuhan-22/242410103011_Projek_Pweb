@extends('visitor-pages.layouts.app')

@section('title', 'Pengaturan')

@section('content')
<div class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg max-w-3xl w-full p-6">
        <h1 class="text-2xl font-semibold text-cyan-500 mb-6">Pengaturan</h1>
        <form action="{{ route('profile.settings.update') }}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
            <!-- Foto Profil -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Foto Profil</label>
                <div class="flex items-center space-x-4">
                    <img id="profile-picture" src="{{ !empty($pengguna->foto_profil) ? asset('storage/' . $pengguna->foto_profil) : 'https://imebehavioralhealth.com/wp-content/uploads/2021/10/user-icon-placeholder-1.png' }}"
                         alt="Foto Profil" class="w-16 h-16 rounded-full border border-gray-300">
                    <input type="file" name="foto_profil" class="text-sm text-gray-600" onchange="profilePictureOnChange(event);">
                </div>
                @error('foto_profil')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nama Depan dan Nama Belakang -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="nama_depan" class="block text-gray-700 font-medium mb-1">Nama Depan</label>
                    <input type="text" id="nama_depan" name="nama_depan" value="{{ old('nama_depan', $pengguna->nama_depan) }}"
                        placeholder="Masukkan nama depan"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                    @error('nama_depan')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="nama_belakang" class="block text-gray-700 font-medium mb-1">Nama Belakang</label>
                    <input type="text" id="nama_belakang" name="nama_belakang" value="{{ old('nama_belakang', $pengguna->nama_belakang) }}"
                        placeholder="Masukkan nama belakang"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                    @error('nama_belakang')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $pengguna->email) }}"
                    placeholder="Masukkan email"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                @error('email')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Username -->
            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-medium mb-1">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username', $pengguna->username) }}"
                    placeholder="Masukkan username"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                @error('username')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium mb-1">Kata Sandi</label>
                <input type="password" id="password" name="password" placeholder="Masukkan kata sandi baru"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                @error('password')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-4">
                <label for="password-confirm" class="block text-gray-700 font-medium mb-1">Konfirmasi Kata Sandi</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi kata sandi baru"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                @error('password_confirmation')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol Simpan Perubahan -->
            <div class="mt-6 flex space-x-4">
                <button type="submit"
                    class="w-full bg-cyan-500 text-white font-medium py-2 px-4 rounded-md hover:bg-cyan-600 focus:outline-none focus:ring-2 focus:ring-cyan-500">
                    Simpan Perubahan
                </button>

                <!-- Tombol Batal Perubahan -->
                <a href="/profile"
                    class="w-full text-center bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Batal Perubahan
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    function profilePictureOnChange(event){
        const file = event.target.files[0];
        let profilePicture = document.getElementById('profile-picture');
        profilePicture.src = URL.createObjectURL(file);
    }
</script>
@endsection
