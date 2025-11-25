@extends('admin-pages.layouts.app')

@section('title', 'Kelola Ulasan')

@section('content')

    @if (!empty($comments))
    <div class="px-4 my-6 bg-white shadow-md rounded-lg overflow-hidden">
        <table id="data-table" class="table w-full text-sm">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="p-2 align-middle border">#</th>
                    <th class="p-2 align-middle border">Nama Tempat Wisata</th>
                    <th class="p-2 align-middle border">Nama Pengunjung</th>
                    <th class="p-2 align-middle border">Isi Komentar</th>
                    <th class="p-2 align-middle border">Rating</th>
                    <th class="p-2 align-middle border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($comments as $comment)
                    <tr class="hover:bg-gray-50">
                        <!-- Row number -->
                        <td class="p-2 align-middle border">{{ $i }}</td>
                        <!-- Other columns -->
                        <td class="p-2 align-middle border">{{ $comment->tempat_wisata->nama }}</td>
                        <td class="p-2 align-middle border">{{ $comment->pengguna->nama_depan}}</td>
                        <td class="p-2 align-middle border">{{ $comment->komentar}}</td>
                        <td class="p-2 align-middle border">{{ $comment->rating}}</td>
                        <td class="p-2 align-middle border">
                            <form action="{{ route('comment.destroy', $comment->id) }}" method="POST" style="display:inline;"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ulasan ini?');">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm px-4 py-2 rounded-md border border-red-500 hover:bg-red-600 hover:text-white transition duration-200">Hapus</button>
                          </form>
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
          <p class="text-sm text-gray-700">Belum ada ulasan!</p>
        </div>
        <div class="mt-4">
        </div>
      </div>
    @endif

<script>
    lightSidebarKelolaUlasanBtn()
</script>
<script src="{{ asset('scripts/data-tables.js') }}" type="module"></script>


@endsection
