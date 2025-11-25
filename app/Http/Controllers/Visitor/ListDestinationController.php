<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Alamat;
use App\Models\Kategori;
use App\Models\TempatWisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListDestinationController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all categories
        $categories = Kategori::all();

        // Fetch unique provinces, ordered alphabetically
        $provinces = Alamat::select('provinsi')
            ->distinct()
            ->orderBy('provinsi')
            ->pluck('provinsi');

        // Pass the data to the view
        return view('visitor-pages.pages.list-tempat-wisata', compact('categories', 'provinces'));
    }

    public function getDestinations(Request $request)
    {
        // Retrieve query parameters with default values
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 25);
        $searchQuery = $request->input('search', '');

        // Safely handle category and province filters
        $categories = $this->parseInput($request->input('categories', '') ?? '');
        $provinces = $this->parseInput($request->input('provinces', '') ?? '');

        // Call the processDestinations method with sanitized inputs
        return $this->processDestinations($page, $limit, $searchQuery, $categories, $provinces);
    }

    /**
     * Parse and normalize the input for categories or provinces.
     *
     * @param string $input
     * @return array
     */
    private function parseInput(string $input): array
    {
        if (empty($input)) {
            return [];
        }

        // Split by comma if applicable, otherwise return as an array
        return str_contains($input, ',') ? array_filter(explode(',', $input)) : [$input];
    }


    public function processDestinations($page = 1, $limit = 25, $searchQuery = "", $categories, $province )
    {
        // dd($categories, $province);
        // Calculate the offset for pagination
        $offset = ($page - 1) * $limit;

        DB::enableQueryLog();


        // Query the database using Eloquent
        $query = TempatWisata::query()
            ->with([
                'alamat',
                'gambar_tempat_wisata',
                'kategori_wisata.kategori',
                'ulasan',
                'tipe_tiket'
            ]);

        // Apply search filter
        if (!empty($searchQuery)) {
            $query->where('nama', 'LIKE', '%' . $searchQuery . '%');
        }

        // Filter by categories
        if (!empty($categories)) {
            $query->whereHas('kategori_wisata.kategori', function ($q) use ($categories) {
                $q->whereIn('id_kategori',  $categories);
            });
        }
        // Filter by province
        if (!empty($province)) {

            $query->whereHas('alamat', function ($q) use ($province) {
                $q->whereIn('provinsi', $province);
            });
        }
        // var_dump(DB::getQueryLog());
        // dd($query->toSql());

        // Get total count for pagination
        $totalDestinations = $query->count();

        // Apply limit and offset for pagination
        $destinations = $query->skip($offset)->take($limit)->get();
        // Transform results to match the dummy data format
        $transformedDestinations = $destinations->map(function ($destination) {
            $minPrice = $destination->tipe_tiket->min(function ($ticket) {
                return $ticket->harga;
            });
            return [
                'id' => $destination->id_tempat_wisata,
                'name' => $destination->nama,
                'address' => optional($destination->alamat)->jalan . ', ' . optional($destination->alamat)->kota,
                'image' => optional($destination->gambar_tempat_wisata->first())->url_gambar ?? 'https://placehold.co/286x198.png?text=No+Image',
                'price' => $minPrice ? $minPrice->harga : 0,
                'avg_rating' => round($destination->ulasan->avg('nilai_rating'), 1) ?? 0
            ];
        });

        // Calculate total pages
        $totalPages = ceil($totalDestinations / $limit);

        // Return the formatted response
        return response()->json([
            'destination' => $transformedDestinations,
            'current_page' => $page,
            'total_pages' => $totalPages
        ]);
    }




}
