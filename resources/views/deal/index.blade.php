@extends('layouts.app')

@section('title', 'Local Deals')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    <!-- Enhanced Header with more spacious design and improved gradient -->
    <div class="bg-gradient-to-r from-blue-600 via-indigo-500 to-purple-600 rounded-2xl shadow-xl mb-12 p-8 relative overflow-hidden">
        <div class="absolute inset-0 bg-grid-white/[0.08] opacity-40"></div>
        <!-- Decorative circles -->
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-xl"></div>
        <div class="absolute -bottom-12 -left-12 w-40 h-40 bg-white/10 rounded-full blur-lg"></div>
        
        <div class="flex flex-col md:flex-row justify-between items-center relative z-10 gap-6">
            <div class="text-center md:text-left">
                <h1 class="text-4xl font-bold text-white mb-3 tracking-tight">Local Deals</h1>
                <p class="text-blue-100 text-lg">Discover amazing savings in your area</p>
            </div>
            <a href="{{ route('deals.createForm') }}" class="group bg-white text-blue-600 hover:bg-blue-50 font-medium px-8 py-3 rounded-xl shadow-lg flex items-center transform transition duration-300 hover:scale-105">
                <i class="fas fa-plus mr-2 group-hover:rotate-90 transition-transform duration-300"></i>
                <span class="font-semibold">Add New Deal</span>
            </a>
        </div>
    </div>

    <!-- Improved Success message with better spacing -->
    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-6 py-4 mb-10 rounded-lg shadow-md" role="alert">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    <!-- More spacious Deals Grid with larger cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($deals as $deal)
        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 transform hover:-translate-y-1">
            <!-- Enhanced Card header with gradient background -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-500 px-6 py-4 flex justify-between items-center">
                <h3 class="font-bold text-lg text-white truncate">{{ $deal->title }}</h3>
                <span class="bg-red-500 text-white px-3 py-1.5 rounded-full text-sm font-bold flex items-center shadow-md">
                    <i class="fas fa-tag mr-1.5"></i>
                    {{ $deal->discount }}% OFF
                </span>
            </div>
            
            <div class="p-6">
                <!-- Card body with more space -->
                <p class="text-gray-600 text-lg mb-6 leading-relaxed">{{ Str::limit($deal->description, 120) }}</p>
                
                <!-- Enhanced Card footer -->
                <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                    <span class="bg-indigo-100 text-indigo-800 rounded-full px-4 py-1.5 text-sm font-medium">
                        {{ $deal->category->name }}
                    </span>
                    <div class="flex items-center text-gray-600 text-sm font-medium">
                        <i class="fas fa-store mr-2 text-indigo-400"></i>
                        {{ $deal->business->name }}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Enhanced Empty state with more visual appeal -->
    @if($deals->isEmpty())
    <div class="bg-blue-50 border border-blue-100 rounded-xl p-12 text-center my-10 shadow-inner">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-100 rounded-full mb-6 shadow-inner">
            <i class="fas fa-shopping-bag text-blue-500 text-2xl"></i>
        </div>
        <h3 class="text-xl font-bold text-blue-800 mb-3">No deals found</h3>
        <p class="text-blue-600 text-lg mb-6 max-w-md mx-auto">Add some amazing deals to attract customers and boost your local business!</p>
        <a href="{{ route('deals.createForm') }}" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-3 rounded-xl transition-all shadow-lg hover:shadow-xl transform hover:scale-105">
            <i class="fas fa-plus-circle mr-2"></i>
            Create your first deal
        </a>
    </div>
    @endif
</div>

@section('scripts')
<script>
    // Enhanced background grid pattern with smoother animation
    document.addEventListener('DOMContentLoaded', function() {
        const gradientHeaders = document.querySelectorAll('.bg-gradient-to-r');
        gradientHeaders.forEach(header => {
            const gridDiv = header.querySelector('.bg-grid-white');
            if (gridDiv) {
                // Smoother animation effect
                let positionX = 0;
                let positionY = 0;
                setInterval(() => {
                    positionX -= 0.3;
                    positionY -= 0.2;
                    gridDiv.style.backgroundPosition = `${positionX}px ${positionY}px`;
                }, 30);
            }
        });
        
        // Optional: Add subtle hover effects to cards
        const dealCards = document.querySelectorAll('.grid > div');
        dealCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.classList.add('shadow-xl');
            });
            card.addEventListener('mouseleave', function() {
                this.classList.remove('shadow-xl');
            });
        });
    });
</script>
@endsection
@endsection