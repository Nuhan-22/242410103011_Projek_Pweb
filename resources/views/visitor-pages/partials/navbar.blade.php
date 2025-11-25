<nav class="flex items-center justify-between bg-white p-4 shadow">
    <!-- Logo -->
    <div class="flex items-center space-x-2 hidden lg:flex">
        <a href=" {{ asset('') }}">
            <img src="{{ asset('assets/images/logo-type-3.svg') }}" alt="Logo" class="h-8 w-40" />
        </a>
    </div>

    <!-- Search Bar -->
        <form action="/cari-wisata" method="get" id="form-search" class="flex items-center border rounded-lg overflow-hidden shadow-sm flex-1 lg:mx-4 lg:w-2/3">
            <input id="search-input" type="text" placeholder="Cari tempat wisata ..." name="search" class="px-4 py-2 w-full focus:outline-none" />
            <button class="bg-cyan-500 text-white px-4 py-2 search-btn" id="search-btn" type="submit">Cari</button>
        </form>

    @if (\Illuminate\Support\Facades\Auth::check())
        <!-- User Profile Icon -->
        <div class="relative">
            <button id="profile-button" class="flex items-center space-x-2 text-cyan-600 hover:text-cyan-800">
                <img src="{{ (!empty(\Illuminate\Support\Facades\Auth::user()->foto_profil)) ?  asset('storage/' . \Illuminate\Support\Facades\Auth::user()->foto_profil) : 'https://img.icons8.com/ios-filled/35/ffffff/user.png' }}" alt="User Profile" class="w-10 h-10 p-1 rounded-full bg-cyan-500">
                <span class="font-medium">User</span>
            </button>

            <!-- Popup Card -->
            <div id="popup-card" class="fixed top-20 right-4 w-64 p-4 bg-white shadow-lg rounded-lg border border-gray-200 hidden z-50">
                <h2 class="text-lg font-semibold text-cyan-600">User Profile</h2>
                {{-- <p class="text-gray-600">View and manage your profile settings here.</p> --}}
                <ul class="mt-4 space-y-2">
                    @php
                        $idRole = \Illuminate\Support\Facades\Auth::user()->id_role;
                    @endphp
                    @if (\App\Helpers\AuthHelper::isDasboardRequired())
                        <li><a href="{{ route('admin.dashboard') }}" class="text-sm text-cyan-600 hover:underline">Dashboard Admin</a></li>
                    @endif
                    <li><a href="{{ route('booking.list') }}" class="text-sm text-cyan-600 hover:underline">Daftar Pesanan Tiketku</a></li>
                    <li><a href="{{ route('profile') }}" class="text-sm text-cyan-600 hover:underline">View Profile</a></li>
                    <li><a href="{{ route('profile.settings') }}" class="text-sm text-cyan-600 hover:underline">Settings</a></li>
                    <li><a href="{{ route('logout') }}" class="text-sm text-cyan-600 hover:underline">Logout</a></li>
                </ul>
            </div>
        </div>


        <script>
            // JavaScript to toggle popup visibility
            document.addEventListener('DOMContentLoaded', () => {
                const profileButton = document.getElementById('profile-button');
                const popupCard = document.getElementById('popup-card');

                profileButton.addEventListener('click', () => {
                    popupCard.classList.toggle('hidden');  // Toggle visibility
                });
            });

        </script>
    @else
    <!-- Buttons -->
    <div class="hidden lg:flex items-center space-x-4">
        <a href="{{ route('login') }}">
            <button class="text-cyan-500 font-semibold">Masuk</button>
        </a>
        <a href="{{ route('register') }}">
            <button class="bg-cyan-500 text-white px-4 py-2 rounded-lg">Daftar</button>
        </a>
    </div>

    @endif

    <!-- Hamburger Menu -->
    <button class="text-cyan-500 lg:hidden ml-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
        </svg>
    </button>
</nav>
