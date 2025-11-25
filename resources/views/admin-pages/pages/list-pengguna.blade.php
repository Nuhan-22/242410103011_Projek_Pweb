@extends('admin-pages.layouts.app')

@section('title', 'Kelola Pengguna')

@section('content')

<div class="px-4 my-6 bg-white shadow-md rounded-lg overflow-hidden">
    <div class="flex justify-end w-full">
        <a href="{{ route('user.create.show') }}" class="border mr-3 rounded-md border-cyan-500 space-x-1.5 p-1 flex w-40 justify-center hover:bg-cyan-500 hover:text-white hover:transition cursor-pointer">
            <img src="{{ asset('assets/images/icons/plus-add.svg') }}" alt="" class=" w-3 text-inherit">
            <span>Tambah Pengguna</span>
        </a>
    </div>


    <table id="data-table" class="table w-full text-sm">
        <thead class="bg-blue-600 text-white">
            <tr>
                <th class="p-2 align-middle border">#</th>
                <th class="p-2 align-middle border">Nama Depan</th>
                <th class="p-2 align-middle border">Nama Belakang</th>
                <th class="p-2 align-middle border">Email</th>
                <th class="p-2 align-middle border">Username</th>
                <th class="p-2 align-middle border">Foto Profil</th>
                <th class="p-2 align-middle border">Role</th>
                <th class="p-2 align-middle border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($users as $user)
                <tr class="hover:bg-gray-50">
                    <!-- Row number -->
                    <td class="p-2 align-middle border">{{ $i }}</td>
                    <!-- Other columns -->
                    <td class="p-2 align-middle border">{{ $user->nama_depan }}</td>
                    <td class="p-2 align-middle border">{{ $user->nama_belakang }}</td>
                    <td class="p-2 align-middle border">{{ $user->email }}</td>
                    <td class="p-2 align-middle border">{{ $user->username }}</td>
                    <td class="p-2 align-middle border">
                        @if($user->foto_profil)
                            <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Foto Profil" class="img-thumbnail w-12 h-12 object-cover rounded-full border border-gray-300">
                        @else
                            <span class="text-gray-500">No Foto</span>
                        @endif
                    </td>
                    <td class="p-2 align-middle border">{{ $user->role->nama_role }}</td>
                    <td class="p-2 align-middle border">
                        <a href="{{ route('user.edit.show', $user->id_pengguna) }}" class="btn btn-warning btn-sm px-4 py-2 rounded-md border border-yellow-500 hover:bg-yellow-500 hover:text-white transition duration-200">Edit</a>
                        <form action="{{ route('user.destroy', $user->id_pengguna) }}" method="POST" style="display:inline;"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus data user {{ $user->nama_depan . ' ' . $user->nama_belakang }} ini?');">
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


        <script src="{{ asset('scripts/data-tables.js') }}" type="module"></script>
@endsection
