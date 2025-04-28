<!DOCTYPE html>
<html lang="en">
<head>
    <title>Nearby Deals</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            200: '#c7d2fe',
                            300: '#a5b4fc',
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81'
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 py-8">
        <header class="mb-8">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-primary-700">
                    <i class="fas fa-tags mr-2"></i>Nearby Deals
                </h1>
                
                @auth
                <div class="flex items-center space-x-4">
                    <div id="location-status" class="text-sm font-medium text-gray-600 flex items-center bg-white py-2 px-4 rounded-full shadow-sm">
                        <div class="animate-spin mr-2">
                            <i class="fas fa-circle-notch"></i>
                        </div>
                        Detecting your location...
                    </div>
                </div>
                @else
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-sm font-medium text-primary-600 hover:text-primary-700">Log in</a>
                    <a href="{{ route('register') }}" class="text-sm font-medium bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg">Register</a>
                </div>
                @endauth
            </div>
            <p class="text-gray-500 mt-2">Discover the best offers around you in just a few clicks</p>
        </header>

        @guest
        <div class="bg-white rounded-xl shadow-md p-8 text-center">
            <div class="text-5xl text-primary-500 mb-4">
                <i class="fas fa-user-lock"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Authentication Required</h2>
            <p class="text-gray-600 mb-6">Please log in or register to view nearby deals</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('login') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2 rounded-lg">
                    <i class="fas fa-sign-in-alt mr-2"></i>Log in
                </a>
                <a href="{{ route('register') }}" class="bg-white border border-primary-600 text-primary-600 hover:bg-primary-50 px-6 py-2 rounded-lg">
                    <i class="fas fa-user-plus mr-2"></i>Register
                </a>
            </div>
        </div>
        @else
        
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Filter Options</h2>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label for="distance" class="block text-sm font-medium text-gray-700 mb-2">Distance Range</label>
                    <div class="mb-1">
                        <input type="range" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-primary-600" 
                               id="distance" min="1" max="50" value="10">
                    </div>
                    <div class="flex justify-between text-xs text-gray-500">
                        <span>1 km</span>
                        <span id="distance-value" class="text-primary-600 font-medium">10 km</span>
                        <span>50 km</span>
                    </div>
                </div>
                
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <div class="relative">
                        <select id="category" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 rounded-lg shadow-sm">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="no-deals" class="hidden bg-amber-50 border-l-4 border-amber-400 p-4 rounded-md mb-6">
            <div class="flex">
                <div class="flex-shrink-0 text-amber-400">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-amber-700">
                        No deals found in your area. Try increasing the distance or changing categories.
                    </p>
                </div>
            </div>
        </div>

        <div id="loading-indicator" class="flex justify-center py-12">
            <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-primary-600"></div>
        </div>

        <div id="deals-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Deals will be loaded here -->
        </div>
        @endguest
    </div>

    @auth
    <script>
        let userLat, userLng;

        // Update distance value display
        document.getElementById('distance').addEventListener('input', function () {
            document.getElementById('distance-value').textContent = this.value + ' km';
            if (userLat && userLng) {
                searchDeals();
            }
        });

        // Filter by category
        document.getElementById('category').addEventListener('change', function () {
            if (userLat && userLng) {
                searchDeals();
            }
        });

        // Get user location
        function getUserLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    position => {
                        userLat = position.coords.latitude;
                        userLng = position.coords.longitude;

                        document.getElementById('location-status').innerHTML =
                            `<i class="fas fa-map-marker-alt text-primary-500 mr-2"></i> Your location detected`;

                        searchDeals();
                    },
                    error => {
                        document.getElementById('location-status').innerHTML =
                            `<i class="fas fa-exclamation-triangle text-red-500 mr-2"></i> Location error: ${error.message}`;
                    }
                );
            } else {
                document.getElementById('location-status').innerHTML =
                    `<i class="fas fa-ban text-red-500 mr-2"></i> Geolocation not supported`;
            }
        }

        // Search deals based on current filters
        function searchDeals() {
            const distance = document.getElementById('distance').value;
            const categoryId = document.getElementById('category').value;
            
            document.getElementById('loading-indicator').classList.remove('hidden');
            document.getElementById('deals-container').classList.add('hidden');
            
            const url = `/api/deals/nearby?latitude=${userLat}&longitude=${userLng}&distance=${distance}&category_id=${categoryId}`;
            
            fetch(url, {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                credentials: 'same-origin' // Ensures cookies are sent with the request
            })
            .then(response => {
                if (!response.ok) {
                    if (response.status === 401) {
                        // Redirect to login if unauthorized
                        window.location.href = '{{ route("login") }}';
                        throw new Error('Please log in to view deals');
                    }
                    return response.text().then(text => {
                        throw new Error(`Server error: ${response.status} - ${text}`);
                    });
                }
                return response.json();
            })
            .then(data => {
                document.getElementById('loading-indicator').classList.add('hidden');
                document.getElementById('deals-container').classList.remove('hidden');
                
                if (!Array.isArray(data)) {
                    console.error("Expected array but got:", typeof data, data);
                    throw new Error("Invalid data format received from server");
                }
                
                const dealsContainer = document.getElementById('deals-container');
                dealsContainer.innerHTML = '';

                if (data.length === 0) {
                    document.getElementById('no-deals').classList.remove('hidden');
                    return;
                }

                document.getElementById('no-deals').classList.add('hidden');

                data.forEach(deal => {
                    // Create random price values for visual effect
                    const oldPrice = Math.round(100 + Math.random() * 900);
                    const newPrice = Math.round(oldPrice * (1 - deal.discount/100));
                    
                    dealsContainer.innerHTML += `
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden border border-gray-100">
                            <div class="relative">
                                <div class="h-48 bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400 text-4xl"></i>
                                </div>
                                <div class="absolute top-4 left-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                        ${deal.category.name}
                                    </span>
                                </div>
                                <div class="absolute top-4 right-4">
                                    <span class="inline-flex items-center px-2.5 py-1.5 rounded-full text-xs font-bold bg-red-500 text-white">
                                        ${deal.discount}% OFF
                                    </span>
                                </div>
                            </div>
                            
                            <div class="p-5">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-lg font-semibold line-clamp-1 text-gray-900">${deal.title}</h3>
                                    <div class="flex items-center text-gray-500 text-sm">
                                        <i class="fas fa-map-marker-alt mr-1 text-primary-500"></i>
                                        <span>${deal.distance.toFixed(1)} km</span>
                                    </div>
                                </div>
                                
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                    ${deal.description ? deal.description.substring(0, 100) + (deal.description.length > 100 ? '...' : '') : 'No description available'}
                                </p>
                                
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-gray-400 line-through text-sm">$${oldPrice}</span>
                                        <span class="text-primary-700 font-bold ml-1">$${newPrice}</span>
                                    </div>
                                    <div class="text-xs text-gray-500">${deal.business.name}</div>
                                </div>
                                
                                
                            </div>
                        </div>
                    `;
                });
            })
            .catch(error => {
                console.error('Error fetching deals:', error);
                document.getElementById('loading-indicator').classList.add('hidden');
                document.getElementById('deals-container').classList.remove('hidden');
                document.getElementById('deals-container').innerHTML = `
                    <div class="col-span-full">
                        <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-md">
                            <div class="flex">
                                <div class="flex-shrink-0 text-red-400">
                                    <i class="fas fa-exclamation-circle"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-red-700">
                                        Error fetching deals: ${error.message}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                document.getElementById('no-deals').classList.add('hidden');
            });
        }

        window.onload = function() {
            document.getElementById('deals-container').classList.add('hidden');
            getUserLocation();
        };
    </script>
    @endauth
</body>
</html>