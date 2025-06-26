@extends('layouts.app')

@section('title', 'Ajouter une Infrastructure - EWARI')
@section('page-title', 'Nouvelle Infrastructure')

@section('sidebar')
<!-- Acteur Navigation -->
<a href="{{ route('acteur.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4M8 7h8"></path>
    </svg>
    Dashboard
</a>

<a href="{{ route('acteur.profile') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
    </svg>
    Mon Profil
</a>

<a href="{{ route('acteur.infrastructures.index') }}" class="nav-link-active flex items-center px-4 py-3 text-sm font-medium rounded-xl text-white">
    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
    </svg>
    Mes Infrastructures
</a>
@endsection

@section('content')
<div class="p-6 max-w-4xl mx-auto">
    <!-- Breadcrumb -->
    <nav class="mb-6">
        <ol class="flex items-center space-x-2 text-sm text-gray-500">
            <li><a href="{{ route('acteur.dashboard') }}" class="hover:text-indigo-600">Dashboard</a></li>
            <li><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></li>
            <li><a href="{{ route('acteur.infrastructures.index') }}" class="hover:text-indigo-600">Infrastructures</a></li>
            <li><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></li>
            <li class="text-gray-900 font-medium">Nouvelle</li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-sm p-6 mb-6 border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Ajouter une Infrastructure</h1>
                <p class="text-gray-600 mt-1">Créez une nouvelle infrastructure touristique pour votre entreprise</p>
            </div>
            <div class="hidden sm:block">
                <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
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
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Informations Générales
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nom -->
                    <div class="md:col-span-2">
                        <label for="nom" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nom de l'infrastructure *
                        </label>
                        <input type="text" id="nom" name="nom" required value="{{ old('nom') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                               placeholder="Ex: Hôtel Paradise, Restaurant Le Gourmet...">
                        @error('nom')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Type -->
                    <div>
                        <label for="type" class="block text-sm font-semibold text-gray-700 mb-2">
                            Type d'infrastructure *
                        </label>
                        <select id="type" name="type" x-model="selectedType" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200">
                            <option value="">Sélectionner un type</option>
                            <option value="hotel">🏨 Hôtel</option>
                            <option value="restaurant">🍽️ Restaurant</option>
                            <option value="plage">🏖️ Espace Plage</option>
                            <option value="transport">🚗 Service de Transport</option>
                        </select>
                        @error('type')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Localisation -->
                    <div>
                        <label for="localisation" class="block text-sm font-semibold text-gray-700 mb-2">
                            Localisation *
                        </label>
                        <input type="text" id="localisation" name="localisation" required value="{{ old('localisation') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                               placeholder="Ex: Cotonou, Quartier Fidjrossè">
                        @error('localisation')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                            Description *
                        </label>
                        <textarea id="description" name="description" rows="4" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                                  placeholder="Décrivez votre infrastructure, ses services, ses particularités...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Characteristics -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Caractéristiques
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Prix -->
                    <div>
                        <label for="prix" class="block text-sm font-semibold text-gray-700 mb-2">
                            Prix (FCFA)
                        </label>
                        <div class="relative">
                            <input type="number" id="prix" name="prix" value="{{ old('prix') }}" min="0"
                                   class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                                   placeholder="50000">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 font-medium">FCFA</span>
                            </div>
                        </div>
                        @error('prix')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Capacité -->
                    <div>
                        <label for="capacite" class="block text-sm font-semibold text-gray-700 mb-2">
                            Capacité
                        </label>
                        <input type="number" id="capacite" name="capacite" value="{{ old('capacite') }}" min="1"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                               placeholder="100">
                        @error('capacite')
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
                                       class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
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
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </span>
                                </template>
                            </div>
                            <input type="hidden" name="amenities" :value="amenitiesList.join(',')">
                        </div>
                        @error('amenities')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Images Upload -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 002 2z"></path>
                    </svg>
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
                               class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-xl cursor-pointer transition-all duration-200"
                               :class="dragOver ? 'border-indigo-500 bg-indigo-50' : 'border-gray-300 hover:border-indigo-400 hover:bg-gray-50'">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
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
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
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
            <div x-show="selectedType" class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
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
            <div class="flex justify-between items-center">
                <a href="{{ route('acteur.infrastructures.index') }}" 
                   class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors font-medium">
                    Annuler
                </a>
                <div class="flex space-x-3">
                    <button type="submit" name="action" value="draft"
                            class="px-6 py-3 border border-indigo-300 text-indigo-700 rounded-xl hover:bg-indigo-50 transition-colors font-medium">
                        Sauvegarder comme brouillon
                    </button>
                    <button type="submit" name="action" value="publish"
                            class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 font-medium shadow-lg hover:shadow-xl transform hover:scale-105">
                        Publier l'Infrastructure
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

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
@endsection