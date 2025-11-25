@extends('admin-pages.layouts.app')

@section('title', 'Dasboard')

@section('content')
<div class="flex flex-wrap gap-7 p-4 w-full">
    <!-- Komentar Baru Card -->
    <div class="card flex items-center gap-4 p-4 bg-white rounded-lg shadow-md flex-1">
        <div class="icon w-12 h-12">
            <img src="{{ asset('assets/images/icons/bubble-speeches.svg') }}" alt="">
        </div>
        <div class="block text-center">
            <h5 class="text-sm font-semibold text-cyan-600">Total Komentar</h5>
            <h1 class="text-3xl font-bold text-cyan-800">{{ $totalUlasan }}</h1>
        </div>
    </div>

    <!-- Ulasan Baru Card -->
    <div class="card flex items-center gap-4 p-4 shadow-md bg-white rounded-lg flex-1">
        <div class="icon w-12 h-12">
            <img src="{{ asset('assets/images/icons/thumb-with-stars.svg') }}" alt="">
        </div>
        <div class="block text-center">
            <h5 class="text-sm font-semibold text-cyan-600">Ulasan Baru Hari ini</h5>
            <h1 class="text-3xl font-bold text-cyan-800">{{ $totalUlasanToday }}</h1>
        </div>
    </div>

    <!-- Jumlah Pengunjung Card -->
    <div class="w-full mx-auto max-w-fitr">
        <div class="card max-w-[900px] p-6 bg-white rounded-lg shadow-md relative">
            <div class="flex justify-between items-center mb-4">
                <h5 class="text-lg font-semibold text-cyan-600">Jumlah Pengunjung Bulan ini</h5>
            </div>


            <div class="chart-container">
                <canvas id="visitorChart" class="w-full h-60"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('scripts/dashboard-visitor-chart.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        lightSidebarDashboardBtn()
    });
</script>
@endsection
