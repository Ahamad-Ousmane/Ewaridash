@extends('layouts.app') 

@section('title', $infrastructure->nom . ' - EWARI')
@section('page-title', $infrastructure->nom)

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

    <!-- Breadcrumb et actions -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
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
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="bi bi-chevron-right text-gray-400"></i>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $infrastructure->nom }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="mt-4 lg:mt-0 flex space-x-3">
            <a href="{{ route('acteur.infrastructures.edit', $infrastructure) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white font-medium rounded-xl hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                <i class="bi bi-pencil mr-2"></i>
                Modifier
            </a>
            <a href="{{ route('acteur.infrastructures.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                <i class="bi bi-arrow-left mr-2"></i>
                Retour à la liste
            </a>
        </div>
    </div>

    <!-- Informations principales -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="relative">
            <!-- Images de l'infrastructure -->
            @if($infrastructure->images && count($infrastructure->images) > 0)
                @php
                    $imageUrls = $infrastructure->image_urls;
                @endphp
                <div x-data="{ 
                        currentImage: 0, 
                        images: {{ json_encode($imageUrls) }}
                     }" class="relative">
                    <div class="aspect-w-16 aspect-h-6 bg-gray-200">
                        <img :src="images[currentImage]" 
                             :alt="'{{ $infrastructure->nom }}'"
                             class="w-full h-64 lg:h-80 object-cover">
                    </div>
                    
                    @if(count($infrastructure->images) > 1)
                        <!-- Navigation des images -->
                        <div class="absolute inset-0 flex items-center justify-between p-4">
                            <button @click="currentImage = currentImage > 0 ? currentImage - 1 : images.length - 1" 
                                    class="p-2 rounded-full bg-black bg-opacity-50 text-white hover:bg-opacity-75 transition-all">
                                <i class="bi bi-chevron-left"></i>
                            </button>
                            <button @click="currentImage = currentImage < images.length - 1 ? currentImage + 1 : 0" 
                                    class="p-2 rounded-full bg-black bg-opacity-50 text-white hover:bg-opacity-75 transition-all">
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        </div>

                        <!-- Indicateurs -->
                        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                            <template x-for="(image, index) in images" :key="index">
                                <button @click="currentImage = index" 
                                        :class="currentImage === index ? 'bg-white' : 'bg-white bg-opacity-50'"
                                        class="w-3 h-3 rounded-full transition-all hover:bg-white"></button>
                            </template>
                        </div>
                    @endif
                </div>
            @else
                <!-- Image par défaut -->
                <div class="h-64 lg:h-80 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                    <div class="text-center">
                        <i class="bi bi-image text-gray-400 text-4xl"></i>
                        <p class="mt-2 text-sm text-gray-500">Aucune image disponible</p>
                    </div>
                </div>
            @endif

            <!-- Badge de statut -->
            <div class="absolute top-4 right-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $infrastructure->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    <span class="w-2 h-2 mr-2 rounded-full {{ $infrastructure->is_active ? 'bg-green-400' : 'bg-red-400' }}"></span>
                    {{ $infrastructure->is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>
        </div>

        <!-- Informations principales -->
        <div class="p-6">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center">
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
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $infrastructure->nom }}</h1>
                            <div class="flex items-center space-x-2 mt-1">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ ucfirst($infrastructure->type) }}
                                </span>
                                @if($infrastructure->localisation)
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="bi bi-geo-alt mr-1"></i>
                                    {{ $infrastructure->localisation }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($infrastructure->description)
                    <div class="prose max-w-none">
                        <p class="text-gray-600 leading-relaxed">{{ $infrastructure->description }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Caractéristiques et informations -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Caractéristiques et Galerie -->
        <div class="lg:col-span-2 space-y-6">
            @if($infrastructure->caracteristiques && count($infrastructure->caracteristiques) > 0)
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 card-hover">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Caractéristiques</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @if(isset($infrastructure->caracteristiques['prix']))
                    <div class="flex items-center p-4 bg-green-50 rounded-xl border border-green-100">
                        <div class="w-10 h-10 rounded-lg bg-green-500 flex items-center justify-center mr-3">
                            <i class="bi bi-currency-exchange text-white"></i>
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

            <!-- Galerie d'images -->
            @if($infrastructure->images && count($infrastructure->images) > 1)
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 card-hover">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Galerie d'images</h3>
                <p class="text-sm text-gray-600 mb-4">{{ count($infrastructure->images) }} image(s) disponible(s)</p>
                
                @php
                    $galleryImageUrls = $infrastructure->image_urls;
                @endphp
                
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($galleryImageUrls as $index => $imageUrl)
                    <div class="relative group cursor-pointer" onclick="openImageModal('{{ $imageUrl }}', {{ $index }})">
                        <img src="{{ $imageUrl }}" 
                             alt="Image {{ $index + 1 }} de {{ $infrastructure->nom }}"
                             class="w-full h-32 object-cover rounded-lg border border-gray-200 group-hover:opacity-75 transition-opacity">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 rounded-lg transition-all flex items-center justify-center">
                            <i class="bi bi-eye text-white opacity-0 group-hover:opacity-100 transition-opacity text-2xl"></i>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Informations complémentaires -->
        <div class="space-y-6">
            <!-- Métadonnées -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 card-hover">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Date de création</p>
                        <p class="text-sm text-gray-900">{{ $infrastructure->created_at->format('d/m/Y à H:i') }}</p>
                        <p class="text-xs text-gray-500">{{ $infrastructure->created_at->diffForHumans() }}</p>
                    </div>
                    
                    <div>
                        <p class="text-sm font-medium text-gray-500">Dernière modification</p>
                        <p class="text-sm text-gray-900">{{ $infrastructure->updated_at->format('d/m/Y à H:i') }}</p>
                        <p class="text-xs text-gray-500">{{ $infrastructure->updated_at->diffForHumans() }}</p>
                    </div>

                    @if($infrastructure->images && count($infrastructure->images) > 0)
                    <div>
                        <p class="text-sm font-medium text-gray-500">Images</p>
                        <p class="text-sm text-gray-900">{{ count($infrastructure->images) }} image(s)</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Actions rapides -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 card-hover">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('acteur.infrastructures.edit', $infrastructure) }}" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        <i class="bi bi-pencil mr-2"></i>
                        Modifier l'infrastructure
                    </a>

                    <form action="{{ route('acteur.infrastructures.destroy', $infrastructure) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette infrastructure ? Cette action est irréversible.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 border border-red-300 text-sm font-medium rounded-xl text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                            <i class="bi bi-trash mr-2"></i>
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal d'image -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden items-center justify-center p-4">
        <div class="relative max-w-4xl max-h-full">
            <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg">
            <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors">
                <i class="bi bi-x-lg text-2xl"></i>
            </button>
            @if($infrastructure->images && count($infrastructure->images) > 1)
            <button id="prevBtn" onclick="navigateImage(-1)" class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 transition-colors">
                <i class="bi bi-chevron-left text-2xl"></i>
            </button>
            <button id="nextBtn" onclick="navigateImage(1)" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 transition-colors">
                <i class="bi bi-chevron-right text-2xl"></i>
            </button>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
let currentImageIndex = 0;
const images = @json($infrastructure->images ?? []);
const imageUrls = @json($infrastructure->image_urls ?? []);

function openImageModal(imageUrl, index) {
    currentImageIndex = index;
    document.getElementById('modalImage').src = imageUrl;
    document.getElementById('imageModal').classList.remove('hidden');
    document.getElementById('imageModal').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    document.getElementById('imageModal').classList.add('hidden');
    document.getElementById('imageModal').classList.remove('flex');
    document.body.style.overflow = 'auto';
}

function navigateImage(direction) {
    if (imageUrls.length === 0) return;
    
    currentImageIndex += direction;
    
    if (currentImageIndex >= imageUrls.length) {
        currentImageIndex = 0;
    } else if (currentImageIndex < 0) {
        currentImageIndex = imageUrls.length - 1;
    }
    
    document.getElementById('modalImage').src = imageUrls[currentImageIndex];
}

// Gestion du clavier pour la navigation des images
document.addEventListener('keydown', function(e) {
    const modal = document.getElementById('imageModal');
    if (modal && !modal.classList.contains('hidden')) {
        if (e.key === 'ArrowLeft') {
            navigateImage(-1);
        } else if (e.key === 'ArrowRight') {
            navigateImage(1);
        } else if (e.key === 'Escape') {
            closeImageModal();
        }
    }
});

// Fermer le modal en cliquant à l'extérieur
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('imageModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });
    }
});
</script>
@endpush

@endsection