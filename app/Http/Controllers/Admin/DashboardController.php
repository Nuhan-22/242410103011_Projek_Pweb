<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){
        // Get total ulasan
        $totalUlasan = Ulasan::count();

        // Get total ulasan for today
        $totalUlasanToday = Ulasan::whereDate('created_at', today())->count();

        return view('admin-pages.pages.dasboard' , ['totalUlasan' => $totalUlasan, 'totalUlasanToday' => $totalUlasanToday]);
    }


}
