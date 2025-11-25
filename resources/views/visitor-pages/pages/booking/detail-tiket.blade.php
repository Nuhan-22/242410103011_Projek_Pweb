@extends('visitor-pages.layouts.app')

@section('title', $namaTempat ?? 'Nama Tempat')

@section('content')

<div class="min-h-screen">
<div class="bg-white rounded-lg shadow-lg p-6 w-2/4 mx-auto mt-10">
    <h1 class="text-center text-2xl font-bold mb-6">Pembelian Tiket</h1>

    <div class="flex justify-center gap-6 mb-4 text-sm font-semibold">
        <span class="text-cyan-500">1. Detail Tiket</span>
        <span class="text-gray-400">2. Pembayaran</span>
    </div>

    <div class="border rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-2">Checkout Tiket</h2>
        <form action="{{ route('destination.booking.payment') }}" method="GET">
            <div class="">
                <span class="font-semibold">Nama Wisata : </span>
                <span>{{ $destination->nama }}</span>
            </div>
            <input class="hidden" name="tempat-wisata" value="{{ $destination->id_tempat_wisata }}">
            <h4 class="font-semibold">Pilih Tiket :</h4>
            <div class="mb-2" id="tickets-container">
                @foreach ($destination->tipe_tiket as $ticket)
                <div class="flex items-center space-x-4">
                    <!-- Radio Button -->
                    <input
                        type="radio"
                        id="ticket-{{ $loop->index }}"
                        name="ticket"
                        value="{{ $ticket['id_tipe_tiket'] }}"
                        data-days="{{ json_encode($ticket->hari) }}"
                        class="form-radio text-cyan-500 ticket-radio"
                    >

                    <!-- Ticket Information -->
                    <label for="ticket-{{ $loop->index }}" class="text-lg">
                        <span class="font-semibold">{{ $ticket['nama_tipe'] }} </span>

                        @if ($ticket->hari[0]->nama_hari != $ticket->hari[1]->nama_hari)
                            <span>({{ $ticket->hari[0]->nama_hari }} - {{ $ticket->hari[1]->nama_hari }})</span>
                        @else
                            <span>({{ $ticket->hari[0]->nama_hari }})</span>
                        @endif
                        <br>
                        <span class="font-semibold text-cyan-500"> Rp {{ number_format($ticket['harga'], 0, ',', '.') }}</span>
                    </label>
                </div>
            @endforeach
            </div>


            <div class="grid grid-cols-2 gap-4">
                <!-- Tanggal Visit -->
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Visit</label>
                    <input type="date" id="tanggal" name="tanggal" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-400" onchange="checkDateMatch()" required>
                </div>
                <!-- Jumlah Tiket -->
                <div>
                    <label for="jumlah" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Tiket</label>
                    <input type="number" id="jumlah" name="jumlah" min="1" placeholder="Masukkan Jumlah Tiket" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-400" required>
                </div>
            </div>

            <!-- Tombol Lanjut -->
            <div class="mt-6">
                <button type="submit" class="w-full bg-cyan-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-cyan-600 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2">
                    Lanjut
                </button>
            </div>
        </form>
    </div>
</div>
</div>
<script>
function checkDateMatch() {
    // Get the selected date
    const selectedDate = new Date(document.getElementById('tanggal').value);

    if (selectedDate < new Date()) {
        alert('Tanggal kunjungan tidak boleh kurang dari hari ini!');
        document.getElementById('tanggal').value = '';
        return;
    }

    let days = [
        "",
        "Senin",
        "Selasa",
        "Rabu",
        "Kamis",
        "Jumat",
        "Sabtu",
        "Minggu"
        ];


    // Get the day name in Bahasa (e.g., "Senin", "Selasa")
    const selectedDay = selectedDate.toLocaleString('id-ID', { weekday: 'long' });

    let offsetHariYangDipilih = days.indexOf(selectedDay);

    const availableDays = getSelectedTicketDataDays();
    console.log(availableDays);

    if (!availableDays) {
        alert('Tolong pilih tiket terlebih dahulu');
        return;
    }

    let hariPertama = availableDays[0].nama_hari;
    let hariTerakhir = availableDays[1].nama_hari

    let offsetHariPertama = days.indexOf(hariPertama);
    let offsetHariTerakhir = days.indexOf(hariTerakhir);

    let isValid = false;

    if (offsetHariYangDipilih >= offsetHariPertama  &&  offsetHariYangDipilih  <= offsetHariTerakhir)
    {
        isValid = true;
    }

    // If no valid ticket is selected, show an alert
    if (!isValid) {
        alert("Tolong pilih hari yang sesuai dengan tiket!.");
        document.getElementById('tanggal').value = null;
    }
}

// Function to get the selected ticket's data-days
function getSelectedTicketDataDays() {
    const ticketRadios = document.querySelectorAll('.ticket-radio');
    let selectedDataDays = null;

    ticketRadios.forEach(radio => {
        if (radio.checked) {
            selectedDataDays = radio.getAttribute('data-days');
        }
    });

    return selectedDataDays ? JSON.parse(selectedDataDays) : null;
}



</script>
@endsection
