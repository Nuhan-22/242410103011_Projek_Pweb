@extends('admin-pages.layouts.app')
{{-- Extends layout utama admin --}}

@section('title', 'Kelola Ulasan')
{{-- Set title halaman --}}

@section('content')
{{-- Bagian konten utama --}}

    {{-- Tampilkan success message jika ada --}}
    @if(session('success'))
        <div class="px-4 py-3 mb-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tampilkan error message jika ada --}}
    @if(session('error'))
        <div class="px-4 py-3 mb-4 bg-red-100 border border-red-400 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif

    @if (!empty($comments))
    {{-- Cek apakah ada data ulasan - Jika ada, tampilkan tabel --}}

    <div class="px-4 my-6 bg-white shadow-md rounded-lg overflow-hidden">
        {{-- Container tabel dengan styling --}}
        {{-- px-4 = padding horizontal 1rem --}}
        {{-- my-6 = margin vertikal 1.5rem --}}
        {{-- bg-white = background putih --}}
        {{-- shadow-md = medium shadow effect --}}
        {{-- rounded-lg = border radius besar --}}
        {{-- overflow-hidden = crop content jika melebihi border --}}

        <table id="data-table" class="table w-full text-sm">
            {{-- Tabel dengan id 'data-table' (untuk JavaScript datatable) --}}
            {{-- w-full = lebar penuh, text-sm = font size kecil --}}

            <thead class="bg-blue-600 text-white">
                {{-- Header tabel dengan background biru dan text putih --}}

                <tr>
                    <th class="p-2 align-middle border">#</th>
                    {{-- Kolom nomor urut --}}

                    <th class="p-2 align-middle border">Nama Tempat Wisata</th>
                    {{-- Kolom nama tempat wisata --}}

                    <th class="p-2 align-middle border">Nama Pengunjung</th>
                    {{-- Kolom nama pengunjung yang memberi ulasan --}}

                    <th class="p-2 align-middle border">Isi Komentar</th>
                    {{-- Kolom isi komentar/review --}}

                    <th class="p-2 align-middle border">Rating</th>
                    {{-- Kolom rating (1-5 bintang) --}}

                    <th class="p-2 align-middle border">Aksi</th>
                    {{-- Kolom aksi (tombol hapus) --}}
                </tr>
            </thead>

            <tbody>
                {{-- Body tabel - berisi data ulasan --}}

                @php
                    // Initialize counter untuk nomor urut
                    $i = 1;
                @endphp

                @foreach ($comments as $comment)
                    {{-- Loop setiap ulasan dari variable $comments --}}

                    <tr class="hover:bg-gray-50">
                        {{-- Row tabel dengan hover effect (background abu-abu) --}}

                        <td class="p-2 align-middle border">{{ $i }}</td>
                        {{-- Nomor urut (increment dari $i) --}}

                        <td class="p-2 align-middle border">{{ $comment->tempat_wisata->nama }}</td>
                        {{-- Nama tempat wisata dari relasi object --}}

                        <td class="p-2 align-middle border">{{ $comment->pengguna->nama_depan}}</td>
                        {{-- Nama depan pengunjung dari relasi object --}}

                        <td class="p-2 align-middle border">{{ $comment->komentar}}</td>
                        {{-- Isi komentar --}}

                        <td class="p-2 align-middle border">{{ $comment->rating}}</td>
                        {{-- Rating (1-5) --}}

                        <td class="p-2 align-middle border">
                            {{-- Kolom aksi - tombol hapus --}}

                            <form action="{{ route('comment.destroy', $comment->id) }}"
                                  method="POST"
                                  style="display:inline;"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ulasan ini?');">
                              {{-- Form untuk delete dengan:
                                   - action ke route 'comment.destroy' dengan ID ulasan
                                   - method POST (converted to DELETE by @method)
                                   - onsubmit = confirmation dialog --}}

                              @csrf
                              {{-- CSRF token untuk security --}}

                              @method('DELETE')
                              {{-- Spoof method POST menjadi DELETE untuk RESTful --}}

                              <button type="submit"
                                      class="btn btn-danger btn-sm px-4 py-2 rounded-md border border-red-500 hover:bg-red-600 hover:text-white transition duration-200"
                                      id="delete-btn-{{ $comment->id }}">
                                {{-- Tombol submit dengan styling: --}}
                                {{-- btn-danger = styling tombol delete --}}
                                {{-- px-4 py-2 = padding horizontal-vertical --}}
                                {{-- hover:bg-red-600 hover:text-white = hover effect --}}
                                {{-- id unique untuk setiap tombol --}}
                                Hapus
                              </button>
                          </form>
                        </td>
                    </tr>

                    @php
                        // Increment counter untuk nomor urut berikutnya
                        $i++;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>

    @else
    {{-- Jika tidak ada data ulasan, tampilkan pesan kosong --}}

    <div class="w-full max-w-sm mx-auto bg-white rounded-lg shadow-md p-4 mt-40">
        {{-- Container pesan kosong dengan styling --}}
        {{-- w-full max-w-sm = lebar penuh max 28rem (small) --}}
        {{-- mx-auto = center horizontal, mt-40 = margin top besar --}}

        <div class="flex items-center space-x-3">
          {{-- Flex container untuk icon dan text --}}
          {{-- space-x-3 = spacing horizontal 0.75rem --}}

          <div class="text-blue-500 rounded-full">
            {{-- Icon container --}}
            <img src="{{ asset('assets/images/icons/warning-icon.svg') }}" class="h-16 w-16" alt="">
            {{-- Icon warning (64x64px) --}}
          </div>

          <p class="text-sm text-gray-700">Belum ada ulasan!</p>
          {{-- Text pesan kosong --}}
        </div>

        <div class="mt-4">
        {{-- Empty div untuk spacing --}}
        </div>
      </div>
    @endif

<script>
    // Highlight menu "Kelola Ulasan" di sidebar
    lightSidebarKelolaUlasanBtn()
</script>

<script src="{{ asset('scripts/data-tables.js') }}" type="module"></script>

@endsection
