@extends('layouts.app')

@section('title', 'Mon Profil - EWARI')
@section('page-title', 'Mon Profil')

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
<a href="{{ route('acteur.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
    <i class="bi bi-grid mr-3"></i>
    Dashboard
</a>

<a href="{{ route('acteur.profile') }}" class="nav-link-active flex items-center px-4 py-3 text-sm font-medium rounded-xl text-white">
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
    <!-- Header avec messages -->
    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6">
        <div class="flex items-center mb-2">
            <i class="bi bi-exclamation-triangle mr-2"></i>
            Des erreurs ont été détectées :
        </div>
        <ul class="list-disc list-inside text-sm">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Profile Header -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="h-32 bg-gradient-to-r from-blue-500 to-purple-600"></div>
        <div class="px-6 pb-6">
            <div class="flex items-start -mt-16 space-x-6">
                <div class="w-24 h-24 rounded-full bg-white p-1 shadow-lg">
                    <div class="w-full h-full rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center">
                        <span class="text-white font-bold text-2xl">{{ substr($acteur->nom_entreprise, 0, 2) }}</span>
                    </div>
                </div>
                <div class="flex-1 pt-4">
                    <h1 class="text-2xl font-bold text-gray-900">{{ $acteur->nom_entreprise }}</h1>
                    <p class="text-gray-600">{{ $acteur->secteur_activite }}</p>
                    <div class="flex items-center mt-2 space-x-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $utilisateur->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $utilisateur->is_active ? 'Compte actif' : 'Compte inactif' }}
                        </span>
                        <span class="text-sm text-gray-500">
                            Membre depuis {{ $utilisateur->created_at->format('M Y') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8 px-6" x-data="{ activeTab: 'profile' }">
                <button @click="activeTab = 'profile'" 
                        :class="activeTab === 'profile' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Informations Générales
                </button>
            </nav>
        </div>

        <!-- Tab Content -->
        <div class="p-6" x-data="{ activeTab: 'profile' }">
            <!-- Onglet Informations Générales -->
            <div x-show="activeTab === 'profile'" x-transition>
                <form action="{{ route('acteur.profile.update') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Informations Entreprise -->
                        <div class="space-y-6 equal-height">
                            <div class="border-b border-gray-200 pb-2">
                                <h3 class="text-lg font-semibold text-gray-900">
                                    Informations Entreprise
                                </h3>
                            </div>

                            <div class="space-y-6 flex-1">
                                <div>
                                    <label for="nom_entreprise" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nom de l'entreprise <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="nom_entreprise" id="nom_entreprise" 
                                           value="{{ old('nom_entreprise', $acteur->nom_entreprise) }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                </div>

                                <div>
                                    <label for="adresse" class="block text-sm font-medium text-gray-700 mb-2">
                                        Adresse <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="adresse" id="adresse"
                                        value="{{ old('adresse', $acteur->adresse) }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                </div>

                                <div>
                                    <label for="ville" class="block text-sm font-medium text-gray-700 mb-2">
                                        Ville <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="ville" id="ville" 
                                           value="{{ old('ville', $acteur->ville) }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                </div>

                                <div class="flex-1">
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                        Description
                                    </label>
                                    <textarea name="description" id="description" rows="4" 
                                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 h-full">{{ old('description', $acteur->description) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Informations Contact -->
                        <div class="space-y-6 equal-height">
                            <div class="border-b border-gray-200 pb-2">
                                <h3 class="text-lg font-semibold text-gray-900">
                                    Informations Contact
                                </h3>
                            </div>

                            <div class="space-y-6 flex-1">
                                <div>
                                    <label for="site_web" class="block text-sm font-medium text-gray-700 mb-2">
                                        Site web
                                    </label>
                                    <input type="url" name="site_web" id="site_web" 
                                           value="{{ old('site_web', $acteur->site_web) }}"
                                           placeholder="https://example.com"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                        Email
                                    </label>
                                    <input type="email" name="email" id="email" 
                                        value="{{ old('email', $acteur->utilisateur->email ?? '') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                </div>

                                <div>
                                    <label for="telephone_entreprise" class="block text-sm font-medium text-gray-700 mb-2">
                                        Téléphone entreprise
                                    </label>
                                    <input type="tel" name="telephone_entreprise" id="telephone_entreprise" 
                                        value="{{ old('telephone_entreprise', $acteur->utilisateur->telephone ?? '') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-6 border-t border-gray-200">
                        <button type="submit" class="px-6 py-3 bg-indigo-600 text-white font-medium rounded-xl hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                            Mettre à jour le profil
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Actions Rapides</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('acteur.infrastructures.create') }}" class="group flex items-center p-4 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl hover:from-blue-100 hover:to-indigo-100 transition-all duration-200 border border-blue-200 h-full">
                <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform mr-4">
                    <i class="bi bi-plus-lg text-white text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold text-blue-900">Ajouter Infrastructure</p>
                    <p class="text-xs text-blue-600 mt-1">Nouvelle infrastructure touristique</p>
                </div>
            </a>

            <a href="{{ route('acteur.infrastructures.index') }}" class="group flex items-center p-4 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl hover:from-green-100 hover:to-emerald-100 transition-all duration-200 border border-green-200 h-full">
                <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform mr-4">
                    <i class="bi bi-building text-white text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold text-green-900">Gérer Infrastructures</p>
                    <p class="text-xs text-green-600 mt-1">Voir et modifier mes infrastructures</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Auto-focus sur les champs avec erreurs
document.addEventListener('DOMContentLoaded', function() {
    const errorField = document.querySelector('.border-red-500');
    if (errorField) {
        errorField.focus();
    }
});
</script>
@endpush