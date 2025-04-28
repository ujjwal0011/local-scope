@extends('layouts.app')

@section('title', $business->name)

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <!-- Header with gradient background -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-500 rounded-xl shadow-lg p-6 mb-8">
        <h1 class="text-2xl font-bold text-white">{{ $business->name }}</h1>
        <p class="text-blue-100 mt-1">Business Details</p>
    </div>
    
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6">
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded mb-6 flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="space-y-6">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-3">About This Business</h2>
                    <p class="text-gray-700">{{ $business->description }}</p>
                </div>
                
                <div class="border-t border-gray-200 pt-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-3">Location Details</h2>
                    
                    <div class="flex items-start mb-4">
                        <div class="flex-shrink-0 mt-1">
                            <i class="fas fa-map-marker-alt text-red-500"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="font-medium text-gray-700">Address</h3>
                            <p class="text-gray-600">{{ $business->address }}</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h3 class="font-medium text-gray-700 mb-1">Latitude</h3>
                            <p class="text-gray-600">{{ $business->latitude }}</p>
                        </div>
                        
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h3 class="font-medium text-gray-700 mb-1">Longitude</h3>
                            <p class="text-gray-600">{{ $business->longitude }}</p>
                        </div>
                    </div>
                    
                    <!-- Simple map placeholder - in a real app, you'd use Google Maps or similar -->
                    <div class="mt-4 bg-gray-100 rounded-lg h-64 flex items-center justify-center">
                        <p class="text-gray-500">Map would be displayed here</p>
                    </div>
                </div>
                
                <div class="border-t border-gray-200 pt-6 flex justify-between">
                    <a href="{{ route('businesses.viewAll') }}" class="px-6 py-3 bg-gray-200 text-gray-700 font-medium rounded-lg shadow hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to List
                    </a>
                    
                    <div class="flex space-x-3">
                        <a href="{{ route('businesses.editForm', $business->id) }}" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition flex items-center">
                            <i class="fas fa-edit mr-2"></i>
                            Edit
                        </a>
                        
                        <form action="{{ route('businesses.destroyFromForm', $business->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this business?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-6 py-3 bg-red-600 text-white font-medium rounded-lg shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition flex items-center">
                                <i class="fas fa-trash mr-2"></i>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection