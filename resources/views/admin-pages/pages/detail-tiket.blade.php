@extends('admin-pages.layouts.app')

@section('title', 'Kelola Tiket')

@section('content')

<div class="bg-white rounded-lg shadow-lg p-6 w-2/4 mx-auto mt-10">
    <!-- Detail Tiket -->
    <div class="mb-4">
      <h2 class="text-lg font-bold">Detail Tiket</h2>
      <p class="text-gray-600">ID Pembayaran : <span class="font-semibold">123</span></p>
      <div class="mt-2 p-4 bg-gray-100 rounded-lg flex justify-between items-center">
        <div>
          <p class="text-gray-800 font-medium">Tempat Wisata : Gunung Bromo</p>
          <p class="text-gray-600 text-sm">Tanggal Keberangkatan : 21/12/2024 (Hari Biasa)</p>
        </div>
        <p class="text-cyan-500 font-semibold">2 Tiket</p>
      </div>
    </div>

    <!-- Pembayaran -->
    <div class="mb-4">
      <h2 class="text-lg font-bold">Pembayaran</h2>
      <div class="mt-2 p-4 bg-gray-100 rounded-lg">
        <p class="text-gray-800 font-medium">Metode Pembayaran</p>
        <p class="text-gray-600 text-sm">Transfer</p>
        <p class="text-gray-800 font-medium">Melalui Bank</p>
        <p class="text-gray-600 text-sm">BRI</p>
        <p class="text-gray-800 font-medium">Total Pembayaran</p>
        <p class="text-gray-600 text-sm">Rp 12.000</p>
        <button class="mt-3 w-full bg-cyan-500 text-white font-semibold py-2 rounded hover:bg-cyan-600">
          Lihat Bukti Pembayaran
        </button>
      </div>
    </div>

    <!-- Tiket -->
    <div class="mb-4">
      <h2 class="text-lg font-bold">Tiket</h2>
      <div class="mt-2 p-4 bg-gray-100 rounded-lg">
        <input
          type="file"
          class="w-full text-gray-600 bg-gray-200 rounded py-2 px-3 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-cyan-500"
        />
      </div>
    </div>

    <div class="flex space-x-4">
        <!-- Konfirmasi Verifikasi -->
        <button class="w-full bg-cyan-500 text-white font-semibold py-3 rounded hover:bg-cyan-600">
            Konfirmasi Verifikasi
        </button>
        <!-- Tolak Verifikasi -->
        <button class="w-full bg-red-600 text-white font-semibold py-3 rounded hover:bg-red-700">
            Tolak Verifikasi
        </button>
    </div>


    <!-- Terima tiket -->
    <button class="w-full mt-4 bg-green-600 text-white font-semibold py-3 rounded hover:bg-green-700">
        Terima tiket
        </button>
</div>


<script>
    lightSidebarKelolaTiketBtn()
</script>
<script src="{{ asset('scripts/data-tables.js') }}" type="module"></script>


@endsection
