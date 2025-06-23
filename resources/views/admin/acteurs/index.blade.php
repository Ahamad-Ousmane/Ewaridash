@extends('layouts.app')

@section('title', 'Gestion des Acteurs Touristiques - TourismoRA')
@section('page-title', 'Gestion des Acteurs Touristiques')

@section('sidebar')
<!-- Admin Navigation -->
<a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4M8 7h8"></path>
    </svg>
    Dashboard
</a>

<a href="{{ route('admin.acteurs.index') }}" class="nav-link-active flex items-center px-4 py-3 text-sm font-medium rounded-xl text-white">
    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
    </svg>
    Acteurs Touristiques
</a>

<a href="{{ route('admin.infrastructures.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
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
    <!-- Header avec statistiques -->
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Gestion des Acteurs Touristiques</h1>
                <p class="text-gray-600 mt-1">Superviser tous les comptes d'acteurs de la plateforme</p>
            </div>
            <div class="mt-4 lg:mt-0 flex items-center space-x-4">
                <!-- Statistiques rapides -->
                <div class="flex items-center space-x-6">
                    <div class="text-center">
                        <p class="text-2xl font-bold text-indigo-600">{{ isset($acteurs) ? $acteurs->total() : 0 }}</p>
                        <p class="text-xs text-gray-500">Total</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-green-600">{{ isset($acteurs) ? $acteurs->where('utilisateur.is_active', true)->count() : 0 }}</p>
                        <p class="text-xs text-gray-500">Actifs</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-red-600">{{ isset($acteurs) ? $acteurs->where('utilisateur.is_active', false)->count() : 0 }}</p>
                        <p class="text-xs text-gray-500">Inactifs</p>
                    </div>
                </div>
                
                <!-- Bouton ajouter -->
                {{-- <a href="{{ route('admin.acteurs.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white font-medium rounded-xl hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Ajouter un acteur
                </a> --}}
            </div>
        </div>
    </div>

    <!-- Filtres et recherche -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <div class="p-6">
            <form method="GET" action="{{ route('admin.acteurs.index') }}" class="flex flex-col lg:flex-row lg:items-center lg:space-x-4 space-y-4 lg:space-y-0">
                <!-- Recherche -->
                <div class="flex-1">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Rechercher un acteur, entreprise, email..." 
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>

                <!-- Filtre par statut -->
                <div class="w-full lg:w-48">
                    <select name="status" class="block w-full px-3 py-3 border border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Tous les statuts</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Actifs</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactifs</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>En attente</option>
                    </select>
                </div>

                <!-- Filtre par type -->
                <div class="w-full lg:w-48">
                    <select name="type" class="block w-full px-3 py-3 border border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Tous les types</option>
                        <option value="hotel" {{ request('type') === 'hotel' ? 'selected' : '' }}>Hôteliers</option>
                        <option value="restaurant" {{ request('type') === 'restaurant' ? 'selected' : '' }}>Restaurateurs</option>
                        <option value="transport" {{ request('type') === 'transport' ? 'selected' : '' }}>Transport</option>
                        <option value="activite" {{ request('type') === 'activite' ? 'selected' : '' }}>Activités</option>
                        <option value="autre" {{ request('type') === 'autre' ? 'selected' : '' }}>Autres</option>
                    </select>
                </div>

                <!-- Tri -->
                <div class="w-full lg:w-48">
                    <select name="sort" class="block w-full px-3 py-3 border border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Plus récents</option>
                        <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Plus anciens</option>
                        <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }}>Nom A-Z</option>
                        <option value="name_desc" {{ request('sort') === 'name_desc' ? 'selected' : '' }}>Nom Z-A</option>
                        <option value="most_infrastructures" {{ request('sort') === 'most_infrastructures' ? 'selected' : '' }}>Plus d'infrastructures</option>
                    </select>
                </div>

                <!-- Boutons -->
                <div class="flex space-x-2">
                    <button type="submit" class="inline-flex items-center px-4 py-3 bg-indigo-600 text-white font-medium rounded-xl hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        Filtrer
                    </button>
                    @if(request()->anyFilled(['search', 'status', 'type', 'sort']))
                    <a href="{{ route('admin.acteurs.index') }}" class="inline-flex items-center px-4 py-3 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Réinitialiser
                    </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Liste des acteurs -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @if(isset($acteurs) && $acteurs->count() > 0)
        <!-- Header du tableau -->
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-semibold text-gray-900">
                    {{ isset($acteurs) ? $acteurs->total() : 0 }} acteur(s) trouvé(s)
                </h3>
                <div class="flex items-center space-x-2">
                    <!-- Actions en lot -->
                    <button id="bulk-activate" class="hidden inline-flex items-center px-3 py-2 bg-green-100 text-green-700 text-sm font-medium rounded-lg hover:bg-green-200 transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Activer
                    </button>
                    <button id="bulk-deactivate" class="hidden inline-flex items-center px-3 py-2 bg-red-100 text-red-700 text-sm font-medium rounded-lg hover:bg-red-200 transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Désactiver
                    </button>
                    <button class="inline-flex items-center px-3 py-2 bg-blue-100 text-blue-700 text-sm font-medium rounded-lg hover:bg-blue-200 transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Exporter
                    </button>
                </div>
            </div>
        </div>

        <!-- Vue grille/carte -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @if(isset($acteurs) && $acteurs->count() > 0)
                @foreach($acteurs as $acteur)
                <div class="bg-white border border-gray-200 rounded-2xl p-6 hover:shadow-lg transition-all duration-200 card-hover" data-acteur-id="{{ $acteur->id }}">
                    <!-- Header carte -->
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center">
                            <input type="checkbox" name="selected_acteurs[]" value="{{ $acteur->id }}" 
                                   class="acteur-checkbox focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-indigo-400 to-purple-500 rounded-xl flex items-center justify-center">
                                <span class="text-white font-semibold text-lg">{{ substr($acteur->nom_entreprise, 0, 2) }}</span>
                            </div>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $acteur->utilisateur->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            <span class="w-1.5 h-1.5 mr-1.5 rounded-full {{ $acteur->utilisateur->is_active ? 'bg-green-400' : 'bg-red-400' }}"></span>
                            {{ $acteur->utilisateur->is_active ? 'Actif' : 'Inactif' }}
                        </span>
                    </div>

                    <!-- Informations principales -->
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-1 truncate">{{ $acteur->nom_entreprise }}</h3>
                        <p class="text-sm text-gray-600 mb-2">{{ $acteur->utilisateur->nom }} {{ $acteur->utilisateur->prenom }}</p>
                        <p class="text-sm text-gray-500 truncate">{{ $acteur->utilisateur->email }}</p>
                    </div>

                    <!-- Informations détaillées -->
                    <div class="space-y-2 mb-4">
                        @if($acteur->telephone)
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            {{ $acteur->telephone }}
                        </div>
                        @endif

                        @if($acteur->adresse)
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="truncate">{{ $acteur->adresse }}</span>
                        </div>
                        @endif

                        <!-- Nombre d'infrastructures -->
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            {{ $acteur->infrastructures_count ?? 0 }} infrastructure(s)
                        </div>

                        <!-- Date d'inscription -->
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4h6m-6 4h6m-7-7h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2v-8a2 2 0 012-2z"></path>
                            </svg>
                            Inscrit {{ $acteur->created_at->diffForHumans() }}
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <div class="flex space-x-2">
                            <!-- Voir -->
                            {{-- <a href="{{ route('admin.acteurs.show', $acteur) }}" 
                               class="inline-flex items-center p-2 text-indigo-600 hover:text-indigo-800 hover:bg-indigo-50 rounded-lg transition-colors" 
                               title="Voir le profil">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a> --}}

                            <!-- Éditer -->
                            {{-- <a href="{{ route('admin.acteurs.edit', $acteur) }}" 
                               class="inline-flex items-center p-2 text-gray-600 hover:text-gray-800 hover:bg-gray-50 rounded-lg transition-colors" 
                               title="Modifier">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a> --}}

                            <!-- Toggle statut -->
                            <form action="{{ route('admin.acteurs.toggle-status', $acteur) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="inline-flex items-center p-2 {{ $acteur->utilisateur->is_active ? 'text-red-600 hover:text-red-800 hover:bg-red-50' : 'text-green-600 hover:text-green-800 hover:bg-green-50' }} rounded-lg transition-colors" 
                                        title="{{ $acteur->utilisateur->is_active ? 'Désactiver' : 'Activer' }}"
                                        onclick="return confirm('Êtes-vous sûr de vouloir {{ $acteur->utilisateur->is_active ? 'désactiver' : 'activer' }} cet acteur ?')">
                                    @if($acteur->utilisateur->is_active)
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @endif
                                </button>
                            </form>
                        </div>

                        <!-- Dropdown menu actions -->
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" 
                                    class="inline-flex items-center p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-50 rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                </svg>
                            </button>

                            <div x-show="open" @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-10">
                                <div class="py-1">
                                    <a href="mailto:{{ $acteur->utilisateur->email }}" 
                                       class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        Envoyer un email
                                    </a>
                                    
                                    
                                    <div class="border-t border-gray-100"></div>
                                    <form action="{{ route('admin.acteurs.destroy', $acteur) }}" method="POST" class="inline w-full">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="flex items-center w-full px-4 py-2 text-sm text-red-700 hover:bg-red-50"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet acteur ? Cette action supprimera aussi toutes ses infrastructures.')">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>

        <!-- Pagination -->
        @if(isset($acteurs) && $acteurs->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            {{ $acteurs->links() }}
        </div>
        @endif

        @else
        <!-- État vide -->
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun acteur trouvé</h3>
            <p class="mt-1 text-sm text-gray-500">
                @if(request()->anyFilled(['search', 'status', 'type', 'sort']))
                    Essayez de modifier vos critères de recherche.
                @else
                    Commencez par ajouter votre premier acteur touristique.
                @endif
            </p>
            <div class="mt-6">
                @if(request()->anyFilled(['search', 'status', 'type', 'sort']))
                <a href="{{ route('admin.acteurs.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Réinitialiser les filtres
                </a>
                @else
                <a href="{{ route('admin.acteurs.create') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Ajouter un acteur
                </a>
                @endif
            </div>
        </div>
        @endif
    </div>

    <!-- Actions en lot -->
    @if(isset($acteurs) && $acteurs->count() > 0)
    <div id="bulk-actions-panel" class="hidden fixed bottom-4 left-1/2 transform -translate-x-1/2 bg-white rounded-lg shadow-lg border border-gray-200 p-4">
        <div class="flex items-center space-x-4">
            <span id="selected-count" class="text-sm font-medium text-gray-700">0 acteur(s) sélectionné(s)</span>
            <div class="flex space-x-2">
                <button id="bulk-activate-btn" 
                        class="inline-flex items-center px-3 py-2 bg-green-100 text-green-700 text-sm font-medium rounded-lg hover:bg-green-200 transition-colors">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Activer
                </button>
                <button id="bulk-deactivate-btn" 
                        class="inline-flex items-center px-3 py-2 bg-red-100 text-red-700 text-sm font-medium rounded-lg hover:bg-red-200 transition-colors">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Désactiver
                </button>
                {{-- <button id="bulk-email-btn" 
                        class="inline-flex items-center px-3 py-2 bg-blue-100 text-blue-700 text-sm font-medium rounded-lg hover:bg-blue-200 transition-colors">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Envoyer email
                </button> --}}
                <button id="bulk-delete-btn" 
                        class="inline-flex items-center px-3 py-2 bg-red-100 text-red-700 text-sm font-medium rounded-lg hover:bg-red-200 transition-colors">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Supprimer
                </button>
            </div>
            <button id="cancel-selection" 
                    class="inline-flex items-center px-3 py-2 text-gray-500 text-sm font-medium rounded-lg hover:bg-gray-100 transition-colors">
                Annuler
            </button>
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const acteurCheckboxes = document.querySelectorAll('.acteur-checkbox');
    const bulkActionsPanel = document.getElementById('bulk-actions-panel');
    const selectedCountSpan = document.getElementById('selected-count');
    const bulkActivateBtn = document.getElementById('bulk-activate-btn');
    const bulkDeactivateBtn = document.getElementById('bulk-deactivate-btn');
    const bulkEmailBtn = document.getElementById('bulk-email-btn');
    const bulkDeleteBtn = document.getElementById('bulk-delete-btn');
    const cancelSelectionBtn = document.getElementById('cancel-selection');

    // Fonction pour mettre à jour l'affichage des actions en lot
    function updateBulkActions() {
        const selectedCheckboxes = document.querySelectorAll('.acteur-checkbox:checked');
        const selectedCount = selectedCheckboxes.length;

        if (selectedCount > 0) {
            bulkActionsPanel.classList.remove('hidden');
            selectedCountSpan.textContent = `${selectedCount} acteur(s) sélectionné(s)`;
        } else {
            bulkActionsPanel.classList.add('hidden');
        }
    }

    // Événements pour les checkboxes individuels
    acteurCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkActions);
    });

    // Fonction pour obtenir les IDs sélectionnés
    function getSelectedIds() {
        return Array.from(document.querySelectorAll('.acteur-checkbox:checked'))
                   .map(checkbox => checkbox.value);
    }

    // Fonction pour effectuer une action en lot
    function performBulkAction(action, message) {
        const selectedIds = getSelectedIds();
        
        if (selectedIds.length === 0) {
            alert('Veuillez sélectionner au moins un acteur.');
            return;
        }

        if (confirm(message)) {
            // Créer un formulaire temporaire pour envoyer la requête
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("admin.acteurs.bulk-action") }}';
            form.style.display = 'none';

            // Ajouter le token CSRF
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            // Ajouter l'action
            const actionInput = document.createElement('input');
            actionInput.type = 'hidden';
            actionInput.name = 'action';
            actionInput.value = action;
            form.appendChild(actionInput);

            // Ajouter les IDs sélectionnés
            selectedIds.forEach(id => {
                const idInput = document.createElement('input');
                idInput.type = 'hidden';
                idInput.name = 'acteur_ids[]';
                idInput.value = id;
                form.appendChild(idInput);
            });

            document.body.appendChild(form);
            form.submit();
        }
    }

    // Fonction spéciale pour l'envoi d'email en lot
    function performBulkEmail() {
        const selectedIds = getSelectedIds();
        
        if (selectedIds.length === 0) {
            alert('Veuillez sélectionner au moins un acteur.');
            return;
        }

        // Récupérer les emails des acteurs sélectionnés
        const emails = [];
        selectedIds.forEach(id => {
            const card = document.querySelector(`[data-acteur-id="${id}"]`);
            const emailElement = card.querySelector('p:nth-of-type(3)'); // L'email est dans le 3ème <p>
            if (emailElement) {
                emails.push(emailElement.textContent.trim());
            }
        });

        if (emails.length > 0) {
            const subject = encodeURIComponent('Message depuis TourismoRA Admin');
            const body = encodeURIComponent('Bonjour,\n\n\n\nCordialement,\nL\'équipe TourismoRA');
            window.open(`mailto:${emails.join(',')}?subject=${subject}&body=${body}`);
        }
    }

    // Événements pour les boutons d'actions en lot
    if (bulkActivateBtn) {
        bulkActivateBtn.addEventListener('click', function() {
            performBulkAction('activate', 'Êtes-vous sûr de vouloir activer les acteurs sélectionnés ?');
        });
    }

    if (bulkDeactivateBtn) {
        bulkDeactivateBtn.addEventListener('click', function() {
            performBulkAction('deactivate', 'Êtes-vous sûr de vouloir désactiver les acteurs sélectionnés ?');
        });
    }

    if (bulkEmailBtn) {
        bulkEmailBtn.addEventListener('click', performBulkEmail);
    }

    if (bulkDeleteBtn) {
        bulkDeleteBtn.addEventListener('click', function() {
            performBulkAction('delete', 'Êtes-vous sûr de vouloir supprimer les acteurs sélectionnés ? Cette action supprimera aussi toutes leurs infrastructures.');
        });
    }

    if (cancelSelectionBtn) {
        cancelSelectionBtn.addEventListener('click', function() {
            acteurCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            updateBulkActions();
        });
    }

    // Animation d'entrée pour les cartes
    function animateCards() {
        const cards = document.querySelectorAll('.card-hover');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 50);
        });
    }

    // Lancer l'animation au chargement de la page
    if (document.querySelector('.card-hover')) {
        animateCards();
    }

    // Raccourcis clavier
    document.addEventListener('keydown', function(e) {
        // Ctrl+A pour sélectionner tout
        if (e.ctrlKey && e.key === 'a' && !e.target.matches('input[type="text"], textarea')) {
            e.preventDefault();
            acteurCheckboxes.forEach(checkbox => {
                checkbox.checked = true;
            });
            updateBulkActions();
        }
        
        // Échap pour annuler la sélection
        if (e.key === 'Escape') {
            cancelSelectionBtn.click();
        }
    });
});

// Confirmation pour les suppressions individuelles
document.querySelectorAll('form[action*="destroy"]').forEach(form => {
    form.addEventListener('submit', function(e) {
        if (!confirm('Êtes-vous sûr de vouloir supprimer cet acteur ? Cette action supprimera aussi toutes ses infrastructures.')) {
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
</script>
@endpush

@endsection