@extends('visitor-pages.layouts.app')

@section('title', $namaTempat ?? 'Nama Tempat')

@section('content')

<div class="max-w-4xl mx-auto py-8 min-h-screen ">
    <h1 class="text-2xl font-bold mb-4">Pesananku</h1>
<!-- Header Tabs -->
<div class="flex justify-start space-x-4 mb-6">

    @php
        // Define default and selected styles
        $defaultStyle = 'text-cyan-500 border border-cyan-500 hover:bg-cyan-500 hover:text-white';
        $selectedStyle = 'bg-cyan-500 text-white hover:bg-cyan-700';

        // Define colors for each status dynamically
        $statusColors = [
            \App\Helpers\Enum\StatusPesananTiket::DIPROSES->value => $currentStatus === \App\Helpers\Enum\StatusPesananTiket::DIPROSES->value ? $selectedStyle : $defaultStyle,
            \App\Helpers\Enum\StatusPesananTiket::SELESAI->value => $currentStatus === \App\Helpers\Enum\StatusPesananTiket::SELESAI->value ? $selectedStyle : $defaultStyle,
            \App\Helpers\Enum\StatusPesananTiket::DITOLAK->value => $currentStatus === \App\Helpers\Enum\StatusPesananTiket::DITOLAK->value ? $selectedStyle : $defaultStyle,
        ];
    @endphp

    <a href="{{ route('booking.list', ['status' => \App\Helpers\Enum\StatusPesananTiket::DIPROSES->value]) }}"
    class="px-4 py-2 text-sm font-medium rounded-lg {{ $statusColors[\App\Helpers\Enum\StatusPesananTiket::DIPROSES->value] }}">
        Menunggu Verifikasi
    </a>
    <a href="{{ route('booking.list', ['status' => \App\Helpers\Enum\StatusPesananTiket::SELESAI->value]) }}"
    class="px-4 py-2 text-sm font-medium rounded-lg {{ $statusColors[\App\Helpers\Enum\StatusPesananTiket::SELESAI->value] }}">
        Selesai
    </a>
    <a href="{{ route('booking.list', ['status' => \App\Helpers\Enum\StatusPesananTiket::DITOLAK->value]) }}"
    class="px-4 py-2 text-sm font-medium rounded-lg {{ $statusColors[\App\Helpers\Enum\StatusPesananTiket::DITOLAK->value] }}">
        Ditolak
    </a>
  </div>
    <!-- Card List -->
    <div class="space-y-4">

        @foreach ($pesananTiket as $pesanan)
      <!-- Card Item -->
      <div class="bg-white shadow-md rounded-lg p-4 flex items-start">
        <img
          src="
            {{ asset('storage/' . $pesanan->tikets->first()->tipe_tiket->first()->tempat_wisata->first()->gambar_tempat_wisata->first()->url_gambar) }}
          "
          alt="Gambar Wisata"
          class=" w-36 h-20 rounded-md object-cover mr-4"
        />
        <div class="flex-1">
            <a href="{{ route('booking.detail', ['pesanan' => $pesanan->id_pesanan]) }}">
                <h3 class="text-lg font-semibold text-cyan-500 hover:text-cyan-700 cursor-pointer">
                    {{ $pesanan->tikets->first()->tipe_tiket->first()->tempat_wisata->first()->nama }}
                </h3>
            </a>
          <p class="text-sm text-gray-600">Tanggal Berlaku Sampai: {{ \Carbon\Carbon::parse($pesanan->tikets->first()->berlaku_sampai)->format('d/m/Y')}} ({{ $pesanan->tikets->first()->tipe_tiket->first()->nama_tipe }})</p>
          <p class="text-sm text-gray-600">Jumlah: {{ $pesanan->tikets->first()->jumlah_tiket }} Tiket</p>
          @if ($pesanan->status == \App\Helpers\Enum\StatusPesananTiket::DIPROSES->value)
          <p class="text-sm">
            Status:
            <span class="px-2 py-1 rounded" style="color: rgb(255, 186, 29); background-color: rgb(255, 246, 219)">
              Menunggu Verifikasi
            </span>
          </p>
          @elseif ($pesanan->status == \App\Helpers\Enum\StatusPesananTiket::SELESAI->value)
          <p class="text-sm">
            Status:
            <span class="px-2 py-1 rounded font-semibold" style="color: rgb(0, 204, 102); background-color: rgb(215, 255, 235)">
              Selesai
            </span>
            <button class="px-2 py-1 rounded font-semibold text-white bg-cyan-500">
              Download Tiket
            </button>
          </p>
          @elseif ($pesanan->status == \App\Helpers\Enum\StatusPesananTiket::DITOLAK->value)
          <p class="text-sm">
            Status:
            <span class="px-2 py-1 rounded" style="color: rgb(255, 84, 84); background-color: rgb(255, 246, 219)">
              Ditolak
            </span>
          </p>
          @else
          @php
              throw new Exception("Error Status invalid " . $pesanan->status );

          @endphp
          @endif

        </div>
      </div>
        @endforeach

    </div>
  </div>


@endsection
