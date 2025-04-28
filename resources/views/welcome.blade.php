@extends('layouts.app')

@section('title', 'Welcome to LocalScope')

@section('content')
<!-- Hero Section with Animated Background -->
<div class="bg-gradient-to-br from-indigo-900 via-purple-800 to-blue-600 text-white py-24 mb-20 rounded-b-3xl text-center relative overflow-hidden shadow-xl">
    <!-- Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <svg class="absolute -left-10 top-0 h-full opacity-10" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <circle cx="50" cy="50" r="40" fill="white" />
        </svg>
        <svg class="absolute right-0 top-20 h-64 opacity-10" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <circle cx="50" cy="50" r="40" fill="white" />
        </svg>
    </div>
    
    <div class="max-w-4xl mx-auto px-4 relative z-10">
        <h1 class="text-4xl md:text-6xl font-extrabold mb-6 tracking-tight leading-tight">
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-yellow-200 to-yellow-500">Find the Best</span> 
            <span class="block">Local Deals Near You</span>
        </h1>
        <p class="text-lg md:text-xl mb-10 text-blue-100 max-w-2xl mx-auto">Discover amazing discounts at businesses in your neighborhood - all with just a few taps</p>
        <div class="flex flex-col md:flex-row justify-center items-center gap-5">
            <a href="{{ route('deals.nearby') }}" class="bg-white text-indigo-800 font-bold px-8 py-4 rounded-full hover:bg-yellow-300 hover:text-indigo-900 transition-all duration-300 shadow-lg transform hover:scale-105 flex items-center justify-center">
                <i class="bi bi-compass mr-2"></i> Find Nearby Deals
            </a>
            @guest
            <a href="{{ route('register') }}" class="border-2 border-white text-white px-8 py-3.5 rounded-full hover:bg-white hover:text-indigo-800 transition-all duration-300 flex items-center justify-center mt-4 md:mt-0">
                <i class="bi bi-person-plus mr-2"></i> Sign Up Now
            </a>
            @endguest
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="max-w-7xl mx-auto px-4 mb-24">
    <div class="text-center mb-12">
        <span class="bg-indigo-100 text-indigo-800 py-1 px-4 rounded-full text-sm font-medium uppercase tracking-wider">Why Choose Us</span>
        <h2 class="text-3xl font-bold mt-4 text-gray-800">Everything you need to save money locally</h2>
    </div>
    
    <div class="grid md:grid-cols-3 gap-8 mb-16">
        <div class="bg-white rounded-2xl shadow-lg p-8 hover:-translate-y-2 transition transform duration-300 border-t-4 border-purple-600">
            <div class="bg-purple-100 text-purple-700 w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                <i class="bi bi-geo-alt text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold mb-3 text-gray-800">Location-Based</h3>
            <p class="text-gray-600 leading-relaxed">Find deals close to your current location, no matter where you are. Always stay updated with local offers.</p>
        </div>
        
        <div class="bg-white rounded-2xl shadow-lg p-8 hover:-translate-y-2 transition transform duration-300 border-t-4 border-blue-600">
            <div class="bg-blue-100 text-blue-700 w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                <i class="bi bi-tag text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold mb-3 text-gray-800">Exclusive Discounts</h3>
            <p class="text-gray-600 leading-relaxed">Get access to special offers and discounts from local businesses that you won't find anywhere else.</p>
        </div>
        
        <div class="bg-white rounded-2xl shadow-lg p-8 hover:-translate-y-2 transition transform duration-300 border-t-4 border-indigo-600">
            <div class="bg-indigo-100 text-indigo-700 w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                <i class="bi bi-shop text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold mb-3 text-gray-800">Support Local</h3>
            <p class="text-gray-600 leading-relaxed">Discover and support small businesses in your community while enjoying great savings on products and services.</p>
        </div>
    </div>

    <!-- How It Works Section -->
    <div class="py-16 bg-gray-50 rounded-3xl mb-20 px-6">
        <div class="text-center mb-12">
            <span class="bg-blue-100 text-blue-800 py-1 px-4 rounded-full text-sm font-medium uppercase tracking-wider">Simple Process</span>
            <h2 class="text-3xl font-bold mt-4 mb-2 text-gray-800">How It Works</h2>
            <p class="text-gray-600 max-w-xl mx-auto">Three simple steps to start saving money at local businesses</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-10">
            <div class="relative">
                <div class="mx-auto bg-gradient-to-r from-indigo-600 to-blue-500 text-white w-16 h-16 flex items-center justify-center rounded-full text-xl font-bold mb-6 shadow-lg">1</div>
                <h4 class="text-xl font-bold mb-3 text-gray-800 text-center">Share Your Location</h4>
                <p class="text-gray-600 text-center">Allow the app to access your location to find the best deals near you.</p>
                <!-- Connector line (hidden on mobile) -->
                <div class="hidden md:block absolute top-8 left-full w-full h-0.5 bg-blue-200 -z-10"></div>
            </div>
            
            <div class="relative">
                <div class="mx-auto bg-gradient-to-r from-indigo-600 to-blue-500 text-white w-16 h-16 flex items-center justify-center rounded-full text-xl font-bold mb-6 shadow-lg">2</div>
                <h4 class="text-xl font-bold mb-3 text-gray-800 text-center">Browse Available Deals</h4>
                <p class="text-gray-600 text-center">Filter by category or distance to find the perfect deal for your needs.</p>
                <!-- Connector line (hidden on mobile) -->
                <div class="hidden md:block absolute top-8 left-full w-full h-0.5 bg-blue-200 -z-10"></div>
            </div>
            
            <div>
                <div class="mx-auto bg-gradient-to-r from-indigo-600 to-blue-500 text-white w-16 h-16 flex items-center justify-center rounded-full text-xl font-bold mb-6 shadow-lg">3</div>
                <h4 class="text-xl font-bold mb-3 text-gray-800 text-center">Enjoy Your Savings</h4>
                <p class="text-gray-600 text-center">Visit the business and claim your discount with no hassle.</p>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-blue-700 to-indigo-800 rounded-3xl p-12 text-center text-white shadow-xl">
        <h3 class="text-3xl font-bold mb-6">Ready to Start Saving?</h3>
        <p class="text-lg mb-8 text-blue-100 max-w-xl mx-auto">Join thousands of happy customers who save money every day with LocalScope</p>
        <a href="{{ route('deals.nearby') }}" class="inline-block bg-yellow-400 text-indigo-900 px-8 py-4 rounded-full text-lg font-bold hover:bg-yellow-300 transition duration-300 shadow-lg transform hover:scale-105">
            <i class="bi bi-search mr-2"></i> Start Exploring Deals Now
        </a>
    </div>
</div>

<!-- Testimonials Section (Optional) -->
<div class="max-w-7xl mx-auto px-4 mb-24">
    <div class="text-center mb-12">
        <span class="bg-green-100 text-green-800 py-1 px-4 rounded-full text-sm font-medium uppercase tracking-wider">Testimonials</span>
        <h2 class="text-3xl font-bold mt-4 text-gray-800">What Our Users Say</h2>
    </div>
    
    <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">
            <div class="text-yellow-400 mb-2">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
            </div>
            <p class="text-gray-600 italic mb-4">"I found an amazing 50% off deal at my favorite restaurant just a block away. This app pays for itself!"</p>
            <div class="flex items-center">
                <div class="bg-blue-100 w-10 h-10 rounded-full flex items-center justify-center mr-3">
                    <span class="font-bold text-blue-700">JD</span>
                </div>
                <div>
                    <h5 class="font-semibold">John D.</h5>
                    <p class="text-sm text-gray-500">Loyal User</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">
            <div class="text-yellow-400 mb-2">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
            </div>
            <p class="text-gray-600 italic mb-4">"LocalScope helped me discover new businesses in my area while saving money. It's a win-win!"</p>
            <div class="flex items-center">
                <div class="bg-purple-100 w-10 h-10 rounded-full flex items-center justify-center mr-3">
                    <span class="font-bold text-purple-700">SM</span>
                </div>
                <div>
                    <h5 class="font-semibold">Sarah M.</h5>
                    <p class="text-sm text-gray-500">Happy Customer</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">
            <div class="text-yellow-400 mb-2">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
            </div>
            <p class="text-gray-600 italic mb-4">"As a business owner, this platform has brought in so many new customers. The ROI is incredible!"</p>
            <div class="flex items-center">
                <div class="bg-green-100 w-10 h-10 rounded-full flex items-center justify-center mr-3">
                    <span class="font-bold text-green-700">RT</span>
                </div>
                <div>
                    <h5 class="font-semibold">Robert T.</h5>
                    <p class="text-sm text-gray-500">Business Owner</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection