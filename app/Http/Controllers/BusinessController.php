<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BusinessController extends Controller
{
    // API Methods
    public function index()
    {
        return response()->json(Business::all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $business = Business::create($request->all());
        return response()->json($business, 201);
    }

    public function show($id)
    {
        $business = Business::find($id);

        if (!$business) {
            return response()->json(['message' => 'Business not found'], 404);
        }

        return response()->json($business);
    }

    public function update(Request $request, $id)
    {
        $business = Business::find($id);

        if (!$business) {
            return response()->json(['message' => 'Business not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'address' => 'sometimes|required|string',
            'latitude' => 'sometimes|required|string',
            'longitude' => 'sometimes|required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $business->update($request->all());
        return response()->json($business);
    }

    public function destroy($id)
    {
        $business = Business::find($id);

        if (!$business) {
            return response()->json(['message' => 'Business not found'], 404);
        }

        $business->delete();
        return response()->json(['message' => 'Business deleted successfully']);
    }

    // Web Methods
    public function viewAll()
    {
        $businesses = Business::all();
        return view('business.index', compact('businesses'));
    }

    public function createForm()
    {
        return view('business.create');
    }

    public function storeFromForm(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
        ]);

        Business::create($validated);
        return redirect()->route('businesses.viewAll')->with('success', 'Business created successfully!');
    }

    // New web methods for edit, update, and delete
    public function editForm($id)
    {
        $business = Business::findOrFail($id);
        return view('business.edit', compact('business'));
    }

    public function updateFromForm(Request $request, $id)
    {
        $business = Business::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
        ]);

        $business->update($validated);
        return redirect()->route('businesses.viewAll')->with('success', 'Business updated successfully!');
    }

    public function destroyFromForm($id)
    {
        $business = Business::findOrFail($id);
        $business->delete();
        
        return redirect()->route('businesses.viewAll')->with('success', 'Business deleted successfully!');
    }
}