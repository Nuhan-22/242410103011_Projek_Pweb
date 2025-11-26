@extends('visitor-pages.layouts.app')

@section('title', $namaTempat ?? 'Nama Tempat')

@section('content')

<div class="container mx-auto p-4 max-w-4xl ">
    <h1 class="text-2xl font-bold mb-4">Detail Pesanan</h1>

    <div class="bg-white shadow-md rounded p-6 mb-4">
            <!-- Detail Tiket -->
            <div class="bg-white p-4 rounded-lg border mb-4">
                <h4 class="text-cyan-500 font-semibold mb-2">Detail Pembelian Tiket</h4>
                <div class="flex justify-between text-gray-700 text-sm">
                    <p>Destinasi</p>
                    <p>{{ $destination->nama }}</p>
                </div>
                <div class="flex justify-between text-gray-700 text-sm">
                    <p>Tanggal Kunjungan</p>
                    <p>{{ \Carbon\Carbon::parse($pesananTiket->tikets->first()->tanggal_kunjungan)->format('d/m/Y') }}</p>
                </div>
                <div class="flex justify-between text-gray-700 text-sm">
                    <p>Tanggal Berlaku Tiket</p>
                    <p>{{ \Carbon\Carbon::parse($pesananTiket->tikets->first()->tanggal_kunjungan)->format('d/m/Y') }} (Hari Biasa)</p>
                </div>
                <div class="flex justify-between text-gray-700 text-sm">
                    <p>Jumlah Tiket</p>
                    <p>{{ $pesananTiket->tikets->first()->jumlah_tiket }}</p>
                </div>
                <div class="flex justify-between text-gray-700 text-sm">
                    <p>Harga Per Tiket</p>
                    <p>Rp. {{ number_format($destination->tipe_tiket->first()->harga, 0, ',', '.') }}</p>
                </div>
                <div class="flex justify-between text-gray-700 text-sm">
                    <p>Total</p>
                    <p>Rp. {{ number_format($destination->tipe_tiket->first()->harga * $pesananTiket->tikets->first()->jumlah_tiket , 0, ',', '.') }}</p>
                </div>

            </div>


    </div>

    <div class="bg-white shadow-md rounded p-6">
      <h2 class="text-xl font-bold mb-2">Pembayaran</h2>
      <p>Transfer {!! (!isset($pesananTiket->pembayaran->rekening_bank->nama_bank)) ? '<span class="text-red-600">(Rekening Telah dihapus)</span>' : ($pesananTiket->pembayaran->rekening_bank->nama_bank) !!}</p>
      <div class="flex justify-between mt-2">
        <span>Total</span>
        <span>{{ number_format($destination->tipe_tiket->first()->harga * $pesananTiket->tikets->first()->jumlah_tiket , 0, ',', '.') }}</span>
      </div>
      <div class="flex justify-between mt-2">
        <span>Status</span>
        @if ($pesananTiket->status == \App\Helpers\Enum\StatusPesananTiket::DIPROSES->value)
          <span class="px-2 py-1 rounded" style="color: rgb(255, 186, 29); background-color: rgb(255, 246, 219)">
            Menunggu Verifikasi
          </span>
        @elseif ($pesananTiket->status == \App\Helpers\Enum\StatusPesananTiket::SELESAI->value)
          <span class="px-2 py-1 rounded font-semibold" style="color: rgb(0, 204, 102); background-color: rgb(215, 255, 235)">
            Selesai
          </span>
        @elseif ($pesananTiket->status == \App\Helpers\Enum\StatusPesananTiket::DITOLAK->value)

          <span class="px-2 py-1 rounded" style="color: rgb(255, 84, 84); background-color: rgb(255, 246, 219)">
            Ditolak
          </span>
        @endif

    </div>
        <!-- Button to trigger the popup -->
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4" id="openModal">Lihat Bukti Pembayaran</button>
    </div>
  </div>


          <!-- Modal Structure -->
          <div id="myModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="relative bg-white rounded-lg p-4">
                <span class="absolute top-2 right-2 text-gray-600 cursor-pointer" id="closeModal">&times;</span>
                <img class="max-w-full max-h-screen" id="modalImage" src="{{ asset('storage/' . $pesananTiket->pembayaran->bukti_pembayaran) }}" alt="Payment Proof">
            </div>
        </div>

        <script>
            // Get the modal and buttons
            const modal = document.getElementById("myModal");
            const btn = document.getElementById("openModal");
            const span = document.getElementById("closeModal");

            // Open the modal when the button is clicked
            btn.onclick = () => {
            modal.classList.remove("hidden");
            }

            // Close the modal when the close button is clicked
            span.onclick = () => {
            modal.classList.add("hidden");
            }

            // Close the modal when clicking outside of the modal content
            modal.onclick = (event) => {
            if (event.target === modal) {
                modal.classList.add("hidden");
            }
            }
        </script>

@endsection
