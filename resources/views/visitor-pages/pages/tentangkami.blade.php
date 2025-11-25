@extends('visitor-pages.layouts.app')

@section('title', 'Tentang Kami')

@section('content')

<!-- Header Section -->
<div class="bg-cyan-500 text-white text-center mx-auto" style="height: 380px; width: 100%;">
    <div class="flex flex-col justify-center h-full">
        <h1 class="font-semibold mb-2" style="font-size: 50px">Tentang Visitnusantara</h1>
        <p class="text-lg " style="font-size: 25px">Sistem informasi wisata daerah berbasis website</p>
    </div>
</div>

<!-- Content Section -->
<div class="container mx-auto px-6 py-10">
    <h2 class=" font-semibold text-[#656565] mb-4" style="font-size:30px">Selamat datang di Visitnusantara !</h2>
    <p class="text-gray-600 leading-relaxed font-normal" style="font-size: 20px">
        Selamat datang di VisitNusantara, platform informasi wisata daerah di Indonesia yang dirancang 
        untuk memperkenalkan keindahan dan kekayaan budaya Nusantara kepada dunia. Kami hadir untuk menghubungkan 
        para pengelola wisata dengan wisatawan, memberikan solusi promosi yang efektif, sekaligus memudahkan Anda menemukan
         destinasi yang sesuai dengan minat dan kebutuhan.
    </p>
</div>

<!-- Misi Kami Section -->
<div class="py-10">
    <div class="container mx-auto px-6">
        <h2 class="font-semibold text-[#656565] mb-4" style="font-size:30px">Misi Kami</h2>
        <ul class="list-disc list-inside text-gray-600 leading-relaxed font-normal" style="font-size: 20px">
            <li>Memajukan Pariwisata Lokal: Memberikan pengelola wisata kesempatan untuk mempromosikan destinasi unggulannya.</li>
            <li>Menginspirasi Wisatawan: Menyajikan informasi lengkap dan terpercaya agar wisatawan dapat merencanakan perjalanan impian mereka dengan mudah.</li>
            <li>Melestarikan Budaya & Alam: Mendukung pariwisata yang berkelanjutan untuk menjaga keindahan alam dan budaya lokal.</li>
        </ul>
    </div>
</div>

<!-- Apa yang Kami Tawarkan Section -->
<div class="container mx-auto px-6 py-10">
    <h2 class="font-semibold text-[#656565] mb-4" style="font-size:30px">Apa yang Kami Tawarkan?</h2>
    <ul class="list-disc list-inside text-gray-600 space-y-2 font-normal" style="font-size: 20px">
        <li>
            Informasi Lengkap: Temukan destinasi wisata dari Sabang hingga Merauke dengan ulasan, foto, dan peta lokasi.
        </li>
        <li>
            Platform Promosi: Fasilitas bagi pengelola wisata untuk mempublikasikan tempat wisata, acara, dan layanan mereka secara online.
        </li>
        <li>
            Konektivitas & Komunitas: Membuka ruang bagi wisatawan dan pengelola untuk berbagi pengalaman, ulasan, dan ide.
        </li>
    </ul>
</div>


</div>


@endsection