<!-- resources/views/dashboard/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tableau de Bord</h2>

    <!-- Statistiques -->
    <div class="row">
        <!-- Réservations Totales -->
        <div class="col-md-4">
            <div class="card text-white mb-3" style="background-color:#FF513A">
                <div class="card-header">
                    <i class="bi bi-card-checklist"></i> Réservations Totales
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{ $totalReservations }}</h4>
                </div>
            </div>
        </div>

        <!-- Réservations du Mois -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">
                    <i class="bi bi-calendar-check"></i> Réservations du Mois
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{ $monthlyReservations }}</h4>
                </div>
            </div>
        </div>

        <!-- Réservations de l'Année -->
        <div class="col-md-4">
            <div class="card text-white mb-3" style="background-color:orange">
                <div class="card-header">
                    <i class="bi bi-calendar-year"></i> Réservations de l'Année
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{ $yearlyReservations }}</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Total payé -->
    <div class="row">
        <!-- Total Payé -->
        <div class="col-md-4">
            <div class="card text-white mb-3" style="background-color:#FF513A">
                <div class="card-header">
                    <i class="bi bi-wallet2"></i> Total Payé
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{ number_format($totalPaid, 2) }} CFA</h4>
                </div>
            </div>
        </div>

        <!-- Total Payé ce Mois -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">
                    <i class="bi bi-wallet"></i> Total Payé ce Mois
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{ number_format($monthlyPaid, 2) }} CFA</h4>
                </div>
            </div>
        </div>

        <!-- Total Payé cette Année -->
        <div class="col-md-4">
            <div class="card text-white mb-3" style="background-color:orange">
                <div class="card-header">
                    <i class="bi bi-wallet2"></i> Total Payé cette Année
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{ number_format($yearlyPaid, 2) }} CFA</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphique des Réservations Mensuelles -->
    <h3 class="mt-5">Graphique des Réservations Mensuelles</h3>
    <canvas id="reservationsChart"></canvas>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('reservationsChart').getContext('2d');
    var reservationsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($monthlyLabels), // les mois de l'année
            datasets: [{
                label: 'Réservations',
                data: @json($monthlyData), // les données des réservations
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1,
                fill: false
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.raw + ' réservations';
                        }
                    }
                }
            }
        }
    });
</script>
@endpush
