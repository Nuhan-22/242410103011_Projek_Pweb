@extends('visitor-pages.layouts.app')

@section('title', 'Daftar Tempat Wisata')

@section('content')

<script src="{{ asset('scripts/destinations-page-script.js') }}"></script>
<script src="{{ asset('scripts/loading-animation.js') }}"></script>

<div class="flex flex-row min-h-screen">

    {{-- Sidebar --}}
    <div class="w-200 bg-white p-5 px-12 border-r-2 border-x-gray-200 border-gray-200">
        <h2 class="text-lg font-bold text-cyan-500 transition-colors duration-300 hover:text-cyan-400">Filter</h2>

        <h3 class="text-md font-semibold mt-4 text-[#656565]">Kategori</h3>
        <ul id="categories-checkboxes">
            @foreach($categories as $category)
                <li>
                    <label class="text-[#656565] flex items-center space-x-2">
                        <input type="checkbox" data-id="{{ $category['id_kategori'] }}" class="w-5 h-5 border-2 border-cyan-500 rounded-sm focus:outline-none peer checked:bg-cyan-500 checked:border-cyan-500 checked:ring-2 checked:ring-white">
                        <span>{{ $category['nama_kategori'] }}</span>
                    </label>
                </li>
            @endforeach
        </ul>

        <h3 class="text-md font-semibold mt-4 text-cyan-500">Lokasi</h3>
        <ul id="provinces-checkboxes">
            @foreach($provinces as $location)
                <li>
                    <label class="text-[#656565] flex items-center space-x-2">
                        <input type="checkbox" class="w-5 h-5 border-2 border-cyan-500 rounded-sm focus:outline-none peer checked:bg-cyan-500 checked:border-cyan-500 checked:ring-2 checked:ring-white">
                        <span>{{ $location }}</span>
                    </label>
                </li>
            @endforeach
        </ul>

        <button id="btn-reset-filter" class="mt-4 p-2 bg-cyan-500 text-white font-semibold rounded transition-colors duration-300 hover:bg-cyan-600">
            Reset Filter
        </button>

        <button class="bg-cyan-500 text-white px-4 py-2 search-btn" type="submit">Cari</button>

        
    </div>

    <script>
        document.getElementById('btn-reset-filter').addEventListener('click', function() {
            var ulCategories = document.getElementById('categories-checkboxes');
            var ulProvinces = document.getElementById('provinces-checkboxes');

            // Uncheck all checkboxes in categories-checkboxes
            var categoryCheckboxes = ulCategories.querySelectorAll('input[type="checkbox"]');
            categoryCheckboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });

            // Uncheck all checkboxes in provinces-checkboxes
            var provinceCheckboxes = ulProvinces.querySelectorAll('input[type="checkbox"]');
            provinceCheckboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });
        });

    </script>

    {{-- End of Sidebar --}}


    {{-- Content --}}
    <div class="flex-row " >

        <div class="px-14 py-14">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="destination-container">

                <!-- being looped 8 times per page -->

            </div>
        </div>


    <!-- pagination -->
    <div aria-label="Page navigation example" class=" flex-col  justify-center items-center md:pb-2 sm:pb-2 pb-6">
        <ul class="pagination flex space-x-2  justify-center">
        </ul>
    </div>

    </div>
    {{-- End of Content --}}
</div>

@endsection
