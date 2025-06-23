@extends('layouts.app')

@section('title', 'Dashboard Acteur - TourismoRA')
@section('page-title', 'Mon Dashboard')

@section('sidebar')
<!-- Acteur Navigation -->
<a href="{{ route('acteur.dashboard') }}" class="nav-link-active flex items-center px-4 py-3 text-sm font-medium rounded-xl text-white">
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

<a href="{{ route('acteur.infrastructures.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
    </svg>
    Mes Infrastructures
</a>

<div class="pt-6 mt-6 border-t border-gray-700">
    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Gestion</p>
    <div class="mt-3 space-y-1">
        <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
            <svg class="mr-3 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            Statistiques
        </a>
        <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
            <svg class="mr-3 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
            Sécurité
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="p-6 space-y-6">
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-2xl shadow-lg overflow-hidden">
        <div class="px-8 py-6 sm:px-10 sm:py-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-white">
                        Bonjour, {{ $acteur ? $acteur->nom_entreprise : Auth::user()->nom }} ! 👋
                    </h1>
                    <p class="mt-2 text-indigo-100 text-lg">
                        Gérez vos infrastructures touristiques en toute simplicité
                    </p>
                    @if(!$acteur)
                    <div class="mt-4">
                        <a href="{{ route('acteur.profile') }}" class="inline-flex items-center px-4 py-2 bg-white text-indigo-600 rounded-lg hover:bg-indigo-50 transition-colors font-medium">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Compléter mon profil
                        </a>
                    </div>
                    @endif
                </div>
                <div class="hidden sm:block">
                    <div class="relative">
                        <div class="w-32 h-32 bg-white/10 rounded-full animate-pulse"></div>
                        <div class="absolute inset-4 bg-white/20 rounded-full animate-pulse" style="animation-delay: 0.5s;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Infrastructures -->
        <div class="bg-white rounded-2xl shadow-sm p-6 card-hover border border-gray-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-blue-500/10 to-blue-600/10 rounded-full -mr-10 -mt-10"></div>
            <div class="relative">
                <div class="flex items-center justify-between">
                    <div class="p-3 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold text-gray-900">{{ $stats['total_infrastructures'] }}</span>
                </div>
                <div class="mt-4">
                    <p class="text-sm font-medium text-gray-500">Total Infrastructures</p>
                    <div class="flex items-center mt-2">
                        <span class="text-xs text-green-600 font-medium">{{ $stats['infrastructures_actives'] }} actives</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hôtels -->
        <div class="bg-white rounded-2xl shadow-sm p-6 card-hover border border-gray-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-green-500/10 to-green-600/10 rounded-full -mr-10 -mt-10"></div>
            <div class="relative">
                <div class="flex items-center justify-between">
                    <div class="p-3 rounded-xl bg-gradient-to-br from-green-500 to-green-600">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold text-gray-900">{{ $stats['hotels'] }}</span>
                </div>
                <div class="mt-4">
                    <p class="text-sm font-medium text-gray-500">Hôtels</p>
                    <div class="w-full bg-gray-200 rounded-full h-1 mt-2">
                        <div class="bg-green-600 h-1 rounded-full" style="width: {{ $stats['total_infrastructures'] > 0 ? ($stats['hotels'] / $stats['total_infrastructures']) * 100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Restaurants -->
        <div class="bg-white rounded-2xl shadow-sm p-6 card-hover border border-gray-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-orange-500/10 to-orange-600/10 rounded-full -mr-10 -mt-10"></div>
            <div class="relative">
                <div class="flex items-center justify-between">
                    <div class="p-3 rounded-xl bg-gradient-to-br from-orange-500 to-orange-600">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold text-gray-900">{{ $stats['restaurants'] }}</span>
                </div>
                <div class="mt-4">
                    <p class="text-sm font-medium text-gray-500">Restaurants</p>
                    <div class="w-full bg-gray-200 rounded-full h-1 mt-2">
                        <div class="bg-orange-600 h-1 rounded-full" style="width: {{ $stats['total_infrastructures'] > 0 ? ($stats['restaurants'] / $stats['total_infrastructures']) * 100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Autres Services -->
        <div class="bg-white rounded-2xl shadow-sm p-6 card-hover border border-gray-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-purple-500/10 to-purple-600/10 rounded-full -mr-10 -mt-10"></div>
            <div class="relative">
                <div class="flex items-center justify-between">
                    <div class="p-3 rounded-xl bg-gradient-to-br from-purple-500 to-purple-600">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold text-gray-900">{{ $stats['plages'] + $stats['transports'] }}</span>
                </div>
                <div class="mt-4">
                    <p class="text-sm font-medium text-gray-500">Autres Services</p>
                    <div class="flex items-center mt-2 text-xs text-gray-500">
                        <span>{{ $stats['plages'] }} plages • {{ $stats['transports'] }} transport</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Infrastructures -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Mes Infrastructures Récentes</h3>
                    <a href="{{ route('acteur.infrastructures.index') }}" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium flex items-center">
                        Voir tout
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="p-6">
                @if($recentInfrastructures->count() > 0)
                <div class="space-y-4">
                    @foreach($recentInfrastructures as $infrastructure)
                    <div class="flex items-center space-x-4 p-4 hover:bg-gray-50 rounded-xl transition-colors border border-gray-100">
                        @if($infrastructure->main_image)
                        <img src="{{ Storage::url($infrastructure->main_image) }}" alt="{{ $infrastructure->nom }}" class="w-12 h-12 rounded-lg object-cover">
                        @else
                        <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-gray-400 to-gray-500 flex items-center justify-center">
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
                                @default
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                            @endswitch
                        </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <h4 class="text-sm font-medium text-gray-900 truncate">{{ $infrastructure->nom }}</h4>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $infrastructure->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $infrastructure->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">{{ $infrastructure->type_libelle }} • {{ $infrastructure->localisation }}</p>
                            <div class="flex items-center justify-between mt-2">
                                <span class="text-xs text-gray-400">{{ $infrastructure->created_at->diffForHumans() }}</span>
                                <div class="flex space-x-2">
                                    <a href="{{ route('acteur.infrastructures.show', $infrastructure->id) }}" class="text-indigo-600 hover:text-indigo-800 text-xs font-medium">
                                        Voir
                                    </a>
                                    <a href="{{ route('acteur.infrastructures.edit', $infrastructure->id) }}" class="text-gray-600 hover:text-gray-800 text-xs font-medium">
                                        Modifier
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Aucune infrastructure</h3>
                    <p class="mt-2 text-sm text-gray-500">Commencez par ajouter votre première infrastructure touristique.</p>
                    <div class="mt-6">
                        <a href="{{ route('acteur.infrastructures.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Ajouter une infrastructure
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Quick Actions & Profile -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions Rapides</h3>
                <div class="space-y-3">
                    <a href="{{ route('acteur.infrastructures.create') }}" class="flex items-center p-3 bg-gradient-to-r from-indigo-50 to-blue-50 rounded-xl hover:from-indigo-100 hover:to-blue-100 transition-all duration-200 group">
                        <div class="w-10 h-10 bg-indigo-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Nouvelle Infrastructure</p>
                            <p class="text-xs text-gray-500">Ajouter hôtel, restaurant...</p>
                        </div>
                    </a>

                    <a href="{{ route('acteur.profile') }}" class="flex items-center p-3 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl hover:from-green-100 hover:to-emerald-100 transition-all duration-200 group">
                        <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Mon Profil</p>
                            <p class="text-xs text-gray-500">Gérer mes informations</p>
                        </div>
                    </a>

                    <button class="flex items-center p-3 bg-gradient-to-r from-purple-50 to-violet-50 rounded-xl hover:from-purple-100 hover:to-violet-100 transition-all duration-200 group w-full">
                        <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div class="ml-3 text-left">
                            <p class="text-sm font-medium text-gray-900">Statistiques</p>
                            <p class="text-xs text-gray-500">Voir mes performances</p>
                        </div>
                    </button>
                </div>
            </div>

            <!-- Profile Summary -->
            @if($acteur)
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Mon Entreprise</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ $acteur->nom_entreprise }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $acteur->description ?: 'Aucune description' }}</p>
                    </div>
                    
                    @if($acteur->adresse)
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        {{ $acteur->adresse }}
                    </div>
                    @endif

                    @if($acteur->site_web)
                    <div class="flex items-center text-sm text-indigo-600">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                        </svg>
                        <a href="{{ $acteur->site_web }}" target="_blank" class="hover:underline">{{ $acteur->site_web }}</a>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Tips -->
            <div class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-2xl p-6 border border-yellow-200">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-yellow-800">Conseil du jour</h3>
                        <p class="text-sm text-yellow-700 mt-1">
                            Ajoutez des images de qualité à vos infrastructures pour attirer plus de visiteurs !
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Performance Chart -->
    @if($stats['total_infrastructures'] > 0)
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-900">Répartition de mes Infrastructures</h3>
            <div class="flex space-x-2">
                <button class="px-3 py-1 text-xs font-medium bg-indigo-100 text-indigo-700 rounded-full">Vue</button>
                <button class="px-3 py-1 text-xs font-medium text-gray-500 hover:bg-gray-100 rounded-full">Type</button>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="h-64">
                <canvas id="infrastructureChart"></canvas>
            </div>
            <div class="flex items-center">
                <div class="space-y-4 w-full">
                    <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                            <span class="text-sm font-medium text-gray-900">Hôtels</span>
                        </div>
                        <span class="text-sm font-bold text-blue-600">{{ $stats['hotels'] }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                            <span class="text-sm font-medium text-gray-900">Restaurants</span>
                        </div>
                        <span class="text-sm font-bold text-green-600">{{ $stats['restaurants'] }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-yellow-500 rounded-full mr-3"></div>
                            <span class="text-sm font-medium text-gray-900">Plages</span>
                        </div>
                        <span class="text-sm font-bold text-yellow-600">{{ $stats['plages'] }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-purple-500 rounded-full mr-3"></div>
                            <span class="text-sm font-medium text-gray-900">Transport</span>
                        </div>
                        <span class="text-sm font-bold text-purple-600">{{ $stats['transports'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
@if($stats['total_infrastructures'] > 0)
<script>
// Infrastructure Types Chart
const ctx = document.getElementById('infrastructureChart').getContext('2d');
new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Hôtels', 'Restaurants', 'Plages', 'Transport'],
        datasets: [{
            data: [{{ $stats['hotels'] }}, {{ $stats['restaurants'] }}, {{ $stats['plages'] }}, {{ $stats['transports'] }}],
            backgroundColor: [
                'rgb(59, 130, 246)',
                'rgb(34, 197, 94)',
                'rgb(251, 191, 36)',
                'rgb(168, 85, 247)'
            ],
            borderWidth: 0,
            cutout: '60%'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        }
    }
});
</script>
@endif
@endpush