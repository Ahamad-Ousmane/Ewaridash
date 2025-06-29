@extends('layouts.app')

@section('title', 'Mes Infrastructures - EWARI')
@section('page-title', 'Mes Infrastructures')

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

    /* Tableau coulissant horizontalement */
    .table-container {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    .table-container table {
        min-width: 100%;
        width: max-content;
    }

    /* Style des boutons d'action */
    .action-btn {
        @apply p-2 rounded-lg hover:bg-gray-100 transition-colors;
    }
    .action-btn.view {
        @apply text-indigo-600 hover:text-indigo-800;
    }
    .action-btn.edit {
        @apply text-gray-600 hover:text-gray-800;
    }
    .action-btn.delete {
        @apply text-red-600 hover:text-red-800;
    }
</style>
@endpush

@section('sidebar')
<!-- Acteur Navigation -->
<a href="{{ route('acteur.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
    <i class="bi bi-grid mr-3"></i>
    Dashboard
</a>

<a href="{{ route('acteur.profile') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
    <i class="bi bi-person mr-3"></i>
    Mon Profil
</a>

<a href="{{ route('acteur.infrastructures.index') }}" class="nav-link-active flex items-center px-4 py-3 text-sm font-medium rounded-xl text-white">
    <i class="bi bi-building mr-3"></i>
    Mes Infrastructures
</a>
@endsection

@section('content')
<div class="p-6 space-y-6">
    <!-- Messages d'alerte -->
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6">
        <div class="flex items-center">
            <i class="bi bi-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6">
        <div class="flex items-center">
            <i class="bi bi-exclamation-triangle mr-2"></i>
            {{ session('error') }}
        </div>
    </div>
    @endif

    <!-- Header avec statistiques -->
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Mes Infrastructures</h1>
                <p class="text-gray-600 mt-1">Gérez vos infrastructures touristiques</p>
            </div>
            <div class="mt-4 lg:mt-0">
                <a href="{{ route('acteur.infrastructures.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white font-medium rounded-xl hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    <i class="bi bi-plus-lg mr-2"></i>
                    Ajouter une infrastructure
                </a>
            </div>
        </div>

        <!-- Statistiques rapides -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4 border border-blue-200 card-hover">
                <div class="flex items-center">
                    <div class="p-2 rounded-lg bg-blue-500">
                        <i class="bi bi-building text-white"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-blue-900">Total</p>
                        <p class="text-xl font-bold text-blue-900">{{ $infrastructures->total() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-4 border border-green-200 card-hover">
                <div class="flex items-center">
                    <div class="p-2 rounded-lg bg-green-500">
                        <i class="bi bi-check-circle text-white"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-900">Actives</p>
                        <p class="text-xl font-bold text-green-900">{{ $infrastructures->where('is_active', true)->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-xl p-4 border border-red-200 card-hover">
                <div class="flex items-center">
                    <div class="p-2 rounded-lg bg-red-500">
                        <i class="bi bi-x-circle text-white"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-red-900">Inactives</p>
                        <p class="text-xl font-bold text-red-900">{{ $infrastructures->where('is_active', false)->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-4 border border-purple-200 card-hover">
                <div class="flex items-center">
                    <div class="p-2 rounded-lg bg-purple-500">
                        <i class="bi bi-calendar-month text-white"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-purple-900">Ce mois</p>
                        <p class="text-xl font-bold text-purple-900">{{ $infrastructures->where('created_at', '>=', now()->startOfMonth())->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres et recherche -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <div class="p-6">
            <form method="GET" action="{{ route('acteur.infrastructures.index') }}" class="flex flex-col lg:flex-row lg:items-center lg:space-x-4 space-y-4 lg:space-y-0">

                <!-- Recherche -->
                <div class="flex-1">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="bi bi-search text-gray-400"></i>
                        </div>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" 
                            placeholder="Rechercher par nom..."
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm placeholder-gray-500">
                    </div>
                </div>

                <!-- Type -->
                <div class="w-full lg:w-48">
                    <select name="type" id="type" class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm bg-white">
                        <option value="">Tous les types</option>
                        <option value="hotel" {{ request('type') === 'hotel' ? 'selected' : '' }}>Hôtels</option>
                        <option value="restaurant" {{ request('type') === 'restaurant' ? 'selected' : '' }}>Restaurants</option>
                        <option value="plage" {{ request('type') === 'plage' ? 'selected' : '' }}>Plages</option>
                        <option value="transport" {{ request('type') === 'transport' ? 'selected' : '' }}>Transport</option>
                        <option value="loisir" {{ request('type') === 'loisir' ? 'selected' : '' }}>Loisir</option>
                    </select>
                </div>

                <!-- Statut -->
                <div class="w-full lg:w-48">
                    <select name="status" id="status" class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm bg-white">
                        <option value="">Tous les statuts</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Actives</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactives</option>
                    </select>
                </div>

                <!-- Boutons -->
                <div class="flex space-x-2">
                    <button type="submit" class="inline-flex items-center px-4 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        <i class="bi bi-funnel mr-2"></i>
                        Filtrer
                    </button>
                    @if(request()->hasAny(['search', 'type', 'status']))
                    <a href="{{ route('acteur.infrastructures.index') }}" class="inline-flex items-center px-4 py-2.5 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                        <i class="bi bi-x-circle mr-2"></i>
                        Réinitialiser
                    </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Liste des infrastructures -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        @if($infrastructures->count() > 0)
        <div class="overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900">
                    {{ $infrastructures->total() }} infrastructure(s) trouvée(s)
                </h3>
            </div>

            <!-- Version Desktop avec tableau coulissant -->
            <div class="hidden lg:block">
                <div class="table-container">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Infrastructure
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Type
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Localisation
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Statut
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date de création
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($infrastructures as $infrastructure)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center">
                                            @switch($infrastructure->type)
                                                @case('hotel')
                                                    <i class="bi bi-building text-white"></i>
                                                    @break
                                                @case('restaurant')
                                                    <i class="bi bi-cup-hot text-white"></i>
                                                    @break
                                                @case('plage')
                                                    <i class="bi bi-umbrella text-white"></i>
                                                    @break
                                                @case('transport')
                                                    <i class="bi bi-bus-front text-white"></i>
                                                    @break
                                                @default
                                                    <i class="bi bi-geo-alt text-white"></i>
                                            @endswitch
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $infrastructure->nom }}</div>
                                            @if($infrastructure->description)
                                            <div class="text-sm text-gray-500 truncate max-w-xs">{{ $infrastructure->description }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ ucfirst($infrastructure->type) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <div class="flex items-center">
                                        <i class="bi bi-geo-alt text-gray-400 mr-1"></i>
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
                                    {{ $infrastructure->created_at->format('d/m/Y') }}
                                    <div class="text-xs">{{ $infrastructure->created_at->diffForHumans() }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('acteur.infrastructures.show', $infrastructure) }}" class="action-btn view text-indigo-500" title="Voir">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('acteur.infrastructures.edit', $infrastructure) }}" class="action-btn edit text-green-500" title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('acteur.infrastructures.destroy', $infrastructure) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette infrastructure ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete text-red-500" title="Supprimer">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Version Mobile -->
            <div class="lg:hidden">
                <div class="p-6 space-y-4">
                    @foreach($infrastructures as $infrastructure)
                    <div class="bg-gray-50 rounded-xl p-4 space-y-3 card-hover">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center">
                                    @switch($infrastructure->type)
                                        @case('hotel')
                                            <i class="bi bi-building text-white"></i>
                                            @break
                                        @case('restaurant')
                                            <i class="bi bi-cup-hot text-white"></i>
                                            @break
                                        @case('plage')
                                            <i class="bi bi-umbrella text-white"></i>
                                            @break
                                        @case('transport')
                                            <i class="bi bi-bus-front text-white"></i>
                                            @break
                                        @default
                                            <i class="bi bi-geo-alt text-white"></i>
                                    @endswitch
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">{{ $infrastructure->nom }}</h3>
                                    <p class="text-sm text-gray-500">{{ ucfirst($infrastructure->type) }}</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $infrastructure->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $infrastructure->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>

                        @if($infrastructure->description)
                        <p class="text-sm text-gray-600">{{ Str::limit($infrastructure->description, 100) }}</p>
                        @endif

                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center text-gray-500">
                                <i class="bi bi-geo-alt mr-1"></i>
                                {{ $infrastructure->ville ?? $infrastructure->adresse }}
                            </div>
                            <div class="text-gray-500">
                                {{ $infrastructure->created_at->format('d/m/Y') }}
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-3 border-t border-gray-200">
                            <div class="flex space-x-3">
                                <a href="{{ route('acteur.infrastructures.show', $infrastructure) }}" class="inline-flex items-center text-sm text-gray-600 hover:text-indigo-700">
                                    <i class="bi bi-eye mr-1 text-indigo-500"></i>
                                    Voir
                                </a>
                                <a href="{{ route('acteur.infrastructures.edit', $infrastructure) }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-700">
                                    <i class="bi bi-pencil mr-1 text-yellow-500"></i>
                                    Modifier
                                </a>
                            </div>
                            <form action="{{ route('acteur.infrastructures.destroy', $infrastructure) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette infrastructure ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center text-sm text-red-600 hover:text-red-700">
                                    <i class="bi bi-trash mr-1 text-red-500"></i>
                                    Supprimer
                                </button>
                            </form>
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $infrastructures->links() }}
            </div>
        </div>
        @else
        <!-- État vide -->
        <div class="text-center py-12">
            <i class="bi bi-building text-gray-400 text-4xl mx-auto"></i>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Aucune infrastructure</h3>
            <p class="mt-1 text-sm text-gray-500">
                @if(request()->hasAny(['search', 'type', 'status']))
                    Aucune infrastructure ne correspond à vos critères de recherche.
                @else
                    Commencez par ajouter votre première infrastructure.
                @endif
            </p>
            <div class="mt-6 space-y-2">
                @if(request()->hasAny(['search', 'type', 'status']))
                <a href="{{ route('acteur.infrastructures.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="bi bi-x-lg mr-2"></i>
                    Réinitialiser les filtres
                </a>
                @else
                <a href="{{ route('acteur.infrastructures.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="bi bi-plus-lg mr-2"></i>
                    Ajouter ma première infrastructure
                </a>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
// Auto-submit du formulaire de recherche après un délai
let searchTimeout;
document.getElementById('search').addEventListener('input', function() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        this.form.submit();
    }, 500);
});
</script>
@endpush