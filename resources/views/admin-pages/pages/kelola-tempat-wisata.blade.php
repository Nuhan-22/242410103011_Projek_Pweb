@extends('admin-pages.layouts.app')

@section('title', 'Kelola Tempat Wisata')

@section('content')

    @if (!empty($destinations))


    <div class="px-4 my-6 bg-white shadow-md rounded-lg overflow-hidden">
        <div class="flex justify-end w-full">
            <a href="{{ route('destination.add.show') }}" class="p-2 border mr-3 rounded-md border-cyan-500 space-x-1.5 flex w-70 justify-center hover:bg-cyan-500 hover:text-white hover:transition cursor-pointer">
                <img src="{{ asset('assets/images/icons/plus-add.svg') }}" alt="" class=" w-3 text-inherit">
                <span>Tambah Tempat Wisata</span>
            </a>
        </div>


        <table id="data-table" class="table w-full text-sm">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="p-2 align-middle border">#</th>
                    <th class="p-2 align-middle border">Nama Tempat Wisata</th>
                    <th class="p-2 align-middle border">Alamat</th>
                    <th class="p-2 align-middle border">Gambar</th>
                    <th class="p-2 align-middle border">Rating</th>
                    <th class="p-2 align-middle border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($destinations as $destination)

                    <tr class="hover:bg-gray-50">
                        <!-- Row number -->
                        <td class="p-2 align-middle border">{{ $i }}</td>
                        <!-- Other columns -->
                        <td class="p-2 align-middle border">{{ $destination->nama }}</td>
                        <td class="p-2 align-middle border">{{ $destination->alamat }}</td>
                        <td class="p-2 align-middle border">
                            @if($destination->gambar)
                                <img src="{{ (str_contains($destination->gambar, "http")) ? $destination->gambar : asset($destination->gambar) }}" alt="Foto Profil" class="img-thumbnail w-12 h-12 object-cover rounded-full border border-gray-300">
                            @else
                                <span class="text-gray-500">No Foto</span>
                            @endif
                        </td>
                        <td class="p-2 align-middle border">{{ $destination->rating_rata_rata }}</td>
                        <td class="p-2 align-middle border">
                            <a href="{{ route('destination.edit.show', $destination->id) }}" class="btn btn-warning btn-sm px-4 py-2 rounded-md border border-yellow-500 hover:bg-yellow-500 hover:text-white transition duration-200">Edit</a>
                            <form action="{{ route('destination.destroy', $destination->id) }}" method="POST" style="display:inline;"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data destination {{ $destination->nama }} ini?');">
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
          <p class="text-sm text-gray-700">Data tempat wisatamu belum ditambahkan, tambahkan dulu yuk!</p>
        </div>
        <div class="mt-4">
          <button class="w-full bg-cyan-500 text-white text-sm font-semibold py-2 rounded hover:bg-cyan-600">
            Tambah Data
          </button>
        </div>
      </div>
    @endif

<script>
    lightSidebarKelolaWisataBtn()
</script>
<script src="{{ asset('scripts/data-tables.js') }}" type="module"></script>


@endsection
