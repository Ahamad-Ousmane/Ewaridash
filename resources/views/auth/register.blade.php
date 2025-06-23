<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - TourismoRA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .bg-gradient-tourism {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="bg-gradient-tourism min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-2xl">
        <!-- Logo / Header -->
        <div class="text-center mb-8">
            <div class="glass-effect rounded-full w-20 h-20 mx-auto flex items-center justify-center mb-4">
                <i class="fas fa-map-marked-alt text-3xl text-white"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">TourismoRA</h1>
            <p class="text-blue-100">Rejoignez notre plateforme en tant qu'acteur touristique</p>
        </div>

        <!-- Formulaire d'inscription -->
        <div class="glass-effect rounded-2xl p-8 shadow-xl">
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Informations personnelles -->
                <div class="bg-white/5 rounded-xl p-6 border border-white/10">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-user mr-2"></i>
                        Informations personnelles
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Prénom -->
                        <div>
                            <label class="block text-sm font-medium text-white mb-2">
                                Prénom *
                            </label>
                            <input type="text" 
                                   name="prenom" 
                                   id="prenom"
                                   value="{{ old('prenom') }}"
                                   class="w-full px-4 py-3 bg-white/10 border border-white/30 rounded-lg text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200" 
                                   placeholder="Votre prénom"
                                   required>
                            @error('prenom')
                                <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nom -->
                        <div>
                            <label class="block text-sm font-medium text-white mb-2">
                                Nom *
                            </label>
                            <input type="text" 
                                   name="nom" 
                                   id="nom"
                                   value="{{ old('nom') }}"
                                   class="w-full px-4 py-3 bg-white/10 border border-white/30 rounded-lg text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200" 
                                   placeholder="Votre nom"
                                   required>
                            @error('nom')
                                <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-white mb-2">
                                Email *
                            </label>
                            <input type="email" 
                                   name="email" 
                                   id="email"
                                   value="{{ old('email') }}"
                                   class="w-full px-4 py-3 bg-white/10 border border-white/30 rounded-lg text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200" 
                                   placeholder="votre@email.com"
                                   required>
                            @error('email')
                                <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Téléphone -->
                        <div>
                            <label class="block text-sm font-medium text-white mb-2">
                                Téléphone
                            </label>
                            <input type="tel" 
                                   name="telephone" 
                                   id="telephone"
                                   value="{{ old('telephone') }}"
                                   class="w-full px-4 py-3 bg-white/10 border border-white/30 rounded-lg text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200" 
                                   placeholder="+229 XX XX XX XX">
                            @error('telephone')
                                <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Informations de l'entreprise -->
                <div class="bg-white/5 rounded-xl p-6 border border-white/10">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-building mr-2"></i>
                        Informations de votre entreprise
                    </h3>
                    
                    <!-- Nom de l'entreprise -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-white mb-2">
                            Nom de l'entreprise *
                        </label>
                        <input type="text" 
                               name="nom_entreprise" 
                               id="nom_entreprise"
                               value="{{ old('nom_entreprise') }}"
                               class="w-full px-4 py-3 bg-white/10 border border-white/30 rounded-lg text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200" 
                               placeholder="Nom de votre entreprise touristique"
                               required>
                        @error('nom_entreprise')
                            <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Type d'activité -->
                        <div>
                            <label class="block text-sm font-medium text-white mb-2">
                                Type d'activité *
                            </label>
                            <select name="type_activite" id="type_activite" 
                                    class="w-full px-4 py-3 bg-white/10 border border-white/30 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200"
                                    required>
                                <option value="" class="text-gray-800">Choisissez votre activité</option>
                                <option value="hotel" class="text-gray-800" {{ old('type_activite') == 'hotel' ? 'selected' : '' }}>
                                    Hôtel / Hébergement
                                </option>
                                <option value="restaurant" class="text-gray-800" {{ old('type_activite') == 'restaurant' ? 'selected' : '' }}>
                                    Restaurant / Restauration
                                </option>
                                <option value="transport" class="text-gray-800" {{ old('type_activite') == 'transport' ? 'selected' : '' }}>
                                    Transport touristique
                                </option>
                                <option value="activite" class="text-gray-800" {{ old('type_activite') == 'activite' ? 'selected' : '' }}>
                                    Activités & Attractions
                                </option>
                                <option value="autre" class="text-gray-800" {{ old('type_activite') == 'autre' ? 'selected' : '' }}>
                                    Autre
                                </option>
                            </select>
                            @error('type_activite')
                                <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Ville -->
                        <div>
                            <label class="block text-sm font-medium text-white mb-2">
                                Ville
                            </label>
                            <input type="text" 
                                   name="ville" 
                                   id="ville"
                                   value="{{ old('ville') }}"
                                   class="w-full px-4 py-3 bg-white/10 border border-white/30 rounded-lg text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200" 
                                   placeholder="Ville de votre entreprise">
                            @error('ville')
                                <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Adresse -->
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-white mb-2">
                            Adresse complète
                        </label>
                        <input type="text" 
                               name="adresse" 
                               id="adresse"
                               value="{{ old('adresse') }}"
                               class="w-full px-4 py-3 bg-white/10 border border-white/30 rounded-lg text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200" 
                               placeholder="Adresse complète de votre entreprise">
                        @error('adresse')
                            <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-white mb-2">
                            Description de votre activité
                        </label>
                        <textarea name="description" 
                                  id="description"
                                  rows="4"
                                  class="w-full px-4 py-3 bg-white/10 border border-white/30 rounded-lg text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200 resize-none" 
                                  placeholder="Décrivez votre entreprise et vos services touristiques...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Site web -->
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-white mb-2">
                            Site web (optionnel)
                        </label>
                        <input type="url" 
                               name="site_web" 
                               id="site_web"
                               value="{{ old('site_web') }}"
                               class="w-full px-4 py-3 bg-white/10 border border-white/30 rounded-lg text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200" 
                               placeholder="https://votre-site-web.com">
                        @error('site_web')
                            <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Sécurité -->
                <div class="bg-white/5 rounded-xl p-6 border border-white/10">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-lock mr-2"></i>
                        Sécurité du compte
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Mot de passe -->
                        <div>
                            <label class="block text-sm font-medium text-white mb-2">
                                Mot de passe *
                            </label>
                            <div class="relative">
                                <input type="password" 
                                       name="password" 
                                       id="password"
                                       class="w-full px-4 py-3 bg-white/10 border border-white/30 rounded-lg text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200 pr-12" 
                                       placeholder="••••••••"
                                       required
                                       minlength="8">
                                <button type="button" 
                                        onclick="togglePassword('password')"
                                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-blue-200 hover:text-white transition duration-200">
                                    <i class="fas fa-eye" id="password-icon"></i>
                                </button>
                            </div>
                            <div id="password-strength" class="mt-1"></div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirmation mot de passe -->
                        <div>
                            <label class="block text-sm font-medium text-white mb-2">
                                Confirmer le mot de passe *
                            </label>
                            <div class="relative">
                                <input type="password" 
                                       name="password_confirmation" 
                                       id="password_confirmation"
                                       class="w-full px-4 py-3 bg-white/10 border border-white/30 rounded-lg text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200 pr-12" 
                                       placeholder="••••••••"
                                       required
                                       minlength="8">
                                <button type="button" 
                                        onclick="togglePassword('password_confirmation')"
                                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-blue-200 hover:text-white transition duration-200">
                                    <i class="fas fa-eye" id="password_confirmation-icon"></i>
                                </button>
                            </div>
                            @error('password_confirmation')
                                <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Conditions générales -->
                <div class="flex items-start">
                    <input type="checkbox" 
                           name="terms" 
                           id="terms"
                           class="mt-1 mr-3 h-4 w-4 text-blue-600 focus:ring-blue-500 border-white/30 rounded bg-white/10"
                           required>
                    <label for="terms" class="text-sm text-blue-100">
                        J'accepte les 
                        <a href="#" class="text-white hover:text-blue-200 underline transition duration-200">
                            conditions générales d'utilisation
                        </a> 
                        et la 
                        <a href="#" class="text-white hover:text-blue-200 underline transition duration-200">
                            politique de confidentialité
                        </a>
                    </label>
                </div>
                @error('terms')
                    <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                @enderror

                <!-- Messages d'erreur globaux -->
                @if ($errors->any() && !in_array(array_keys($errors->messages())[0] ?? '', ['nom', 'prenom', 'email', 'password', 'nom_entreprise', 'type_activite', 'terms']))
                    <div class="bg-red-500/20 border border-red-500/30 text-red-200 px-4 py-3 rounded-lg">
                        <h4 class="font-medium mb-2">Erreurs dans le formulaire :</h4>
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Bouton de soumission -->
                <button type="submit" 
                        class="w-full bg-white text-purple-600 font-semibold py-4 px-6 rounded-lg hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 focus:ring-offset-purple-600 transform hover:scale-105 transition duration-200 shadow-lg">
                    <i class="fas fa-user-plus mr-2"></i>
                    Créer mon compte d'acteur touristique
                </button>
            </form>

            <!-- Lien vers la connexion -->
            <div class="mt-6 text-center">
                <p class="text-blue-100">
                    Déjà un compte ? 
                    <a href="{{ route('login') }}" 
                       class="text-white font-medium hover:text-blue-200 transition duration-200 underline">
                        Se connecter
                    </a>
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-blue-200 text-sm">
                © {{ date('Y') }} TourismoRA - Plateforme de gestion touristique du Bénin
            </p>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(fieldId + '-icon');
            
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
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
                    color = 'text-red-300';
                    break;
                case strength <= 2:
                    text = 'Faible';
                    color = 'text-orange-300';
                    break;
                case strength <= 3:
                    text = 'Moyen';
                    color = 'text-yellow-300';
                    break;
                case strength <= 4:
                    text = 'Bon';
                    color = 'text-blue-300';
                    break;
                case strength >= 5:
                    text = 'Excellent';
                    color = 'text-green-300';
                    break;
            }
            
            strengthDiv.innerHTML = `<p class="text-xs ${color}"><i class="fas fa-shield-alt mr-1"></i>Force : ${text}</p>`;
        });

        // Validation en temps réel du mot de passe
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmation = this.value;
            
            if (confirmation.length === 0) return;
            
            const isMatch = password === confirmation;
            this.style.borderColor = isMatch ? 'rgba(34, 197, 94, 0.5)' : 'rgba(239, 68, 68, 0.5)';
        });

        // Auto-capitalisation des noms
        document.getElementById('nom').addEventListener('input', function() {
            this.value = this.value.toLowerCase().replace(/\b\w/g, l => l.toUpperCase());
        });

        document.getElementById('prenom').addEventListener('input', function() {
            this.value = this.value.toLowerCase().replace(/\b\w/g, l => l.toUpperCase());
        });

        // Animation smooth scroll si erreurs
        document.addEventListener('DOMContentLoaded', function() {
            const firstError = document.querySelector('.text-red-300');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
    </script>
</body>
</html>