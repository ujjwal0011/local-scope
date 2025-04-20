<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeolocationDealController extends Controller
{
    public function nearby(Request $request)
{
    // Add debug logs
    \Log::info('Nearby deals request received', [
        'params' => $request->all()
    ]);
    
    try {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'distance' => 'nullable|numeric|min:1|max:100',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $distance = $request->distance ?? 10; // Default 10km radius
        $categoryId = $request->category_id;

        // Calculate distance using the Haversine formula
        $deals = Deal::with(['business', 'category'])
            ->select('deals.*')
            ->selectRaw(
                '(6371 * acos(cos(radians(?)) * cos(radians(businesses.latitude)) * 
                 cos(radians(businesses.longitude) - radians(?)) + 
                 sin(radians(?)) * sin(radians(businesses.latitude)))) AS distance',
                [$latitude, $longitude, $latitude]
            )
            ->join('businesses', 'deals.business_id', '=', 'businesses.id')
            ->having('distance', '<=', $distance)
            ->when($categoryId, function ($query) use ($categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->orderBy('distance')
            ->get();

        \Log::info('Deals found', ['count' => $deals->count()]);
        
        return response()->json($deals);
    } catch (\Exception $e) {
        \Log::error('Error in nearby deals', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

    public function nearbyView()
    {
        $categories = Category::all();
        return view('deal.nearby', compact('categories'));
    }
}