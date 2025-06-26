<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Touristique')</title>
    
    <!-- Google Fonts - Exile + Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exile&family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                fontFamily: {
                    sans: ['Montserrat', 'sans-serif'],
                    exile: ['Exile', 'cursive']
                },
                extend: {
                    colors: {
                        primary: {
                            500: '#6366f1',
                            600: '#4f46e5'
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Custom Styles -->
    <style>
        .app-logo {
            font-family: 'Exile', cursive;
            letter-spacing: 1px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
            font-weight: 400; /* Exile a un poids unique */
        }
        .sidebar-gradient {
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
        }
        .glass-effect {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.1);
        }
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }
    </style>
    
    @stack('styles')
</head>
<body class="h-full bg-gray-50 font-sans">
@auth
    <div x-data="{ sidebarOpen: false }" class="h-full flex">
        <!-- Sidebar Mobile Overlay -->
        <div x-show="sidebarOpen" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 lg:hidden">
            <div class="fixed inset-0 bg-gray-900/80" @click="sidebarOpen = false"></div>
        </div>

        <!-- Sidebar -->
        <div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
             class="fixed inset-y-0 left-0 z-50 w-64 transition-transform duration-300 ease-in-out lg:relative lg:translate-x-0 lg:z-auto lg:flex lg:flex-shrink-0">
            
            <div class="sidebar-gradient w-64 h-full flex flex-col border-r border-gray-700/50">
                <!-- Logo avec police Exile et icône Bootstrap -->
                <div class="flex items-center justify-center h-20 px-4 border-b border-gray-700/50">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center shadow-md">
                            <i class="bi bi-building text-white text-lg"></i>
                        </div>
                        <h2 class="app-logo text-2xl font-bold text-white tracking-wider">EWARI</h2>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                    @yield('sidebar')
                </nav>

                <!-- User Profile -->
                <div class="p-4 border-t border-gray-700/50">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center shadow-inner">
                            <span class="text-white font-semibold text-sm">{{ substr(Auth::user()->nom ?? 'U', 0, 2) }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-white truncate">{{ Auth::user()->nom ?? 'Utilisateur' }}</p>
                            <p class="text-xs text-gray-300/80 truncate">{{ Auth::user()->email ?? '' }}</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-400 hover:text-white transition-colors">
                                <i class="bi bi-box-arrow-right text-lg"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 min-h-0 overflow-hidden">
            <!-- Top Navigation -->
            <div class="sticky top-0 z-40 bg-white/80 glass-effect shadow-sm border-b border-gray-200/50">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <button @click="sidebarOpen = true" 
                                    class="lg:hidden p-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100/50 transition-colors">
                                <i class="bi bi-list text-xl"></i>
                            </button>
                            <h1 class="ml-4 text-xl font-semibold text-gray-800 lg:ml-0">@yield('page-title', 'Dashboard')</h1>
                        </div>

                        <div class="flex items-center space-x-4">
                            <!-- Profile dropdown -->
                            <div x-data="{ open: false }" class="relative">
                                <button @click="open = !open" class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100/50 transition-colors">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-purple-400 to-pink-500 flex items-center justify-center shadow-inner">
                                        <span class="text-white font-semibold text-xs">{{ substr(Auth::user()->nom ?? 'U', 0, 2) }}</span>
                                    </div>
                                    <i class="bi bi-chevron-down text-gray-500"></i>
                                </button>
                                
                                <div x-show="open" @click.away="open = false" 
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg ring-1 ring-black/5 z-50">
                                    <div class="py-1">
                                        @if(Auth::user() && method_exists(Auth::user(), 'isActeurTouristique') && Auth::user()->isActeurTouristique())
                                        <a href="{{ route('acteur.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                            <i class="bi bi-person mr-2"></i> Mon Profil
                                        </a>
                                        @endif
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                                <i class="bi bi-box-arrow-right mr-2"></i> Se déconnecter
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50/50">
                <!-- Flash Messages avec icônes Bootstrap -->
                @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
                     class="bg-green-50 border-l-4 border-green-400 p-4 m-4 rounded-r-lg">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="bi bi-check-circle-fill text-green-400 text-lg"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-700">{{ session('success') }}</p>
                        </div>
                        <button @click="show = false" class="ml-auto -mt-0.5 -mr-1 p-1 rounded-full hover:bg-green-100 transition-colors">
                            <i class="bi bi-x text-green-500"></i>
                        </button>
                    </div>
                </div>
                @endif

                @if(session('error'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
                     class="bg-red-50 border-l-4 border-red-400 p-4 m-4 rounded-r-lg">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="bi bi-exclamation-circle-fill text-red-400 text-lg"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-700">{{ session('error') }}</p>
                        </div>
                        <button @click="show = false" class="ml-auto -mt-0.5 -mr-1 p-1 rounded-full hover:bg-red-100 transition-colors">
                            <i class="bi bi-x text-red-500"></i>
                        </button>
                    </div>
                </div>
                @endif

                <div class="p-6">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    @else
    <!-- Page pour utilisateurs non connectés -->
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-xl shadow-lg">
            <div class="text-center">
                <div class="mx-auto w-20 h-20 rounded-full bg-gradient-to-r from-blue-100 to-purple-100 flex items-center justify-center mb-4">
                    <i class="bi bi-shield-lock text-blue-500 text-3xl"></i>
                </div>
                <h2 class="mt-6 text-3xl font-bold text-gray-900 font-sans">
                    Accès refusé
                </h2>
                <p class="mt-2 text-gray-600 font-sans">
                    Vous devez être connecté pour accéder à cette page.
                </p>
                <div class="mt-6">
                    <a href="{{ route('login') }}" class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                        <i class="bi bi-box-arrow-in-right mr-2"></i> Se connecter
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endauth

    @stack('scripts')
</body>
</html>