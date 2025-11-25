@extends('admin-pages.layouts.app')

@section('title', 'Kelola Tempat Wisata')

@section('content')

    @if (!empty([]))


    <div class="container">
        {{-- Search bar --}}
        <div class="w-full max-w-lg mx-auto bg-white rounded-lg shadow-md p-6">
            <div class="relative">
              <input
                type="text"
                placeholder="Cari tempat wisata"
                class="w-full pl-4 pr-12 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-cyan-500"
              />
              <button
                class="absolute top-0 right-0 h-full px-4 bg-cyan-500 text-white rounded-r-full hover:bg-cyan-600"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="2"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M11 19a8 8 0 100-16 8 8 0 000 16zM21 21l-4.35-4.35"
                  />
                </svg>
              </button>
            </div>
        </div>

        <div id="destination-container">
            @if($destinations->isEmpty())
                <div class="flex justify-center items-center min-h-[30px] top-4">
                    <div class="text-center">
                        <img src="{{ asset('assets/images/search-not-found.svg') }}" alt="No results found">
                        <h4 class="mt-3">Tidak ada Destinasi<br>yang sesuai</h4>
                        <button class="bg-green-500 text-white mt-3 py-2 px-4 rounded">
                            <a href="{{ url('/') }}" class="no-underline text-white">Reset Pencarian</a>
                        </button>
                    </div>
                </div>
            @else
                @foreach($destinations as $dest)
                <div class="destination-card-container transform transition-transform duration-300 hover:-translate-y-2 hover:shadow-lg relative">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col" style="min-height: 403px; width: 284px;">
                        <!-- Dropdown button -->
                        <div class="absolute top-2 right-2">
                            <div class="relative">
                                <button
                                    class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 dropdown-button"
                                    data-card-id="{{ $dest->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v.01M12 12v.01M12 18v.01" />
                                    </svg>
                                </button>
                                <!-- Dropdown menu -->
                                <div
                                    class="absolute right-0 mt-2 w-24 bg-white rounded-md shadow-lg hidden dropdown-menu"
                                    data-card-id="{{ $dest->id }}">
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ubah</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Hapus</a>
                                </div>
                            </div>
                        </div>

                        <a href="{{ url('destination/'.$dest->id) }}" class="no-underline text-black flex flex-col flex-1">
                            <div class="relative" style="width: 284px; height: 198px;">
                                <img src="{{ $dest->image }}" class="w-full h-full object-cover" alt="{{ $dest->name }}">
                            </div>
                            <div class="p-4 flex-grow">
                                <h3 class="text-2xl mb-1 text-[#656565]">{{ $dest->name }}</h3>
                            </div>
                            <div class="p-4 mt-auto">
                                <div class="flex mb-2 pt-3">
                                    @php
                                        $fullStars = floor($dest->avg_rating);
                                        $halfStar = $dest->avg_rating % 1 !== 0;
                                        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                    @endphp

                                    @for($i = 0; $i < $fullStars; $i++)
                                        <svg ... fill="#FFC100"></svg>
                                    @endfor
                                    @if($halfStar)
                                        <svg ... style="clip-path: inset(0 50% 0 0);"></svg>
                                    @endif
                                    @for($i = 0; $i < $emptyStars; $i++)
                                        <svg ... fill="#D9D9D9"></svg>
                                    @endfor
                                </div>
                                <div class="flex text-sm text-gray-700 mb-2">
                                    <img src="{{ asset('assets/images/icons/location.svg') }}" alt="" class="w-4 h-4 mb-auto mr-2">
                                    <span class="text-gray-700 break-words">{{ $dest->address }}</span>
                                </div>
                                <div class="text-xl font-bold text-[#00CCDD] flex">
                                    <img src="{{ asset('assets/images/icons/tickets.svg') }}" alt="" class="w-7 h-7 mr-2">
                                    <span class="text-cyan-500">Rp {{ number_format($dest->price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            @endif
        </div>

        <div class="pagination">
            {{ $destinations->appends(['search' => $search, 'limit' => $itemsPerPage])->links() }}
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const dropdownButtons = document.querySelectorAll(".dropdown-button");

            dropdownButtons.forEach(button => {
                button.addEventListener("click", () => {
                    const cardId = button.getAttribute("data-card-id");
                    const menu = document.querySelector(`.dropdown-menu[data-card-id="${cardId}"]`);
                    menu.classList.toggle("hidden");
                });
            });

            // Close dropdowns when clicking outside
            document.addEventListener("click", (e) => {
                dropdownButtons.forEach(button => {
                    const cardId = button.getAttribute("data-card-id");
                    const menu = document.querySelector(`.dropdown-menu[data-card-id="${cardId}"]`);
                    if (!button.contains(e.target) && !menu.contains(e.target)) {
                        menu.classList.add("hidden");
                    }
                });
            });
        });
    </script>


    @else
    <div class="w-full max-w-sm mx-auto bg-white rounded-lg shadow-md p-4 mt-40">
        <div class="flex items-center space-x-3">
          <div class= text-blue-500 rounded-full">
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

@endsection
