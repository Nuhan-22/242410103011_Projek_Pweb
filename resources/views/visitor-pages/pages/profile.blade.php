@extends('visitor-pages.layouts.app')

@section('title', 'Profile')

@section('content')
<div class="bg-gray-100 min-h-screen justify-center">
    <div class=" w-2/4 mx-auto mt-14 bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center space-x-4">
            <img class="w-24 h-24 rounded-full border border-gray-300" src="{{ (!empty($pengguna->foto_profil)) ?  asset('storage/' . $pengguna->foto_profil)  : "https://imebehavioralhealth.com/wp-content/uploads/2021/10/user-icon-placeholder-1.png" }}" alt="Profile Picture">
            <div>
                <div class="flex space-x-4">
                    <h1 class="text-2xl font-semibold text-gray-700">{{ $pengguna->nama_depan }} {{ $pengguna->nama_belakang }}</h1>
                    <a href=" {{ route('profile.settings') }}" class="text-white bg-cyan-500 p-2 rounded-lg hover:bg-cyan-700 transition-opacity">Pengaturan</a>
                </div>
                <p class="text-gray-500">{{ $pengguna->username }}</p>
                <p class="text-gray-500">{{ $pengguna->email }}</p>
                {{-- <p class="text-gray-400 text-sm">Role: {{ $pengguna->role->name ?? 'N/A' }}</p> --}}
            </div>
        </div>

        <div class="mt-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Profile Details</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600">First Name:</p>
                    <p class="font-medium text-gray-800">{{ $pengguna->nama_depan }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Last Name:</p>
                    <p class="font-medium text-gray-800">{{ $pengguna->nama_belakang }}</p>
                </div>
            </div>
            @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-4 text-green-700 rounded-md">
                {{ session('success') }}
            </div>
        @endif
        </div>

        <div class="mt-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">User Reviews</h2>
            <div class="space-y-4">
                @foreach ($ulasans as $ulasan)
                <div class="flex items-start gap-4 mb-6">
                    <div class="w-12 h-12 bg-cyan-200 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="text-cyan-600 w-6 h-6" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <h3 class="font-semibold text-gray-800">
                                {{ $ulasan->pengguna['nama_depan'] . " " . $ulasan->pengguna['nama_belakang'] }}
                            </h3>
                            <div class="flex items-center">
                                @php
                                    $rating = $ulasan->nilai_rating;
                                    $filledStars = floor($rating); // Full stars
                                    $halfStar = $rating - $filledStars >= 0.5; // Half star check
                                    $emptyStars = 5 - $filledStars - ($halfStar ? 1 : 0); // Remaining empty stars
                                @endphp

                                <!-- Render full stars -->
                                @for ($i = 0; $i < $filledStars; $i++)
                                    <img src="{{ asset('assets/images/icons/yellow-star.svg') }}" alt="Star" class="w-5 h-5">
                                @endfor

                                <!-- Render half star if needed -->
                                @if ($halfStar)
                                    <img src="{{ asset('assets/images/icons/half-star.svg') }}" alt="Half Star" class="w-5 h-5">
                                @endif

                                <!-- Render empty stars -->
                                @for ($i = 0; $i < $emptyStars; $i++)
                                    <img src="{{ asset('assets/images/icons/gray-star.svg') }}" alt="Gray Star" class="w-5 h-5">
                                @endfor
                            </div>
                        </div>

                        <p class="text-gray-600 mt-1">{{ $ulasan->isi_komentar }}</p>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
