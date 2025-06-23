@extends('layouts.app')

@section('title', 'Dashboard Admin - TourismoRA')
@section('page-title', 'Dashboard Admin')

@section('sidebar')
<!-- Admin Navigation -->
<a href="{{ route('admin.dashboard') }}" class="nav-link-active flex items-center px-4 py-3 text-sm font-medium rounded-xl text-white">
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
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Acteurs -->
        <div class="bg-white rounded-2xl shadow-sm p-6 card-hover border border-gray-100">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Acteurs</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_acteurs'] }}</p>
                    <div class="flex items-center mt-1">
                        <span class="text-xs text-green-600 font-medium">{{ $stats['active_users'] }} actifs</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Infrastructures -->
        <div class="bg-white rounded-2xl shadow-sm p-6 card-hover border border-gray-100">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-gradient-to-br from-green-500 to-green-600">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Infrastructures</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_infrastructures'] }}</p>
                    <div class="flex items-center mt-1">
                        <span class="text-xs text-green-600 font-medium">{{ $stats['active_infrastructures'] }} actives</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Taux d'activité -->
        <div class="bg-white rounded-2xl shadow-sm p-6 card-hover border border-gray-100">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-gradient-to-br from-purple-500 to-purple-600">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Taux d'Activité</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ $stats['total_acteurs'] > 0 ? round(($stats['active_acteurs'] / $stats['total_acteurs']) * 100) : 0 }}%
                    </p>
                    <div class="flex items-center mt-1">
                        <div class="w-12 bg-gray-200 rounded-full h-1">
                            <div class="bg-purple-600 h-1 rounded-full" style="width: {{ $stats['total_acteurs'] > 0 ? round(($stats['active_acteurs'] / $stats['total_acteurs']) * 100) : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Croissance -->
        <div class="bg-white rounded-2xl shadow-sm p-6 card-hover border border-gray-100">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-gradient-to-br from-orange-500 to-orange-600">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Croissance</p>
                    <p class="text-2xl font-bold text-gray-900">+12%</p>
                    <div class="flex items-center mt-1">
                        <svg class="w-3 h-3 text-green-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-xs text-green-600 font-medium">Ce mois</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Activity Chart -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Activité de la Plateforme</h3>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 text-xs font-medium bg-indigo-100 text-indigo-700 rounded-full">7j</button>
                    <button class="px-3 py-1 text-xs font-medium text-gray-500 hover:bg-gray-100 rounded-full">30j</button>
                    <button class="px-3 py-1 text-xs font-medium text-gray-500 hover:bg-gray-100 rounded-full">90j</button>
                </div>
            </div>
            <div class="h-64">
                <canvas id="activityChart"></canvas>
            </div>
        </div>

        <!-- Infrastructure Types Chart -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Types d'Infrastructures</h3>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                    <span class="text-xs text-gray-600">Répartition</span>
                </div>
            </div>
            <div class="h-64">
                <canvas id="infrastructureChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Acteurs -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Nouveaux Acteurs</h3>
                    <a href="{{ route('admin.acteurs.index') }}" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                        Voir tout →
                    </a>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @forelse($recentActeurs as $acteur)
                    <div class="flex items-center space-x-4 p-3 hover:bg-gray-50 rounded-xl transition-colors">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center">
                            <span class="text-white font-semibold text-sm">{{ substr($acteur->nom_entreprise, 0, 2) }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">{{ $acteur->nom_entreprise }}</p>
                            <p class="text-xs text-gray-500">{{ $acteur->utilisateur->email }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500">{{ $acteur->created_at->diffForHumans() }}</p>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                {{ $acteur->utilisateur->is_active ? 'Actif' : 'Inactif' }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <p class="mt-2 text-sm text-gray-500">Aucun acteur récent</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Infrastructures -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Nouvelles Infrastructures</h3>
                    <a href="{{ route('admin.infrastructures.index') }}" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                        Voir tout →
                    </a>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @forelse($recentInfrastructures as $infrastructure)
                    <div class="flex items-center space-x-4 p-3 hover:bg-gray-50 rounded-xl transition-colors">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center">
                            @switch($infrastructure->type)
                                @case('hotel')
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    @break
                                @case('restaurant')
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                                    </svg>
                                    @break
                                @default
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                            @endswitch
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">{{ $infrastructure->nom }}</p>
                            <p class="text-xs text-gray-500">{{ $infrastructure->type_libelle }} • {{ $infrastructure->acteurTouristique->nom_entreprise }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500">{{ $infrastructure->created_at->diffForHumans() }}</p>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $infrastructure->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $infrastructure->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <p class="mt-2 text-sm text-gray-500">Aucune infrastructure récente</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Actions Rapides</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.acteurs.create') }}" class="group flex items-center justify-center p-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl hover:from-blue-100 hover:to-indigo-100 transition-all duration-200 border border-blue-200">
                <div class="text-center">
                    <div class="w-12 h-12 bg-blue-500 rounded-xl mx-auto mb-3 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-blue-900">Ajouter un Acteur</p>
                    <p class="text-xs text-blue-600 mt-1">Créer un nouveau compte</p>
                </div>
            </a>

            <button class="group flex items-center justify-center p-6 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl hover:from-green-100 hover:to-emerald-100 transition-all duration-200 border border-green-200">
                <div class="text-center">
                    <div class="w-12 h-12 bg-green-500 rounded-xl mx-auto mb-3 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-green-900">Générer Rapport</p>
                    <p class="text-xs text-green-600 mt-1">Exporter les données</p>
                </div>
            </button>

            <button class="group flex items-center justify-center p-6 bg-gradient-to-br from-purple-50 to-violet-50 rounded-xl hover:from-purple-100 hover:to-violet-100 transition-all duration-200 border border-purple-200">
                <div class="text-center">
                    <div class="w-12 h-12 bg-purple-500 rounded-xl mx-auto mb-3 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-purple-900">Paramètres</p>
                    <p class="text-xs text-purple-600 mt-1">Configuration système</p>
                </div>
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Activity Chart
const activityCtx = document.getElementById('activityChart').getContext('2d');
new Chart(activityCtx, {
    type: 'line',
    data: {
        labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
        datasets: [{
            label: 'Nouvelles Inscriptions',
            data: [12, 19, 8, 15, 22, 8, 5],
            borderColor: 'rgb(99, 102, 241)',
            backgroundColor: 'rgba(99, 102, 241, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4
        }, {
            label: 'Infrastructures Ajoutées',
            data: [8, 12, 15, 10, 18, 12, 8],
            borderColor: 'rgb(34, 197, 94)',
            backgroundColor: 'rgba(34, 197, 94, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    usePointStyle: true,
                    padding: 20
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(0, 0, 0, 0.05)'
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        },
        elements: {
            point: {
                radius: 0,
                hoverRadius: 8
            }
        }
    }
});

// Infrastructure Types Chart
const infraCtx = document.getElementById('infrastructureChart').getContext('2d');
new Chart(infraCtx, {
    type: 'doughnut',
    data: {
        labels: ['Hôtels', 'Restaurants', 'Plages', 'Transport'],
        datasets: [{
            data: [35, 28, 22, 15],
            backgroundColor: [
                'rgb(59, 130, 246)',
                'rgb(34, 197, 94)',
                'rgb(251, 191, 36)',
                'rgb(168, 85, 247)'
            ],
            borderWidth: 0,
            cutout: '70%'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    usePointStyle: true,
                    padding: 20
                }
            }
        }
    }
});
</script>
@endpush