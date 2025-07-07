@extends('layouts.app')

@section('title', 'Dashboard Acteur - EWARI')
@section('page-title', 'Mon Dashboard')

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
</style>
@endpush

@section('sidebar')
<!-- Acteur Navigation -->
<a href="{{ route('acteur.dashboard') }}" class="nav-link-active flex items-center px-4 py-3 text-sm font-medium rounded-xl text-white">
    <i class="bi bi-grid mr-3"></i>
    Dashboard
</a>

<a href="{{ route('acteur.profile') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
    <i class="bi bi-person mr-3"></i>
    Mon Profil
</a>

<a href="{{ route('acteur.infrastructures.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
    <i class="bi bi-building mr-3"></i>
    Mes Infrastructures
</a>
@endsection

@section('content')
<div class="p-6 space-y-6">
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-2xl shadow-lg overflow-hidden">
        <div class="px-8 py-6 sm:px-10 sm:py-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-white">
                        Bonjour, {{ $acteur ? $acteur->nom_entreprise : Auth::user()->nom }} ! <i class="bi bi-emoji-smile"></i>
                    </h1>
                    <p class="mt-2 text-indigo-100 text-lg">
                        Gérez vos infrastructures touristiques en toute simplicité
                    </p>
                    @if(!$acteur)
                    <div class="mt-4">
                        <a href="{{ route('acteur.profile') }}" class="inline-flex items-center px-4 py-2 bg-white text-indigo-600 rounded-lg hover:bg-indigo-50 transition-colors font-medium">
                            <i class="bi bi-plus-circle mr-2"></i>
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
                        <i class="bi bi-building text-white"></i>
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
                        <i class="bi bi-building text-white"></i>
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
                        <i class="bi bi-cup-hot text-white"></i>
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
                        <i class="bi bi-geo-alt text-white"></i>
                    </div>
                    <span class="text-2xl font-bold text-gray-900">{{ $stats['attractions'] + $stats['transports'] + $stats['attractions'] }}</span>
                </div>
                <div class="mt-4">
                    <p class="text-sm font-medium text-gray-500">Autres Services</p>
                    <div class="flex items-center mt-2 text-xs text-gray-500">
                        <span>{{ $stats['attractions'] }} attractions • {{ $stats['transports'] }} transport</span>
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
                        <i class="bi bi-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            <div class="p-6">
                @if($recentInfrastructures->count() > 0)
                <div class="space-y-4">
                    @foreach($recentInfrastructures as $infrastructure)
                    <div class="flex items-center space-x-4 p-4 hover:bg-gray-50 rounded-xl transition-colors border border-gray-100">
                        @if($infrastructure->main_image)
                        <img src="{{ $infrastructure->getImageUrl($infrastructure->images[0] ?? '') }}" alt="{{ $infrastructure->nom }}" class="w-12 h-12 rounded-lg object-cover">
                        @else
                        <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-gray-400 to-gray-500 flex items-center justify-center">
                            @switch($infrastructure->type)
                                @case('hotel')
                                    <i class="bi bi-building text-white"></i>
                                    @break
                                @case('restaurant')
                                    <i class="bi bi-cup-hot text-white"></i>
                                    @break
                                @default
                                    <i class="bi bi-geo-alt text-white"></i>
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
                    <i class="bi bi-building text-gray-400 text-4xl mx-auto"></i>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Aucune infrastructure</h3>
                    <p class="mt-2 text-sm text-gray-500">Commencez par ajouter votre première infrastructure touristique.</p>
                    <div class="mt-6">
                        <a href="{{ route('acteur.infrastructures.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
                            <i class="bi bi-plus-circle mr-2"></i>
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
                            <i class="bi bi-plus-lg text-white"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Nouvelle Infrastructure</p>
                            <p class="text-xs text-gray-500">Ajouter hôtel, restaurant...</p>
                        </div>
                    </a>

                    <a href="{{ route('acteur.profile') }}" class="flex items-center p-3 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl hover:from-green-100 hover:to-emerald-100 transition-all duration-200 group">
                        <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="bi bi-person text-white"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Mon Profil</p>
                            <p class="text-xs text-gray-500">Gérer mes informations</p>
                        </div>
                    </a>
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
                        <i class="bi bi-geo-alt mr-2"></i>
                        {{ $acteur->adresse }}
                    </div>
                    @endif

                    @if($acteur->site_web)
                    <div class="flex items-center text-sm text-indigo-600">
                        <i class="bi bi-globe mr-2"></i>
                        <a href="{{ $acteur->site_web }}" target="_blank" class="hover:underline">{{ $acteur->site_web }}</a>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Tips -->
            <div 
                x-data="{
                    conseils: [
                        'Ajoutez des images de qualité à vos infrastructures pour attirer plus de visiteurs !',
                        'Assurez-vous que vos informations de contact sont à jour.',
                        'Mettez en avant les points forts uniques de votre site touristique.',
                        'Partagez votre profil sur les réseaux sociaux pour plus de visibilité.',
                        'Répondez aux avis pour montrer que vous êtes à l\'écoute des visiteurs.'
                    ],
                    index: 0,
                    get conseilActuel() {
                        return this.conseils[this.index];
                    },
                    suivant() {
                        this.index = (this.index + 1) % this.conseils.length;
                    },
                    init() {
                        setInterval(() => this.suivant(), 30000); // change toutes les 5 secondes
                    }
                }"
                x-init="init"
                class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-2xl p-6 border border-yellow-200 transition-all duration-500"
            >
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <i class="bi bi-lightbulb text-yellow-600 text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-yellow-800">Conseil du jour</h3>
                        <p class="text-sm text-yellow-700 mt-1" x-text="conseilActuel"></p>
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
                            <span class="text-sm font-medium text-gray-900">Attractions</span>
                        </div>
                        <span class="text-sm font-bold text-yellow-600">{{ $stats['attractions'] }}</span>
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
        labels: ['Hôtels', 'Restaurants', 'Attractions', 'Transport'],
        datasets: [{
            data: [{{ $stats['hotels'] }}, {{ $stats['restaurants'] }}, {{ $stats['attractions'] }}, {{ $stats['transports'] }}],
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