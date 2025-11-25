@extends('admin-pages.layouts.app')

@section('title', 'Kelola Tiket')

@section('content')

    @if (!empty($pesananTiket))


    <div class="px-4 my-6 bg-white shadow-md rounded-lg overflow-hidden">
        <div class="flex justify-end w-full">
            {{-- <a href="{{ route('destination.add.show') }}" class="p-2 border mr-3 rounded-md border-cyan-500 space-x-1.5 flex w-70 justify-center hover:bg-cyan-500 hover:text-white hover:transition cursor-pointer">
                <img src="{{ asset('assets/images/icons/plus-add.svg') }}" alt="" class=" w-3 text-inherit">
                <span>Tambah Tempat Wisata</span>
            </a> --}}
        </div>


        <table id="data-table" class="table w-full text-sm">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="p-2 align-middle border">#</th>
                    <th class="p-2 align-middle border">Tempat Wisata</th>
                    <th class="p-2 align-middle border">Tanggal Visit</th>
                    <th class="p-2 align-middle border">Nama Pengguna</th>
                    <th class="p-2 align-middle border">Jumlah</th>
                    <th class="p-2 align-middle border">Status</th>
                    <th class="p-2 align-middle border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($pesananTiket as $pesanan)

                    <tr class="hover:bg-gray-50">
                        <!-- Row number -->
                        <td class="p-2 align-middle border">{{ $i }}</td>
                        <!-- Other columns -->
                        <td class="p-2 align-middle border">{{ $pesanan->tikets->first()->tipe_tiket->first()->tempat_wisata()->first()->nama }}</td>
                        <td class="p-2 align-middle border">{{ \Carbon\Carbon::parse($pesanan->tikets->first()->tanggal_kunjungan)->format("d/m/Y") }}</td>
                        <td class="p-2 align-middle border">{{ $pesanan->pengguna->first()->nama_depan }} {{ $pesanan->pengguna->first()->nama_belakang }}</td>
                        <td class="p-2 align-middle border underline">{{ $pesanan->tikets->first()->jumlah_tiket }}</td>
                        <td class="p-2 align-middle border">
                            @if ($pesanan->status == \App\Helpers\Enum\StatusPesananTiket::DIPROSES->value)
                            <span class="px-2 py-1 rounded" style="color: rgb(255, 186, 29); background-color: rgb(255, 246, 219)">
                              Menunggu Verifikasi
                            </span>
                          @elseif ($pesanan->status == \App\Helpers\Enum\StatusPesananTiket::SELESAI->value)
                            <span class="px-2 py-1 rounded font-semibold" style="color: rgb(0, 204, 102); background-color: rgb(215, 255, 235)">
                              Selesai
                            </span>
                          @elseif ($pesanan->status == \App\Helpers\Enum\StatusPesananTiket::DITOLAK->value)

                            <span class="px-2 py-1 rounded" style="color: rgb(255, 84, 84); background-color: rgb(255, 246, 219)">
                              Ditolak
                            </span>
                          @endif
                        </td>

                        <td class="p-2 align-middle border">
                            <a href="{{ route('admin.kelola-tiket.konfirmasi') }}">
                                <button type="submit" class="btn btn-danger btn-sm px-4 font-semibold py-2 text-white bg-cyan-500 rounded-md border border-cyan-500 hover:bg-cyan-600 hover:text-white transition duration-200">Detail</button>
                            </a>
                        </td>
                    </tr>
                    @php
                        $i++;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>

    @else
    <div class="w-full max-w-sm mx-auto bg-white rounded-lg shadow-md p-4 mt-40">
        <div class="flex items-center space-x-3">
          <div class="text-blue-500 rounded-full">
            <img src="{{ asset('assets/images/icons/warning-icon.svg') }}" class="h-16 w-16" alt="">
          </div>
          <p class="text-sm text-gray-700">Belum ada pemesanan tiket</p>
        </div>
      </div>
    @endif

<script>
    lightSidebarKelolaTiketBtn()
</script>
<script src="{{ asset('scripts/data-tables.js') }}" type="module"></script>


@endsection
