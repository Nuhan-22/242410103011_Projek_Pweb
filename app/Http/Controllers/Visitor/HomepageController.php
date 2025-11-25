<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use App\Models\TempatWisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    public function index(Request $request){

        $carousel = Carousel::all();
        // dd($carousel);
        $topTwelveDestinations = TempatWisata::with('ulasan', 'gambar_tempat_wisata') // Load 'ulasan' relationship
        ->get() // Retrieve all TempatWisata records
        ->map(function ($destination) {
            // Calculate the average rating for this destination
            $destination->average_rating = $destination->ulasan->avg('nilai_rating') ?? 0;
            // Add it as a new attribute to the destination object
            return $destination;
        })
        ->sortByDesc('average_rating') // Sort destinations by this calculated value
        ->take(12); // Get the top 12 destinations

        $data = [
            'carousels' =>  $carousel,
            'destinations' => $topTwelveDestinations
        ];
        return view('visitor-pages.pages.homepage', $data);
    }
}
