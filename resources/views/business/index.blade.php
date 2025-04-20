@extends('layouts.app')

@section('title', 'Local Businesses')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    <!-- Enhanced Header with animated gradient background -->
    <div class="bg-gradient-to-r from-blue-600 via-indigo-500 to-purple-600 rounded-2xl shadow-xl mb-12 p-8 relative overflow-hidden">
        <div class="absolute inset-0 bg-grid-white/[0.08] opacity-40"></div>
        <!-- Decorative elements -->
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-xl"></div>
        <div class="absolute -bottom-12 -left-12 w-40 h-40 bg-white/10 rounded-full blur-lg"></div>
        
        <div class="flex flex-col md:flex-row justify-between items-center relative z-10 gap-6">
            <div class="text-center md:text-left">
                <h1 class="text-4xl font-bold text-white mb-3 tracking-tight">Local Businesses</h1>
                <p class="text-blue-100 text-lg">Discover great local businesses in your area</p>
            </div>
            <a href="{{ route('businesses.createForm') }}" class="group bg-white text-blue-600 hover:bg-blue-50 font-medium px-8 py-3 rounded-xl shadow-lg flex items-center transform transition duration-300 hover:scale-105">
                <i class="fas fa-plus mr-2 group-hover:rotate-90 transition-transform duration-300"></i>
                <span class="font-semibold">Add Business</span>
            </a>
        </div>
    </div>

    <!-- Improved Success message -->
    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-6 py-4 mb-10 rounded-lg shadow-md" role="alert">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    <!-- Enhanced Businesses Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($businesses as $business)
        <div class="bg-gradient-to-b from-white to-blue-50 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-blue-100 transform hover:-translate-y-1">
            <div class="relative">
                <!-- Business icon at the top right -->
                <div class="absolute top-4 right-4 bg-blue-500 text-white p-3 rounded-full shadow-lg">
                    <i class="fas fa-store"></i>
                </div>
                
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">{{ $business->name }}</h3>
                    <p class="text-gray-600 mb-6 text-lg leading-relaxed">{{ Str::limit($business->description, 120) }}</p>
                    
                    <div class="flex items-start text-gray-600 mb-5">
                        <i class="fas fa-map-marker-alt mt-1 mr-3 text-red-500 text-lg"></i>
                        <span class="leading-snug">{{ $business->address }}</span>
                    </div>
                    
                    <!-- Map coordinates with visual enhancement -->
                    <div class="flex justify-between items-center pt-4 border-t border-blue-100 text-sm">
                        <div class="flex items-center text-indigo-600 bg-blue-50 px-3 py-1.5 rounded-full">
                            <i class="fas fa-map-pin mr-1.5"></i>
                            <span>{{ number_format($business->latitude, 4) }}</span>
                        </div>
                        <div class="flex items-center text-indigo-600 bg-blue-50 px-3 py-1.5 rounded-full">
                            <i class="fas fa-location-arrow mr-1.5"></i>
                            <span>{{ number_format($business->longitude, 4) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Enhanced Empty state -->
    @if($businesses->isEmpty())
    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-100 rounded-xl p-12 text-center my-10 shadow-inner">
        <div class="inline-flex items-center justify-center w-24 h-24 bg-blue-100 rounded-full mb-6 shadow-inner">
            <i class="fas fa-store text-blue-500 text-3xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-blue-800 mb-3">No businesses found</h3>
        <p class="text-blue-600 text-lg mb-6 max-w-lg mx-auto">Be the first to add a business to our directory and help grow the local community!</p>
        <a href="{{ route('businesses.createForm') }}" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium px-8 py-3 rounded-xl transition-all shadow-lg hover:shadow-xl transform hover:scale-105">
            <i class="fas fa-plus-circle mr-2"></i>
            Add Your Business
        </a>
    </div>
    @endif
</div>

@section('scripts')
<script>
    // Background grid pattern animation
    document.addEventListener('DOMContentLoaded', function() {
        const gradientHeaders = document.querySelectorAll('.bg-gradient-to-r');
        gradientHeaders.forEach(header => {
            const gridDiv = header.querySelector('.bg-grid-white');
            if (gridDiv) {
                // Smooth animation effect
                let positionX = 0;
                let positionY = 0;
                setInterval(() => {
                    positionX -= 0.3;
                    positionY -= 0.2;
                    gridDiv.style.backgroundPosition = `${positionX}px ${positionY}px`;
                }, 30);
            }
        });
        
        // Add subtle hover interaction effect to business cards
        const businessCards = document.querySelectorAll('.grid > div');
        businessCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.querySelector('.fas-store')?.classList.add('animate-pulse');
            });
            card.addEventListener('mouseleave', function() {
                this.querySelector('.fas-store')?.classList.remove('animate-pulse');
            });
        });
    });
</script>
@endsection
@endsection