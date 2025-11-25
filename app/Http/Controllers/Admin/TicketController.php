<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PesananTiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function indexKelolaTiket(){
        $pesananTiket = PesananTiket::with([
            'tikets.tipe_tiket.tempat_wisata'
        ]);

        if (Auth::user()->id_role == 3) {
            $pesananTiket = $pesananTiket->whereHas('tikets.tipe_tiket.tempat_wisata', function($query) {
                $query->where('id_pengguna', Auth::user()->id_pengguna);
            });
        }

        $pesananTiket = $pesananTiket->get();


        return view('admin-pages.pages.kelola-tiket', compact('pesananTiket'));
    }

    public function indexKonfirmasiTiket(){
        return view('admin-pages.pages.detail-tiket');
    }
}
