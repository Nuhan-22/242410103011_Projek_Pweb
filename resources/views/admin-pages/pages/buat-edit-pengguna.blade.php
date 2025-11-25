@extends('admin-pages.layouts.app')

@section('title', isset($pengguna) ? 'Ubah Pengguna' : 'Buat Pengguna')

@section('content')


<div class="p-4 m-5 bg-white shadow-md rounded-lg overflow-hidden">
    <h2 class="text-2xl font-semibold mb-4">{{ isset($pengguna) ? 'Ubah Pengguna' : 'Buat Pengguna' }}</h2>

    <form action="{{ isset($pengguna) ? route('user.update', $pengguna->id_pengguna) : route('user.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (isset($pengguna))
            @method('PUT')
        @endif

        <div class="space-y-4">
            <!-- First Name -->
            <div>
                <label for="nama_depan" class="block text-sm font-medium text-gray-700">Nama Depan</label>
                <input type="text" id="nama_depan" name="nama_depan" value="{{ old('nama_depan', $pengguna->nama_depan ?? '') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                @error('nama_depan')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Last Name -->
            <div>
                <label for="nama_belakang" class="block text-sm font-medium text-gray-700">Nama Belakang</label>
                <input type="text" id="nama_belakang" name="nama_belakang" value="{{ old('nama_belakang', $pengguna->nama_belakang ?? '') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                @error('nama_belakang')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $pengguna->email ?? '') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Username -->
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username', $pengguna->username ?? '') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                @error('username')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password (only for Create) -->
            @if (!isset($pengguna))
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            @endif

            <!-- Role -->
            <div>
                <label for="id_role" class="block text-sm font-medium text-gray-700">Role</label>
                <select id="id_role" name="id_role" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    <option value="" disabled>Pilih Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id_role }}" {{ (old('id_role', $pengguna->id_role ?? '') == $role->id_role) ? 'selected' : '' }}>
                            {{ $role->nama_role }}
                        </option>
                    @endforeach
                </select>
                @error('id_role')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Profile Picture -->
            <div>
                <label for="foto_profil" class="block text-sm font-medium text-gray-700">Foto Profil</label>
                <input type="file" id="foto_profil" name="foto_profil" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @if (isset($pengguna) && $pengguna->foto_profil)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $pengguna->foto_profil) }}" alt="Foto Profil" class="w-20 h-20 rounded-full object-cover">
                    </div>
                @endif
                @error('foto_profil')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    {{ isset($pengguna) ? 'Simpan Perubahan' : 'Buat pengguna' }}
                </button>
            </div>
        </div>
    </form>
</div>


@endsection
