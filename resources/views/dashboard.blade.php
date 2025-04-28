@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-black leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="text-sm text-gray-500 dark:text-black">
                {{ __('Welcome back') }}, <span class="font-medium">{{ Auth::user()->name }}</span>!
            </div>
        </div>

        <div class="space-y-6">
            <!-- User Profile Summary Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-16 w-16 rounded-full bg-indigo-600 text-white flex items-center justify-center text-xl font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ Auth::user()->name }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                {{ __('Member since') }} {{ Auth::user()->created_at->format('M Y') }}
                            </p>
                        </div>
                        <div class="ml-auto">
                            <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-200 dark:hover:bg-gray-600 focus:bg-gray-200 dark:focus:bg-gray-600 active:bg-gray-300 dark:active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                {{ __('Edit Profile') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('deals.nearby') }}" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg hover:shadow-md transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="bg-indigo-50 dark:bg-indigo-900 p-3 rounded-full">
                                <i class="bi bi-compass text-indigo-600 dark:text-indigo-400 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-md font-medium text-gray-900 dark:text-gray-100">{{ __('Browse Deals') }}</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Discover deals near your location') }}</p>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('deals.viewAll') }}" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg hover:shadow-md transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="bg-indigo-50 dark:bg-indigo-900 p-3 rounded-full">
                                <i class="bi bi-tags text-indigo-600 dark:text-indigo-400 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-md font-medium text-gray-900 dark:text-gray-100">{{ __('All Deals') }}</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Browse all available offers') }}</p>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('businesses.viewAll') }}" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg hover:shadow-md transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="bg-indigo-50 dark:bg-indigo-900 p-3 rounded-full">
                                <i class="bi bi-shop text-indigo-600 dark:text-indigo-400 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-md font-medium text-gray-900 dark:text-gray-100">{{ __('Businesses') }}</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Explore registered businesses') }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Categories -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Deal Categories') }}</h3>
                        <a href="{{ route('categories.viewAll') }}" class="text-sm text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300">
                            {{ __('View All') }} →
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($categories->take(4) as $category)
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 text-center hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                            <div class="text-indigo-600 dark:text-indigo-400 text-2xl mb-2">
                                <i class="bi bi-tag"></i>
                            </div>
                            <h4 class="font-medium text-gray-900 dark:text-gray-100">{{ $category->name }}</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $category->deals_count }} {{ __('deals') }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Featured Deals -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">{{ __('Featured Deals') }}</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @forelse($featuredDeals as $deal)
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-md overflow-hidden">
                            <div class="h-32 bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                <i class="bi bi-image text-gray-400 dark:text-gray-500 text-3xl"></i>
                            </div>
                            <div class="p-4">
                                <div class="flex justify-between items-start">
                                    <h4 class="font-medium text-gray-900 dark:text-gray-100">{{ $deal->title }}</h4>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100">
                                        {{ $deal->discount }}% OFF
                                    </span>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $deal->business->name }}</p>
                                <div class="mt-3 flex justify-between items-center">
                                    @if(isset($deal->original_price) && isset($deal->discounted_price))
                                    <div>
                                        <span class="text-xs text-gray-400 line-through">${{ $deal->original_price }}</span>
                                        <span class="text-sm font-medium text-indigo-600 dark:text-indigo-400">${{ $deal->discounted_price }}</span>
                                    </div>
                                    @else
                                    <div>
                                        <span class="text-sm font-medium text-indigo-600 dark:text-indigo-400">{{ $deal->discount }}% OFF</span>
                                    </div>
                                    @endif
                                    
                                    @if(isset($deal->distance))
                                    <div class="text-xs text-gray-500 dark:text-gray-400 flex items-center">
                                        <i class="bi bi-geo-alt text-xs mr-1"></i>
                                        {{ number_format($deal->distance, 1) }} km
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-3 text-center py-8 text-gray-500 dark:text-gray-400">
                            {{ __('No featured deals available right now.') }}
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection