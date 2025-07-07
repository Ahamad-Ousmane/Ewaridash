<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - EWARI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exile&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(rgba(102, 126, 234, 0.85), rgba(118, 75, 162, 0.85)), url('{{ asset("img/back-signin.jpg") }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
        }
        
        .app-name {
            font-family: 'Exile', sans-serif;
            letter-spacing: 1px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .form-section {
            background: rgba(255, 255, 255, 0.87);
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="p-4 flex items-center justify-center">
    <div class="w-full max-w-6xl">
        <!-- Logo / Header -->
        <div class="text-center mb-8">
            <div class="bg-white rounded-full w-20 h-20 mx-auto flex items-center justify-center mb-4 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#667eea" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-white mb-2 app-name">EWARI</h1>
            <p class="text-blue-100">Rejoignez notre plateforme en tant qu'acteur touristique</p>
        </div>

        <!-- Formulaire d'inscription -->
        <div class="form-section p-8">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="space-y-6">
                    <!-- 1. Informations personnelles -->
                    <div class="bg-white rounded-xl p-6 border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="bi bi-person-fill mr-2 text-purple-600"></i>
                            Informations personnelles
                        </h3>
                        
                        <!-- Nom -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nom *
                            </label>
                            <input type="text" 
                                name="nom" 
                                id="nom"
                                value="{{ old('nom') }}"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200" 
                                placeholder="Votre nom"
                                required>
                            @error('nom')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Email *
                                </label>
                                <input type="email" 
                                       name="email" 
                                       id="email"
                                       value="{{ old('email') }}"
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200" 
                                       placeholder="votre@email.com"
                                       required>
                                @error('email')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Téléphone -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Téléphone
                                </label>
                                <input type="tel" 
                                       name="telephone" 
                                       id="telephone"
                                       value="{{ old('telephone') }}"
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200" 
                                       placeholder="+229 XX XX XX XX">
                                @error('telephone')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- 2. Informations de l'entreprise -->
                    <div class="bg-white rounded-xl p-6 border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="bi bi-building-fill mr-2 text-purple-600"></i>
                            Informations de votre entreprise
                        </h3>
                        
                        <!-- Nom de l'entreprise -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nom de l'entreprise *
                            </label>
                            <input type="text" 
                                   name="nom_entreprise" 
                                   id="nom_entreprise"
                                   value="{{ old('nom_entreprise') }}"
                                   class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200" 
                                   placeholder="Nom de votre entreprise touristique"
                                   required>
                            @error('nom_entreprise')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Ville -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Ville
                            </label>
                            <input type="text" 
                                name="ville" 
                                id="ville"
                                value="{{ old('ville') }}"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200" 
                                placeholder="Ville de votre entreprise">
                            @error('ville')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Adresse -->
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Adresse complète
                            </label>
                            <input type="text" 
                                   name="adresse" 
                                   id="adresse"
                                   value="{{ old('adresse') }}"
                                   class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200" 
                                   placeholder="Adresse complète de votre entreprise">
                            @error('adresse')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Description de votre activité
                            </label>
                            <textarea name="description" 
                                      id="description"
                                      rows="4"
                                      class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200 resize-none" 
                                      placeholder="Décrivez votre entreprise et vos services touristiques...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Site web -->
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Site web (optionnel)
                            </label>
                            <input type="url" 
                                   name="site_web" 
                                   id="site_web"
                                   value="{{ old('site_web') }}"
                                   class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200" 
                                   placeholder="https://votre-site-web.com">
                            @error('site_web')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- 3. Sécurité -->
                    <div class="bg-white rounded-xl p-6 border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="bi bi-lock-fill mr-2 text-purple-600"></i>
                            Sécurité du compte
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Mot de passe -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Mot de passe *
                                </label>
                                <div class="relative">
                                    <input type="password" 
                                           name="password" 
                                           id="password"
                                           class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200 pr-12" 
                                           placeholder="••••••••"
                                           required
                                           minlength="8">
                                    <button type="button" 
                                            onclick="togglePassword('password')"
                                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition duration-200">
                                        <i class="bi bi-eye-fill" id="password-icon"></i>
                                    </button>
                                </div>
                                <div id="password-strength" class="mt-1"></div>
                                @error('password')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Confirmation mot de passe -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Confirmer le mot de passe *
                                </label>
                                <div class="relative">
                                    <input type="password" 
                                           name="password_confirmation" 
                                           id="password_confirmation"
                                           class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200 pr-12" 
                                           placeholder="••••••••"
                                           required
                                           minlength="8">
                                    <button type="button" 
                                            onclick="togglePassword('password_confirmation')"
                                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition duration-200">
                                        <i class="bi bi-eye-fill" id="password_confirmation-icon"></i>
                                    </button>
                                </div>
                                @error('password_confirmation')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Conditions générales -->
                    <div class="flex items-start">
                        <input type="checkbox" 
                               name="terms" 
                               id="terms"
                               class="mt-1 mr-3 h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded"
                               required>
                        <label for="terms" class="text-sm text-gray-700">
                            J'accepte les 
                            <a href="#" class="text-purple-600 hover:text-purple-800 underline transition duration-200">
                                conditions générales d'utilisation
                            </a> 
                            et la 
                            <a href="#" class="text-purple-600 hover:text-purple-800 underline transition duration-200">
                                politique de confidentialité
                            </a>
                        </label>
                    </div>
                    @error('terms')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror

                    <!-- Bouton de soumission -->
                    <button type="submit" 
                            class="w-full bg-purple-600 text-white font-semibold py-4 px-6 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-offset-2 transition duration-200 shadow-md">
                        <i class="bi bi-person-plus-fill mr-2"></i>
                        Inscription
                    </button>

                    <!-- Lien vers la connexion -->
                    <div class="text-center">
                        <p class="text-gray-600">
                            Déjà un compte ? 
                            <a href="{{ route('login') }}" 
                               class="text-purple-600 font-medium hover:text-purple-800 transition duration-200 underline">
                                Se connecter
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Messages d'erreur globaux -->
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mt-6">
                        <h4 class="font-medium mb-2">Erreurs dans le formulaire :</h4>
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(fieldId + '-icon');
            
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('bi-eye-fill');
                icon.classList.add('bi-eye-slash-fill');
            } else {
                field.type = 'password';
                icon.classList.remove('bi-eye-slash-fill');
                icon.classList.add('bi-eye-fill');
            }
        }

        // Password strength indicator
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthDiv = document.getElementById('password-strength');
            
            if (password.length === 0) {
                strengthDiv.innerHTML = '';
                return;
            }
            
            let strength = 0;
            let text = '';
            let color = '';
            
            // Critères de force
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            switch(true) {
                case strength <= 1:
                    text = 'Très faible';
                    color = 'text-red-500';
                    break;
                case strength <= 2:
                    text = 'Faible';
                    color = 'text-orange-500';
                    break;
                case strength <= 3:
                    text = 'Moyen';
                    color = 'text-yellow-500';
                    break;
                case strength <= 4:
                    text = 'Bon';
                    color = 'text-blue-500';
                    break;
                case strength >= 5:
                    text = 'Excellent';
                    color = 'text-green-500';
                    break;
            }
            
            strengthDiv.innerHTML = `<p class="text-xs ${color}"><i class="bi bi-shield-fill mr-1"></i>Force : ${text}</p>`;
        });

        // Validation en temps réel du mot de passe
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmation = this.value;
            
            if (confirmation.length === 0) return;
            
            const isMatch = password === confirmation;
            this.style.borderColor = isMatch ? 'rgba(34, 197, 94, 0.5)' : 'rgba(239, 68, 68, 0.5)';
        });

        // Animation smooth scroll si erreurs
        document.addEventListener('DOMContentLoaded', function() {
            const firstError = document.querySelector('.text-red-500');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
    </script>
</body>
</html>