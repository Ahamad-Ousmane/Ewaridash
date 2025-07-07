@extends('layouts.app')

@section('title', 'Modifier ' . $infrastructure->nom . ' - EWARI')
@section('page-title', 'Modifier une infrastructure')

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


    @if(session('error'))
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6">
        <div class="flex items-center">
            <i class="bi bi-exclamation-triangle mr-2"></i>
            {{ session('error') }}
        </div>
    </div>
    @endif

    <!-- Breadcrumb -->
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('acteur.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-indigo-600">
                    <i class="bi bi-house-door mr-2"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="bi bi-chevron-right text-gray-400"></i>
                    <a href="{{ route('acteur.infrastructures.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-indigo-600 md:ml-2">Infrastructures</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="bi bi-chevron-right text-gray-400"></i>
                    <a href="{{ route('acteur.infrastructures.show', $infrastructure) }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-indigo-600 md:ml-2">{{ $infrastructure->nom }}</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <i class="bi bi-chevron-right text-gray-400"></i>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Modifier</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 card-hover">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Modifier l'infrastructure</h1>
                <p class="text-gray-600 mt-1">Modifiez les informations de votre infrastructure touristique</p>
            </div>
            <div class="mt-4 lg:mt-0 flex space-x-3">
                <a href="{{ route('acteur.infrastructures.show', $infrastructure) }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                    <i class="bi bi-eye mr-2"></i>
                    Voir l'infrastructure
                </a>
                <a href="{{ route('acteur.infrastructures.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                    <i class="bi bi-arrow-left mr-2"></i>
                    Retour à la liste
                </a>
            </div>
        </div>
    </div>

    <!-- Formulaire -->
    <form action="{{ route('acteur.infrastructures.update', $infrastructure) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Informations de base -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 card-hover">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900">Informations de base</h3>
                <p class="text-sm text-gray-600 mt-1">Les informations essentielles de votre infrastructure</p>
            </div>
            
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Nom -->
                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">
                            Nom de l'infrastructure <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nom" name="nom" value="{{ old('nom', $infrastructure->nom) }}" required
                               class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('nom') border-red-300 @enderror">
                        @error('nom')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Type -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                            Type d'infrastructure <span class="text-red-500">*</span>
                        </label>
                        <select id="type" name="type" required 
                                class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('type') border-red-300 @enderror">
                            <option value="">Sélectionnez un type</option>
                            <option value="hotel" {{ old('type', $infrastructure->type) === 'hotel' ? 'selected' : '' }}>Hôtel</option>
                            <option value="restaurant" {{ old('type', $infrastructure->type) === 'restaurant' ? 'selected' : '' }}>Restaurant</option>
                            <option value="attraction" {{ old('type', $infrastructure->type) === 'attraction' ? 'selected' : '' }}>Attraction</option>
                            <option value="transport" {{ old('type', $infrastructure->type) === 'transport' ? 'selected' : '' }}>Service de Transport</option>
                        </select>
                        @error('type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Localisation -->
                <div>
                    <label for="localisation" class="block text-sm font-medium text-gray-700 mb-2">
                        Localisation <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="localisation" name="localisation" value="{{ old('localisation', $infrastructure->localisation) }}" required
                           placeholder="Ex: Cotonou, Littoral, Bénin"
                           class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('localisation') border-red-300 @enderror">
                    @error('localisation')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Description
                    </label>
                    <textarea id="description" name="description" rows="4" 
                              placeholder="Décrivez votre infrastructure, ses atouts, ses services..."
                              class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-300 @enderror">{{ old('description', $infrastructure->description) }}</textarea>
                    @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Statut -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
                    <div class="flex items-center space-x-4">
                        <label class="flex items-center">
                            <input type="radio" name="is_active" value="1" {{ old('is_active', $infrastructure->is_active) == '1' ? 'checked' : '' }}
                                   class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                            <span class="ml-2 text-sm text-gray-700">Active</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="is_active" value="0" {{ old('is_active', $infrastructure->is_active) == '0' ? 'checked' : '' }}
                                   class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                            <span class="ml-2 text-sm text-gray-700">Inactive</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Caractéristiques -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 card-hover">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900">Caractéristiques</h3>
                <p class="text-sm text-gray-600 mt-1">Détails spécifiques de votre infrastructure</p>
            </div>
            
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Prix -->
                    <div>
                        <label for="prix" class="block text-sm font-medium text-gray-700 mb-2">
                            Prix (FCFA)
                        </label>
                        <div class="relative">
                            <input type="number" id="prix" name="caracteristiques[prix]" 
                                   value="{{ old('caracteristiques.prix', $infrastructure->caracteristiques['prix'] ?? '') }}" 
                                   min="0" step="100"
                                   placeholder="Ex: 25000"
                                   class="block w-full px-4 py-3 pr-16 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <span class="text-gray-500 text-sm">FCFA</span>
                            </div>
                        </div>
                    </div>

                    <!-- Capacité -->
                    <div>
                        <label for="capacite" class="block text-sm font-medium text-gray-700 mb-2">
                            Capacité (personnes)
                        </label>
                        <input type="number" id="capacite" name="caracteristiques[capacite]" 
                               value="{{ old('caracteristiques.capacite', $infrastructure->caracteristiques['capacite'] ?? '') }}" 
                               min="1"
                               placeholder="Ex: 50"
                               class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>

                <!-- Équipements et services -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Équipements et services
                    </label>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3" id="amenities-container">
                        @php
                            $allAmenities = [
                                'WiFi gratuit', 'Climatisation', 'Parking', 'Piscine', 'Restaurant', 
                                'Bar', 'Spa', 'Salle de fitness', 'Service de chambre', 'Réception 24h/24',
                                'Animaux acceptés', 'Navette aéroport', 'Blanchisserie', 'Coffre-fort',
                                'Télévision', 'Minibar', 'Balcon', 'Vue sur mer', 'Jardin', 'Terrasse'
                            ];
                            $currentAmenities = old('caracteristiques.amenities', $infrastructure->caracteristiques['amenities'] ?? []);
                        @endphp
                        
                        @foreach($allAmenities as $amenity)
                        <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="checkbox" name="caracteristiques[amenities][]" value="{{ $amenity }}"
                                   {{ in_array($amenity, $currentAmenities) ? 'checked' : '' }}
                                   class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                            <span class="ml-2 text-sm text-gray-700">{{ $amenity }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Images -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 card-hover">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900">Images</h3>
                <p class="text-sm text-gray-600 mt-1">Ajoutez des images attrayantes de votre infrastructure</p>
            </div>
            
            <div class="p-6 space-y-6">
                <!-- Images actuelles -->
                @if($infrastructure->images && count($infrastructure->images) > 0)
                <div>
                    <h4 class="text-sm font-medium text-gray-700 mb-3">Images actuelles</h4>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="current-images">
                        @foreach($infrastructure->images as $index => $image)
                        <div class="relative group" data-image-index="{{ $index }}">
                            <img src="{{ $infrastructure->getImageUrl($image) }}" 
                                 alt="Image {{ $index + 1 }}"
                                 class="w-full h-32 object-cover rounded-lg border border-gray-200">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 rounded-lg transition-all flex items-center justify-center">
                                <button type="button" onclick="removeImage({{ $index }})" 
                                        class="opacity-0 group-hover:opacity-100 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-all">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                            <input type="hidden" name="existing_images[]" value="{{ $image }}">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Nouvelles images -->
                <div>
                    <h4 class="text-sm font-medium text-gray-700 mb-3">Ajouter de nouvelles images</h4>
                    <div class="flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl drop-zone">
                        <div class="space-y-1 text-center">
                            <i class="bi bi-images text-gray-400 text-4xl mx-auto"></i>
                            <div class="flex text-sm text-gray-600">
                                <label for="images" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                    <span>Télécharger des images</span>
                                    <input id="images" name="images[]" type="file" class="sr-only" multiple accept="image/*" onchange="previewImages(this)">
                                </label>
                                <p class="pl-1">ou glissez-déposez</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF jusqu'à 10MB</p>
                        </div>
                    </div>
                    
                    <!-- Aperçu des nouvelles images -->
                    <div id="image-preview" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4 hidden"></div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0 sm:space-x-4">
            <div class="flex items-center space-x-4">
                <a href="{{ route('acteur.infrastructures.show', $infrastructure) }}" 
                   class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    Annuler
                </a>
            </div>
            
            <div class="flex items-center space-x-4">
                <button type="submit" name="action" value="save" 
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    <i class="bi bi-check-circle mr-2"></i>
                    Enregistrer les modifications
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
// Variables pour gérer les images
let imagesToRemove = [];

// Fonction pour supprimer une image existante
function removeImage(index) {
    const imageDiv = document.querySelector(`[data-image-index="${index}"]`);
    if (imageDiv) {
        const hiddenInput = imageDiv.querySelector('input[name="existing_images[]"]');
        if (hiddenInput) {
            imagesToRemove.push(hiddenInput.value);
            // Créer un input hidden pour marquer l'image à supprimer
            const removeInput = document.createElement('input');
            removeInput.type = 'hidden';
            removeInput.name = 'images_to_remove[]';
            removeInput.value = hiddenInput.value;
            document.querySelector('form').appendChild(removeInput);
        }
        imageDiv.remove();
    }
}

// Fonction pour prévisualiser les nouvelles images
function previewImages(input) {
    const previewContainer = document.getElementById('image-preview');
    previewContainer.innerHTML = '';
    
    if (input.files && input.files.length > 0) {
        previewContainer.classList.remove('hidden');
        
        Array.from(input.files).forEach((file, index) => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imageDiv = document.createElement('div');
                    imageDiv.className = 'relative group';
                    imageDiv.innerHTML = `
                        <img src="${e.target.result}" 
                             alt="Nouvelle image ${index + 1}"
                             class="w-full h-32 object-cover rounded-lg border border-gray-200">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 rounded-lg transition-all flex items-center justify-center">
                            <button type="button" onclick="removeNewImage(this, ${index})" 
                                    class="opacity-0 group-hover:opacity-100 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-all">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    `;
                    previewContainer.appendChild(imageDiv);
                };
                reader.readAsDataURL(file);
            }
        });
    } else {
        previewContainer.classList.add('hidden');
    }
}

// Fonction pour supprimer une nouvelle image de l'aperçu
function removeNewImage(button, index) {
    const imageDiv = button.closest('.relative');
    imageDiv.remove();
    
    // Recréer l'input file sans cette image
    const fileInput = document.getElementById('images');
    const dt = new DataTransfer();
    const files = fileInput.files;
    
    for (let i = 0; i < files.length; i++) {
        if (i !== index) {
            dt.items.add(files[i]);
        }
    }
    
    fileInput.files = dt.files;
    previewImages(fileInput);
}

// Validation du formulaire
document.querySelector('form').addEventListener('submit', function(e) {
    const nom = document.getElementById('nom').value.trim();
    const type = document.getElementById('type').value;
    const localisation = document.getElementById('localisation').value.trim();
    
    if (!nom || !type || !localisation) {
        e.preventDefault();
        alert('Veuillez remplir tous les champs obligatoires.');
        return false;
    }
});

// Gestion du drag & drop pour les images
const dropZone = document.querySelector('.drop-zone');
const fileInput = document.getElementById('images');

dropZone.addEventListener('dragover', function(e) {
    e.preventDefault();
    this.classList.add('active');
});

dropZone.addEventListener('dragleave', function(e) {
    e.preventDefault();
    this.classList.remove('active');
});

dropZone.addEventListener('drop', function(e) {
    e.preventDefault();
    this.classList.remove('active');
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        fileInput.files = files;
        previewImages(fileInput);
    }
});
</script>
@endpush

@endsection