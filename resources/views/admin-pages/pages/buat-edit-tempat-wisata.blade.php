@extends('admin-pages.layouts.app') @section('title', $isEditMode ? 'Edit Tempat Wisata' : 'Tambah Tempat Wisata') @section('content')
<div class="bg-gray-50 p-6">
    <div class="max-w-full mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold text-cyan-600 mb-4">{{ $isEditMode ? 'Edit' : 'Tambah' }} Tempat Wisata</h1>
        <form method="POST" action="{{ $isEditMode ? route('destination.update', $destination->id_tempat_wisata) : route('destination.store') }}" enctype="multipart/form-data">
            @csrf @if ($isEditMode) @method('PUT') @endif

            @if ($isEditMode)
                <input type="text" class="hidden" name="id_tempat_wisata" value="{{ $destination->id_tempat_wisata }}">
            @endif
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Nama Tempat Wisata</label>
                <input type="text" name="nama" value="{{ old('nama', $isEditMode ? $destination->nama : '') }}" placeholder="Masukkan Nama Tempat Wisata" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-400" />
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Deskripsi Tempat Wisata</label>
                <textarea name="description" placeholder="Masukkan Deskripsi Tempat Wisata" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-400">{{ old('deskripsi', $isEditMode ? $destination->deskripsi : '') }}</textarea>
            </div>


            {{-- Fasilitas --}}

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Fasilitas</label>
                <div class="flex gap-2 mb-2 max-w-96">
                    <input type="text" id="facilityInput" placeholder="Masukkan Nama Fasilitas" class="flex-1 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-400" />
                    <button type="button" id="addFacilityButton" class="bg-cyan-500 text-white px-4 py-2 rounded-md hover:bg-cyan-600">Tambah</button>
                </div>
                <div id="input-facilities-deletion-container">

                </div>
                <div class="flex flex-wrap gap-2 w-full p-2 border border-gray-300 rounded-md" id="facilityContainer">
                    @if (empty($destination->fasilitas) && !$isEditMode)
                        <p class="text-gray-500 italic p-2">Anda belum menambahkan fasilitas</p>
                    @else
                    @foreach ($destination->fasilitas as $i => $fasilitas)
                        <div class="border-cyan-500 p-1 border-2 rounded-md flex gap-1" data-id="{{ $i+1 }}">
                            <input type="text" name="nama_fasilitas_{{ $i+1 }}" value="{{ old('nama_fasilitas_'.$i+1, $fasilitas->nama_fasilitas) }}" class="p-2" required />
                            <input type="hidden" name="id_fasilitas_{{ $i+1 }}" value="{{ old('id_fasilitas_'.$i+1, $fasilitas->id_fasilitas) }}" />
                            <button type="button" class="bg-cyan-500 rounded-sm text-white px-2" onclick="removeFacility(this); checkIfFacilitiesEmpty();">x</button>
                        </div>
                    @endforeach
                    @endif
                </div>
            </div>


            {{-- End of Fasilitas --}}


            {{-- Nomer Rekening --}}

            <div class="bg-white my-2 rounded-lg w-full max-w-lg">
                <h2 class="block text-gray-700 font-semibold mb-2">Rekening Bank</h2>
                <div class="flex items-center gap-2 p-2 border border-gray-300 mb-4">
                    <input id="nama-bank" type="text" placeholder="Nama Bank..." class="border border-gray-300 rounded-md px-3 py-2 w-1/3 focus:outline-none focus:ring-2 focus:ring-cyan-500">
                    <input id="nomer-rekening" type="text" placeholder="Nomor Rekening" class="border border-gray-300 rounded-md px-3 py-2 w-1/2 focus:outline-none focus:ring-2 focus:ring-cyan-500">
                    <button type="button" id="btn-tambah-rekening" class="bg-cyan-500 text-white px-4 py-2 rounded-md hover:bg-cyan-600">Tambah</button>
                </div>
                <div id="input-bank-account-for-deletion-container">

                </div>
                <ul id="daftar-rekening" class="space-y-2">
                    @if ($isEditMode && !empty($destination->rekening_bank))
                    @foreach ($destination->rekening_bank as $i => $rekeningBank)
                    <li class='flex gap-1' data-id="{{ $i+1 }}">
                        <div class="border-cyan-500 p-1 border-2 rounded-md flex gap-1">
                            <input type="text" name="id_rekening_bank_{{ $i+1 }}" value="{{ $rekeningBank->id_rekening_bank }}" class="hidden">
                            <input type='text' name="nama_bank_{{ $i+1 }}" value='{{ $rekeningBank->nama_bank }}' class='border border-gray-300 rounded-md px-2 py-1 w-1/3 focus:outline-none focus:ring-cyan-500'>
                            <input type='number' name="nomer_rekening_{{ $i+1 }}" value='{{ $rekeningBank->nomer_rekening }}' class='border border-gray-300 rounded-md px-2 py-1 w-1/2 focus:outline-none focus:ring-cyan-500'>
                        </div>
                        <button type="button" class='bg-cyan-500 rounded-sm text-white px-2' onclick="removeAccountBtnFunction(this)">X</button>
                    </li>
                    @endforeach
                    @else
                    <p class="text-gray-500 italic p-2">Anda belum menambahkan rekening bank</p>
                    @endif
                </ul>
            </div>

            <script>
                const bankNameInput = document.getElementById('nama-bank');
                const accountNumberInput = document.getElementById('nomer-rekening');
                const addButton = document.getElementById('btn-tambah-rekening');
                let accountList = document.getElementById('daftar-rekening');

                addButton.addEventListener('click', () => {
                    const bankName = bankNameInput.value.trim();
                    const accountNumber = accountNumberInput.value.trim();

                    if (!bankName || !accountNumber) {
                        alert('Harap isi Nama Bank dan Nomor Rekening.');
                        return;
                    }

                    let i = accountList.children.length;
                    i++;

                    // Hapus pesan "Anda belum menambahkan fasilitas" jika ada
                    const firstChild = accountList.firstElementChild;
                    if (firstChild && firstChild.tagName === "P") {
                        accountList.innerHTML = "";
                    }

                    const listItemHTML = `<li class='flex gap-1' data-id='${i}'>
                        <div class="border-cyan-500 p-1 border-2 rounded-md flex gap-1">
                            <input type="text" name="id_rekening_bank_${i}" value="0" class="hidden">
                            <input type='text' name="nama_bank_${i}" value='${bankName}' class='border border-gray-300 rounded-md px-2 py-1 w-1/3 focus:outline-none focus:ring-2 focus:ring-cyan-500'>
                            <input type='number' name="nomer_rekening_${i}" value='${accountNumber}' class='border border-gray-300 rounded-md px-2 py-1 w-1/2 focus:outline-none focus:ring-2 focus:ring-cyan-500'>
                        </div>
                        <button type="button" class='bg-cyan-500 rounded-sm text-white px-2'>X</button>
                    </li>`;


                    let listItem = createElementFromHTML(listItemHTML);

                    // Create a closure to capture the current value of listItem
                    listItem.querySelector('button').addEventListener('click', (function(currentListItem) {
                        return function(event) {
                            removeAccount(event, currentListItem);
                        };
                    })(listItem));


                    accountList.appendChild(listItem);

                    bankNameInput.value = '';
                    accountNumberInput.value = '';
                    bankNameInput.focus();
                });

                function removeAccountBtnFunction(element){
                    let listItem = element.parentElement;
                    removeAccount(element, listItem)
                }

                function removeAccount(element, listItem) {
                    const bankAccountElement = event.target.closest("li[data-id]");

                    const bankAccountInput = bankAccountElement.querySelector('input[name^="id_rekening_bank_"]');
                    const bankAccountId = bankAccountInput.value;

                    if (bankAccountId != 0) {
                        if (!confirm("Yakin ingin menghapus rekening bank ini?")) {
                            return;
                        }
                    }



                    if(bankAccountId != "0"){
                        markbankAccountForDeletion(bankAccountId, bankAccountElement.getAttribute('data-id'));
                    }

                    accountList.removeChild(listItem);
                    checkIfBankAccountEmpty();

                }

                function markbankAccountForDeletion(id, dataIdIteration){
                    const backAccountContainer = document.querySelector("#input-bank-account-for-deletion-container");
                    const inputForDeletion = createElementFromHTML(`<input class="hidden" name="id_rekening_bank_to_delete_${dataIdIteration}" value="${id}">`);
                    backAccountContainer.appendChild(inputForDeletion)
                }


                function checkIfBankAccountEmpty() {
                    const facilityList = document.getElementById("daftar-rekening");
                    if (!facilityList.children.length) {
                        facilityList.innerHTML = '<p class="text-gray-500 italic p-2">Anda belum menambahkan Rekening Bank</p>';
                    }
                }
            </script>

            {{-- End Nomer Rekening --}}


            {{-- Foto Tempat Wisata --}}

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Foto Tempat Wisata (Maksimal 5 foto)</label>
                <input type="file" id="input" class="block w-full text-gray-700 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-400" onchange="handleFileChange(event)" />
                <div class="flex flex-wrap gap-3 w-full p-2 border border-gray-300 rounded-md">
                    <div id="input-images-deletion-container">

                    </div>
                    <div id="input-images-container" class="flex">
                        @if (empty($destination->gambar_tempat_wisata))
                            <p class="text-gray-500 mt-2">Belum ada foto diunggah</p>
                        @else
                        @foreach ($destination->gambar_tempat_wisata as $i => $gambar)
                            <div class="border-cyan-500 p-1 border-2 rounded-md flex gap-1" data-id="{{ $i+1 }}">
                                <div class="max-h-24 transition duration-300 ease-in-out">
                                    <img src="{{ asset('storage/' . $gambar->url_gambar) }}" alt="" class="max-h-24 group-hover:filter group-hover:brightness-0 group-hover:invert" />
                                    <input class="hidden" name="id_gambar_tempat_wisata_{{ $i+1 }}" value="{{ $gambar->id_gambar_tempat_wisata }}" />
                                    <input class="hidden" type="file" name="gambar_tempat_wisata_{{ $i+1 }}" />
                                </div>
                                <button type="button" class="px-2 border border-r-1 border-t-1 border-b-1 hover:bg-cyan-500 transition duration-300 ease-in-out group" onclick="deleteImage(event)">
                                    <img src="https://img.icons8.com/ios-filled/24/06b6d4/trash.png" alt="" class="transition duration-300 ease-in-out group-hover:filter group-hover:brightness-0 group-hover:invert" />
                                </button>
                            </div>
                        @endforeach
                    @endif

                    </div>
                </div>


            {{-- Fitur Lokasi --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Lokasi</label>
                <input type="text" class="hidden"
                value="{{ old('id_alamat', $isEditMode ? $destination->alamat->id_alamat : '') }}"
                >
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">Provinsi</label>
                        <input name="provinsi"
                               placeholder="Isi Provinsi"
                               class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-400"
                               value="{{ old('provinsi', $isEditMode ? $destination->alamat->provinsi : '') }}"
                               required />
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">Kabupaten</label>
                        <input name="kabupaten"
                               placeholder="Isi Kabupaten"
                               class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-400"
                               value="{{ old('kabupaten', $isEditMode ? $destination->alamat->kabupaten : '') }}"
                               required />
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">Kecamatan</label>
                        <input name="kecamatan"
                               placeholder="Isi Kecamatan"
                               class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-400"
                               value="{{ old('kecamatan', $isEditMode ? $destination->alamat->kecamatan : '') }}"
                               required />
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">Kota</label>
                        <input name="kota"
                               placeholder="Isi Kota"
                               class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-400"
                               value="{{ old('kota', $isEditMode ? $destination->alamat->kota : '') }}"
                               required />
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">Desa</label>
                        <input name="desa"
                               placeholder="Isi Desa (Opsional)"
                               class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-400"
                               value="{{ old('desa', $isEditMode ? $destination->alamat->desa : '') }}" />
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">Dusun</label>
                        <input name="dusun"
                               placeholder="Isi Dusun (Opsional)"
                               class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-400"
                               value="{{ old('dusun', $isEditMode ? $destination->alamat->dusun : '') }}" />
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">Jalan</label>
                        <input name="jalan"
                               placeholder="Isi Jalan (Opsional)"
                               class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-400"
                               value="{{ old('jalan', $isEditMode ? $destination->alamat->jalan : '') }}" />
                    </div>
                </div>
            </div>



                <div class="flex mt-4">
                    <div class="p-2 bg-gray-200 rounded-l-md"><img src="{{ asset('assets/images/icons/gmaps-icon.svg') }}" alt="" class="max-w-full" /></div>
                    <input type="text" name="link_gmaps" value="{{ old('link_gmaps', $isEditMode ? $destination->link_gmaps : '') }}" placeholder="Link Google Maps" class="p-3 w-full border border-gray-300 rounded-r-md focus:outline-none focus:ring-2 focus:ring-cyan-400" />
                </div>
            {{-- Tiket --}}

<div class="mb-4">
    <label class="block text-gray-700 font-semibold mb-2">Jam Buka & Harga Tiket</label>
    <button type="button" class="p-2 rounded-lg my-4 border bg-cyan-500 hover:bg-cyan-700 text-white transition" id="addTicketButton">Tambah Tiket baru</button>
    <div id="input-tickets-deletion-container">

    </div>
    <div id="ticketsContainer" class="grid grid-cols-3 gap-6">
        @if (empty($destination->tipe_tiket))
            <p class="text-gray-500 italic p-2" id="noTicketMessage">Anda belum menambahkan tiket</p>
        @else
        @php $i = 1; @endphp
        @foreach ($destination->tipe_tiket as $tipe_tiket)
        <div class="p-4 border border-gray-300 rounded-md mb-4" data-id="{{ $i }}">
            <div class="block my-4">
                <div class="flex w-full">
                    <label for="nama_tipe_{{ $i }}" class="font-medium text-gray-800">Nama tipe tiket :</label>
                    <button type="button" class="p-2 ml-60 max-lg:ml-20 border border-r-1 border-t-1 border-b-1 hover:bg-cyan-500 transition duration-300 ease-in-out group" onclick="removeTicket(this); checkTicketIfEmpty();">
                        <img src="https://img.icons8.com/ios-filled/24/06b6d4/trash.png" alt="" class="transition duration-300 ease-in-out group-hover:filter group-hover:brightness-0 group-hover:invert" />
                    </button>
                </div>
                <input type="text" name="id_tipe_tiket_{{ $i }}" value="{{ old('id_tipe_tiket_' . $i, $tipe_tiket->id_tipe_tiket) }}" class="hidden" />
                <input type="text" name="nama_tipe_{{ $i }}" class="text-lg font-semibold text-gray-800 border border-gray-300 p-2" value="{{ old('nama_tipe_' . $i, $tipe_tiket->nama_tipe) }}" required />
            </div>

            @php $name = ['mulai', 'sampai']; $j = 0; @endphp
            @foreach ($tipe_tiket->hari as $hari)
            <div class="flex items-center gap-2 mb-4">
                <label class="flex-shrink-0 w-32 font-medium text-gray-700" for="day">Hari {{ ucfirst($name[$j]) }}</label>
                <select name="hari_{{ $name[$j] }}_{{ $i }}" class="flex-grow p-3 border border-gray-300 rounded-md">
                    @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                    <option value="{{ $day }}" {{ (old('hari_' . $name[$j] . '_' . $i, $hari->nama_hari) == $day) ? 'selected' : '' }}>{{ $day }}</option>
                    @endforeach
                </select>
            </div>
            @php $j++; @endphp
            @endforeach

            <div class="flex items-center gap-2 mb-4">
                <label for="waktu_dimulai" class="flex-shrink-0 w-32 font-medium text-gray-700">Dibuka</label>
                <input type="time" name="waktu_dimulai_{{ $i }}" value="{{ old('waktu_dimulai', $isEditMode ? date('H:i', strtotime($tipe_tiket->waktu_dimulai)) : '00:00') }}" class="flex-grow p-3 border border-gray-300 rounded-md" required />
            </div>

            <div class="flex items-center gap-2 mb-4">
                <label for="waktu_berakhir" class="flex-shrink-0 w-32 font-medium text-gray-700">Ditutup</label>
                <input type="time" name="waktu_berakhir_{{ $i }}" value="{{ old('waktu_berakhir', $isEditMode ? date('H:i', strtotime($tipe_tiket->waktu_berakhir)) : '00:00') }}" class="flex-grow p-3 border border-gray-300 rounded-md" required />
            </div>

            <div class="flex items-center gap-2 mb-4">
                <label for="harga_tiket" class="flex-shrink-0 w-32 font-medium text-gray-700">Harga Tiket</label>
                <div class="flex">
                    <div class="p-3 bg-cyan-500 text-white rounded-l-md">Rp.</div>
                    <input type="number" name="harga_tiket_{{ $i }}" value="{{ old('harga_tiket', $isEditMode ? $tipe_tiket->harga : '') }}" placeholder="Harga Tiket" class="flex-grow p-3 border border-gray-300 rounded-md" required />
                </div>
            </div>
        </div>
        @php $i++; @endphp
        @endforeach
        @endif
    </div>
</div>


<div class="p-6 ">
    <h2 class="text-lg font-semibold text-cyan-600 mb-4">Link Sosial Media (Opsional)</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- WhatsApp -->
        <div class="flex items-center border-gray-400 border-1 rounded-lg px-4 py-2">
            <img src="https://img.icons8.com/color/48/000000/whatsapp--v1.png" alt="WhatsApp" class="w-6 h-6 mr-2" />
            <input
                type="text"
                name="whatsapp"
                placeholder="Link Whatsapp"
                value="{{ $sosialMediaLinks['whatsapp'] ?? '' }}"
                class="w-full bg-transparent outline-none text-gray-600 placeholder-gray-400"
            />
        </div>
        <!-- Instagram -->
        <div class="flex items-center border-gray-400 border-1 rounded-lg px-4 py-2">
            <img src="https://img.icons8.com/fluency/48/000000/instagram-new.png" alt="Instagram" class="w-6 h-6 mr-2" />
            <input
                type="text"
                name="instagram"
                placeholder="Link Instagram"
                value="{{ $sosialMediaLinks['instagram'] ?? '' }}"
                class="w-full bg-transparent outline-none text-gray-600 placeholder-gray-400"
            />
        </div>
        <!-- Website -->
        <div class="flex items-center border-gray-400 border-1 rounded-lg px-4 py-2">
            <img src="https://img.icons8.com/color/48/000000/internet.png" alt="Website" class="w-6 h-6 mr-2" />
            <input
                type="text"
                name="website"
                placeholder="Link Website"
                value="{{ $sosialMediaLinks['website'] ?? '' }}"
                class="w-full bg-transparent outline-none text-gray-600 placeholder-gray-400"
            />
        </div>
        <!-- YouTube -->
        <div class="flex items-center border-gray-400 border-1 rounded-lg px-4 py-2">
            <img src="https://img.icons8.com/color/48/000000/youtube-play.png" alt="YouTube" class="w-6 h-6 mr-2" />
            <input
                type="text"
                name="youtube"
                placeholder="Link Youtube"
                value="{{ $sosialMediaLinks['youtube'] ?? '' }}"
                class="w-full bg-transparent outline-none text-gray-600 placeholder-gray-400"
            />
        </div>
        <!-- TikTok -->
        <div class="flex items-center border-gray-400 border-1 rounded-lg px-4 py-2">
            <img src="https://img.icons8.com/fluency/48/000000/tiktok.png" alt="TikTok" class="w-6 h-6 mr-2" />
            <input
                type="text"
                name="tiktok"
                placeholder="Link Tiktok"
                value="{{ $sosialMediaLinks['tiktok'] ?? '' }}"
                class="w-full bg-transparent outline-none text-gray-600 placeholder-gray-400"
            />
        </div>
    </div>
</div>



            <button type="submit" class="w-full bg-cyan-500 text-white py-3 rounded-md hover:bg-cyan-600">
                {{ $isEditMode ? 'Perbarui' : 'Simpan' }}
            </button>
        </form>
    </div>
            </div>
        </div>



</div>

{{-- Script MAnipulasi Fasilitas --}}

<script>
    document.getElementById("addFacilityButton").addEventListener("click", function () {
        const facilityInput = document.getElementById("facilityInput");
        const facilityContainer = document.getElementById("facilityContainer");

        // Ambil nilai input
        const facilityName = facilityInput.value.trim();

        if (facilityName === "") {
            alert("Nama fasilitas tidak boleh kosong!");
            return;
        }

        // Hapus pesan "Anda belum menambahkan fasilitas" jika ada
        const firstChild = facilityContainer.firstElementChild;
        if (firstChild && firstChild.tagName === "P") {
            facilityContainer.innerHTML = "";
        }

        // Hitung jumlah fasilitas saat ini
        const facilityCount = facilityContainer.querySelectorAll("div.border-cyan-500").length + 1;

        // Tambahkan fasilitas baru
        const facilityHTML = `
            <div class="border-cyan-500 p-1 border-2 rounded-md flex gap-1">
                <input type="text" name="nama_fasilitas_${facilityCount}" value="${facilityName}" class="p-2" required>
                <input type="text" name="id_fasilitas_${facilityCount}" value="0" class="hidden">
                <button type="button" class="bg-cyan-500 rounded-sm text-white px-2" onclick="removeFacility(this); checkIfFacilitiesEmpty()">x</button>
            </div>
        `;

        facilityContainer.insertAdjacentHTML("beforeend", facilityHTML);

        // Kosongkan input setelah menambah fasilitas
        facilityInput.value = "";
    });

    function removeFacility(element) {
        const facilityElement = event.target.closest("div[data-id]");

        const facilityInput = element.parentElement.querySelector('input[name^="id_fasilitas_"]');
        const facilityId = facilityInput.value;

        if (facilityId != 0) {
            if (!confirm("Yakin ingin menghapus fasilitas ini?")) {
                return;
            }
        }

        if(facilityId != "0"){
            markFacilityForDeletion(facilityId, facilityElement.getAttribute('data-id'));
        }

        element.parentElement.remove();

        }

        function markFacilityForDeletion(id, dataIdIteration){
            const FacilityContainer = document.querySelector("#input-facilities-deletion-container");
            const inputForDeletion = createElementFromHTML(`<input class="hidden" name="id_facility_to_delete_${dataIdIteration}" value="${id}">`);
            FacilityContainer.appendChild(inputForDeletion)
        }



    function checkIfFacilitiesEmpty() {
        const facilityList = document.getElementById("facilityContainer");
        if (!facilityList.children.length) {
            facilityList.innerHTML = '<p class="text-gray-500 italic p-2" id="noFacilityMessage">Anda belum menambahkan fasilitas</p>';
        }
    }
</script>

{{--End script manipulasi fasilitas --}}

{{-- Script untuk manipulasi foto --}}

<script>
    function handleFileChange(event) {

        const file = event.target.files[0];

        // Cek apakah ada file yang dipilih
        if (!file) return;

        const imageContainer = document.getElementById("input-images-container");
        if (imageContainer && imageContainer.children.length >= 5) {
            alert("Maksimal 5 foto yang dapat diunggah");
            return;
        }

        // Hapus pesan "Belum ada foto diunggah" jika ada
        const firstChild = imageContainer.firstElementChild;
        if (firstChild && firstChild.tagName === "P") {
            imageContainer.innerHTML = "";
        }

        // Buat struktur HTML untuk gambar
        const imageCount = imageContainer.children.length;
        const imageHtml = `
            <div class="border-cyan-500 p-1 border-2 rounded-md flex gap-1" data-id="0">
                <div class="max-h-24 transition duration-300 ease-in-out">
                    <img alt="" class="max-h-24 group-hover:filter group-hover:brightness-0 group-hover:invert">
                    <input class="hidden id" name="id_gambar_tempat_wisata_${imageCount}" value="0">
                    <input class="hidden image" type="file" name="gambar_tempat_wisata_${imageCount}">
                </div>
                <button type="button" class="px-2 border border-r-1 border-t-1 border-b-1 hover:bg-cyan-500 transition duration-300 ease-in-out group" onclick="deleteImage(event)">
                    <img src="https://img.icons8.com/ios-filled/24/06b6d4/trash.png" alt="" class="transition duration-300 ease-in-out group-hover:filter group-hover:brightness-0 group-hover:invert">
                </button>
            </div>
        `;

        // Buat elemen DOM dari string HTML
        const imgElement = createElementFromHTML(imageHtml);

        // Set sumber gambar (src)
        const imageElement = imgElement.querySelector("img.max-h-24");
        imageElement.src = URL.createObjectURL(file);

        // Update nama atribut input file dan file input
        const idInputElement = imgElement.querySelector('input[name^="id_gambar_tempat_wisata_"]');
        const fileInputElement = imgElement.querySelector('input[type="file"][name^="gambar_tempat_wisata_"]');

        idInputElement.name = `id_gambar_tempat_wisata_${imageCount}`;
        fileInputElement.name = `gambar_tempat_wisata_${imageCount}`;
        fileInputElement.files = event.target.files;

        // Masukkan elemen gambar ke dalam container
        imageContainer.appendChild(imgElement);
    }

    function deleteImage(event) {
        const imageElement = event.target.closest("div[data-id]");
        const idInputElement = imageElement.querySelector('input[name^="id_gambar_tempat_wisata_"]');

        // Konfirmasi jika gambar memiliki id yang sudah disimpan
        if (idInputElement.value !== "0" && !confirm("Yakin mau hapus gambar yang udah disimpan ini?")) return;

        imageElement.remove();

        checkContainerEmpty();

        if(idInputElement.value !== "0"){
            markImageForDeletion(idInputElement.value, imageElement.getAttribute('data-id'));
        }
    }

    function markImageForDeletion(id, dataIdIteration){
        const imageContainer = document.querySelector("#input-images-deletion-container");
        const inputForDeletion = createElementFromHTML(`<input class="hidden" name="id_gambar_to_delete_${dataIdIteration}" value="${id}">`);
        imageContainer.appendChild(inputForDeletion)
    }

    function checkContainerEmpty() {
        const imageContainer = document.getElementById("input-images-container");
        if (!imageContainer.children.length) {
            imageContainer.innerHTML = `<p class="text-gray-500 mt-2">Belum ada foto diunggah</p>`;
        }
    }
</script>


{{-- End Script untuk manipulasi foto --}}


{{-- Script untuk manipulasi tiket --}}

<script>
    function addTicket() {
        // Fungsi untuk menambah entri Jam Buka & Harga Tiket
        let ticketContainer = document.querySelector("#ticketsContainer");

        let i = ticketContainer.children.length;

        // Hapus pemberitahuan jika tiket kosong
        if (ticketContainer.firstElementChild.tagName === "P") {
            ticketContainer.innerHTML = "";
        }

        i++;

        let newTicket = document.createElement("div");
        newTicket.setAttribute("data-id", $i);
        newTicket.classList.add("p-4", "border", "border-gray-300", "rounded-md", "mb-4");

        newTicket.innerHTML = `
            <div class="block my-4">
                <div class="flex w-full">
                    <label for="nama_tipe_${i}" class="font-medium text-gray-800">Nama tipe tiket :</label><br>
                    <button class="p-2 ml-60 border border-r-1 border-t-1 border-b-1 hover:bg-cyan-500 transition duration-300 ease-in-out group" onclick="removeTicket(this)">
                        <img src="https://img.icons8.com/ios-filled/24/06b6d4/trash.png" alt="" class="transition duration-300 ease-in-out group-hover:filter group-hover:brightness-0 group-hover:invert">
                    </button>
                </div>
                <input type="text" name="nama_tipe_${i}" class="text-lg font-semibold text-gray-800 border border-gray-300 p-2" value="" required>
                <input type="text" name="id_tipe_tiket_${i}" value="0" class="hidden">
            </div>

            <div class="flex items-center gap-2 mb-4">
                <label class="flex-shrink-0 w-32 font-medium text-gray-700" for="hari">Hari Mulai</label>
                <select name="hari_mulai_${i}" class="flex-grow p-3 border border-gray-300 rounded-md" required>
                    <option value="Senin" selected>Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                    <option value="Minggu">Minggu</option>
                </select>
            </div>

            <div class="flex items-center gap-2 mb-4">
                <label class="flex-shrink-0 w-32 font-medium text-gray-700" for="hari">Hari Sampai</label>
                <select name="hari_sampai_${i}" class="flex-grow p-3 border border-gray-300 rounded-md" required>
                    <option value="Senin" selected>Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                    <option value="Minggu">Minggu</option>
                </select>
            </div>

            <div class="flex items-center gap-2 mb-4">
                <label for="waktu_dimulai_${i}" class="flex-shrink-0 w-32 font-medium text-gray-700">Dibuka</label>
                <input type="time" name="waktu_dimulai_${i}" class="flex-grow p-3 border border-gray-300 rounded-md" required>
            </div>

            <div class="flex items-center gap-2 mb-4">
                <label for="waktu_berakhir_${i}" class="flex-shrink-0 w-32 font-medium text-gray-700">Ditutup</label>
                <input type="time" name="waktu_berakhir_${i}" class="flex-grow p-3 border border-gray-300 rounded-md" required>
            </div>

            <div class="flex items-center gap-2 mb-4">
                <label for="harga_tiket_${i}" class="flex-shrink-0 w-32 font-medium text-gray-700">Harga Tiket</label>
                <div class="flex">
                    <div class="p-3 bg-cyan-500 text-white rounded-l-md">Rp.</div>
                    <input type="number" name="harga_tiket_${i}" class="flex-grow p-3 border border-gray-300 rounded-md" required>
                </div>
            </div>
        `;

        ticketContainer.appendChild(newTicket);
    }

    function removeTicket(element) {
        const ticketElement = element.parentElement.parentElement.parentElement;

        const ticketInput = element.parentElement.parentElement.querySelector('input[name^="id_tipe_tiket_"]');
        const ticketId = ticketInput.value;

        if (ticketId != 0 && !confirm("Yakin ingin menghapus tiket yang tersimpan ini?")) {
            return;
        }

        ticketInput.parentElement.parentElement.remove();
        checkTicketIfEmpty();

        if(ticketId !== "0"){
            markTicketForDeletion(ticketId, ticketElement.getAttribute('data-id'));
        }
    }

    function markTicketForDeletion(id, dataIdIteration){
        const ticketsDeletionContainer = document.querySelector("#input-tickets-deletion-container");
        const inputForDeletion = createElementFromHTML(`<input class="hidden" name="id_ticket_to_delete_${dataIdIteration}" value="${id}">`);
        ticketsDeletionContainer.appendChild(inputForDeletion)
    }


    function checkTicketIfEmpty() {
        const ticketList = document.getElementById("ticketsContainer");
        if (!ticketList.children.length) {
            ticketList.innerHTML = '<p class="text-gray-500 italic p-2" id="noTicketMessage">Anda belum menambahkan tiket</p>';
        }
    }

    // Add event listener for adding ticket button
    let addTicketButton = document.querySelector("#addTicketButton");
    if (addTicketButton) {
        addTicketButton.addEventListener("click", addTicket);
    }
</script>


{{-- End Script untuk manipulasi tiket --}}
@endsection
