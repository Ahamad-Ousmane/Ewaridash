@extends('layouts.app') 

@section('title', $infrastructure->nom . ' - EWARI')
@section('page-title', $infrastructure->nom)

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
<div class="p-6 space-y-6">
    <!-- Breadcrumb et actions -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('acteur.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-9 9a1 1 0 001.414 1.414L2 12.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-4.586l.293.293a1 1 0 001.414-1.414l-9-9z"></path>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('acteur.infrastructures.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Infrastructures</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $infrastructure->nom }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="mt-4 lg:mt-0 flex space-x-3">
            <a href="{{ route('acteur.infrastructures.edit', $infrastructure) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white font-medium rounded-xl hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Modifier
            </a>
            <a href="{{ route('acteur.infrastructures.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
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
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button @click="currentImage = currentImage < images.length - 1 ? currentImage + 1 : 0" 
                                class="p-2 rounded-full bg-black bg-opacity-50 text-white hover:bg-opacity-75 transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
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
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
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
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                @break
                            @case('restaurant')
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                                </svg>
                                @break
                            @case('plage')
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                @break
                            @case('transport')
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                </svg>
                                @break
                            @default
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
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
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
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
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Caractéristiques</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @if(isset($infrastructure->caracteristiques['prix']))
                    <div class="flex items-center p-4 bg-green-50 rounded-xl border border-green-100">
                        <div class="w-10 h-10 rounded-lg bg-green-500 flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
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
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
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
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
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
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
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
                            <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
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
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
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
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('acteur.infrastructures.edit', $infrastructure) }}" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Modifier l'infrastructure
                    </a>

                    <form action="{{ route('acteur.infrastructures.destroy', $infrastructure) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette infrastructure ? Cette action est irréversible.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 border border-red-300 text-sm font-medium rounded-xl text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>

            <!-- Statistiques -->
            {{-- <div class="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-2xl p-6 border border-blue-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistiques</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Vues</span>
                        <span class="text-sm font-semibold text-gray-900">{{ rand(50, 500) }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Visiteurs</span>
                        <span class="text-sm font-semibold text-gray-900">{{ rand(20, 150) }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Note moyenne</span>
                        <div class="flex items-center">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= 4 ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endfor
                            <span class="ml-1 text-sm text-gray-600">(4.2)</span>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    <!-- Modal d'image -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden items-center justify-center p-4">
        <div class="relative max-w-4xl max-h-full">
            <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg">
            <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            @if($infrastructure->images && count($infrastructure->images) > 1)
            <button id="prevBtn" onclick="navigateImage(-1)" class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button id="nextBtn" onclick="navigateImage(1)" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
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