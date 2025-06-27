@extends('layouts.app')

@section('title', 'Gestion des Infrastructures - EWARI')
@section('page-title', 'Gestion des Infrastructures')

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

<a href="{{ route('admin.acteurs.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
    <i class="bi bi-people mr-3"></i>
    Acteurs Touristiques
</a>

<a href="{{ route('admin.infrastructures.index') }}" class="nav-link-active flex items-center px-4 py-3 text-sm font-medium rounded-xl text-white">
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
                            <i class="bi bi-search text-gray-400"></i>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Rechercher une infrastructure..."
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                    </div>
                </div>

                <!-- Filtre par type -->
                <div class="w-full lg:w-48">
                    <select name="type" class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm bg-white">
                        <option value="">Tous les types</option>
                        <option value="hotel" {{ request('type') === 'hotel' ? 'selected' : '' }}>Hôtels</option>
                        <option value="restaurant" {{ request('type') === 'restaurant' ? 'selected' : '' }}>Restaurants</option>
                        <option value="plage" {{ request('type') === 'plage' ? 'selected' : '' }}>Plages</option>
                        <option value="transport" {{ request('type') === 'transport' ? 'selected' : '' }}>Transport</option>
                    </select>
                </div>

                <!-- Filtre par statut -->
                <div class="w-full lg:w-48">
                    <select name="status" class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm bg-white">
                        <option value="">Tous les statuts</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Actives</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactives</option>
                    </select>
                </div>

                <!-- Filtre par acteur -->
                <div class="w-full lg:w-64">
                    <select name="acteur" class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm bg-white">
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
                    <button type="submit" class="inline-flex items-center px-4 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        <i class="bi bi-funnel mr-2"></i>
                        Filtrer
                    </button>
                    @if(request()->anyFilled(['search', 'type', 'status', 'acteur']))
                    <a href="{{ route('admin.infrastructures.index') }}" class="inline-flex items-center px-4 py-2.5 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                        <i class="bi bi-x-circle mr-2"></i>
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
                        <i class="bi bi-check-circle mr-1"></i>
                        Activer
                    </button>
                    <button id="bulk-deactivate" class="hidden inline-flex items-center px-3 py-2 bg-red-100 text-red-700 text-sm font-medium rounded-lg hover:bg-red-200 transition-colors">
                        <i class="bi bi-x-circle mr-1"></i>
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
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12">
                                    @if($infrastructure->images && count($infrastructure->images) > 0)
                                    <img class="h-12 w-12 rounded-lg object-cover border border-gray-200"
                                        src="{{ $infrastructure->getImageUrl($infrastructure->images[0] ?? '') }}"
                                        alt="{{ $infrastructure->nom }}">
                                    @else
                                    <div class="h-12 w-12 rounded-lg bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                        <i class="bi bi-image text-gray-400"></i>
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
                                <span class="text-sm font-medium text-gray-900">{{ ucfirst($infrastructure->type) }}</span>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 font-medium">{{ $infrastructure->acteurTouristique->nom_entreprise }}</div>
                            <div class="text-sm text-gray-500">{{ $infrastructure->acteurTouristique->utilisateur->email }}</div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="bi bi-geo-alt mr-1"></i>
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
                                    <i class="bi bi-eye"></i>
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
                                        <i class="bi bi-x-circle"></i>
                                        @else
                                        <i class="bi bi-check-circle"></i>
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

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            {{ $infrastructures->links() }}
        </div>

        @else
        <!-- État vide -->
        <div class="text-center py-12">
            <i class="bi bi-building text-gray-400 text-4xl mx-auto"></i>
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
                    <i class="bi bi-check-circle mr-1"></i>
                    Activer
                </button>
                <button id="bulk-deactivate-btn"
                    class="inline-flex items-center px-3 py-2 bg-red-100 text-red-700 text-sm font-medium rounded-lg hover:bg-red-200 transition-colors">
                    <i class="bi bi-x-circle mr-1"></i>
                    Désactiver
                </button>
                <button id="bulk-delete-btn"
                    class="inline-flex items-center px-3 py-2 bg-red-100 text-red-700 text-sm font-medium rounded-lg hover:bg-red-200 transition-colors">
                    <i class="bi bi-trash mr-1"></i>
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