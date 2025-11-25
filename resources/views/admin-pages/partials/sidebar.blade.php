<div id="sidebar" class="h-screen w-64 bg-cyan-500 flex flex-col items-start py-6 px-4 text-white fixed transition-all duration-300 ease-in-out z-10 transform">
    <div class="text-xl font-bold mb-8">
        <span class="block">visitnusantara</span>
    </div>
    <nav class="w-full">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 mb-4 hover:bg-cyan-400 rounded-md" id="dasboard-sidebar-btn">
            <img src="https://img.icons8.com/ios-filled/24/ffffff/speedometer.png" alt="Dashboard Icon" class="mr-3">
            <span class="font-medium">Dashboard</span>
        </a>
        <a href="{{ route('admin.manage.destination') }}" class="flex items-center px-4 py-3 mb-4 hover:bg-cyan-400 rounded-md" id="kelola-wisata-sidebar-btn">
        <img src="https://img.icons8.com/ios-filled/24/ffffff/city-hall.png" alt="Kelola Wisata Icon" class="mr-3">
        <span class="font-medium">Kelola Wisata</span>
        </a>

        <a href="{{ route('admin.manage.comment') }}" class="flex items-center px-4 py-3 mb-4 hover:bg-cyan-400 rounded-md" id="kelola-ulasan-sidebar-btn">
        <img src="https://img.icons8.com/ios-filled/24/ffffff/chat.png" alt="Kelola Ulasan Icon" class="mr-3">
        <span class="font-medium">Kelola Ulasan</span>
        </a>




        <a href="{{ route('admin.kelola-tiket') }}" class="flex items-center px-4 py-3 mb-4 hover:bg-cyan-400 rounded-md" id="kelola-tiket-sidebar-btn">
        <img src="https://img.icons8.com/ios-filled/24/ffffff/ticket.png" alt="Kelola Ulasan Icon" class="mr-3">
        <span class="font-medium">Kelola Tiket</span>
        </a>

        @if (\App\Helpers\AuthHelper::isAdminOrSuperAdmin())
        <a href="{{ route('admin.kategori-wisata') }}" class="flex items-center px-4 py-3 mb-4 hover:bg-cyan-400 rounded-md" id="kelola-ulasan-sidebar-btn">
            <img src="https://img.icons8.com/ios-filled/24/ffffff/chat.png" alt="Kelola Ulasan Icon" class="mr-3">
            <span class="font-medium">Kelola Kategori Wisata</span>
        </a>
        <a href="{{ route('user.manage') }}" class="flex items-center px-4 py-3 mb-4 hover:bg-cyan-400 rounded-md" id="kelola-ulasan-sidebar-btn">
            <img src="https://img.icons8.com/ios-filled/24/ffffff/user.png" alt="Kelola Ulasan Icon" class="mr-3">
            <span class="font-medium">Kelola Pengguna</span>
        </a>
        @endif
    </nav>
    <div class="mt-auto">
        <a href="/cari-wisata" class="flex items-center px-4 py-3 hover:bg-cyan-400 rounded-md">
            <img src="https://img.icons8.com/ios-filled/24/ffffff/beach.png" alt="Logout Icon" class="mr-3">
            <span class="font-medium">Halaman Cari Wisata</span>
        </a>
        <a href="{{ route('logout') }}" class="flex items-center px-4 py-3 hover:bg-cyan-400 rounded-md">
            <img src="https://img.icons8.com/ios-filled/24/ffffff/exit.png" alt="Logout Icon" class="mr-3">
            <span class="font-medium">Logout</span>
        </a>
    </div>
</div>

<script>

const ICON_URLS = {
        dashboard: "https://img.icons8.com/ios-filled/24/06b6d4/speedometer.png",
        kelolaWisata: "https://img.icons8.com/ios-filled/24/06b6d4/city-hall.png",
        kelolaUlasan: "https://img.icons8.com/ios-filled/24/06b6d4/chat.png",
        kelolaTiket: "https://img.icons8.com/ios-filled/24/06b6d4/ticket.png"

    };

    function lightSidebarDashboardBtn() {
        let btn = document.getElementById("dasboard-sidebar-btn");
        btn.classList.add('bg-white', 'text-cyan-500');
        btn.classList.remove('hover:bg-cyan-400');
        btn.querySelector('img').src = ICON_URLS.dashboard;
    }

    function lightSidebarKelolaWisataBtn() {
        let btn = document.getElementById("kelola-wisata-sidebar-btn");
        btn.classList.add('bg-white', 'text-cyan-500');
        btn.classList.remove('hover:bg-cyan-400');
        btn.querySelector('img').src = ICON_URLS.kelolaWisata;
    }

    function lightSidebarKelolaUlasanBtn() {
        let btn = document.getElementById("kelola-ulasan-sidebar-btn");
        btn.classList.add('bg-white', 'text-cyan-500');
        btn.classList.remove('hover:bg-cyan-400');
        btn.querySelector('img').src = ICON_URLS.kelolaUlasan;
    }

    function lightSidebarKelolaTiketBtn() {
        let btn = document.getElementById("kelola-tiket-sidebar-btn");
        btn.classList.add('bg-white', 'text-cyan-500');
        btn.classList.remove('hover:bg-cyan-400');
        btn.querySelector('img').src = ICON_URLS.kelolaTiket;
    }

</script>
