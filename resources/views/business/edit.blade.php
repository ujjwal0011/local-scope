@extends('layouts.app')

@section('title', 'Edit Business')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <!-- Header with gradient background -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-500 rounded-xl shadow-lg p-6 mb-8">
        <h1 class="text-2xl font-bold text-white">Edit Business</h1>
        <p class="text-blue-100 mt-1">Update your business information</p>
    </div>
    
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6">
            <div id="alert-placeholder" class="mb-6">
                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded">
                        <div class="font-medium">Please fix the following errors:</div>
                        <ul class="mt-1 ml-5 list-disc">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <form id="businessForm" action="{{ route('businesses.updateFromForm', $business->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Business Name</label>
                    <input type="text" name="name" value="{{ old('name', $business->name) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter business name" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 h-32" placeholder="Describe your business..." required>{{ old('description', $business->description) }}</textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <input type="text" name="address" value="{{ old('address', $business->address) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Full address" required>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Latitude</label>
                        <div class="relative">
                            <input type="text" name="latitude" id="latitude" value="{{ old('latitude', $business->latitude) }}" class="w-full pl-9 pr-3 py-2 border border-gray-300 rounded-lg" required>
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-map-marker-alt text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
                        <div class="relative">
                            <input type="text" name="longitude" id="longitude" value="{{ old('longitude', $business->longitude) }}" class="w-full pl-9 pr-3 py-2 border border-gray-300 rounded-lg" required>
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-map-marker-alt text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="pt-4 flex justify-between">
                    <a href="{{ route('businesses.viewAll') }}" class="px-6 py-3 bg-gray-200 text-gray-700 font-medium rounded-lg shadow hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back
                    </a>
                    
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i>
                        Update Business
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// You could add JavaScript here to update geolocation if needed
</script>
@endsection