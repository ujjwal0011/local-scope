@extends('layouts.app')

@section('title', 'Deal Categories')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <!-- Header with animated gradient background -->
    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 rounded-xl shadow-lg mb-8 p-8 relative overflow-hidden">
        <div class="absolute inset-0 bg-grid-white/[0.07] opacity-30"></div>
        <div class="flex flex-col md:flex-row justify-between items-center relative z-10">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Deal Categories</h1>
                <p class="text-blue-100">Organize your deals for better discovery</p>
            </div>
            <a href="{{ route('categories.createForm') }}" class="mt-4 md:mt-0 bg-white text-blue-600 hover:bg-blue-50 font-medium px-6 py-3 rounded-lg shadow-md flex items-center transform transition hover:scale-105">
                <i class="bi bi-plus-circle mr-2"></i>
                Add Category
            </a>
        </div>
    </div>

    <!-- Success message -->
    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-6 py-4 mb-6 rounded-lg shadow-md" role="alert">
        <div class="flex items-center">
            <i class="bi bi-check-circle-fill mr-3 text-xl text-green-600"></i>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    <!-- Categories Container -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <!-- Header with category count -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-white flex items-center">
                <i class="bi bi-grid-3x3-gap-fill mr-2"></i>
                All Categories
            </h2>
            <span class="bg-white text-blue-600 px-3 py-1 rounded-full text-sm font-medium flex items-center">
                <i class="bi bi-tag-fill mr-1 text-xs"></i>
                {{ count($categories) }} {{ Str::plural('Category', count($categories)) }}
            </span>
        </div>
        
        <div class="p-6">
            @if($categories->isNotEmpty())
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bg-gray-50 rounded-tl-lg">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bg-gray-50">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bg-gray-50">Created At</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($categories as $category)
                                <tr class="hover:bg-blue-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">#{{ $category->id }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-r from-indigo-500 to-blue-500 text-white flex items-center justify-center shadow-md">
                                                <i class="bi bi-tag-fill"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">{{ $category->name }}</p>
                                                @if(isset($category->description))
                                                    <p class="text-xs text-gray-500 truncate max-w-xs">{{ $category->description }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if($category->created_at)
                                            <div class="flex items-center space-x-1">
                                                <i class="bi bi-calendar-event text-indigo-400"></i>
                                                <span>{{ $category->created_at->format('M d, Y') }}</span>
                                            </div>
                                        @else
                                            <span class="text-gray-400">N/A</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination - if you have pagination set up -->
                @if(method_exists($categories, 'links') && $categories->hasPages())
                    <div class="mt-6 px-6">
                        {{ $categories->links() }}
                    </div>
                @endif
            @else
                <!-- Empty state with illustration -->
                <div class="py-12 flex flex-col items-center justify-center">
                    <div class="w-24 h-24 mb-4 rounded-full bg-blue-100 flex items-center justify-center">
                        <i class="bi bi-folder-x text-4xl text-blue-500"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">No Categories Found</h3>
                    <p class="text-gray-600 text-center max-w-md mb-6">Categories help you organize deals for better discovery. Create your first category to get started.</p>
                    <a href="{{ route('categories.createForm') }}" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition transform hover:scale-105 flex items-center">
                        <i class="bi bi-plus-circle mr-2"></i>
                        Create First Category
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .bg-grid-white {
        background-image: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
        background-size: 15px 15px;
    }
    
    /* For animated gradient if desired */
    @keyframes gradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    .animate-gradient {
        background-size: 200% 200%;
        animation: gradient 8s ease infinite;
    }
</style>
@endsection

@section('scripts')
<script>
    // Background grid pattern animation
    document.addEventListener('DOMContentLoaded', function() {
        const gradientHeaders = document.querySelectorAll('.bg-gradient-to-r');
        gradientHeaders.forEach(header => {
            const gridDiv = header.querySelector('.bg-grid-white');
            if (gridDiv) {
                // Simple animation effect (subtle)
                let position = 0;
                setInterval(() => {
                    position -= 0.5;
                    gridDiv.style.backgroundPosition = `${position}px ${position}px`;
                }, 50);
            }
        });
    });
</script>
@endsection