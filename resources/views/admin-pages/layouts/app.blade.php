<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('scripts/functions.js') }}"></script>
    <script src="{{ asset('bundle/datatable/simple-datatables.js') }}" type="module"></script>
    <link rel="stylesheet" href="{{ asset('bundle/datatable/style.css') }}">
</head>
    <body class="bg-gray-100">
    <!-- Wrapper that contains sidebar and right side -->
    <div id="wrapper" class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        @include('admin-pages.partials.sidebar')

        <!-- Right Side -->
        <div id="right-side" class="flex-1 bg-white p-6 transition-all duration-300 ease-in-out ml-64 mr-auto w-max h-screen overflow-y-auto">
            {{-- Top Bar --}}
            @include('admin-pages.partials.topbar')
            {{-- Content --}}
            @yield('content')
        </div>

    </div>

    @include('admin-pages.partials.footer')

    </body>

    <!-- JavaScript -->
    <script>
const sidebar = document.getElementById("sidebar");
const rightSide = document.getElementById("right-side");

// Function to toggle sidebar
function toggleSidebar() {
  if (sidebar.classList.contains("translate-x-0")) {
    sidebar.classList.remove("translate-x-0");
    sidebar.classList.add("-translate-x-full"); // Move sidebar out of view
    rightSide.classList.remove("ml-64"); // Remove left margin (adjust right content)
  } else {
    sidebar.classList.remove("-translate-x-full");
    sidebar.classList.add("translate-x-0"); // Move sidebar back into view
    rightSide.classList.add("ml-64"); // Add margin to move content right
  }
}

// Resize handler to call toggleSidebar function when the screen is small
function handleResize() {
  // Reset all classes on the right side
  rightSide.className = ''; // Clear all current classes

  if (window.innerWidth <= 1024) {  // Below medium screen size (md)
    toggleSidebar(); // Collapse the sidebar if the screen is small
    rightSide.classList.add("w-full"); // Ensure right content takes full width
  } else {
    if (!sidebar.classList.contains("translate-x-0")) {
      toggleSidebar(); // Ensure the sidebar is expanded on larger screens
    }
    rightSide.classList.add("ml-64", "bg-white", "p-6", "transition-all", "duration-300", "ease-in-out"); // Add necessary classes on large screen
  }
}

// Attach event listener to window resize
// window.addEventListener("resize", handleResize);

// Call handleResize on initial load to apply proper layout
// handleResize();


    </script>
</html>
