@extends('layouts.app')

@section('title', 'Gestion des Infrastructures - EWARI')
@section('page-title', 'Gestion des Infrastructures')

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
@endsection

@section('content')
<div class="p-6 space-y-6">
    <!-- Header avec statistiques -->
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Gestion des Infrastructures</h1>
                <p class="text-gray-600 mt-1">Superviser toutes les infrastructures de la plateforme</p>
            </div>
            <div class="mt-4 lg:mt-0 flex items-center space-x-4">
                <!-- Statistiques rapides -->
                <div class="flex items-center space-x-6">
                    <div class="text-center">
                        <p class="text-2xl font-bold text-indigo-600">{{ $infrastructures->total() }}</p>
                        <p class="text-xs text-gray-500">Total</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-green-600">{{ $infrastructures->where('is_active', true)->count() }}</p>
                        <p class="text-xs text-gray-500">Actives</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-red-600">{{ $infrastructures->where('is_active', false)->count() }}</p>
                        <p class="text-xs text-gray-500">Inactives</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres et recherche -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <div class="p-6">
            <form method="GET" action="{{ route('admin.infrastructures.index') }}" class="flex flex-col lg:flex-row lg:items-center lg:space-x-4 space-y-4 lg:space-y-0">
                <!-- Recherche -->
                <div class="flex-1">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Rechercher une infrastructure..." 
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>

                <!-- Filtre par type -->
                <div class="w-full lg:w-48">
                    <select name="type" class="block w-full px-3 py-3 border border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Tous les types</option>
                        <option value="hotel" {{ request('type') === 'hotel' ? 'selected' : '' }}>Hôtels</option>
                        <option value="restaurant" {{ request('type') === 'restaurant' ? 'selected' : '' }}>Restaurants</option>
                        <option value="plage" {{ request('type') === 'plage' ? 'selected' : '' }}>Plages</option>
                        <option value="transport" {{ request('type') === 'transport' ? 'selected' : '' }}>Transport</option>
                    </select>
                </div>

                <!-- Filtre par statut -->
                <div class="w-full lg:w-48">
                    <select name="status" class="block w-full px-3 py-3 border border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Tous les statuts</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Actives</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactives</option>
                    </select>
                </div>

                <!-- Filtre par acteur -->
                <div class="w-full lg:w-64">
                    <select name="acteur" class="block w-full px-3 py-3 border border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Tous les acteurs</option>
                        @foreach($acteurs as $acteur)
                        <option value="{{ $acteur->id }}" {{ request('acteur') == $acteur->id ? 'selected' : '' }}>
                            {{ $acteur->nom_entreprise }}
                        </option>
                        @endforeach
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
                    @if(request()->anyFilled(['search', 'type', 'status', 'acteur']))
                    <a href="{{ route('admin.infrastructures.index') }}" class="inline-flex items-center px-4 py-3 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
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

    <!-- Liste des infrastructures -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @if($infrastructures->count() > 0)
        <!-- Header du tableau -->
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-semibold text-gray-900">
                    {{ $infrastructures->total() }} infrastructure(s) trouvée(s)
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
                </div>
            </div>
        </div>

        <!-- Tableau -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left">
                            <input type="checkbox" id="select-all" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Infrastructure
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Type
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Acteur
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Localisation
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date création
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($infrastructures as $infrastructure)
                    <tr class="hover:bg-gray-50 transition-colors" data-infrastructure-id="{{ $infrastructure->id }}">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" name="selected_infrastructures[]" value="{{ $infrastructure->id }}" 
                                   class="infrastructure-checkbox focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12">
                                    @if($infrastructure->images && count($infrastructure->images) > 0)
                                        <img class="h-12 w-12 rounded-lg object-cover border border-gray-200" 
                                             src="{{ $infrastructure->getImageUrl($infrastructure->images[0] ?? '') }}"
                                             alt="{{ $infrastructure->nom }}">
                                    @else
                                        <div class="h-12 w-12 rounded-lg bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <a href="{{ route('admin.infrastructures.show', $infrastructure) }}">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $infrastructure->nom }}
                                    </div>
                                    </a>
                                    @if($infrastructure->description)
                                    <div class="text-sm text-gray-500 max-w-xs truncate">
                                        {{ $infrastructure->description }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
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
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 font-medium">{{ $infrastructure->acteurTouristique->nom_entreprise }}</div>
                            <div class="text-sm text-gray-500">{{ $infrastructure->acteurTouristique->utilisateur->email }}</div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $infrastructure->localisation }}
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $infrastructure->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                <span class="w-1.5 h-1.5 mr-1.5 rounded-full {{ $infrastructure->is_active ? 'bg-green-400' : 'bg-red-400' }}"></span>
                                {{ $infrastructure->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div>{{ $infrastructure->created_at->format('d/m/Y') }}</div>
                            <div class="text-xs">{{ $infrastructure->created_at->diffForHumans() }}</div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <!-- Voir -->
                                <a href="{{ route('admin.infrastructures.show', $infrastructure) }}" 
                                   class="text-indigo-600 hover:text-indigo-900 transition-colors" title="Voir">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>

                                <!-- Toggle statut -->
                                <form action="{{ route('admin.infrastructures.toggle-status', $infrastructure) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="{{ $infrastructure->is_active ? 'text-red-600 hover:text-red-900' : 'text-green-600 hover:text-green-900' }} transition-colors" 
                                            title="{{ $infrastructure->is_active ? 'Désactiver' : 'Activer' }}"
                                            onclick="return confirm('Êtes-vous sûr de vouloir {{ $infrastructure->is_active ? 'désactiver' : 'activer' }} cette infrastructure ?')">
                                        @if($infrastructure->is_active)
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        @endif
                                    </button>
                                </form>

                                <!-- Supprimer -->
                                <form action="{{ route('admin.infrastructures.destroy', $infrastructure) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-900 transition-colors" 
                                            title="Supprimer"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette infrastructure ? Cette action est irréversible.')">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            {{ $infrastructures->links() }}
        </div>

        @else
        <!-- État vide -->
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Aucune infrastructure trouvée</h3>
            <p class="mt-1 text-sm text-gray-500">
                @if(request()->anyFilled(['search', 'type', 'status', 'acteur']))
                    Essayez de modifier vos critères de recherche.
                @else
                    Les acteurs n'ont pas encore ajouté d'infrastructures.
                @endif
            </p>
            @if(request()->anyFilled(['search', 'type', 'status', 'acteur']))
            <div class="mt-6">
                <a href="{{ route('admin.infrastructures.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Réinitialiser les filtres
                </a>
            </div>
            @endif
        </div>
        @endif
    </div>

    <!-- Actions en lot -->
    @if($infrastructures->count() > 0)
    <div id="bulk-actions-panel" class="hidden fixed bottom-4 left-1/2 transform -translate-x-1/2 bg-white rounded-lg shadow-lg border border-gray-200 p-4">
        <div class="flex items-center space-x-4">
            <span id="selected-count" class="text-sm font-medium text-gray-700">0 infrastructure(s) sélectionnée(s)</span>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('select-all');
    const infrastructureCheckboxes = document.querySelectorAll('.infrastructure-checkbox');
    const bulkActionsPanel = document.getElementById('bulk-actions-panel');
    const selectedCountSpan = document.getElementById('selected-count');
    const bulkActivateBtn = document.getElementById('bulk-activate-btn');
    const bulkDeactivateBtn = document.getElementById('bulk-deactivate-btn');
    const bulkDeleteBtn = document.getElementById('bulk-delete-btn');
    const cancelSelectionBtn = document.getElementById('cancel-selection');

    // Fonction pour mettre à jour l'affichage des actions en lot
    function updateBulkActions() {
        const selectedCheckboxes = document.querySelectorAll('.infrastructure-checkbox:checked');
        const selectedCount = selectedCheckboxes.length;

        if (selectedCount > 0) {
            bulkActionsPanel.classList.remove('hidden');
            selectedCountSpan.textContent = `${selectedCount} infrastructure(s) sélectionnée(s)`;
        } else {
            bulkActionsPanel.classList.add('hidden');
        }

        // Mettre à jour l'état du checkbox "Sélectionner tout"
        if (selectedCount === 0) {
            selectAllCheckbox.indeterminate = false;
            selectAllCheckbox.checked = false;
        } else if (selectedCount === infrastructureCheckboxes.length) {
            selectAllCheckbox.indeterminate = false;
            selectAllCheckbox.checked = true;
        } else {
            selectAllCheckbox.indeterminate = true;
            selectAllCheckbox.checked = false;
        }
    }

    // Événement pour le checkbox "Sélectionner tout"
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            infrastructureCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateBulkActions();
        });
    }

    // Événements pour les checkboxes individuels
    infrastructureCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkActions);
    });

    // Fonction pour obtenir les IDs sélectionnés
    function getSelectedIds() {
        return Array.from(document.querySelectorAll('.infrastructure-checkbox:checked'))
                   .map(checkbox => checkbox.value);
    }

    // Fonction pour effectuer une action en lot
    function performBulkAction(action, message) {
        const selectedIds = getSelectedIds();
        
        if (selectedIds.length === 0) {
            alert('Veuillez sélectionner au moins une infrastructure.');
            return;
        }

        if (confirm(message)) {
            // Créer un formulaire temporaire pour envoyer la requête
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("admin.infrastructures.bulk-action") }}';
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
                idInput.name = 'infrastructure_ids[]';
                idInput.value = id;
                form.appendChild(idInput);
            });

            document.body.appendChild(form);
            form.submit();
        }
    }

    // Événements pour les boutons d'actions en lot
    if (bulkActivateBtn) {
        bulkActivateBtn.addEventListener('click', function() {
            performBulkAction('activate', 'Êtes-vous sûr de vouloir activer les infrastructures sélectionnées ?');
        });
    }

    if (bulkDeactivateBtn) {
        bulkDeactivateBtn.addEventListener('click', function() {
            performBulkAction('deactivate', 'Êtes-vous sûr de vouloir désactiver les infrastructures sélectionnées ?');
        });
    }

    if (bulkDeleteBtn) {
        bulkDeleteBtn.addEventListener('click', function() {
            performBulkAction('delete', 'Êtes-vous sûr de vouloir supprimer les infrastructures sélectionnées ? Cette action est irréversible.');
        });
    }

    if (cancelSelectionBtn) {
        cancelSelectionBtn.addEventListener('click', function() {
            infrastructureCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            updateBulkActions();
        });
    }

    // Raccourcis clavier
    document.addEventListener('keydown', function(e) {
        // Ctrl+A pour sélectionner tout
        if (e.ctrlKey && e.key === 'a' && !e.target.matches('input[type="text"], textarea')) {
            e.preventDefault();
            selectAllCheckbox.checked = true;
            selectAllCheckbox.dispatchEvent(new Event('change'));
        }
        
        // Échap pour annuler la sélection
        if (e.key === 'Escape') {
            cancelSelectionBtn.click();
        }
    });
});

// Animation d'entrée pour les lignes du tableau
function animateTableRows() {
    const rows = document.querySelectorAll('tbody tr');
    rows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateY(20px)';
        setTimeout(() => {
            row.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            row.style.opacity = '1';
            row.style.transform = 'translateY(0)';
        }, index * 50);
    });
}

// Lancer l'animation au chargement de la page
if (document.querySelector('tbody tr')) {
    animateTableRows();
}
</script>
@endpush

@endsection