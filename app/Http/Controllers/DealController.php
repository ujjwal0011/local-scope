<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Business;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DealController extends Controller
{
    // API Methods
    public function index()
    {
        return response()->json(Deal::with(['business', 'category'])->get());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount' => 'required|numeric|min:0|max:100',
            'business_id' => 'required|exists:businesses,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $deal = Deal::create($request->all());
        return response()->json($deal, 201);
    }

    public function show($id)
    {
        $deal = Deal::with(['business', 'category'])->find($id);
        if (!$deal) {
            return response()->json(['message' => 'Deal not found'], 404);
        }

        return response()->json($deal);
    }

    public function update(Request $request, $id)
    {
        $deal = Deal::find($id);
        if (!$deal) {
            return response()->json(['message' => 'Deal not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'discount' => 'sometimes|required|numeric|min:0|max:100',
            'business_id' => 'sometimes|required|exists:businesses,id',
            'category_id' => 'sometimes|required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $deal->update($request->all());
        return response()->json($deal);
    }

    public function destroy($id)
    {
        $deal = Deal::find($id);
        if (!$deal) {
            return response()->json(['message' => 'Deal not found'], 404);
        }

        $deal->delete();
        return response()->json(['message' => 'Deal deleted successfully']);
    }

    // Web Methods
    public function viewAll()
    {
        $deals = Deal::with(['business', 'category'])->get();
        return view('deal.index', compact('deals'));
    }

    public function createForm()
    {
        $businesses = Business::all();
        $categories = Category::all();
        return view('deal.create', compact('businesses', 'categories'));
    }

    public function storeFromForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount' => 'required|numeric|min:0|max:100',
            'business_id' => 'required|exists:businesses,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Deal::create($request->all());
        return redirect()->route('deals.viewAll')->with('success', 'Deal created successfully!');
    }
}