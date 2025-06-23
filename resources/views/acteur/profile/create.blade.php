@extends('layouts.app')

@section('title', 'Compléter votre profil - TourismoRA')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Compléter votre profil d'acteur touristique</h1>
            
            <form method="POST" action="{{ route('acteur.profile.update') }}">
                @csrf
                @method('PATCH')
                
                <div class="space-y-4">
                    <div>
                        <label for="nom_entreprise" class="block text-sm font-medium text-gray-700">Nom de l'entreprise *</label>
                        <input type="text" name="nom_entreprise" id="nom_entreprise" 
                               value="{{ old('nom_entreprise') }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                               required>
                        @error('nom_entreprise')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="4" 
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                  placeholder="Décrivez votre activité touristique...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse</label>
                        <input type="text" name="adresse" id="adresse" 
                               value="{{ old('adresse') }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('adresse')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="site_web" class="block text-sm font-medium text-gray-700">Site web</label>
                        <input type="url" name="site_web" id="site_web" 
                               value="{{ old('site_web') }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               placeholder="https://votre-site.com">
                        @error('site_web')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mt-6 flex justify-end space-x-3">
                    <a href="{{ route('acteur.dashboard') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Passer pour l'instant
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Enregistrer le profil
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection