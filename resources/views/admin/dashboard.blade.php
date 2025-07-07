@extends('layouts.app')

@section('title', 'Dashboard Admin - EWARI')
@section('page-title', 'Dashboard Admin')

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
<!-- Admin Navigation -->
<a href="{{ route('admin.dashboard') }}" class="nav-link-active flex items-center px-4 py-3 text-sm font-medium rounded-xl text-white">
    <i class="bi bi-grid mr-3"></i>
    Dashboard
</a>

<a href="{{ route('admin.acteurs.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
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
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Acteurs -->
        <div class="bg-white rounded-2xl shadow-sm p-6 card-hover border border-gray-100">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600">
                    <i class="bi bi-people-fill text-white text-lg"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Acteurs</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_acteurs'] }}</p>
                    <div class="flex items-center mt-1">
                        <span class="text-xs text-green-600 font-medium">{{ $stats['active_acteurs'] }} actifs</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Infrastructures -->
        <div class="bg-white rounded-2xl shadow-sm p-6 card-hover border border-gray-100">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-gradient-to-br from-green-500 to-green-600">
                    <i class="bi bi-building text-white text-lg"></i>
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
                    <i class="bi bi-bar-chart-line text-white text-lg"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Taux d'Activité</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ $stats['taux_activite'] }}%
                    </p>
                    <div class="flex items-center mt-1">
                        <div class="w-12 bg-gray-200 rounded-full h-1">
                            <div class="bg-purple-600 h-1 rounded-full" style="width: {{ $stats['taux_activite'] }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Croissance -->
        <div class="bg-white rounded-2xl shadow-sm p-6 card-hover border border-gray-100">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-gradient-to-br from-orange-500 to-orange-600">
                    <i class="bi bi-graph-up-arrow text-white text-lg"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Croissance</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['croissance'] }}%</p>
                    <div class="flex items-center mt-1">
                        <i class="bi bi-arrow-{{ $stats['croissance'] >= 0 ? 'up' : 'down' }} text-{{ $stats['croissance'] >= 0 ? 'green' : 'red' }}-500 text-xs mr-1"></i>
                        <span class="text-xs text-{{ $stats['croissance'] >= 0 ? 'green' : 'red' }}-600 font-medium">Ce mois</span>
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
                <h3 class="text-lg font-semibold text-gray-900">Activité de la Plateforme (30 derniers jours)</h3>
                <div class="flex space-x-2">
                    <button data-period="30" class="activity-period-btn px-3 py-1 text-xs font-medium bg-indigo-100 text-indigo-700 rounded-full">30j</button>
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
                        Voir tout <i class="bi bi-arrow-right"></i>
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
                        <i class="bi bi-people text-gray-400 text-4xl mx-auto"></i>
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
                        Voir tout <i class="bi bi-arrow-right"></i>
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
                                    <i class="bi bi-building text-white"></i>
                                    @break
                                @case('restaurant')
                                    <i class="bi bi-cup-hot text-white"></i>
                                    @break
                                @default
                                    <i class="bi bi-geo-alt text-white"></i>
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
                        <i class="bi bi-building text-gray-400 text-4xl mx-auto"></i>
                        <p class="mt-2 text-sm text-gray-500">Aucune infrastructure récente</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Données dynamiques passées depuis le contrôleur
const chartData = {
    activity: {
        labels: @json($chartData['activity']['labels']),
        datasets: [{
            label: 'Nouvelles Inscriptions',
            data: @json($chartData['activity']['inscriptions']),
            borderColor: 'rgb(99, 102, 241)',
            backgroundColor: 'rgba(99, 102, 241, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4
        }, {
            label: 'Infrastructures Ajoutées',
            data: @json($chartData['activity']['infrastructures']),
            borderColor: 'rgb(34, 197, 94)',
            backgroundColor: 'rgba(34, 197, 94, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4
        }]
    },
    infrastructure: {
        labels: @json($chartData['infrastructure_types']['labels']),
        datasets: [{
            data: @json($chartData['infrastructure_types']['data']),
            backgroundColor: [
                'rgb(59, 130, 246)',
                'rgb(34, 197, 94)',
                'rgb(251, 191, 36)',
                'rgb(168, 85, 247)',
                'rgb(239, 68, 68)'
            ],
            borderWidth: 0,
            cutout: '70%'
        }]
    }
};

// Activity Chart
let activityChart;
const initActivityChart = () => {
    const activityCtx = document.getElementById('activityChart').getContext('2d');
    activityChart = new Chart(activityCtx, {
        type: 'line',
        data: chartData.activity,
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
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        stepSize: 1
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
};

// Infrastructure Types Chart
const infraCtx = document.getElementById('infrastructureChart').getContext('2d');
new Chart(infraCtx, {
    type: 'doughnut',
    data: chartData.infrastructure,
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
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        const label = context.label || '';
                        const value = context.raw || 0;
                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                        const percentage = Math.round((value / total) * 100);
                        return `${label}: ${value} (${percentage}%)`;
                    }
                }
            }
        }
    }
});

// Initialisation du graphique d'activité
initActivityChart();

// Gestion du changement de période pour l'activité
document.querySelectorAll('.activity-period-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const period = this.getAttribute('data-period');
        
        // Mettre à jour le style des boutons
        document.querySelectorAll('.activity-period-btn').forEach(b => {
            b.classList.remove('bg-indigo-100', 'text-indigo-700');
            b.classList.add('text-gray-500', 'hover:bg-gray-100');
        });
        this.classList.add('bg-indigo-100', 'text-indigo-700');
        this.classList.remove('text-gray-500', 'hover:bg-gray-100');
        
        // Charger les nouvelles données (vous pouvez implémenter une requête AJAX ici)
        // Pour l'exemple, nous utilisons les mêmes données
        // En pratique, vous feriez:
        // fetch(`/admin/dashboard/chart-data?period=${period}`)
        //     .then(response => response.json())
        //     .then(data => {
        //         activityChart.data.labels = data.labels;
        //         activityChart.data.datasets[0].data = data.inscriptions;
        //         activityChart.data.datasets[1].data = data.infrastructures;
        //         activityChart.update();
        //     });
    });
});
</script>
@endpush