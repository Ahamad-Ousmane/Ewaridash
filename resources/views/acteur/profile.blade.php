@extends('layouts.app')

@section('title', 'Mon Profil - TourismoRA')
@section('page-title', 'Mon Profil')

@section('sidebar')
<!-- Acteur Navigation -->
<a href="{{ route('acteur.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4M8 7h8"></path>
    </svg>
    Dashboard
</a>

<a href="{{ route('acteur.profile') }}" class="nav-link-active flex items-center px-4 py-3 text-sm font-medium rounded-xl text-white">
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
            Rapports
        </a>
        <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
            <svg class="mr-3 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            Paramètres
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="p-6 space-y-6">
    <!-- Header avec messages -->
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            {{ session('success') }}
        </div>
    </div>
    @endif

    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6">
        <div class="flex items-center mb-2">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
            </svg>
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
                <button @click="activeTab = 'account'" 
                        :class="activeTab === 'account' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Compte Utilisateur
                </button>
                <button @click="activeTab = 'stats'" 
                        :class="activeTab === 'stats' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Statistiques
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
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">
                                Informations Entreprise
                            </h3>

                            <div>
                                <label for="nom_entreprise" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nom de l'entreprise <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nom_entreprise" id="nom_entreprise" 
                                       value="{{ old('nom_entreprise', $acteur->nom_entreprise) }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>

                            <div>
                                <label for="secteur_activite" class="block text-sm font-medium text-gray-700 mb-2">
                                    Secteur d'activité <span class="text-red-500">*</span>
                                </label>
                                <select name="secteur_activite" id="secteur_activite" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">-- Sélectionner --</option>
                                    <option value="Hébergement" {{ $acteur->secteur_activite === 'Hébergement' ? 'selected' : '' }}>Hébergement</option>
                                    <option value="Restauration" {{ $acteur->secteur_activite === 'Restauration' ? 'selected' : '' }}>Restauration</option>
                                    <option value="Transport" {{ $acteur->secteur_activite === 'Transport' ? 'selected' : '' }}>Transport</option>
                                    <option value="Loisirs" {{ $acteur->secteur_activite === 'Loisirs' ? 'selected' : '' }}>Loisirs</option>
                                    <option value="Guide touristique" {{ $acteur->secteur_activite === 'Guide touristique' ? 'selected' : '' }}>Guide touristique</option>
                                    <option value="Agence de voyage" {{ $acteur->secteur_activite === 'Agence de voyage' ? 'selected' : '' }}>Agence de voyage</option>
                                    <option value="Autre" {{ $acteur->secteur_activite === 'Autre' ? 'selected' : '' }}>Autre</option>
                                </select>
                            </div>

                            <div>
                                <label for="numero_licence" class="block text-sm font-medium text-gray-700 mb-2">
                                    Numéro de licence
                                </label>
                                <input type="text" name="numero_licence" id="numero_licence" 
                                       value="{{ old('numero_licence', $acteur->numero_licence) }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                    Description
                                </label>
                                <textarea name="description" id="description" rows="4" 
                                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $acteur->description) }}</textarea>
                            </div>
                        </div>

                        <!-- Informations Contact -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">
                                Informations Contact
                            </h3>

                            <div>
                                <label for="adresse" class="block text-sm font-medium text-gray-700 mb-2">
                                    Adresse <span class="text-red-500">*</span>
                                </label>
                                <textarea name="adresse" id="adresse" rows="3" 
                                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('adresse', $acteur->adresse) }}</textarea>
                            </div>

                            <div>
                                <label for="ville" class="block text-sm font-medium text-gray-700 mb-2">
                                    Ville <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="ville" id="ville" 
                                       value="{{ old('ville', $acteur->ville) }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>

                            <div>
                                <label for="telephone_entreprise" class="block text-sm font-medium text-gray-700 mb-2">
                                    Téléphone entreprise
                                </label>
                                <input type="tel" name="telephone_entreprise" id="telephone_entreprise" 
                                       value="{{ old('telephone_entreprise', $acteur->telephone_entreprise) }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>

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
                                <label for="horaires" class="block text-sm font-medium text-gray-700 mb-2">
                                    Horaires d'ouverture
                                </label>
                                <textarea name="horaires" id="horaires" rows="3" 
                                          placeholder="Ex: Lun-Ven: 8h-17h, Sam: 9h-12h"
                                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('horaires', $acteur->horaires) }}</textarea>
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

            <!-- Onglet Compte Utilisateur -->
            <div x-show="activeTab === 'account'" x-transition>
                <form action="{{ route('acteur.account.update') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">
                                Informations Personnelles
                            </h3>

                            <div>
                                <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nom complet <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nom" id="nom" 
                                       value="{{ old('nom', $utilisateur->nom) }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="email" id="email" 
                                       value="{{ old('email', $utilisateur->email) }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>

                            <div>
                                <label for="telephone" class="block text-sm font-medium text-gray-700 mb-2">
                                    Téléphone personnel
                                </label>
                                <input type="tel" name="telephone" id="telephone" 
                                       value="{{ old('telephone', $utilisateur->telephone) }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>

                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">
                                Modifier le mot de passe
                            </h3>
                            <p class="text-sm text-gray-600">Laissez vide si vous ne souhaitez pas changer le mot de passe</p>

                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                                    Mot de passe actuel
                                </label>
                                <input type="password" name="current_password" id="current_password" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nouveau mot de passe
                                </label>
                                <input type="password" name="password" id="password" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                    Confirmer le nouveau mot de passe
                                </label>
                                <input type="password" name="password_confirmation" id="password_confirmation" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-6 border-t border-gray-200">
                        <button type="submit" class="px-6 py-3 bg-indigo-600 text-white font-medium rounded-xl hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                            Mettre à jour le compte
                        </button>
                    </div>
                </form>
            </div>

            <!-- Onglet Statistiques -->
            <div x-show="activeTab === 'stats'" x-transition>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Mes Infrastructures -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-200">
                        <div class="flex items-center">
                            <div class="p-3 rounded-xl bg-blue-500">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-blue-900">Mes Infrastructures</p>
                                <p class="text-2xl font-bold text-blue-900">{{ $acteur->infrastructures()->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Infrastructures Actives -->
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-200">
                        <div class="flex items-center">
                            <div class="p-3 rounded-xl bg-green-500">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-green-900">Actives</p>
                                <p class="text-2xl font-bold text-green-900">{{ $acteur->infrastructures()->where('is_active', true)->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Compte depuis -->
                    <div class="bg-gradient-to-br from-purple-50 to-violet-50 rounded-2xl p-6 border border-purple-200">
                        <div class="flex items-center">
                            <div class="p-3 rounded-xl bg-purple-500">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4M8 7h8m0 0v4m0-4l-4 4m-6 6h8m0 0v4m0-4l-4 4"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-purple-900">Membre depuis</p>
                                <p class="text-lg font-bold text-purple-900">{{ $utilisateur->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dernières Infrastructures -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900">Dernières Infrastructures</h3>
                    </div>
                    <div class="p-6">
                        @forelse($acteur->infrastructures()->latest()->take(5)->get() as $infrastructure)
                        <div class="flex items-center space-x-4 py-3 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center">
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
                                    @case('plage')
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        @break
                                    @case('transport')
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
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
                                <p class="text-xs text-gray-500">{{ ucfirst($infrastructure->type) }} • {{ $infrastructure->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="text-right">
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
                            <p class="mt-2 text-sm text-gray-500">Aucune infrastructure enregistrée</p>
                            <div class="mt-4">
                                <a href="{{ route('acteur.infrastructures.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                                    Ajouter une infrastructure
                                </a>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Actions Rapides</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('acteur.infrastructures.create') }}" class="group flex items-center justify-center p-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl hover:from-blue-100 hover:to-indigo-100 transition-all duration-200 border border-blue-200">
                <div class="text-center">
                    <div class="w-12 h-12 bg-blue-500 rounded-xl mx-auto mb-3 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-blue-900">Ajouter Infrastructure</p>
                    <p class="text-xs text-blue-600 mt-1">Nouvelle infrastructure</p>
                </div>
            </a>

            <a href="{{ route('acteur.infrastructures.index') }}" class="group flex items-center justify-center p-6 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl hover:from-green-100 hover:to-emerald-100 transition-all duration-200 border border-green-200">
                <div class="text-center">
                    <div class="w-12 h-12 bg-green-500 rounded-xl mx-auto mb-3 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-green-900">Gérer Infrastructures</p>
                    <p class="text-xs text-green-600 mt-1">Voir toutes mes infrastructures</p>
                </div>
            </a>

            <button class="group flex items-center justify-center p-6 bg-gradient-to-br from-purple-50 to-violet-50 rounded-xl hover:from-purple-100 hover:to-violet-100 transition-all duration-200 border border-purple-200">
                <div class="text-center">
                    <div class="w-12 h-12 bg-purple-500 rounded-xl mx-auto mb-3 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-purple-900">Mes Rapports</p>
                    <p class="text-xs text-purple-600 mt-1">Statistiques détaillées</p>
                </div>
            </button>
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