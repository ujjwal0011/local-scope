@extends('layouts.app')

@section('title', 'Businesses')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <!-- Header with gradient background -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-500 rounded-xl shadow-lg p-6 mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-white">Businesses</h1>
                <p class="text-blue-100 mt-1">Browse local businesses in our directory</p>
            </div>
            <a href="{{ route('businesses.createForm') }}" class="px-4 py-2 bg-white text-blue-600 font-medium rounded-lg shadow hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-600 transition flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Add Business
            </a>
        </div>
    </div>
    
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded mb-6 flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($businesses as $business)
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-800">{{ $business->name }}</h2>
                <p class="text-gray-500 mt-1">{{ Str::limit($business->description, 100) }}</p>
                
                <div class="mt-4 text-sm text-gray-600">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                        {{ $business->address }}
                    </div>
                </div>
                
                <div class="mt-6 flex justify-between items-center">
                    <div class="flex space-x-2">
                        <a href="{{ route('businesses.editForm', $business->id) }}" class="px-3 py-1 bg-blue-100 text-blue-600 rounded hover:bg-blue-200 transition">
                            <i class="fas fa-edit"></i>
                        </a>
                        
                        <form action="{{ route('businesses.destroyFromForm', $business->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this business?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-100 text-red-600 rounded hover:bg-red-200 transition">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                    
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                        View Details
                        <i class="fas fa-chevron-right ml-1 text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 bg-blue-50 rounded-xl p-8 text-center">
            <div class="text-blue-500 mb-2">
                <i class="fas fa-store fa-3x"></i>
            </div>
            <h3 class="text-xl font-medium text-gray-800 mb-2">No businesses found</h3>
            <p class="text-gray-600 mb-4">Be the first to add a business to our directory!</p>
            <a href="{{ route('businesses.createForm') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                <i class="fas fa-plus mr-2"></i>
                Add Business
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection