@extends('layouts.app')

@section('title', $infrastructure->nom . ' - TourismoRA Admin')
@section('page-title', 'Détails Infrastructure')

@section('sidebar')
<!-- Admin Navigation -->
<a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4M8 7h8"></path>
    </svg>
    Dashboard
</a>

<a href="{{ route('admin.acteurs.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
    </svg>
    Acteurs Touristiques
</a>

<a href="{{ route('admin.infrastructures.index') }}" class="nav-link-active flex items-center px-4 py-3 text-sm font-medium rounded-xl text-white">
    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
    </svg>
    Infrastructures
</a>

<div class="pt-6 mt-6 border-t border-gray-700">
    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Rapports</p>
    <div class="mt-3 space-y-1">
        <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
            <svg class="mr-3 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            Statistiques
        </a>
        <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
            <svg class="mr-3 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Exports
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="p-6 space-y-6">
    <!-- Header avec actions -->
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
        <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between">
            <div class="flex items-start space-x-4">
                <!-- Retour -->
                <a href="{{ route('admin.infrastructures.index') }}" 
                   class="inline-flex items-center p-2 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
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
                <form action="{{ route('admin.infrastructures.toggle-status', $infrastructure) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 {{ $infrastructure->is_active ? 'bg-red-100 text-red-700 hover:bg-red-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }} font-medium rounded-xl transition-colors"
                            onclick="return confirm('Êtes-vous sûr de vouloir {{ $infrastructure->is_active ? 'désactiver' : 'activer' }} cette infrastructure ?')">
                        @if($infrastructure->is_active)
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Désactiver
                        @else
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Activer
                        @endif
                    </button>
                </form>

                <!-- Supprimer -->
                <form action="{{ route('admin.infrastructures.destroy', $infrastructure) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-red-100 text-red-700 font-medium rounded-xl hover:bg-red-200 transition-colors"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette infrastructure ? Cette action est irréversible.')">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Contenu principal -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Images -->
            @if($infrastructure->images && count($infrastructure->images) > 0)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
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
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <button @click="currentImage = currentImage < images.length - 1 ? currentImage + 1 : 0"
                                    class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-75 transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
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
            </div>

            <!-- Description -->
            @if($infrastructure->description)
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Description</h2>
                <div class="prose prose-gray max-w-none">
                    <p class="text-gray-700 leading-relaxed">{{ $infrastructure->description }}</p>
                </div>
            </div>
            @endif

            <!-- Horaires -->
            @if($infrastructure->horaires)
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
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
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Informations générales</h2>
                
                <div class="space-y-4">
                    <!-- Type -->
                    <div>
                        <label class="text-sm font-medium text-gray-500">Type</label>
                        <div class="flex items-center mt-1">
                            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center mr-3">
                                @switch($infrastructure->type)
                                    @case('hotel')
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                        @break
                                    @case('restaurant')
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                                        </svg>
                                        @break
                                    @case('plage')
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        @break
                                    @case('transport')
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                        </svg>
                                        @break
                                    @default
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                @endswitch
                            </div>
                            <span class="text-sm font-medium text-gray-900">{{ ucfirst($infrastructure->type) }}</span>
                        </div>
                    </div>

                    <!-- Localisation -->
                    <div>
                        <label class="text-sm font-medium text-gray-500">Localisation</label>
                        <div class="flex items-center mt-1">
                            <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
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
                            <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span class="text-sm text-gray-900">{{ $infrastructure->capacite }} personnes</span>
                        </div>
                    </div>
                    @endif

                    <!-- Tarif -->
                    @if($infrastructure->tarif)
                    <div>
                        <label class="text-sm font-medium text-gray-500">Tarif</label>
                        <div class="flex items-center mt-1">
                            <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
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
                                <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span class="text-sm text-gray-900">{{ $infrastructure->telephone }}</span>
                            </div>
                            @endif
                            @if($infrastructure->email)
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
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
                            <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
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
                            <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4h6m-6 4h6m-7-7h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2v-8a2 2 0 012-2z"></path>
                            </svg>
                            <span class="text-sm text-gray-900">{{ $infrastructure->created_at->format('d/m/Y à H:i') }}</span>
                        </div>
                    </div>

                    <!-- Dernière modification -->
                    <div>
                        <label class="text-sm font-medium text-gray-500">Dernière modification</label>
                        <div class="flex items-center mt-1">
                            <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            <span class="text-sm text-gray-900">{{ $infrastructure->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informations propriétaire -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
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
                            <svg class="w-4 h-4 text-gray-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span class="text-xs text-gray-500">{{ $infrastructure->acteurTouristique->telephone }}</span>
                        </div>
                        @endif

                        {{-- <div class="mt-3">
                            <a href="{{ route('admin.acteurs.show', $infrastructure->acteurTouristique) }}" 
                               class="inline-flex items-center px-3 py-1.5 bg-indigo-100 text-indigo-700 text-xs font-medium rounded-lg hover:bg-indigo-200 transition-colors">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Voir le profil
                            </a>
                        </div> --}}
                    </div>
                </div>
            </div>

            <!-- Statistiques rapides -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Statistiques</h2>
                
                <div class="space-y-4">
                    <!-- Nombre d'images -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-sm text-gray-600">Images</span>
                        </div>
                        <span class="text-sm font-semibold text-gray-900">{{ $infrastructure->images ? count($infrastructure->images) : 0 }}</span>
                    </div>

                    <!-- Âge de l'infrastructure -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm text-gray-600">Ancienneté</span>
                        </div>
                        <span class="text-sm font-semibold text-gray-900">{{ $infrastructure->created_at->diffForHumans() }}</span>
                    </div>

                    <!-- Statut actuel -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm text-gray-600">Statut</span>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $infrastructure->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $infrastructure->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Actions supplémentaires -->
            {{-- <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Actions</h2>
                
                <div class="space-y-3">
                    <!-- Voir sur le site public -->
                    <a href="#" class="w-full inline-flex items-center justify-center px-4 py-2 bg-indigo-100 text-indigo-700 font-medium rounded-xl hover:bg-indigo-200 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        Voir sur le site
                    </a>

                    <!-- Historique -->
                    <button class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Voir l'historique
                    </button>

                    <!-- Générer rapport -->
                    <button class="w-full inline-flex items-center justify-center px-4 py-2 bg-purple-100 text-purple-700 font-medium rounded-xl hover:bg-purple-200 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Générer un rapport
                    </button>
                </div>
            </div> --}}
        </div>
    </div>
</div>

@push('scripts')
<script>
// Animation d'entrée des cartes
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.bg-white');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});

// Amélioration du carrousel d'images
document.addEventListener('alpine:init', () => {
    Alpine.data('imageCarousel', () => ({
        init() {
            // Gestion des touches du clavier
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') {
                    this.previousImage();
                } else if (e.key === 'ArrowRight') {
                    this.nextImage();
                }
            });
        },
        
        previousImage() {
            this.currentImage = this.currentImage > 0 ? this.currentImage - 1 : this.images.length - 1;
        },
        
        nextImage() {
            this.currentImage = this.currentImage < this.images.length - 1 ? this.currentImage + 1 : 0;
        }
    }));
});

// Confirmation pour les actions destructives
document.querySelectorAll('form[action*="destroy"]').forEach(form => {
    form.addEventListener('submit', function(e) {
        if (!confirm('Êtes-vous sûr de vouloir supprimer cette infrastructure ? Cette action est irréversible.')) {
            e.preventDefault();
        }
    });
});

// Affichage des notifications toast
@if(session('success'))
    // Créer une notification toast
    const toast = document.createElement('div');
    toast.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300';
    toast.innerHTML = `
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            {{ session('success') }}
        </div>
    `;
    
    document.body.appendChild(toast);
    
    // Animer l'entrée
    setTimeout(() => {
        toast.classList.remove('translate-x-full');
    }, 100);
    
    // Supprimer après 4 secondes
    setTimeout(() => {
        toast.classList.add('translate-x-full');
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 300);
    }, 4000);
@endif

// Lazy loading pour les images
if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });

    document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
    });
}
</script>
@endpush

@endsection