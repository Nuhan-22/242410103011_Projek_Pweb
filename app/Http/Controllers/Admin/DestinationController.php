<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use App\Models\Hari;
use App\Models\TempatWisata;
use App\Models\TipeTiket;
use App\Models\Ulasan;
use Exception;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Nette\Utils\Random;
use App\Http\Controllers\Admin\Str;
use App\Models\RekeningBank;

class DestinationController extends Controller
{
    public function indexEditDestination(Request $request, $id){
        if(!is_numeric($id)){
            return back('404');
        }

        $query = TempatWisata::query()
        ->with([
            'alamat',
            'gambar_tempat_wisata',
            'kategori_wisata.kategori',
            'fasilitas',
            'tipe_tiket.hari',
            'rekening_bank'
        ]);

        if(Auth::user()->id_role == 3){
            $query->where('id_pengguna', Auth::user()->id_pengguna);
        }


        $destination = $query->where('id_tempat_wisata', $id)->get();

        // dd($destination);

        if (empty($destination->toArray())){
            return back(404);
        }

        $sosialMediaLinks = DB::table('sosial_media')
        ->where('id_tempat_wisata', $id)
        ->get();

        return view('admin-pages.pages.buat-edit-tempat-wisata', ['isEditMode' => true, 'destination' => $destination[0], 'sosialMediaLinks' => $sosialMediaLinks]);
    }

    public function indexAddDestination(Request $request){
        return view('admin-pages.pages.buat-edit-tempat-wisata', ['isEditMode' => false]);

    }

    public function createDestination(Request $request) {
        $requestData = $request->all();
        $fileData = $request->files->all();
        $parsedData = $this->parseRequestData($requestData, $fileData);

        // Validator for validation
        // $validator = Validator::make($parsedData, [
        //     'nama' => 'required|string|max:255',
        //     'description' => 'nullable|string',
        //     'provinsi' => 'required|string|max:255',
        //     'kabupaten' => 'required|string|max:255',
        //     'kecamatan' => 'required|string|max:255',
        //     'kota' => 'required|string|max:255',
        //     'desa' => 'nullable|string|max:255',
        //     'dusun' => 'nullable|string|max:255',
        //     'jalan' => 'nullable|string|max:255',
        //     'link_gmaps' => 'required|url',
        //     'hari_mulai' => 'string|max:255',
        //     'hari_sampai' => 'string|max:255',
        //     'fasilitas' => 'nullable|array',
        //     'fasilitas.*.nama_fasilitas' => 'nullable|string|max:255',
        //     'tiket' => 'nullable|array',
        //     'tiket.*.nama' => 'required_with:tiket|string|max:255',
        //     'tiket.*.waktu_dimulai' => 'nullable|string|max:5',
        //     'tiket.*.waktu_berakhir' => 'nullable|string|max:5',
        //     'tiket.*.harga' => 'nullable|numeric',
        //     'gambar' => 'nullable|array',
        //     'gambar.*.gambar_tempat_wisata' => 'nullable|file|image|max:2048',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()], 422);
        // }

        $validated = $request->toArray();
        $fileData = $request->files->all();


        $validated = $this->parseRequestData($validated, $fileData);

        // dd($validated);

        // Create main TempatWisata entity
        $tempatWisata = TempatWisata::create([
            'nama' => $validated['nama'],
            'deskripsi' => $validated['description'] ?? null,
            'link_gmaps' => $validated['link_gmaps'],
        ]);

        // dd($tempatWisata);

        // Create address details
        $tempatWisata->alamat()->create([
            'provinsi' => $validated['provinsi'],
            'kabupaten' => $validated['kabupaten'],
            'kecamatan' => $validated['kecamatan'],
            'kota' => $validated['kota'],
            'desa' => $validated['desa'] ?? null,
            'dusun' => $validated['dusun'] ?? null,
            'jalan' => $validated['jalan'] ?? null,
        ]);

        // Insert facilities
        foreach ($validated['fasilitas'] ?? [] as $facility) {
            $tempatWisata->fasilitas()->create([
                'nama_fasilitas' => $facility['nama_fasilitas'],
            ]);
        }

        // Insert tickets
        foreach ($validated['tiket'] ?? [] as $ticket) {

            $newTipeTicket = $tempatWisata->tipe_tiket()->create([
                'nama_tipe' => $ticket['nama'],
                'waktu_dimulai' => $ticket['waktu_dimulai'] ?? null,
                'waktu_berakhir' => $ticket['waktu_berakhir'] ?? null,
                'harga' => $ticket['harga'] ?? null,
            ]);

            if(empty($ticket['hari_mulai'])) {
                throw new Exception("Data Hari mulai null di ticket '" . $ticket['hari_mulai'] . "'");
            }

            Hari::create([
                'nama_hari' => $ticket['hari_mulai'],
                'id_tipe_tiket' => $newTipeTicket->id_tipe_tiket,
            ]);

            if(empty($ticket['hari_berakhir'])) {
                throw new Exception("Data Hari akhir null di ticket '" . $ticket['hari_berakhir'] . "'");
            }

            Hari::create([
                'nama_hari' => $ticket['hari_berakhir'],
                'id_tipe_tiket' => $newTipeTicket->id_tipe_tiket,
            ]);
        }

        foreach ($validated['gambar']as $newImage) {
            $gambarFile = $newImage['gambar_tempat_wisata'] ?? null;
            $publicPath = public_path('storage');

            if ($gambarFile) {
                $fileName = Random::generate() . "." . $gambarFile->getClientOriginalExtension();
                $fullPathGambar = $gambarFile->move($publicPath, $fileName);
                $tempatWisata->gambar_tempat_wisata()->create(['url_gambar' => 'storage/' . $fileName]);
            }
        }

        // if ($request->hasFile('gambar_tempat_wisata')) {
        //     $filePath = public_path('storage/' . $validated['gambar_tempat_wisata']);

        //     if (file_exists($filePath) && !is_dir($filePath)) {
        //         unlink($filePath);
        //     }

        //     $filePath = $request->file('foto_profil')->store('profile_pictures', 'public');
        //     // $dataUpdate['foto_profil'] = $filePath;
        // }

        // Insert social media links
        $data = $request->only(['whatsapp', 'instagram', 'website', 'youtube', 'tiktok']);

        foreach ($data as $platform => $link) {
            if ($link) {
                DB::table('sosial_media')->insert([
                    'id_tempat_wisata' => $tempatWisata->id_tempat_wisata,
                    'tipe_sosial_media' => DB::table('platform_sosial_media')->where('nama_platform', ucfirst($platform))->value('id_platform'),
                    'link_sosial_media' => $link,
                ]);
            }
        }
        return redirect()->route('admin.manage.destination');
        // return response()->json(['message' => 'Tempat Wisata successfully inserted', 'data' => $tempatWisata], 201);
    }


    public function updateDestination(Request $request){
        $requestData = $request->all();


        $fileData = $request->files->all();

        $parsedData = $this->parseRequestData($requestData, $fileData);

        // dd($parsedData, $requestData);

        // Use Validator for validation
        $validator = Validator::make($parsedData, [
            'id_tempat_wisata' => 'required|numeric',
            'nama' => 'required|string|max:255',
            'description' => 'nullable|string',
            'provinsi' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'desa' => 'nullable|string|max:255',
            'dusun' => 'nullable|string|max:255',
            'jalan' => 'nullable|string|max:255',
            'link_gmaps' => 'required|url',
            'hari_mulai' => 'string|max:255',
            'hari_sampai' => 'string|max:255',
            'fasilitas' => 'nullable|array',
            'fasilitas.*.id_fasilitas' => 'nullable|integer',
            'fasilitas.*.nama_fasilitas' => 'nullable|string|max:255',
            'tiket' => 'nullable|array',
            'tiket.*.id_tipe_tiket' => 'nullable|integer',
            'tiket.*.nama' => 'required_with:tiket|string|max:255',
            'tiket.*.hari_mulai' => 'nullable|string|max:255',
            'tiket.*.hari_berakhir' => 'nullable|string|max:255',
            'tiket.*.waktu_dimulai' => 'nullable|string|max:5',
            'tiket.*.waktu_berakhir' => 'nullable|string|max:5',
            'tiket.*.harga' => 'nullable|numeric',
            'gambar_for_deletion' => 'nullable|array',
            'gambar_for_deletion.*.id_gambar' => 'required|exists:gambar_tempat_wisata,id',
            'gambar' => 'nullable|array',
            'gambar.*.gambar_tempat_wisata' => 'nullable|file|image|max:4448',
            'gambar.*.id_gambar_tempat_wisata' => 'nullable|numeric',
        ]);


        // if ($validator->fails()) {
        //     echo "<script>
        //             alert('" . $validator->errors()->__toString() . "');
        //             window.history.back();
        //         </script>";
        //     exit;
        // }

        // $validated = $validator->validated();

        $validated = $parsedData;
        // dd($validated);


        $tempatWisata = TempatWisata::findOrFail($validated['id_tempat_wisata']);

        // Extract validated data into variables
        $nama = $validated['nama'];
        $description = $validated['description'];
        $linkGmaps = $validated['link_gmaps'];

        $provinsi = $validated['provinsi'];
        $kabupaten = $validated['kabupaten'];
        $kecamatan = $validated['kecamatan'];
        $kota = $validated['kota'];
        $desa = $validated['desa'];
        $dusun = $validated['dusun'];
        $jalan = $validated['jalan'];

        $fasilitas = $validated['fasilitas'] ?? [];
        $tiket = $validated['tiket'] ?? [];
        $rekeningBank = $validated['rekening_bank'] ?? [];
        $gambarForDeletion = $validated['gambar_for_deletion'] ?? [];
        $facilityForDeletion = $validated['facilty_for_deletion'] ?? [];
        $ticketForDeletion = $validated['ticket_for_deletion'] ?? [];
        $rekeningBankForDeletion = $validated['rekening_bank_for_deletion'] ?? [];

        $gambar = $validated['gambar'] ?? [];

        // Update main TempatWisata details
        $tempatWisata->update([
            'nama' => $nama,
            'description' => $description,
            'link_gmaps' => $linkGmaps,
        ]);

        // Update address details
        $tempatWisata->alamat()->update([
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'kota' => $kota,
            'desa' => $desa,
            'dusun' => $dusun,
            'jalan' => $jalan,
        ]);

        // Delete Facilites

        foreach ($facilityForDeletion as $facilityToDelete) {
            $idFasilitas = $facilityToDelete['id_fasilitas'] ?? null;
            $fasilitas = Fasilitas::where( 'id_fasilitas', $idFasilitas )->first();
            if ($fasilitas) {
                $fasilitas->delete();
            }
        }

        // Update facilities
        foreach ($fasilitas as $facility) {
            $idFasilitas = $facility['id_fasilitas'] ?? null;
            $namaFasilitas = $facility['nama_fasilitas'];

            if ($idFasilitas && $idFasilitas > 0) {
                // Update existing facility
                Fasilitas::where('id_fasilitas', $idFasilitas)->update([
                    'nama_fasilitas' => $namaFasilitas,
                ]);
            } else {
                // Create new facility
                Fasilitas::create([
                    'id_tempat_wisata' => $tempatWisata->id_tempat_wisata,
                    'nama_fasilitas' => $namaFasilitas,
                ]);
            }
        }

        // Delete tickets

        foreach ($ticketForDeletion as $ticketToDelete) {

            $idTiket = $ticketToDelete['id_tipe_tiket'] ?? null;
            $tiket = TipeTiket::where( 'id_tipe_tiket', $idTiket)->first();
            if ($tiket) {
                $tiket->delete();
            }
        }

        // Update tickets
        foreach ($tiket as $ticket) {
            // dd($ticket);
            $idTipeTiket = $ticket['id_tipe_tiket'] ?? null;
            $namaTiket = $ticket['nama'];
            $harga = $ticket['harga'];

            if ($idTipeTiket && $idTipeTiket > 0) {
                // Update existing ticket
                TipeTiket::where('id_tipe_tiket', $idTipeTiket)->update([
                    'nama_tipe' => $namaTiket,
                    'waktu_dimulai' => $ticket['waktu_dimulai'],
                    'waktu_berakhir' => $ticket['waktu_berakhir'],
                    'harga' => $harga,
                ]);

                $hari = Hari::where('id_tipe_tiket')->get();
                $tipeHari = [ 0 => 'hari_mulai', 1 => 'hari_berakhir'];
                foreach($hari as $i => $h){
                    $h->update([
                        'nama_hari' => $ticket[$tipeHari[$i]],
                    ]);
                }

            } else {
                // Create new ticket
                $newTipeTicket = $tempatWisata->tipe_tiket()->create([
                    'nama_tipe' => $namaTiket,
                    'waktu_dimulai' => $ticket['waktu_dimulai'],
                    'waktu_berakhir' => $ticket['waktu_berakhir'],
                    'harga' => $harga,
                    ]);
                $tipeHari = [ 0 => 'hari_mulai', 1 => 'hari_berakhir'];
                // dd($ticket);
                Hari::create([
                    'nama_hari' => $ticket[$tipeHari[0]],
                    'id_tipe_tiket' => $newTipeTicket->id_tipe_tiket
                ]);

                Hari::create([
                    'nama_hari' => $ticket[$tipeHari[1]],
                    'id_tipe_tiket' => $newTipeTicket->id_tipe_tiket
                ]);

            }
        }


        foreach($rekeningBank as $rekening){
            if ($rekening['id_rekening_bank'] == 0){
                //insert
                $rekeningBank = RekeningBank::create([
                    'nama_bank' => $rekening['nama_bank'],
                    'nomer_rekening' => $rekening['nomer_rekening'],
                    'id_tempat_wisata' => $tempatWisata->id_tempat_wisata
                ]);
            } else {
                // update
                $rekeningBank = RekeningBank::where('id_rekening_bank', $rekening['id_rekening_bank'])->first();
                $rekeningBank->nama_bank = $rekening['nama_bank'];
                $rekeningBank->nomer_rekening = $rekening['nomer_rekening'];
                $rekeningBank->save();
            }

        }

        foreach($rekeningBankForDeletion as $rekeningBank){
            $rekeningBank = RekeningBank::where('id_rekening_bank', $rekeningBank['id_rekening_bank'])->first();
            $rekeningBank->delete();
        }

        // Delete images marked for deletion
        foreach ($gambarForDeletion as $gambar) {
            $idGambar = $gambar['id_gambar'] ?? null;

            $image = $tempatWisata->gambar_tempat_wisata()->where('id_gambar_tempat_wisata', $idGambar)->first();

            if ($image) {
                if (!str_contains($image->url_gambar, 'http')){
                    Storage::delete($image->url_gambar);
                }
                $image->delete();
            }
        }

        // Add new images
        foreach ($gambar as $newImage) {
            $gambarFile = $newImage['gambar_tempat_wisata'] ?? null;
            $publicPath = public_path('storage');

            if ($gambarFile) {
                $fileName = Random::generate() . "." . $gambarFile->getClientOriginalExtension();
                $fullPathGambar = $gambarFile->move($publicPath, $fileName);
                $tempatWisata->gambar_tempat_wisata()->create(['url_gambar' => 'storage/' . $fileName]);
            }
        }


        $data = $request->only(['whatsapp', 'instagram', 'website', 'youtube', 'tiktok']);

        // Remove existing social media links
        DB::table('sosial_media')->where('id_tempat_wisata', $validated['id_tempat_wisata'])->delete();

        // Insert the new links
        foreach ($data as $platform => $link) {
            if ($link) {
                DB::table('sosial_media')->insert([
                    'id_tempat_wisata' => $validated['id_tempat_wisata'],
                    'tipe_sosial_media' => DB::table('platform_sosial_media')->where('nama_platform', ucfirst($platform))->value('id_platform'),
                    'link_sosial_media' => $link,
                ]);
            }
        }


        echo "<script>
                alert('Update Tempat Wisata Berhasil');
                window.history.back();
            </script>";
        exit;

    }

    private function parseRequestData($requestData, $fileData)
    {
        $result = [];
        $fasilitas = [];
        $rekeningBank = [];
        $tiket = [];
        $gambar = [];
        $gambarForDeletion = [];
        $ticketForDeletion = [];
        $facilityForDeletion = [];
        $rekeningBankForDeletion = [];

        // Process the data
        foreach ($requestData as $key => $value) {
            $keyParts = explode('_', $key);

            // Group data by key and suffixes like _1, _2, etc.
            if (count($keyParts) > 1 && is_numeric(end($keyParts))) {
                $baseKey = implode('_', array_slice($keyParts, 0, -1)); // Get the base key without the suffix
                $index = (int)end($keyParts); // Get the index number (1, 2, etc.), converted to integer

                // Handle 'fasilitas' (example: nama_fasilitas_1, id_fasilitas_1)
                if ($baseKey === 'nama_fasilitas') {
                    $fasilitas[$index]['nama_fasilitas'] = $value;
                } elseif ($baseKey === 'id_fasilitas') {
                    $fasilitas[$index]['id_fasilitas'] = $value;
                }

                // Handle 'tiket' (example: nama_tipe_1, harga_tiket_1)
                elseif ($baseKey === 'id_tipe_tiket') {
                    $tiket[$index]['id_tipe_tiket'] = $value;
                } elseif ($baseKey === 'nama_tipe') {
                    $tiket[$index]['nama'] = $value;
                } elseif ($baseKey === 'harga_tiket') {
                    $tiket[$index]['harga'] = $value;
                } elseif ($baseKey === 'hari_mulai') {
                    $tiket[$index]['hari_mulai'] = $value;
                } elseif ($baseKey === 'hari_sampai') {
                    $tiket[$index]['hari_berakhir'] = $value;
                } elseif ($baseKey === 'waktu_dimulai') {
                    $tiket[$index]['waktu_dimulai'] = $value;
                } elseif ($baseKey === 'waktu_berakhir') {
                    $tiket[$index]['waktu_berakhir'] = $value;
                }

                elseif ($baseKey === 'id_rekening_bank'){
                    $rekeningBank[$index]['id_rekening_bank'] = $value;
                }
                elseif ($baseKey === 'nama_bank'){
                    $rekeningBank[$index]['nama_bank'] = $value;
                }
                elseif ($baseKey === 'nomer_rekening'){
                    $rekeningBank[$index]['nomer_rekening'] = $value;
                }


                elseif ($baseKey === 'id_gambar_to_delete'){
                    $gambarForDeletion[$index]['id_gambar'] = $value;
                }

                elseif ($baseKey === 'id_facility_to_delete'){
                    $facilityForDeletion[$index]['id_fasilitas'] = $value;
                }

                elseif ($baseKey === 'id_ticket_to_delete'){
                    $ticketForDeletion[$index]['id_tipe_tiket'] = $value;
                }

                elseif ($baseKey === 'id_rekening_bank_to_delete'){
                    $rekeningBankForDeletion[$index]['id_rekening_bank'] = $value;
                }


            } else {
                // If it's not grouped (e.g., basic fields like 'provinsi')
                $result[$key] = $value;
            }
        }

        // Reindex 'fasilitas' and 'tiket' arrays to have 0-based indexing
        $result['fasilitas'] = array_values($fasilitas);
        $result['tiket'] = array_values($tiket);
        $result['rekening_bank'] = array_values($rekeningBank);
        $result['gambar_for_deletion'] = array_values($gambarForDeletion);
        $result['ticket_for_deletion'] = array_values($ticketForDeletion);
        $result['facility_for_deletion'] = array_values($facilityForDeletion);
        $result['rekening_bank_for_deletion'] = array_values($rekeningBankForDeletion);


        // Process the files and ID pair (e.g., gambar_tempat_wisata_1)
        foreach ($fileData as $key => $file) {
            $keyParts = explode('_', $key);

            if (count($keyParts) > 1 && is_numeric(end($keyParts))) {
                $baseKey = implode('_', array_slice($keyParts, 0, -1)); // Get the base key without the suffix
                $index = (int)end($keyParts); // Get the index number

                // Handle 'gambar_tempat_wisata' and its corresponding 'id_gambar_tempat_wisata'
                if ($baseKey === 'gambar_tempat_wisata') {
                    $gambar[$index]['gambar_tempat_wisata'] = $file;
                    $gambar[$index]['id_gambar_tempat_wisata'] = $requestData["id_gambar_tempat_wisata_{$index}"] ?? null;
                }
            }
        }

        // Reindex 'gambar' array to have 0-based indexing
        $result['gambar'] = array_values($gambar);
        return $result;
    }
}
