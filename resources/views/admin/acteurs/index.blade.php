@extends('layouts.app')

@section('title', 'Gestion des Acteurs Touristiques - EWARI')
@section('page-title', 'Gestion des Acteurs Touristiques')

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

    /* Style des sélecteurs */
    select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.75rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        padding-right: 2.5rem;
    }

    /* Cartes d'acteurs */
    .acteur-card {
        position: relative;
        background-color: white;
        border-radius: 0.75rem;
        border: 1px solid #e5e7eb;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .acteur-card:hover {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        border-color: #e0e7ff;
        transform: translateY(-4px);
    }

    .acteur-avatar {
        width: 3.5rem;
        height: 3.5rem;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 1.25rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .acteur-status {
        position: absolute;
        top: 1rem;
        right: 1rem;
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.5rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .acteur-status-dot {
        width: 0.5rem;
        height: 0.5rem;
        margin-right: 0.375rem;
        border-radius: 9999px;
    }

    .acteur-details {
        margin-top: 1rem;
        display: flex;
        flex-direction: column;
        gap: 0.375rem;
        font-size: 0.875rem;
        color: #4b5563;
    }

    .acteur-detail-item {
        display: flex;
        align-items: center;
    }

    .acteur-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        margin-top: 1rem;
        border-top: 1px solid #f3f4f6;
    }

    /* Modale de confirmation */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .modal-overlay.show {
        opacity: 1;
        visibility: visible;
    }

    .modal-content {
        background: white;
        border-radius: 1rem;
        padding: 2rem;
        max-width: 500px;
        width: 90%;
        transform: scale(0.9);
        transition: transform 0.3s ease;
    }

    .modal-overlay.show .modal-content {
        transform: scale(1);
    }

    /* Notifications toast */
    .toast {
        position: fixed;
        top: 1rem;
        right: 1rem;
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        padding: 1rem;
        max-width: 400px;
        z-index: 1001;
        transform: translateX(100%);
        transition: transform 0.3s ease;
    }

    .toast.show {
        transform: translateX(0);
    }

    .toast-success {
        border-left: 4px solid #10b981;
    }

    .toast-error {
        border-left: 4px solid #ef4444;
    }
</style>
@endpush

@section('sidebar')
<!-- Admin Navigation -->
<a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
    <i class="bi bi-grid mr-3"></i>
    Dashboard
</a>

<a href="{{ route('admin.acteurs.index') }}" class="nav-link-active flex items-center px-4 py-3 text-sm font-medium rounded-xl text-white">
    <i class="bi bi-people mr-3"></i>
    Acteurs Touristiques
</a>

<a href="{{ route('admin.infrastructures.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
    <i class="bi bi-building mr-3"></i>
    Infrastructures
</a>
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
                        <p class="text-2xl font-bold text-indigo-600">{{ $acteurs->total() }}</p>
                        <p class="text-xs text-gray-500">Total</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-green-600">{{ $acteurs->where('utilisateur.is_active', true)->count() }}</p>
                        <p class="text-xs text-gray-500">Actifs</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-red-600">{{ $acteurs->where('utilisateur.is_active', false)->count() }}</p>
                        <p class="text-xs text-gray-500">Inactifs</p>
                    </div>
                </div>
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
                            <i class="bi bi-search text-gray-400"></i>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Rechercher un acteur..."
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                    </div>
                </div>

                <!-- Filtre par statut -->
                <div class="w-full lg:w-48">
                    <select name="status" class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm bg-white">
                        <option value="">Tous les statuts</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Actifs</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactifs</option>
                    </select>
                </div>

                <!-- Tri -->
                <div class="w-full lg:w-48">
                    <select name="sort" class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm bg-white">
                        <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Plus récents</option>
                        <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Plus anciens</option>
                        <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }}>Nom A-Z</option>
                        <option value="name_desc" {{ request('sort') === 'name_desc' ? 'selected' : '' }}>Nom Z-A</option>
                        <option value="most_infrastructures" {{ request('sort') === 'most_infrastructures' ? 'selected' : '' }}>Plus d'infrastructures</option>
                    </select>
                </div>

                <!-- Boutons -->
                <div class="flex space-x-2">
                    <button type="submit" class="inline-flex items-center px-4 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        <i class="bi bi-funnel mr-2"></i>
                        Filtrer
                    </button>
                    @if(request()->anyFilled(['search', 'status', 'sort']))
                    <a href="{{ route('admin.acteurs.index') }}" class="inline-flex items-center px-4 py-2.5 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                        <i class="bi bi-x-circle mr-2"></i>
                        Réinitialiser
                    </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Liste des acteurs -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @if($acteurs->count() > 0)
        <!-- Header du tableau -->
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-semibold text-gray-900">
                    {{ $acteurs->total() }} acteur(s) trouvé(s)
                </h3>
            </div>
        </div>

        <!-- Vue grille/carte -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($acteurs as $acteur)
                <div class="acteur-card" data-acteur-id="{{ $acteur->id }}">
                    <div class="p-5">
                        <!-- Header carte -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-3 min-w-0">
                                <div class="w-14 h-14 rounded-xl flex items-center justify-center text-white font-bold text-xl"
                                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                    {{ substr($acteur->nom_entreprise, 0, 2) }}
                                </div>
                                <div class="truncate">
                                    <h3 class="text-lg font-semibold text-gray-900 truncate">{{ $acteur->nom_entreprise }}</h3>
                                    <p class="text-sm text-gray-500">{{ $acteur->utilisateur->nom }}</p>
                                </div>
                            </div>

                            <span class="shrink-0 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $acteur->utilisateur->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                <span class="w-2 h-2 mr-1.5 rounded-full {{ $acteur->utilisateur->is_active ? 'bg-green-400' : 'bg-red-400' }}"></span>
                                {{ $acteur->utilisateur->is_active ? 'Actif' : 'Inactif' }}
                            </span>
                        </div>

                        <!-- Informations détaillées -->
                        <div class="acteur-details">
                            <div class="acteur-detail-item">
                                <i class="bi bi-envelope mr-2 text-gray-400"></i>
                                <span class="truncate">{{ $acteur->utilisateur->email }}</span>
                            </div>

                            @if($acteur->telephone)
                            <div class="acteur-detail-item">
                                <i class="bi bi-telephone mr-2 text-gray-400"></i>
                                <span>{{ $acteur->telephone }}</span>
                            </div>
                            @endif

                            <div class="acteur-detail-item">
                                <i class="bi bi-building mr-2 text-gray-400"></i>
                                <span>{{ $acteur->infrastructures_count ?? 0 }} infrastructure(s)</span>
                            </div>

                            <div class="acteur-detail-item">
                                <i class="bi bi-calendar mr-2 text-gray-400"></i>
                                <span>Inscrit {{ $acteur->created_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="acteur-actions">
                            <div class="flex space-x-2">
                                <!-- Toggle statut -->
                                <button onclick="showConfirmModal('toggle', '{{ $acteur->id }}', '{{ $acteur->utilisateur->is_active ? 'désactiver' : 'activer' }}', '{{ $acteur->nom_entreprise }}')"
                                    class="inline-flex items-center p-2 {{ $acteur->utilisateur->is_active ? 'text-red-600 hover:text-red-800 hover:bg-red-50' : 'text-green-600 hover:text-green-800 hover:bg-green-50' }} rounded-lg transition-colors"
                                    title="{{ $acteur->utilisateur->is_active ? 'Désactiver' : 'Activer' }}">
                                    @if($acteur->utilisateur->is_active)
                                    <i class="bi bi-x-circle"></i>
                                    @else
                                    <i class="bi bi-check-circle"></i>
                                    @endif
                                </button>

                                <a href="mailto:{{ $acteur->utilisateur->email }}"
                                    class="inline-flex items-center p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors"
                                    title="Envoyer un email">
                                    <i class="bi bi-envelope"></i>
                                </a>
                            </div>

                            <!-- Bouton Supprimer -->
                            <button onclick="showConfirmModal('delete', '{{ $acteur->id }}', 'supprimer', '{{ $acteur->nom_entreprise }}')"
                                class="inline-flex items-center p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors"
                                title="Supprimer">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Pagination -->
        @if($acteurs->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            {{ $acteurs->links() }}
        </div>
        @endif

        @else
        <!-- État vide -->
        <div class="text-center py-12">
            <i class="bi bi-people text-gray-400 text-4xl mx-auto"></i>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun acteur trouvé</h3>
            <p class="mt-1 text-sm text-gray-500">
                @if(request()->anyFilled(['search', 'status', 'sort']))
                Essayez de modifier vos critères de recherche.
                @else
                Commencez par ajouter votre premier acteur touristique.
                @endif
            </p>
            <div class="mt-6">
                @if(request()->anyFilled(['search', 'status', 'sort']))
                <a href="{{ route('admin.acteurs.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Réinitialiser les filtres
                </a>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Modale de confirmation -->
<div id="confirmModal" class="modal-overlay">
    <div class="modal-content">
        <div class="text-center">
            <div id="modalIcon" class="mx-auto mb-4 w-12 h-12 rounded-full flex items-center justify-center">
                <i id="modalIconElement" class="text-2xl"></i>
            </div>
            <h3 id="modalTitle" class="text-lg font-semibold text-gray-900 mb-2"></h3>
            <p id="modalMessage" class="text-gray-600 mb-6"></p>
            <div class="flex justify-center space-x-3">
                <button id="confirmAction" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    Confirmer
                </button>
                <button onclick="hideConfirmModal()" class="px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors">
                    Annuler
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Formulaires cachés pour les actions -->
@foreach($acteurs as $acteur)
<form id="toggleForm{{ $acteur->id }}" action="{{ route('admin.acteurs.toggle-status', $acteur) }}" method="POST" style="display: none;">
    @csrf
    @method('PATCH')
</form>

<form id="deleteForm{{ $acteur->id }}" action="{{ route('admin.acteurs.destroy', $acteur) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endforeach

@push('scripts')
<script>
    // Gestion de la modale de confirmation
    let currentAction = null;
    let currentActeurId = null;

    function showConfirmModal(action, acteurId, actionText, acteurName) {
        currentAction = action;
        currentActeurId = acteurId;
        
        const modal = document.getElementById('confirmModal');
        const modalIcon = document.getElementById('modalIcon');
        const modalIconElement = document.getElementById('modalIconElement');
        const modalTitle = document.getElementById('modalTitle');
        const modalMessage = document.getElementById('modalMessage');
        const confirmButton = document.getElementById('confirmAction');
        
        if (action === 'delete') {
            modalIcon.className = 'mx-auto mb-4 w-12 h-12 rounded-full flex items-center justify-center bg-red-100';
            modalIconElement.className = 'text-2xl bi bi-trash text-red-600';
            modalTitle.textContent = 'Confirmer la suppression';
            modalMessage.textContent = `Êtes-vous sûr de vouloir supprimer l'acteur "${acteurName}" ? Cette action supprimera aussi toutes ses infrastructures.`;
            confirmButton.className = 'px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors';
            confirmButton.textContent = 'Supprimer';
        } else if (action === 'toggle') {
            if (actionText === 'désactiver') {
                modalIcon.className = 'mx-auto mb-4 w-12 h-12 rounded-full flex items-center justify-center bg-orange-100';
                modalIconElement.className = 'text-2xl bi bi-x-circle text-orange-600';
                modalTitle.textContent = 'Confirmer la désactivation';
                modalMessage.textContent = `Êtes-vous sûr de vouloir désactiver l'acteur "${acteurName}" ?`;
                confirmButton.className = 'px-6 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors';
                confirmButton.textContent = 'Désactiver';
            } else {
                modalIcon.className = 'mx-auto mb-4 w-12 h-12 rounded-full flex items-center justify-center bg-green-100';
                modalIconElement.className = 'text-2xl bi bi-check-circle text-green-600';
                modalTitle.textContent = 'Confirmer l\'activation';
                modalMessage.textContent = `Êtes-vous sûr de vouloir activer l'acteur "${acteurName}" ?`;
                confirmButton.className = 'px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors';
                confirmButton.textContent = 'Activer';
            }
        }
        
        modal.classList.add('show');
    }

    function hideConfirmModal() {
        const modal = document.getElementById('confirmModal');
        modal.classList.remove('show');
        currentAction = null;
        currentActeurId = null;
    }

    function executeAction() {
        if (currentAction && currentActeurId) {
            const formId = currentAction === 'delete' ? `deleteForm${currentActeurId}` : `toggleForm${currentActeurId}`;
            const form = document.getElementById(formId);
            if (form) {
                form.submit();
            }
        }
        hideConfirmModal();
    }

    // Event listener pour le bouton de confirmation
    document.getElementById('confirmAction').addEventListener('click', executeAction);

    // Fermer la modale en cliquant sur l'overlay
    document.getElementById('confirmModal').addEventListener('click', function(e) {
        if (e.target === this) {
            hideConfirmModal();
        }
    });

    // Fermer la modale avec la touche Échap
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            hideConfirmModal();
        }
    });

    // Affichage des notifications toast
    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        
        const icon = type === 'success' ? 'bi-check-circle' : 'bi-exclamation-circle';
        const iconColor = type === 'success' ? 'text-green-600' : 'text-red-600';
        
        toast.innerHTML = `
            <div class="flex items-center">
                <i class="bi ${icon} ${iconColor} mr-3"></i>
                <span class="text-gray-800">${message}</span>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-gray-400 hover:text-gray-600">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        `;
        
        document.body.appendChild(toast);
        
        // Animer l'entrée
        setTimeout(() => toast.classList.add('show'), 100);
        
        // Supprimer automatiquement après 5 secondes
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 300);
        }, 5000);
    }
</script>
@endpush

@endsection