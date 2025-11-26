@extends('visitor-pages.layouts.app')

@section('title', 'Homepage')

@section('content')



 <script>
document.addEventListener('DOMContentLoaded', () => {
    let currentIndex = 0;
    const carouselWrapper = document.getElementById('carousel-wrapper');
    const slides = carouselWrapper.children;
    const totalSlides = slides.length;

    // Function to move the carousel
    function moveCarousel() {
        // Move to the next slide by adjusting the transform property of the wrapper
        currentIndex = (currentIndex + 1) % totalSlides;
        carouselWrapper.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    // Auto-move the carousel every 3 seconds
    setInterval(moveCarousel, 6000);
});





     </script>

     {{-- end Carousal script --}}

     {{-- Carousal --}}

     @php
    //  $carousels = [
    //      [
    //      'id' => 1,
    //      'header' => 'Menyaksikan Keajaiban Sunrise di Gunung Bromo',
    //      'description' => 'Nikmati keindahan alam yang memukau saat matahari terbit di salah satu gunung terindah di Indonesia.',
    //      'image' => asset('assets/images/homepage/gunung-bromo.svg')
    //      ],
    //      [
    //      'id' => 2,
    //      'header' => 'Menikmati Keindahan Alam di Bali',
    //      'description' => 'Jelajahi keindahan alam Bali dengan pemandangan pantai yang memukau.',
    //      'image' => asset('assets/images/homepage/pantai-kuta.jpg')
    //      ],
    //  ];
     @endphp

<div class="relative w-full overflow-hidden">
    <div id="carousel-wrapper" class="flex transition-transform duration-1000 ease-in-out">
        @foreach ($carousels as $index => $carousel)
            <div class="carousel-slide w-full flex-shrink-0">
                <div class="relative w-full h-[500px]">
                    <img src="{{ asset($carousel->image_url) }}" alt="{{ $carousel['judul'] }}" class="w-full h-full object-cover" />
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center">
                        <div class="p-12 lg:ml-20 text-left max-w-lg">
                            <h2 class="text-white text-4xl font-bold mb-4">
                                {{ $carousel['judul'] }}
                            </h2>
                            <p class="text-white text-lg mb-6">
                                {{ $carousel['deskripsi'] }}
                            </p>
                            <a href="{{ $carousel['link_button'] }}" class="bg-cyan-500 hover:bg-teal-600 text-white font-semibold py-3 px-6 rounded shadow">
                                Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


{{-- Section pilih seleramu --}}
@php
    $categories = [
        ['name' => 'Alam', 'icon' => 'pilih-selera-icon-alam.svg'],
        ['name' => 'Sejarah', 'icon' => 'pilih-selera-icon-sejarah.svg'],
        ['name' => 'Kuliner', 'icon' => 'pilih-selera-icon-kuliner.svg'],
        ['name' => 'Religi', 'icon' => 'pilih-selera-icon-religi.svg'],
        ['name' => 'Rekreasi', 'icon' => 'pilih-selera-icon-rekreasi.svg'],
        ['name' => 'Bahari', 'icon' => 'pilih-selera-icon-bahari.svg'],
    ];
@endphp

<div class="text-center py-12">
    <h1 class="text-3xl font-extrabold text-cyan-500">Pilih Seleramu</h1>
    <p class="text-gray-500 mt-2 text-lg">Cari tempat wisata berdasarkan kategori tempat wisata kesukaanmu</p>
    <div class="flex justify-center items-center gap-8 mt-10 flex-wrap">
        @foreach ($categories as $category)
            <div class="flex flex-col items-center">
                <div class="w-20 h-20 flex items-center justify-center bg-cyan-100 rounded-full">
                    <img src="{{ asset('assets/images/homepage/' . $category['icon']) }}" alt="{{ $category['name'] }} Icon" class="w-20 h-20">
                </div>
                <p class="text-base font-medium text-gray-700 mt-3">{{ $category['name'] }}</p>
            </div>
        @endforeach
    </div>
</div>
{{-- end of Section pilih seleramu --}}

{{-- tempat wisata populer --}}

    <div class="bg-cyan-500">
    <div class="text-center py-8">
      <h1 class="text-white text-2xl font-bold">
        #12 Tempat Wisata Populer
      </h1>
      <p class="text-white text-lg">
        12 tempat wisata yang paling sering dikunjungi bulan ini
      </p>
    </div>
  </div>

{{-- tempat wisata populer --}}


{{-- top 12 tempat wisata --}}


@php
//         $destinations = [
//         ['id' => 1, 'name' => 'Gunung Bromo', 'image' => asset('assets/images/homepage/cards/gunung-bromo-card.jpg')],
//         ['id' => 2, 'name' => 'Candi Borobudur', 'image' => asset('assets/images/homepage/cards/candi-borobudur-card.jpg')],
//         ['id' => 3, 'name' => 'Raja Ampat', 'image' => 'raja-ampat.jpg'],
//         ['id' => 4, 'name' => 'Pulau Dewata', 'image' => 'pulau-dewata.jpg'],
//         ['id' => 5, 'name' => 'Labuan Bajo', 'image' => ''],
//         ['id' => 6, 'name' => 'Taman Bunaken', 'image' => ''],
//         ['id' => 7, 'name' => 'Kawah Ijen', 'image' => ''],
//         ['id' => 8, 'name' => 'Gili Trawang', 'image' => ''],
//         ['id' => 9, 'name' => 'Tana Toraja', 'image' => ''],
//         ['id' => 10, 'name' => 'Taman Bunaken', 'image' => ''],
//         ['id' => 11, 'name' => 'Kawah Ijen', 'image' => ''],
//         ['id' => 12, 'name' => 'Gili Trawang', 'image' => ''],

// ];
@endphp
<div class="p-8">
    <div class="grid gap-6 justify-center px-9" style="grid-template-columns: repeat(auto-fit, minmax(283px, 1fr));">
        @foreach ($destinations as $destination)
          <!-- Card -->
          <div class="w-[283px] h-[326px] bg-white rounded-lg shadow-lg overflow-hidden relative">
            <!-- Content -->
            <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/60 to-transparent p-4 z-10">
              <h2 class="text-3xl font-bold text-white">{!! str_replace(' ', '<br>', $destination['nama']) !!}</h2>
              <a href="/tempat-wisata/{{ $destination['id_tempat_wisata'] }}" class="mt-3 inline-block font-semibold bg-cyan-500 text-white text-xm py-1 px-16 rounded-full hover:bg-cyan-700 transition">
                Selengkapnya
              </a>
            </div>

            <!-- Badge -->
            <div class="absolute top-5 left-5 bg-cyan-500 text-white font-bold text-sm px-3 py-1 rounded-full z-20">
              {{ $destination['id_tempat_wisata'] }}
            </div>

            <!-- Image -->
            <img
              class="w-full h-full object-cover absolute top-0 left-0 z-0 hover:scale-150"
              src="{{ asset($destination->gambar_tempat_wisata->first()->image_url) }}"
              alt="{{ $destination['nama_tempat'] }}"
              style="transition: 800ms">

          </div>

        @endforeach
    </div>

</div>



@endsection
