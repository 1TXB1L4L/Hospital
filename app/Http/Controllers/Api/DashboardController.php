<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Medicine_log;

class DashboardController extends Controller
{
    // Most used medicines
    public function mostUsedMedicines()
    {
        $medicines = DB::table('medicine_logs')
            ->select('medicine_id', DB::raw('COUNT(*) as usage_count'))
            ->groupBy('medicine_id')
            ->orderByDesc('usage_count')
            ->take(10)
            ->get();
        //get name and geberaric name of medicines by id.*/
        foreach ($medicines as $medicine) {
            $medicine->name = DB::table('medicines')->where('id', $medicine->medicine_id)->value('name');
                $medicine->generic_id = DB::table('medicines')->where('id', $medicine->medicine_id)->value('generic_id');
            $medicine->generic_name = DB::table('generics')->where('id', $medicine->generic_id)->value('generic_name');
            $medicine->category = DB::table('medicines')->where('id', $medicine->medicine_id)->value('category');
        }
        return response()->json($medicines, 200);
    }

    // Medicines used in the last month
    public function lastMonthUsedMedicines()
    {
        $lastMonth = now()->subMonth();
        $medicines = DB::table('medicine_logs')
            ->where('created_at', '>=', $lastMonth)
            ->select('medicine_id', DB::raw('COUNT(*) as usage_count'))
            ->groupBy('medicine_id')
            ->orderByDesc('usage_count')
            ->take(10)
            ->get();

        return response()->json($medicines, 200);
    }

    // Prediction for next month
    public function predictNextMonthUsage()
    {
        // Example: Use an average of past months' usage
        $medicines = DB::table('medicine_logs')
            ->select('medicine_id', DB::raw('ROUND(AVG(usage_count), 2) as predicted_usage'))
            ->groupBy('medicine_id')
            ->get();

        return response()->json($medicines, 200);
    }

    // Medicines near to end
    public function medicinesNearToEnd()
    {
        $medicines = DB::table('medicines')
            ->where('quantity', '<=', 30) // Threshold of 10 units
            ->get();

        return response()->json($medicines, 200);
    }

    // Medicines about to expire
    public function medicinesAboutToExpire()
    {
        $thresholdDate = now()->addMonth(); // Expiry within the next month
        $medicines = DB::table('medicines')
            ->where('expiry_date', '<=', $thresholdDate)
            ->pluck('name', 'expiry_date', 'category', 'generic_id')
            ->toJson();

        return response()->json($medicines, 200);
    }

    // Usage of a specific medicine
    public function getMedicineUsage(Request $request)
    {
        $medicineId = $request->input('medicine_id');
        // send data for chart.js
        $result = Medicine_log::where('medicine_id', $medicineId)
            ->select('created_at', DB::raw('COUNT(*) as usage_count'))
            ->groupBy('created_at')
            ->get();
        return response()->json($result, 200);
    }

    // Add additional stats as needed
}
