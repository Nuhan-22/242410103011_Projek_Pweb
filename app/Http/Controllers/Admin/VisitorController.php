<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengunjung;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VisitorController extends Controller
{
    public function getVisitorData(Request $request)
    {
        // Get the first and last day of the current month
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Generate the labels (days of the current month)
        $daysOfMonth = [];
        for ($i = 1; $i <= $endOfMonth->day; $i++) {
            $daysOfMonth[] = $i;  // Add day number to the array
        }

        // Query to get visitor counts for each day of the current month
        $data = Pengunjung::whereBetween('waktu_kunjungan', [$startOfMonth, $endOfMonth])
            ->selectRaw('DAY(waktu_kunjungan) as day, COUNT(*) as total')
            ->groupBy('day')
            ->orderBy('day')  // Order by day to ensure correct sequence
            ->pluck('total', 'day')
            ->toArray();

        // Fill missing days with 0 visits
        $filledData = array_fill_keys($daysOfMonth, 0); // Initialize all days with 0
        foreach ($data as $day => $total) {
            $filledData[$day] = $total;  // Overwrite with actual visit data
        }

        return response()->json([
            'label' => $daysOfMonth,  // Return the days of the month as labels
            'data' => array_values($filledData),  // Return the corresponding visitor counts
        ]);

        
    }
}
