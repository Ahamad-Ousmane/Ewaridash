@extends('layouts.app')

@section('title', 'Ajouter une Infrastructure - EWARI')
@section('page-title', 'Nouvelle Infrastructure')

@push('styles')
<!-- Police Exile -->
<link href="https://fonts.googleapis.com/css2?family=Exile&display=swap" rel="stylesheet">
<!-- Police Montserrat -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    /* Application des polices */
    .app-title {
        font-family: 'Exile', cursive;
        letter-spacing: 1px;
    }
    
    body {
        font-family: 'Montserrat', sans-serif;
    }
    
    /* Animation pour les cartes */
    .card-hover {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    /* Style des boutons d'action */
    .action-btn {
        @apply p-2 rounded-lg hover:bg-gray-100 transition-colors;
    }
    .action-btn.view {
        @apply text-indigo-600 hover:text-indigo-800;
    }
    .action-btn.edit {
        @apply text-gray-600 hover:text-gray-800;
    }
    .action-btn.delete {
        @apply text-red-600 hover:text-red-800;
    }

    /* Style pour les zones de drag & drop */
    .drop-zone {
        transition: all 0.3s ease;
    }
    .drop-zone.active {
        border-color: #6366f1;
        background-color: #eef2ff;
    }
</style>
@endpush

@section('sidebar')
<!-- Acteur Navigation -->
<a href="{{ route('acteur.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
    <i class="bi bi-grid mr-3"></i>
    Dashboard
</a>

<a href="{{ route('acteur.profile') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
    <i class="bi bi-person mr-3"></i>
    Mon Profil
</a>

<a href="{{ route('acteur.infrastructures.index') }}" class="nav-link-active flex items-center px-4 py-3 text-sm font-medium rounded-xl text-white">
    <i class="bi bi-building mr-3"></i>
    Mes Infrastructures
</a>
@endsection

@section('content')
<div class="p-6 space-y-6">
    <!-- Messages d'alerte -->
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6">
        <div class="flex items-center">
            <i class="bi bi-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6">
        <div class="flex items-center">
            <i class="bi bi-exclamation-triangle mr-2"></i>
            {{ session('error') }}
        </div>
    </div>
    @endif

    <!-- Breadcrumb -->
    <nav class="mb-6">
        <ol class="flex items-center space-x-2 text-sm text-gray-500">
            <li><a href="{{ route('acteur.dashboard') }}" class="hover:text-indigo-600 flex items-center">
                <i class="bi bi-house-door mr-1"></i> Dashboard
            </a></li>
            <li><i class="bi bi-chevron-right text-gray-400"></i></li>
            <li><a href="{{ route('acteur.infrastructures.index') }}" class="hover:text-indigo-600">Infrastructures</a></li>
            <li><i class="bi bi-chevron-right text-gray-400"></i></li>
            <li class="text-gray-900 font-medium">Nouvelle</li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-sm p-6 mb-6 border border-gray-100 card-hover">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Ajouter une Infrastructure</h1>
                <p class="text-gray-600 mt-1">Créez une nouvelle infrastructure touristique pour votre entreprise</p>
            </div>
            <div class="hidden sm:block">
                <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center">
                    <i class="bi bi-plus-lg text-white text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('acteur.infrastructures.store') }}" enctype="multipart/form-data" 
          x-data="infrastructureForm()">
        @csrf
        
        <div class="space-y-6">
            <!-- Basic Information -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 card-hover">
                <h2 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="bi bi-info-circle text-indigo-600 mr-2"></i>
                    Informations Générales
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nom -->
                    <div class="md:col-span-2">
                        <label for="nom" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nom de l'infrastructure <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nom" name="nom" required value="{{ old('nom') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 @error('nom') border-red-300 @enderror"
                               placeholder="Ex: Hôtel Paradise, Restaurant Le Gourmet...">
                        @error('nom')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Type -->
                    <div>
                        <label for="type" class="block text-sm font-semibold text-gray-700 mb-2">
                            Type d'infrastructure <span class="text-red-500">*</span>
                        </label>
                        <select id="type" name="type" x-model="selectedType" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 @error('type') border-red-300 @enderror">
                            <option value="">Sélectionner un type</option>
                            <option value="hotel" {{ old('type') === 'hotel' ? 'selected' : '' }}>🏨 Hôtel</option>
                            <option value="restaurant" {{ old('type') === 'restaurant' ? 'selected' : '' }}>🍽️ Restaurant</option>
                            <option value="plage" {{ old('type') === 'plage' ? 'selected' : '' }}>🏖️ Espace Plage</option>
                            <option value="transport" {{ old('type') === 'transport' ? 'selected' : '' }}>🚗 Service de Transport</option>
                        </select>
                        @error('type')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Localisation -->
                    <div>
                        <label for="localisation" class="block text-sm font-semibold text-gray-700 mb-2">
                            Localisation <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="localisation" name="localisation" required value="{{ old('localisation') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 @error('localisation') border-red-300 @enderror"
                               placeholder="Ex: Cotonou, Quartier Fidjrossè">
                        @error('localisation')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                            Description <span class="text-red-500">*</span>
                        </label>
                        <textarea id="description" name="description" rows="4" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-300 @enderror"
                                  placeholder="Décrivez votre infrastructure, ses services, ses particularités...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Characteristics -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 card-hover">
                <h2 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="bi bi-list-check text-indigo-600 mr-2"></i>
                    Caractéristiques
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Prix -->
                    <div>
                        <label for="prix" class="block text-sm font-semibold text-gray-700 mb-2">
                            Prix (FCFA)
                        </label>
                        <div class="relative">
                            <input type="number" id="prix" name="caracteristiques[prix]" value="{{ old('caracteristiques.prix') }}" min="0"
                                   class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500"
                                   placeholder="50000">
                            <div class="absolute inset-y-0 left-0 pl-1 flex items-center pointer-events-none">
                                <span class="text-gray-500 font-medium">FCFA</span>
                            </div>
                        </div>
                        @error('caracteristiques.prix')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Capacité -->
                    <div>
                        <label for="capacite" class="block text-sm font-semibold text-gray-700 mb-2">
                            Capacité
                        </label>
                        <input type="number" id="capacite" name="caracteristiques[capacite]" value="{{ old('caracteristiques.capacite') }}" min="1"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="100">
                        @error('caracteristiques.capacite')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Amenities -->
                    <div class="md:col-span-2">
                        <label for="amenities" class="block text-sm font-semibold text-gray-700 mb-2">
                            Services et Équipements
                        </label>
                        <div x-data="{ newAmenity: '' }" class="space-y-3">
                            <div class="flex space-x-2">
                                <input type="text" x-model="newAmenity" @keydown.enter.prevent="addAmenity(newAmenity); newAmenity = '';"
                                       class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                                       placeholder="Ex: WiFi gratuit, Piscine, Climatisation...">
                                <button type="button" @click="addAmenity(newAmenity); newAmenity = '';"
                                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                                    Ajouter
                                </button>
                            </div>
                            <div class="flex flex-wrap gap-2" x-show="amenitiesList.length > 0">
                                <template x-for="(amenity, index) in amenitiesList" :key="index">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-indigo-100 text-indigo-800">
                                        <span x-text="amenity"></span>
                                        <button type="button" @click="removeAmenity(index)" class="ml-2 text-indigo-600 hover:text-indigo-800">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </span>
                                </template>
                            </div>
                            <input type="hidden" name="caracteristiques[amenities]" :value="JSON.stringify(amenitiesList)">
                        </div>
                        @error('caracteristiques.amenities')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Images Upload -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 card-hover">
                <h2 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="bi bi-images text-indigo-600 mr-2"></i>
                    Images de l'Infrastructure
                </h2>

                <div class="space-y-4">
                    <!-- Drop Zone -->
                    <div class="relative"
                         @dragover.prevent="dragOver = true"
                         @dragleave.prevent="dragOver = false"
                         @drop.prevent="handleDrop($event)">
                        <input type="file" id="images" name="images[]" multiple accept="image/*" class="hidden"
                               @change="handleFileSelect($event)">
                        <label for="images" 
                               class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-xl cursor-pointer transition-all duration-200 drop-zone"
                               :class="dragOver ? 'active' : ''">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <i class="bi bi-cloud-arrow-up text-gray-400 text-2xl mb-3"></i>
                                <p class="mb-2 text-sm text-gray-500">
                                    <span class="font-semibold">Cliquez pour sélectionner</span> ou glissez-déposez
                                </p>
                                <p class="text-xs text-gray-500">PNG, JPG ou JPEG (MAX. 2MB chacune)</p>
                            </div>
                        </label>
                    </div>

                    <!-- Preview Images -->
                    <div x-show="images.length > 0" class="space-y-3">
                        <div class="flex items-center justify-between">
                            <h3 class="text-sm font-medium text-gray-900">Images sélectionnées (<span x-text="images.length"></span>)</h3>
                            <button type="button" @click="clearAllImages()" class="text-sm text-red-600 hover:text-red-800">
                                Tout supprimer
                            </button>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <template x-for="(image, index) in images" :key="index">
                                <div class="relative group bg-gray-100 rounded-lg overflow-hidden">
                                    <img :src="image.url" :alt="image.name" 
                                         class="w-full h-24 object-cover">
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-200 flex items-center justify-center">
                                        <button type="button" @click="removeImage(index)"
                                                class="w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-600">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                    <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-75 text-white text-xs p-1 truncate">
                                        <span x-text="image.name"></span>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                    
                    @error('images.*')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Type-specific fields -->
            <div x-show="selectedType" class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 card-hover">
                <h2 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="bi bi-gear text-indigo-600 mr-2"></i>
                    Informations Spécifiques
                </h2>

                <!-- Hotel specific fields -->
                <div x-show="selectedType === 'hotel'" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-blue-50 p-4 rounded-xl">
                        <h3 class="font-medium text-blue-900 mb-3">🏨 Informations Hôtel</h3>
                        <p class="text-sm text-blue-700">
                            Pour un hôtel, pensez à préciser le nombre de chambres dans la capacité, 
                            les services comme le petit-déjeuner, le WiFi, la piscine, etc.
                        </p>
                    </div>
                </div>

                <!-- Restaurant specific fields -->
                <div x-show="selectedType === 'restaurant'" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-green-50 p-4 rounded-xl">
                        <h3 class="font-medium text-green-900 mb-3">🍽️ Informations Restaurant</h3>
                        <p class="text-sm text-green-700">
                            Pour un restaurant, indiquez le nombre de couverts dans la capacité, 
                            le type de cuisine, les horaires d'ouverture, etc.
                        </p>
                    </div>
                </div>

                <!-- Beach specific fields -->
                <div x-show="selectedType === 'plage'" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-yellow-50 p-4 rounded-xl">
                        <h3 class="font-medium text-yellow-900 mb-3">🏖️ Informations Plage</h3>
                        <p class="text-sm text-yellow-700">
                            Pour un espace plage, mentionnez les activités disponibles, 
                            la location d'équipements, les services de restauration, etc.
                        </p>
                    </div>
                </div>

                <!-- Transport specific fields -->
                <div x-show="selectedType === 'transport'" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-purple-50 p-4 rounded-xl">
                        <h3 class="font-medium text-purple-900 mb-3">🚗 Informations Transport</h3>
                        <p class="text-sm text-purple-700">
                            Pour un service de transport, précisez le type de véhicules, 
                            les destinations desservies, les tarifs par zone, etc.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                <a href="{{ route('acteur.infrastructures.index') }}" 
                   class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors font-medium text-center">
                    Annuler
                </a>
                <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3">
                    <button type="submit" name="action" value="draft"
                            class="px-6 py-3 border border-indigo-300 text-indigo-700 rounded-xl hover:bg-indigo-50 transition-colors font-medium">
                        Sauvegarder comme brouillon
                    </button>
                    <button type="submit" name="action" value="publish"
                            class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all font-medium shadow hover:shadow-md">
                        <i class="bi bi-check-circle mr-2"></i> Publier l'Infrastructure
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
function infrastructureForm() {
    return {
        selectedType: '',
        images: [],
        dragOver: false,
        amenitiesList: [],

        // Gestion des images
        handleFileSelect(event) {
            const files = Array.from(event.target.files);
            this.processFiles(files);
        },

        handleDrop(event) {
            this.dragOver = false;
            const files = Array.from(event.dataTransfer.files);
            this.processFiles(files);
        },

        processFiles(files) {
            files.forEach(file => {
                // Vérification du type de fichier
                if (!file.type.startsWith('image/')) {
                    alert(`Le fichier "${file.name}" n'est pas une image valide.`);
                    return;
                }

                // Vérification de la taille
                if (file.size > 2 * 1024 * 1024) {
                    alert(`Le fichier "${file.name}" est trop volumineux (max 2MB).`);
                    return;
                }

                // Lecture du fichier
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.images.push({
                        file: file,
                        url: e.target.result,
                        name: file.name,
                        size: file.size
                    });
                };
                reader.readAsDataURL(file);
            });
        },

        removeImage(index) {
            this.images.splice(index, 1);
        },

        clearAllImages() {
            this.images = [];
            document.getElementById('images').value = '';
        },

        // Gestion des équipements
        addAmenity(amenity) {
            if (amenity && amenity.trim() && !this.amenitiesList.includes(amenity.trim())) {
                this.amenitiesList.push(amenity.trim());
            }
        },

        removeAmenity(index) {
            this.amenitiesList.splice(index, 1);
        }
    }
}
</script>
@endpush

@endsection