@extends('layouts.app')

@section('title', $infrastructure->nom . ' - EWARI Admin')
@section('page-title', 'Détails Infrastructure')

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

    /* Modale de confirmation */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .modal-overlay.show {
        opacity: 1;
        visibility: visible;
    }

    .modal-content {
        background: white;
        border-radius: 1rem;
        padding: 2rem;
        max-width: 500px;
        width: 90%;
        transform: scale(0.9);
        transition: transform 0.3s ease;
    }

    .modal-overlay.show .modal-content {
        transform: scale(1);
    }

    /* Notifications toast */
    .toast {
        position: fixed;
        top: 1rem;
        right: 1rem;
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        padding: 1rem;
        max-width: 400px;
        z-index: 1001;
        transform: translateX(100%);
        transition: transform 0.3s ease;
    }

    .toast.show {
        transform: translateX(0);
    }

    .toast-success {
        border-left: 4px solid #10b981;
    }

    .toast-error {
        border-left: 4px solid #ef4444;
    }

    /* Animation des cartes */
    .animate-card {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .animate-card.show {
        opacity: 1;
        transform: translateY(0);
    }
</style>
@endpush

@section('sidebar')
<!-- Admin Navigation -->
<a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
    <i class="bi bi-grid mr-3"></i>
    Dashboard
</a>

<a href="{{ route('admin.acteurs.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
    <i class="bi bi-people mr-3"></i>
    Acteurs Touristiques
</a>

<a href="{{ route('admin.infrastructures.index') }}" class="nav-link-active flex items-center px-4 py-3 text-sm font-medium rounded-xl text-white">
    <i class="bi bi-building mr-3"></i>
    Infrastructures
</a>
@endsection

@section('content')
<div class="p-6 space-y-6">
    <!-- Header avec actions -->
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 animate-card">
        <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between">
            <div class="flex items-start space-x-4">
                <!-- Retour -->
                <a href="{{ route('admin.infrastructures.index') }}" 
                   class="inline-flex items-center p-2 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition-colors">
                    <i class="bi bi-arrow-left"></i>
                </a>
                
                <div>
                    <div class="flex items-center space-x-3">
                        <h1 class="text-2xl font-bold text-gray-900">{{ $infrastructure->nom }}</h1>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $infrastructure->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            <span class="w-2 h-2 mr-2 rounded-full {{ $infrastructure->is_active ? 'bg-green-400' : 'bg-red-400' }}"></span>
                            {{ $infrastructure->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <p class="text-gray-600 mt-1">
                        {{ ucfirst($infrastructure->type) }} • 
                        {{ $infrastructure->acteurTouristique->nom_entreprise }}
                    </p>
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-4 lg:mt-0 flex items-center space-x-3">
                <!-- Toggle statut -->
                <button onclick="showConfirmModal('toggle', '{{ $infrastructure->id }}', '{{ $infrastructure->is_active ? 'désactiver' : 'activer' }}', '{{ $infrastructure->nom }}')"
                    class="inline-flex items-center px-4 py-2 {{ $infrastructure->is_active ? 'bg-red-100 text-red-700 hover:bg-red-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }} font-medium rounded-xl transition-colors">
                    @if($infrastructure->is_active)
                        <i class="bi bi-x-circle mr-2"></i>
                        Désactiver
                    @else
                        <i class="bi bi-check-circle mr-2"></i>
                        Activer
                    @endif
                </button>

                <!-- Supprimer -->
                <button onclick="showConfirmModal('delete', '{{ $infrastructure->id }}', 'supprimer', '{{ $infrastructure->nom }}')"
                    class="inline-flex items-center px-4 py-2 bg-red-100 text-red-700 font-medium rounded-xl hover:bg-red-200 transition-colors">
                    <i class="bi bi-trash mr-2"></i>
                    Supprimer
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Contenu principal -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Images -->
            @if($infrastructure->images && count($infrastructure->images) > 0)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-card">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900">Images</h2>
                </div>
                
                <!-- Image principale -->
                @php
                $imageUrls = $infrastructure->image_urls;
                @endphp
                <div x-data="{ currentImage: 0, images: {{ json_encode($imageUrls) }} }" class="relative">
                    <div class="aspect-w-16 aspect-h-9 bg-gray-200">
                        <img :src="images[currentImage]" 
                            :alt="'{{ $infrastructure->nom }}'"
                            class="w-full h-80 object-cover">
                    </div>

                    <!-- Contrôles navigation -->
                    <template x-if="images.length > 1">
                        <div>
                            <button @click="currentImage = currentImage > 0 ? currentImage - 1 : images.length - 1"
                                    class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-75 transition-all">
                                <i class="bi bi-chevron-left"></i>
                            </button>
                            <button @click="currentImage = currentImage < images.length - 1 ? currentImage + 1 : 0"
                                    class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-75 transition-all">
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        </div>
                    </template>

                    <!-- Indicateurs -->
                    <template x-if="images.length > 1">
                        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                            <template x-for="(image, index) in images" :key="index">
                                <button @click="currentImage = index"
                                        :class="currentImage === index ? 'bg-white' : 'bg-white bg-opacity-50'"
                                        class="w-3 h-3 rounded-full transition-all"></button>
                            </template>
                        </div>
                    </template>
                </div>

                <!-- Miniatures -->
                @if(count($infrastructure->images) > 1)
                <div class="p-4">
                    <div class="grid grid-cols-4 md:grid-cols-6 gap-2">
                        @foreach($infrastructure->image_urls as $index => $imageUrl)
                        <button @click="currentImage = {{ $index }}"
                                :class="currentImage === {{ $index }} ? 'ring-2 ring-indigo-500' : ''"
                                class="relative group aspect-square overflow-hidden rounded-lg border border-gray-200 hover:opacity-75 transition-all">
                            <img src="{{ $imageUrl }}" 
                                 alt="Image {{ $index + 1 }}"
                                 class="w-full h-full object-cover">
                        </button>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            @endif

            <!-- Caractéristiques et Galerie -->
            <div class="lg:col-span-2 space-y-6">
                @if($infrastructure->caracteristiques && count($infrastructure->caracteristiques) > 0)
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 animate-card">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Caractéristiques</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @if(isset($infrastructure->caracteristiques['prix']))
                        <div class="flex items-center p-4 bg-green-50 rounded-xl border border-green-100">
                            <div class="w-10 h-10 rounded-lg bg-green-500 flex items-center justify-center mr-3">
                                <i class="bi bi-cash-coin text-white"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-green-900">Prix</p>
                                <p class="text-lg font-bold text-green-900">{{ number_format($infrastructure->caracteristiques['prix'], 0, ',', ' ') }} FCFA</p>
                            </div>
                        </div>
                        @endif

                        @if(isset($infrastructure->caracteristiques['capacite']))
                        <div class="flex items-center p-4 bg-blue-50 rounded-xl border border-blue-100">
                            <div class="w-10 h-10 rounded-lg bg-blue-500 flex items-center justify-center mr-3">
                                <i class="bi bi-people text-white"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-blue-900">Capacité</p>
                                <p class="text-lg font-bold text-blue-900">{{ $infrastructure->caracteristiques['capacite'] }} personnes</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    @if(isset($infrastructure->caracteristiques['amenities']) && is_array($infrastructure->caracteristiques['amenities']))
                    <div class="mt-6">
                        <h4 class="text-sm font-medium text-gray-900 mb-3">Équipements et services</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($infrastructure->caracteristiques['amenities'] as $amenity)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                <i class="bi bi-check-circle mr-1"></i>
                                {{ trim($amenity) }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                @endif
            </div>

            <!-- Description -->
            @if($infrastructure->description)
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 animate-card">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Description</h2>
                <div class="prose prose-gray max-w-none">
                    <p class="text-gray-700 leading-relaxed">{{ $infrastructure->description }}</p>
                </div>
            </div>
            @endif

            <!-- Horaires -->
            @if($infrastructure->horaires)
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 animate-card">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Horaires d'ouverture</h2>
                <div class="bg-gray-50 rounded-xl p-4">
                    <pre class="text-sm text-gray-700 whitespace-pre-wrap">{{ $infrastructure->horaires }}</pre>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar informations -->
        <div class="space-y-6">
            <!-- Informations générales -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 animate-card">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Informations générales</h2>
                
                <div class="space-y-4">
                    <!-- Type -->
                    <div>
                        <label class="text-sm font-medium text-gray-500">Type</label>
                        <div class="flex items-center mt-1">
                            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center mr-3">
                                @switch($infrastructure->type)
                                    @case('hotel')
                                        <i class="bi bi-building text-white"></i>
                                        @break
                                    @case('restaurant')
                                        <i class="bi bi-cup-hot text-white"></i>
                                        @break
                                    @case('plage')
                                        <i class="bi bi-umbrella text-white"></i>
                                        @break
                                    @case('transport')
                                        <i class="bi bi-bus-front text-white"></i>
                                        @break
                                    @default
                                        <i class="bi bi-geo-alt text-white"></i>
                                @endswitch
                            </div>
                            <span class="text-sm font-medium text-gray-900">{{ ucfirst($infrastructure->type) }}</span>
                        </div>
                    </div>

                    <!-- Localisation -->
                    <div>
                        <label class="text-sm font-medium text-gray-500">Localisation</label>
                        <div class="flex items-center mt-1">
                            <i class="bi bi-geo-alt text-gray-400 mr-2"></i>
                            <span class="text-sm text-gray-900">{{ $infrastructure->localisation }}</span>
                        </div>
                    </div>

                    <!-- Adresse -->
                    @if($infrastructure->adresse)
                    <div>
                        <label class="text-sm font-medium text-gray-500">Adresse</label>
                        <p class="text-sm text-gray-900 mt-1">{{ $infrastructure->adresse }}</p>
                    </div>
                    @endif

                    <!-- Capacité -->
                    @if($infrastructure->capacite)
                    <div>
                        <label class="text-sm font-medium text-gray-500">Capacité</label>
                        <div class="flex items-center mt-1">
                            <i class="bi bi-people text-gray-400 mr-2"></i>
                            <span class="text-sm text-gray-900">{{ $infrastructure->capacite }} personnes</span>
                        </div>
                    </div>
                    @endif

                    <!-- Tarif -->
                    @if($infrastructure->tarif)
                    <div>
                        <label class="text-sm font-medium text-gray-500">Tarif</label>
                        <div class="flex items-center mt-1">
                            <i class="bi bi-cash-coin text-gray-400 mr-2"></i>
                            <span class="text-sm text-gray-900">{{ $infrastructure->tarif }}</span>
                        </div>
                    </div>
                    @endif

                    <!-- Contact -->
                    @if($infrastructure->telephone || $infrastructure->email)
                    <div>
                        <label class="text-sm font-medium text-gray-500">Contact</label>
                        <div class="mt-1 space-y-1">
                            @if($infrastructure->telephone)
                            <div class="flex items-center">
                                <i class="bi bi-telephone text-gray-400 mr-2"></i>
                                <span class="text-sm text-gray-900">{{ $infrastructure->telephone }}</span>
                            </div>
                            @endif
                            @if($infrastructure->email)
                            <div class="flex items-center">
                                <i class="bi bi-envelope text-gray-400 mr-2"></i>
                                <span class="text-sm text-gray-900">{{ $infrastructure->email }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Site web -->
                    @if($infrastructure->site_web)
                    <div>
                        <label class="text-sm font-medium text-gray-500">Site web</label>
                        <div class="flex items-center mt-1">
                            <i class="bi bi-globe text-gray-400 mr-2"></i>
                            <a href="{{ $infrastructure->site_web }}" target="_blank" 
                               class="text-sm text-indigo-600 hover:text-indigo-800 transition-colors">
                                {{ $infrastructure->site_web }}
                            </a>
                        </div>
                    </div>
                    @endif

                    <!-- Date création -->
                    <div>
                        <label class="text-sm font-medium text-gray-500">Date de création</label>
                        <div class="flex items-center mt-1">
                            <i class="bi bi-calendar text-gray-400 mr-2"></i>
                            <span class="text-sm text-gray-900">{{ $infrastructure->created_at->format('d/m/Y à H:i') }}</span>
                        </div>
                    </div>

                    <!-- Dernière modification -->
                    <div>
                        <label class="text-sm font-medium text-gray-500">Dernière modification</label>
                        <div class="flex items-center mt-1">
                            <i class="bi bi-clock-history text-gray-400 mr-2"></i>
                            <span class="text-sm text-gray-900">{{ $infrastructure->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informations propriétaire -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 animate-card">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Acteur Touristique</h2>
                
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-400 to-purple-500 rounded-xl flex items-center justify-center">
                        <span class="text-white font-semibold text-lg">{{ substr($infrastructure->acteurTouristique->nom_entreprise, 0, 2) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-sm font-semibold text-gray-900">{{ $infrastructure->acteurTouristique->nom_entreprise }}</h3>
                        <p class="text-sm text-gray-600">{{ $infrastructure->acteurTouristique->utilisateur->nom }} {{ $infrastructure->acteurTouristique->utilisateur->prenom }}</p>
                        <p class="text-sm text-gray-500">{{ $infrastructure->acteurTouristique->utilisateur->email }}</p>
                        
                        @if($infrastructure->acteurTouristique->telephone)
                        <div class="flex items-center mt-2">
                            <i class="bi bi-telephone text-gray-400 mr-1"></i>
                            <span class="text-xs text-gray-500">{{ $infrastructure->acteurTouristique->telephone }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Statistiques rapides -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 animate-card">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Statistiques</h2>
                
                <div class="space-y-4">
                    <!-- Nombre d'images -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="bi bi-image text-gray-400 mr-2"></i>
                            <span class="text-sm text-gray-600">Images</span>
                        </div>
                        <span class="text-sm font-semibold text-gray-900">{{ $infrastructure->images ? count($infrastructure->images) : 0 }}</span>
                    </div>

                    <!-- Âge de l'infrastructure -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="bi bi-clock text-gray-400 mr-2"></i>
                            <span class="text-sm text-gray-600">Ancienneté</span>
                        </div>
                        <span class="text-sm font-semibold text-gray-900">{{ $infrastructure->created_at->diffForHumans() }}</span>
                    </div>

                    <!-- Statut actuel -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="bi bi-check-circle text-gray-400 mr-2"></i>
                            <span class="text-sm text-gray-600">Statut</span>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $infrastructure->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $infrastructure->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modale de confirmation -->
<div id="confirmModal" class="modal-overlay">
    <div class="modal-content">
        <div class="text-center">
            <div id="modalIcon" class="mx-auto mb-4 w-12 h-12 rounded-full flex items-center justify-center">
                <i id="modalIconElement" class="text-2xl"></i>
            </div>
            <h3 id="modalTitle" class="text-lg font-semibold text-gray-900 mb-2"></h3>
            <p id="modalMessage" class="text-gray-600 mb-6"></p>
            <div class="flex justify-center space-x-3">
                <button id="confirmAction" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    Confirmer
                </button>
                <button onclick="hideConfirmModal()" class="px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors">
                    Annuler
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Formulaires cachés pour les actions -->
<form id="toggleForm" action="{{ route('admin.infrastructures.toggle-status', $infrastructure) }}" method="POST" style="display: none;">
    @csrf
    @method('PATCH')
</form>

<form id="deleteForm" action="{{ route('admin.infrastructures.destroy', $infrastructure) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@push('scripts')
<script>
// Animation des cartes au chargement
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.animate-card');
    cards.forEach((card, index) => {
        setTimeout(() => {
            card.classList.add('show');
        }, index * 100);
    });
});

// Gestion de la modale de confirmation
let currentAction = null;
let currentInfrastructureId = null;

function showConfirmModal(action, infrastructureId, actionText, infrastructureName) {
    currentAction = action;
    currentInfrastructureId = infrastructureId;
    
    const modal = document.getElementById('confirmModal');
    const modalIcon = document.getElementById('modalIcon');
    const modalIconElement = document.getElementById('modalIconElement');
    const modalTitle = document.getElementById('modalTitle');
    const modalMessage = document.getElementById('modalMessage');
    const confirmButton = document.getElementById('confirmAction');
    
    if (action === 'delete') {
        modalIcon.className = 'mx-auto mb-4 w-12 h-12 rounded-full flex items-center justify-center bg-red-100';
        modalIconElement.className = 'text-2xl bi bi-trash text-red-600';
        modalTitle.textContent = 'Confirmer la suppression';
        modalMessage.textContent = `Êtes-vous sûr de vouloir supprimer l'infrastructure "${infrastructureName}" ? Cette action est irréversible.`;
        confirmButton.className = 'px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors';
        confirmButton.textContent = 'Supprimer';
    } else if (action === 'toggle') {
        if (actionText === 'désactiver') {
            modalIcon.className = 'mx-auto mb-4 w-12 h-12 rounded-full flex items-center justify-center bg-orange-100';
            modalIconElement.className = 'text-2xl bi bi-x-circle text-orange-600';
            modalTitle.textContent = 'Confirmer la désactivation';
            modalMessage.textContent = `Êtes-vous sûr de vouloir désactiver l'infrastructure "${infrastructureName}" ?`;
            confirmButton.className = 'px-6 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors';
            confirmButton.textContent = 'Désactiver';
        } else {
            modalIcon.className = 'mx-auto mb-4 w-12 h-12 rounded-full flex items-center justify-center bg-green-100';
            modalIconElement.className = 'text-2xl bi bi-check-circle text-green-600';
            modalTitle.textContent = 'Confirmer l\'activation';
            modalMessage.textContent = `Êtes-vous sûr de vouloir activer l'infrastructure "${infrastructureName}" ?`;
            confirmButton.className = 'px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors';
            confirmButton.textContent = 'Activer';
        }
    }
    
    modal.classList.add('show');
}

function hideConfirmModal() {
    const modal = document.getElementById('confirmModal');
    modal.classList.remove('show');
    currentAction = null;
    currentInfrastructureId = null;
}

function executeAction() {
    if (currentAction) {
        const formId = currentAction === 'delete' ? 'deleteForm' : 'toggleForm';
        const form = document.getElementById(formId);
        if (form) {
            form.submit();
        }
    }
    hideConfirmModal();
}

// Event listener pour le bouton de confirmation
document.getElementById('confirmAction').addEventListener('click', executeAction);

// Fermer la modale en cliquant sur l'overlay
document.getElementById('confirmModal').addEventListener('click', function(e) {
    if (e.target === this) {
        hideConfirmModal();
    }
});

// Fermer la modale avec la touche Échap
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        hideConfirmModal();
    }
});
</script>
@endpush

@endsection