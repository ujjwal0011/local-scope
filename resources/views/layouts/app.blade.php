<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Local Business Promotions')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @yield('styles')
</head>

<body class="bg-light">
<nav class="bg-gradient-to-r from-blue-700 to-indigo-800 text-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <a href="/" class="flex items-center space-x-2 text-lg font-bold">
                <i class="bi bi-geo-alt-fill text-xl text-yellow-300"></i>
                <span class="tracking-wide">LocalScope</span>
            </a>
            <div class="hidden md:flex space-x-8">
                <a href="{{ route('deals.nearby') }}" class="flex items-center space-x-2 hover:text-yellow-200 transition-colors duration-200">
                    <i class="bi bi-compass"></i><span>Nearby Deals</span>
                </a>
                <a href="{{ route('deals.viewAll') }}" class="flex items-center space-x-2 hover:text-yellow-200 transition-colors duration-200">
                    <i class="bi bi-tags"></i><span>All Deals</span>
                </a>
                <a href="{{ route('businesses.viewAll') }}" class="flex items-center space-x-2 hover:text-yellow-200 transition-colors duration-200">
                    <i class="bi bi-shop"></i><span>Businesses</span>
                </a>
                <a href="{{ route('categories.viewAll') }}" class="flex items-center space-x-2 hover:text-yellow-200 transition-colors duration-200">
                    <i class="bi bi-grid"></i><span>Categories</span>
                </a>
            </div>
            <div class="hidden md:flex space-x-4 items-center">
                @auth
                <div class="relative group">
                    <button class="flex items-center space-x-2 focus:outline-none bg-indigo-900 bg-opacity-40 px-3 py-1.5 rounded-lg hover:bg-opacity-60 transition-colors duration-200">
                        <i class="bi bi-person-circle text-xl text-yellow-200"></i>
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top scale-95 group-hover:scale-100 z-50 border border-gray-200">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-indigo-50 rounded-t-lg">
                            <i class="bi bi-person mr-2 text-indigo-600"></i>Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-indigo-50 rounded-b-lg">
                                <i class="bi bi-box-arrow-right mr-2 text-indigo-600"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <a href="{{ route('login') }}" class="px-4 py-1.5 bg-indigo-600 hover:bg-indigo-700 rounded-lg transition-colors duration-200">Login</a>
                <a href="{{ route('register') }}" class="px-4 py-1.5 bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-medium rounded-lg transition-colors duration-200">Register</a>
                @endauth
            </div>
            
            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button class="text-white focus:outline-none">
                    <i class="bi bi-list text-2xl"></i>
                </button>
            </div>
        </div>
    </div>
</nav>



    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="bi bi-geo-alt-fill"></i> LocalDeals</h5>
                    <p>Find the best deals in your neighborhood.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p>&copy; {{ date('Y') }} Local Business Promotions Portal</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>