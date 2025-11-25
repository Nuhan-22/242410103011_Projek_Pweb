@extends('admin-pages.layouts.app')

@section('title', 'Dasboard')

@section('content')

@if (!empty($categories))

{{-- dd($categories); --}}

<div class="px-4 my-6 bg-white shadow-md rounded-lg overflow-hidden">
    <div class="flex justify-end w-full">
        <button id="btn-tambah-kategori" onclick="addCategory()" class="p-2 border mr-3 rounded-md border-cyan-500 space-x-1.5 flex w-70 justify-center hover:bg-cyan-500 hover:text-white hover:transition cursor-pointer">
            <img src="{{ asset('assets/images/icons/plus-add.svg') }}" alt="" class=" w-3 text-inherit">
            <span>Tambah Kategori</span>
        </button>
    </div>

    <form action="" method="post" id="form-sender">
        <input type="text" name="id_kategori" value="" class="hidden">
        <input type="text" name="nama_kategori" value="" class="hidden">

        @csrf
    </form>

    <table id="data-table" class="table w-full text-sm">
        <thead class="bg-blue-600 text-white">
            <tr>
                <th class="p-2 align-middle border">#</th>
                <th class="p-2 align-middle border">Nama Kategori</th>
                <th class="p-2 align-middle border">Jumlah Tempat Wisata</th>
                <th class="p-2 align-middle border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($categories as $category)

                <tr class="hover:bg-gray-50">
                    <!-- Row number -->
                    <td class="p-2 align-middle border">{{ $i }}</td>
                    <!-- Other columns -->
                    <td class="p-2 align-middle border">{{ $category->nama_kategori }}</td>
                    <td class="p-2 align-middle border"></td>
                    <td class="p-2 align-middle border">
                        
                        <button type="submit" class="btn btn-danger btn-sm px-4 py-2 rounded-md border border-yellow-500 hover:bg-yellow-500 hover:text-white transition duration-200" onclick="updateCategory('{{ $category->nama_kategori }}', {{ $category->id_kategori }})">edit</button>
                        <a href="{{ route('admin.kategori-wisata.destroy', $category->id_kategori) }}" 
                            onclick="return confirm('Apakah yakin anda ingin menghapus kategori \'{{ $category->nama_kategori }}\'?')">
                             <button type="button" class="btn btn-danger btn-sm px-4 py-2 rounded-md border border-red-500 hover:bg-red-600 hover:text-white transition duration-200">Hapus</button>
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
@endif

{{-- <div class="w-full max-w-sm mx-auto bg-white rounded-lg shadow-md p-4 mt-40">
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
  </div> --}}
    <script>
    function addCategory() {
    let category = prompt("Masukkan Kategori Baru :");
        if (!category) {
            return
        }

        updateFormData(0, category, "POST", "{{ route('admin.kategori-wisata.store') }}");
        submitForm()
    }

    function updateCategory(namaCategory, id){

        let newCategory = prompt("Masukan Nama Kategori baru", namaCategory);

        if (!newCategory) {
            return
        }

        updateFormData(id, newCategory, "POST", "{{ route('admin.kategori-wisata.update') }}");
        submitForm()

    
    }

    function updateFormData(idValue, kategoriValue, formMethod, formAction) {
        // Mengubah nilai input berdasarkan name
        document.querySelector('input[name="id_kategori"]').value = idValue;
        document.querySelector('input[name="nama_kategori"]').value = kategoriValue;

        // Mengubah method dan action form
        var form = document.getElementById('form-sender');
        form.method = formMethod;
        form.action = formAction;
    }

    // Fungsi untuk mengirim form
    function submitForm() {
        // Mendapatkan form dengan id "form-sender"
        var form = document.getElementById('form-sender');
        // Mengirim form menggunakan method POST atau sesuai method yang sudah diubah
        form.submit();
    }


    </script>
  <script src="{{ asset('scripts/data-tables.js') }}" type="module"></script>

@endsection