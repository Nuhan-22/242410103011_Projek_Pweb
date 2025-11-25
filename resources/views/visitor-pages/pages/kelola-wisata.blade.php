@extends('visitor-pages.layouts.app')

@section('title', 'Kelola Wisata')

@section('content')

<div class="flex flex-col min-h-screen">

    <div class="bg-cyan-500 text-white text-center mx-auto" style="height: 380px; width: 100%;">
        <div class="flex flex-col justify-center h-full">
            <h1 class="font-semibold mb-2" style="font-size: 50px">Kelola wisata</h1>
            <p class="text-lg " style="font-size: 25px">Sistem informasi wisata daerah berbasis website</p>
        </div>
    </div>

    <div class="container mx-auto px-6 py-10">
        <h2 class=" font-semibold text-[#00CCDD] mb-4" style="font-size:30px">Bagaimana Sih Cara Kelola Wisata di Visitnusantara ?</h2>
        <ul class="list-disc list-inside text-gray-600 leading-relaxed font-normal" style="font-size: 20px">
            <li>Anda dapat membuat akun terlebih dahulu dihalaman register</li>
            <li>Anda juga dapat langsung menghubungi pihak kami di <a href="https://wa.me/6285103080404" style="color: blue">https://wa.me/6285103080404</a></li>
        </ul>
    </div>

</div>



@endsection
