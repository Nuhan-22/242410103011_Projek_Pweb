<?php

namespace App\Http\Controllers\Visitor;

use App\Helpers\Common;
use App\Helpers\Enum\StatusPesananTiket;
use App\Helpers\Enum\StatusTiket;
use App\Helpers\FileSystem;
use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\PesananTiket;
use App\Models\TempatWisata;
use App\Models\TipeTiket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BookingTicketController extends Controller
{
    public function indexBookingAmount(Request $request){
        $tempatWisata = $request->get('tempat-wisata');

        // If the parameter is not provided or not numeric, return an error
        if (empty($tempatWisata) || !is_numeric($tempatWisata)) {
            abort(404, 'Tempat Wisata is required.');
        }

        $destination = TempatWisata::where('id_tempat_wisata', $tempatWisata)->with([
            'tipe_tiket.hari'
        ])->first();


        // dd($tempatWisata);


        return view('visitor-pages.pages.booking.detail-tiket', ['destination' => $destination]);
    }

    public function indexBookingPayment(Request $request){

        $validator = $this->validate($request);

        $idTempatWisata = $request->get('tempat-wisata');
        $idTipeTiket = $request->get('ticket');
        $tanggal = $request->get('tanggal');
        $jumlah = $request->get('jumlah');

        $tempatWisata = TempatWisata::where('id_tempat_wisata', $idTempatWisata)->with([
            'tipe_tiket.hari',
            'rekening_bank'
        ])->first();

        if (!$tempatWisata){
            abort(404, 'Tempat Wisata tidak ditemukan');
        }

        $tipeTiket = $tempatWisata->tipe_tiket()->where('id_tipe_tiket', $idTipeTiket)->first();
        if (!$tipeTiket){
            abort(404, 'Tipe Tiket tidak ditemukan');
        }

        $tanggal = Carbon::parse($tanggal);

        return view('visitor-pages.pages.booking.pembayaran-tiket', ['destination' => $tempatWisata, 'tipeTiket' => $idTipeTiket, 'tanggal' => $tanggal, 'jumlah' => $jumlah]);
    }

    public function processBuyTicket(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'tempat-wisata' => 'required|integer|exists:tempat_wisata,id_tempat_wisata',
            'id-rekening' => 'required|integer|exists:rekening_bank,id_rekening_bank',
            'ticket' => 'required|integer|exists:tipe_tiket,id_tipe_tiket',
            'tanggal' => 'required|date|date_format:Y-m-d|after_or_equal:today',
            'jumlah' => 'required|integer|min:1',
            'file' => 'required|file|image',
        ]);

        // Retrieve the ticket type from the database
        $tipeTiket = TipeTiket::find($validated['ticket']);

        $tempatWisata = TempatWisata::find($validated['tempat-wisata']);

        // Save the payment proof image and get the file path
        $path = FileSystem::saveImage($validated['file'], null, 'storage/payment-proof');

        // Start a database transaction for consistency
        DB::beginTransaction();
        try {
            // Create a payment record
            $pembayaran = Pembayaran::create([
                'bukti_pembayaran' => $path,
            ]);

            // Create a ticket order related to the payment
            $pesananTiket = $pembayaran->pesanan_tiket()->create([
                'id_pengguna' => Auth::user()->id_pengguna,
                'status' => StatusPesananTiket::DIPROSES,
                'id_rekening_bank' => $validated['id-rekening'],
            ]);

            // Create the ticket entry
            $pesananTiket->tikets()->create([
                'id_tipe_tiket' => $validated['ticket'],
                'tanggal_kunjungan' => $validated['tanggal'],
                'berlaku_sampai' => $validated['tanggal'],
                'jumlah_tiket' => $validated['jumlah'],
                'harga_per_unit' => $tipeTiket->harga,
                'status' => StatusTiket::ACTIVE,
            ]);

            // Commit the transaction
            DB::commit();
        } catch (\Exception $e) {
            // Rollback the transaction in case of any error
            DB::rollback();
            // Optionally, log the exception or handle it as needed
            throw $e;
        }

        // return redirect()->route('destination.detail', ['id' => $validated['tempat_wisata']]);

        Common::alertAndRedirect('Pembelian tiket ' . $tempatWisata->nama . 'berhasil!', route('booking.list'));
    }

    private function validate($request){
        $validator = Validator::make($request->all(), [
            'tempat-wisata' => 'required|integer|exists:tempat_wisata,id_tempat_wisata',
            'ticket' => 'required|integer|exists:tipe_tiket,id_tipe_tiket',
            'tanggal' => 'required|date|date_format:Y-m-d|after_or_equal:today',
            'jumlah' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {

            $idTempatWisata = $request->get('tempat-wisata');
            if (empty($idTempatWisata)) {
                Common::alertAndRedirect(
                    implode(",", $this->flattenArray($validator->errors()->messages())), // Flatten the error array
                    route('homepage')
                );
            }

            Common::alertAndRedirect(
                implode(",", $this->flattenArray($validator->errors()->messages())), // Flatten the error array here too
                route('destination.booking', ['tempat-wisata' => $idTempatWisata])
            );

        }

        return $validator;
    }

    public function flattenArray($array) {
        $flattened = [];
        array_walk_recursive($array, function($value) use (&$flattened) {
            $flattened[] = $value;
        });
        return $flattened;
    }
}
