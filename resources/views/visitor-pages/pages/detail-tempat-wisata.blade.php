@extends('visitor-pages.layouts.app')

@section('title', $namaTempat ?? 'Nama Tempat')

@section('content')

<div class="w-full bg-white shadow-none border-spacing-1 border-gray-400">
    <div class="max-w-screen-xl mx-auto flex items-center justify-between px-8 py-12 space-x-8">
        <!-- Image Section -->
        <div class="flex-shrink-0 w-1/2 over" style="width: 600px; height: 400px">
            @if ($destination->gambar_tempat_wisata && $destination->gambar_tempat_wisata->first())
                <img id="destinationImage"
                    src="{{ asset($destination->gambar_tempat_wisata->first()->image_url) }}"
                    alt="{{ $destination->nama }}"
                    class="w-full h-full object-cover rounded-lg shadow-lg"
                    style="object-fit: cover; display: block;">
            @else
                <img id="destinationImage"
                    src="{{ asset('assets/images/default-image.jpg') }}"
                    alt="Default Image"
                    class="w-full h-full object-cover rounded-lg shadow-lg">
            @endif

        </div>



        <!-- Right Section: Details -->
        <div class="flex flex-col w-1/2 space-y-4">
            <h1 class="text-5xl font-semibold text-gray-600">{{ $destination->nama }}</h1>

        <!-- Rating Section -->
        <div class="flex items-center">
            @php
                // Filter out reviews with 0, null, or empty ratings
                $validUlasan = collect($destination['ulasan'])->filter(function ($ulasan) {
                    return !empty($ulasan['nilai_rating']) && $ulasan['nilai_rating'] > 0;
                });

                // Calculate average rating
                $totalRatings = $validUlasan->count();
                $averageRating = $totalRatings > 0
                    ? $validUlasan->avg('nilai_rating')
                    : 0;

                // Determine star distribution
                $filledStars = floor($averageRating); // Number of full stars
                $halfStar = $averageRating - $filledStars >= 0.5; // Check if a half-star is needed
                $emptyStars = 5 - $filledStars - ($halfStar ? 1 : 0); // Remaining stars
            @endphp

            <!-- Render Stars -->
            <span class="text-yellow-500 text-2xl flex">
                @for ($i = 0; $i < $filledStars; $i++)
                    <img class="w-9" src="{{ asset('assets/images/icons/yellow-star.svg') }}" alt="Star">
                @endfor
                @if ($halfStar)
                    <img class="w-9" src="{{ asset('assets/images/icons/half-star.svg') }}" alt="Half Star">
                @endif
                @for ($i = 0; $i < $emptyStars; $i++)
                    <img class="w-9" src="{{ asset('assets/images/icons/gray-star.svg') }}" alt="Gray Star">
                @endfor
            </span>

            <span class="text-gray-500 ml-2 text-xl">| ({{ $totalRatings }} Penilaian)</span>
        </div>


            <!-- Location Section -->
            <div class="flex items-center text-gray-600 mt-4">
                <img class="w-20" src="{{ asset('assets/images/icons/location.svg') }}" alt="">
                <div>
                    <span class="text-lg">{{ $destination->alamat['kota'] }}, {{ $destination->alamat['provinsi'] }}</span>
                    <a href="{{ $destination->link_gmaps }}" class="text-blue-500 underline mt-2 text-sm block">
                        <img src="{{ asset('assets/images/icons/look-at-google-maps.svg') }}" alt="">
                    </a>
                </div>
            </div>

            <!-- Ticket Prices Section -->
            <div class="mt-6 space-y-2">
                <div class="flex items-center">
                    <img class="mr-2" src="{{ asset('assets/images/icons/tickets.svg') }}" alt="">
                    <h2 class="text-2xl font-semibold text-cyan-500">Harga Tiket</h2>
                </div>
                <div class="flex items-center space-x-4 text-gray-600">
                    <!-- First Price Section -->
                    @foreach ($destination->tipe_tiket as $ticket)
                        <div class="text-lg">
                            <span class=" font-semibold">{{ $ticket['nama_tipe'] }}</span><br>
                            @if ($ticket->hari[0]->nama_hari != $ticket->hari[1]->nama_hari )
                            <span>{{ $ticket->hari[0]->nama_hari }} - {{ $ticket->hari[1]->nama_hari  }}</span><br>
                            @else
                            <span>{{ $ticket->hari[0]->nama_hari }}</span><br>
                            @endif
                            <span class="font-bold text-cyan-500">Rp {{ number_format($ticket['harga'], 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            @php
                $whatsappLink = $sosialMedia['Whatsapp'];
            @endphp

            <!-- WhatsApp Contact Button -->
            <div class="mt-6 max-w-sm">
                <a href="{{ $whatsappLink ?: '#' }}"
                   class="{{ $whatsappLink ? 'bg-green-500 hover:bg-green-600 text-white' : 'bg-gray-300 text-gray-500 cursor-not-allowed' }}
                          flex items-center justify-center px-6 py-3 rounded-lg text-lg font-medium space-x-3 transition"
                   title="{{ $whatsappLink ? '' : 'WhatsApp link is not available' }}">
                    <img class="h-6 w-6" src="{{ asset('assets/images/icons/whatsapp.svg') }}" alt="">
                    <span>WhatsApp Pengelola</span>
                </a>
            </div>
            <div class="mt-6 max-w-sm">
                <a
                class="flex items-center justify-center px-6 py-3 rounded-lg text-lg font-medium space-x-3 transition bg-cyan-500 text-white hover:bg-cyan-600"
                href="{{ route('destination.booking', ['tempat-wisata' => $destination->id_tempat_wisata]) }}">Beli Tiket</a>
            </div>
        </div>
    </div>

    <!-- Description Section -->
    <div class="px-32 py-7">
        <div class="bg-gray-100 flex justify-center items-center">
            <div class="bg-white shadow-md rounded-lg p-6 max-w-full w-full">
                @if (!empty(array_filter($sosialMedia)))
                    <h1 class="text-xl font-bold text-cyan-500 mb-4">Sosial Media</h1>
                    <div class="flex items-center space-x-4">
                        <!-- Instagram -->
                        @if(!empty($sosialMedia['instagram']))
                        <div class="flex items-center">
                            <img src="https://img.icons8.com/fluency/48/000000/instagram-new.png" alt="Instagram" class="w-6 h-6 mr-2" />
                            <a href="{{ $sosialMedia['instagram'] }}" target="_blank" class="text-lg font-medium">Instagram</a>
                        </div>
                        <span class="text-gray-600">|</span>
                        @endif
                        <!-- Website -->
                        @if(!empty($sosialMedia['website']))
                        <div class="flex items-center">
                            <img src="https://img.icons8.com/color/48/000000/internet.png" alt="Website" class="w-6 h-6 mr-2" />
                            <a href="{{ $sosialMedia['website'] }}" target="_blank" class="text-lg font-medium">Website</a>
                        </div>
                        <span class="text-gray-600">|</span>
                        @endif
                        <!-- YouTube -->
                        @if(!empty($sosialMedia['youtube']))
                        <div class="flex items-center">
                            <img src="https://img.icons8.com/color/48/000000/youtube-play.png" alt="YouTube" class="w-6 h-6 mr-2" />
                            <a href="{{ $sosialMedia['youtube'] }}" target="_blank" class="text-lg font-medium">YouTube</a>
                        </div>
                        <span class="text-gray-600">|</span>
                        @endif
                        <!-- TikTok -->
                        @if(!empty($sosialMedia['tiktok']))
                        <div class="flex items-center">
                            <img src="https://img.icons8.com/fluency/48/000000/tiktok.png" alt="TikTok" class="w-6 h-6 mr-2" />
                            <a href="{{ $sosialMedia['tiktok'] }}" target="_blank" class="text-lg font-medium">Tiktok</a>
                        </div>
                        @endif
                    </div>
                @endif



                <h1 class="text-xl font-bold text-cyan-500 mb-4">Tentang {{ $destination->nama }}</h1>
                <p class="text-gray-700 bg-gray-100 p-4 rounded-md mb-6">
                    {{ $destination->deskripsi }}
                </p>
                <h2 class="text-lg font-bold text-cyan-500 mb-3">Fasilitas Wisatawan</h2>
                <ul class="space-y-2">
                    @foreach ($destination->fasilitas as $fasilitas)
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-cyan-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">{{ $fasilitas['nama_fasilitas'] }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="bg-white py-7 px-32">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-bold text-cyan-600 mb-4">Rating dan Ulasan</h2>
            @if (\Illuminate\Support\Facades\Auth::check())
            @php
                // Check if the user has already posted a review
                $userHasReviewed = $destination->ulasan->contains(function ($ulasan) {
                    return $ulasan->id_pengguna === \Illuminate\Support\Facades\Auth::user()->id_pengguna;
                });
            @endphp
            <div id="comment-section" class="mb-6">
                @if (!$userHasReviewed)
                    <button id="tambah-ulasan" class="text-cyan-600  px-4 py-2 rounded-lg hover:bg-cyan-600 hover:text-white mb-4">
                        Tambah Ulasan
                    </button>
                    <div id="comment-form" class="flex flex-col gap-4 hidden">
                        <div class="flex items-center gap-4">
                            <img
                                src="{{ empty(\Illuminate\Support\Facades\Auth::user()->foto_profil) ? 'https://img.icons8.com/ios-filled/35/ffffff/user.png' : \Illuminate\Support\Facades\Auth::user()->foto_profil }}"
                                alt="User  Profile"
                                class="w-12 h-12 p-1 rounded-full bg-cyan-500">
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800">
                                    {{ \Illuminate\Support\Facades\Auth::user()->nama_depan . ' ' . \Illuminate\Support\Facades\Auth::user()->nama_belakang }}
                                </p>
                                <form action="{{ route('comment.store', $destination->id_tempat_wisata) }}" method="post">
                                    @csrf

                                    <div class="block">
                                        <div class="flex">
                                            <span class="star" data-value="1">
                                                <img src="{{ asset('assets/images/icons/gray-star.svg') }}" alt="Star" class="w-5 h-5">
                                            </span>
                                            <span class="star" data-value="2">
                                                <img src="{{ asset('assets/images/icons/gray-star.svg') }}" alt="Star" class="w-5 h-5">
                                            </span>
                                            <span class="star" data-value="3">
                                                <img src="{{ asset('assets/images/icons/gray-star.svg') }}" alt="Star" class="w-5 h-5">
                                            </span>
                                            <span class="star" data-value="4">
                                                <img src="{{ asset('assets/images/icons/gray-star.svg') }}" alt="Star" class="w-5 h-5">
                                            </span>
                                            <span class="star" data-value="5">
                                                <img src="{{ asset('assets/images/icons/gray-star.svg') }}" alt="Star" class="w-5 h-5">
                                            </span>
                                        </div>

                                        <input type="hidden" id="rating" name="rating" value="0">
                                    </div>
                                    <input
                                        name="komentar"
                                        type="text"
                                        aria-label="Isi komentar"
                                        placeholder="Tulis komentar anda di sini..."
                                        class="w-full border-b focus:outline-none focus:border-cyan-600">

                                    <button type="submit" id="kirim-ulasan" class="  bg-cyan-600 px-4 py-2 rounded-lg hover:bg-cyan-700 text-white mb-4">
                                        Kirim Ulasan
                                    </button>
                                </form>

                        </div>
                    </div>
                @else
                    <p class="text-gray-600 mb-4">Anda sudah memberikan ulasan untuk destinasi ini.</p>
                @endif
            </div>
            @endif

            @foreach ($destination->ulasan as $ulasan)
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

{{-- Script tambah ulasan --}}
<script>
    document.querySelector('#tambah-ulasan').addEventListener('click', () => {
        const commentForm = document.getElementById('comment-form');
        commentForm.classList.toggle('hidden');
        // Check if the class list has 'hidden', then add a 'text-white' class, else remove the class
        if (commentForm.classList.contains('hidden')) {
            commentForm.classList.add('text-white');
            commentForm.classList.add('bg-cyan-600');
        } else {
            commentForm.classList.remove('bg-cyan-600');
            commentForm.classList.remove('text-white');
        }
    });
</script>


{{-- Script klik bintang --}}
<script>
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('rating');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const value = star.getAttribute('data-value');
            ratingInput.value = value;

            // Update the star display
            stars.forEach(s => {
                if (s.getAttribute('data-value') <= value) {
                    s.innerHTML = '<img src="{{ asset('assets/images/icons/yellow-star.svg') }}" alt="Star" class="w-5 h-5">';
                } else {
                    s.innerHTML = '<img src="{{ asset('assets/images/icons/gray-star.svg') }}" alt="Gray Star" class="w-5 h-5">';
                }
            });
        });
    });
</script>


<style>
    .star {
        cursor: pointer;
    }
</style>

</div>




@endsection
