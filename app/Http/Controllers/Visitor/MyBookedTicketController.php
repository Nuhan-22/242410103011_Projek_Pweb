<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\PesananTiket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyBookedTicketController extends Controller
{
    public function index(Request $request){
        $statusType = $request->get('status');

        if (empty($statusType)){
            $statusType = \App\Helpers\Enum\StatusPesananTiket::DIPROSES->value;
        }

        $pesananTiket = PesananTiket::where(['id_pengguna' => Auth::user()->id_pengguna, 'status' => $statusType])->with([
            'tikets.tipe_tiket.tempat_wisata'
        ])->get();


        return view('visitor-pages.pages.booking.pesanan.daftar-pesanan-tiket', ['pesananTiket' => $pesananTiket, 'currentStatus' => $statusType]);
    }

    public function indexDetail(Request $request){
        $idPesanan = $request->get('pesanan');
        if (empty($idPesanan)){
            return redirect()->route('booking.list');
        }
        $pesananTiket = PesananTiket::where(['id_pengguna' => Auth::user()->id_pengguna, 'id_pesanan' => $idPesanan])->with([
            'tikets.tipe_tiket.tempat_wisata',
            'pembayaran.rekening_bank'
        ])->get()->first();

        return view('visitor-pages.pages.booking.pesanan.detail-pesanan', ['pesananTiket'=> $pesananTiket,'destination' => $pesananTiket->tikets->first()->tipe_tiket->tempat_wisata]);
    }
}
