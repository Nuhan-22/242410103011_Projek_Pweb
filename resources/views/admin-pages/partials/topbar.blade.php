<div class="flex items-center justify-between p-4 bg-white shadow-md">
    <div class="flex items-center space-x-4">
        <!-- Hamburger Icon -->
        <button onclick="toggleSidebar()" class="text-cyan-500 border-2 border-cyan-500 p-2 rounded-full hover:bg-cyan-500 hover:text-white hover:transition-opacity">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Logo or Dashboard Title -->
        <h1 class="text-2xl font-semibold text-cyan-500">@yield('title')</h1>
    </div>

    <div class="flex items-center space-x-6">

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
                    @if ($idRole == 1 || $idRole == 2)
                        <li><a href="{{ route('admin.dashboard') }}" class="text-sm text-cyan-600 hover:underline">Dashboard Admin</a></li>
                    @endif
                    <li><a href="{{ route('profile') }}" class="text-sm text-cyan-600 hover:underline">View Profile</a></li>
                    <li><a href="{{ route('profile.settings') }}" class="text-sm text-cyan-600 hover:underline">Settings</a></li>
                    <li><a href="{{ route('logout') }}" class="text-sm text-cyan-600 hover:underline">Logout</a></li>
                </ul>
            </div>
        </div>

        <script>
            // JavaScript to toggle popup visibility
            document.getElementById('profile-button').addEventListener('click', () => {
                const popup = document.getElementById('popup-card');
                popup.classList.toggle('hidden');
            });
        </script>

    </div>
</div>
