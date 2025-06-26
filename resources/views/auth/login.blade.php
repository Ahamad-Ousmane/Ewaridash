<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Connexion - EWARI</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exile&family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .font-exile { font-family: 'Exile', sans-serif; }
        .font-montserrat { font-family: 'Montserrat', sans-serif; }

        .video-background {
            position: relative;
            overflow: hidden;
        }

        .video-background video {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translate(-50%, -50%);
            object-fit: cover;
        }

        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.8) 0%, rgba(118, 75, 162, 0.8) 100%);
        }

        .mobile-bg {
            background-image: linear-gradient(135deg, rgba(102, 126, 234, 0.8) 0%, rgba(118, 75, 162, 0.8) 100%), 
                              url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .form-container {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.95);
            border-left: 1px solid rgba(255, 255, 255, 0.3);
        }

        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .pulse-glow {
            animation: pulseGlow 2s ease-in-out infinite alternate;
        }

        @keyframes pulseGlow {
            from { box-shadow: 0 0 20px rgba(200, 200, 200, 0.5); }
            to { box-shadow: 0 0 30px rgba(200, 200, 200, 0.5); }
        }

        .slide-in-right {
            animation: slideInRight 0.8s ease-out;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @media (max-width: 640px) {
            .desktop-layout { display: none !important; }
            .mobile-layout { display: flex !important; }
        }

        @media (min-width: 641px) and (max-width: 1024px) {
            .desktop-layout { display: none !important; }
            .mobile-layout { display: flex !important; }
        }

        @media (min-width: 1025px) {
            .desktop-layout { display: flex !important; }
            .mobile-layout { display: none !important; }
        }
    </style>
</head>
<body class="h-full overflow-hidden font-montserrat">
    <!-- Desktop Layout -->
    <div class="desktop-layout h-screen">
        <!-- Video Section -->
        <div class="w-3/4 h-full video-background relative">
            <video autoplay muted loop class="absolute inset-0 w-full h-full object-cover">
                <source src="https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4" type="video/mp4">
                <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" alt="Tourism background" class="w-full h-full object-cover">
            </video>
            <div class="video-overlay"></div>
            <div class="absolute inset-0 flex items-center justify-center z-10">
                <div class="text-center text-white px-8">
                    <h1 class="text-8xl font-exile font-bold mb-6 floating-animation tracking-wider">EWARI</h1>
                    <p class="text-3xl mb-4 opacity-90 font-montserrat font-medium">Faites découvrir le Bénin autrement</p>
                    <p class="text-xl opacity-75 max-w-lg mx-auto font-montserrat">
                        Votre plateforme de gestion touristique pour la promotion de vos infrastructures touristiques.
                    </p>
                </div>
            </div>
            <div class="absolute top-20 left-20 w-32 h-32 bg-white opacity-10 rounded-full floating-animation"></div>
            <div class="absolute bottom-32 right-32 w-24 h-24 bg-white opacity-10 rounded-full floating-animation" style="animation-delay: -2s;"></div>
        </div>

        <!-- Form Section -->
        <div class="w-1/3 h-full form-container flex items-center justify-center">
            <div class="w-full max-w-sm px-6 slide-in-right">
                <!-- Logo et header -->
                <div class="text-center mb-8">
                    <div class="mx-auto h-16 w-16 rounded-xl bg-gradient-to-br from-indigo-600 to-purple-600 pulse-glow flex items-center justify-center mb-4">
                        <i class="bi bi-building text-white text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2 font-montserrat">Connexion</h2>
                    <p class="text-gray-600 text-sm font-montserrat">Accédez à votre espace personnel</p>
                </div>

                <!-- Formulaire de connexion -->
                <form method="POST" action="{{ route('login') }}" x-data="{ loading: false }" @submit="loading = true" class="space-y-5">
                    @csrf
                    
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2 font-montserrat">
                            Adresse email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="bi bi-envelope text-gray-400 text-sm"></i>
                            </div>
                            <input id="email" name="email" type="email" required 
                                   value="{{ old('email') }}"
                                   class="block w-full pl-9 pr-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-white/80 text-sm font-montserrat"
                                   placeholder="votre@email.com">
                        </div>
                        @error('email')
                            <p class="mt-2 text-xs text-red-600 font-montserrat">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Mot de passe -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2 font-montserrat">
                            Mot de passe
                        </label>
                        <div class="relative" x-data="{ showPassword: false }">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="bi bi-lock text-gray-400 text-sm"></i>
                            </div>
                            <input id="password" name="password" :type="showPassword ? 'text' : 'password'" required 
                                   class="block w-full pl-9 pr-10 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-white/80 text-sm font-montserrat"
                                   placeholder="••••••••">
                            <button type="button" @click="showPassword = !showPassword" 
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i x-show="!showPassword" class="bi bi-eye text-gray-400 hover:text-gray-600 text-sm"></i>
                                <i x-show="showPassword" class="bi bi-eye-slash text-gray-400 hover:text-gray-600 text-sm"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-2 text-xs text-red-600 font-montserrat">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Se souvenir de moi / Mot de passe oublié -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox" 
                                   class="h-3 w-3 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="remember" class="ml-2 block text-xs text-gray-700 font-montserrat">
                                Se souvenir
                            </label>
                        </div>
                        <div class="text-xs">
                            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors font-montserrat">
                                Mot de passe oublié ?
                            </a>
                        </div>
                    </div>

                    <!-- Bouton de connexion -->
                    <div>
                        <button type="submit" :disabled="loading"
                                class="group relative w-full flex justify-center py-2.5 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 transform hover:scale-105 font-montserrat">
                            <span x-show="!loading" class="flex items-center">
                                <i class="bi bi-box-arrow-in-right mr-2 text-sm"></i>
                                Se connecter
                            </span>
                            <span x-show="loading" class="flex items-center">
                                <i class="bi bi-arrow-repeat animate-spin mr-2 text-sm"></i>
                                Connexion...
                            </span>
                        </button>
                    </div>

                    <!-- Lien d'inscription -->
                    <div class="text-center">
                        <p class="text-xs text-gray-600 font-montserrat">
                            Pas de compte ?
                            <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors font-montserrat">
                                Créer un compte
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Mobile Layout -->
    <div class="mobile-layout min-h-screen mobile-bg items-center justify-center py-12 px-4">
        <div class="max-w-md w-full space-y-8 relative z-10">
            <!-- Logo et header -->
            <div class="text-center">
                <div class="mx-auto h-20 w-20 rounded-2xl bg-white backdrop-blur-sm bg-opacity-90 pulse-glow flex items-center justify-center mb-6">
                    <i class="bi bi-building text-indigo-600 text-3xl"></i>
                </div>
                <h2 class="text-5xl font-exile font-bold text-white mb-2 tracking-wider">EWARI</h2>
                <p class="text-xl text-indigo-100 font-montserrat font-medium">Plateforme de Gestion Touristique</p>
                <p class="text-indigo-200 mt-2 font-montserrat">Accédez à votre espace personnel</p>
            </div>

            <!-- Formulaire de connexion mobile -->
            <div class="backdrop-blur-sm bg-white bg-opacity-95 rounded-2xl shadow-2xl p-8">
                <form method="POST" action="{{ route('login') }}" x-data="{ loading: false }" @submit="loading = true">
                    @csrf
                    <div class="space-y-6">
                        <!-- Email -->
                        <div>
                            <label for="email-mobile" class="block text-sm font-semibold text-gray-700 mb-2 font-montserrat">
                                Adresse email
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="bi bi-envelope text-gray-400 text-sm"></i>
                                </div>
                                <input id="email-mobile" name="email" type="email" required 
                                       value="{{ old('email') }}"
                                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-white/90 backdrop-blur-sm font-montserrat"
                                       placeholder="votre@email.com">
                            </div>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600 font-montserrat">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Mot de passe -->
                        <div>
                            <label for="password-mobile" class="block text-sm font-semibold text-gray-700 mb-2 font-montserrat">
                                Mot de passe
                            </label>
                            <div class="relative" x-data="{ showPassword: false }">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="bi bi-lock text-gray-400 text-sm"></i>
                                </div>
                                <input id="password-mobile" name="password" :type="showPassword ? 'text' : 'password'" required 
                                       class="block w-full pl-10 pr-12 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-white/90 backdrop-blur-sm font-montserrat"
                                       placeholder="••••••••">
                                <button type="button" @click="showPassword = !showPassword" 
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <i x-show="!showPassword" class="bi bi-eye text-gray-400 hover:text-gray-600"></i>
                                    <i x-show="showPassword" class="bi bi-eye-slash text-gray-400 hover:text-gray-600"></i>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600 font-montserrat">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Se souvenir de moi / Mot de passe oublié -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember-mobile" name="remember" type="checkbox" 
                                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <label for="remember-mobile" class="ml-2 block text-sm text-gray-700 font-montserrat">
                                    Se souvenir de moi
                                </label>
                            </div>
                            <div class="text-sm">
                                <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors font-montserrat">
                                    Mot de passe oublié ?
                                </a>
                            </div>
                        </div>

                        <!-- Bouton de connexion -->
                        <div>
                            <button type="submit" :disabled="loading"
                                    class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 transform hover:scale-105 font-montserrat">
                                <span x-show="!loading" class="flex items-center">
                                    <i class="bi bi-box-arrow-in-right mr-2"></i>
                                    Se connecter
                                </span>
                                <span x-show="loading" class="flex items-center">
                                    <i class="bi bi-arrow-repeat animate-spin mr-2"></i>
                                    Connexion en cours...
                                </span>
                            </button>
                        </div>

                        <!-- Lien d'inscription -->
                        <div class="text-center">
                            <p class="text-sm text-gray-600 font-montserrat">
                                Vous n'avez pas de compte ?
                                <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors font-montserrat">
                                    Créer un compte
                                </a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>