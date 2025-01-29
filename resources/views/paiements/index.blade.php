@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
    <div class="col-md-9">
    <h1 class="mb-4">Liste des Paiements</h1>
    </div>
    <div  class="col-md-3">

    <a href="{{ route('destinations_national.create') }}" class="btn btn-primary mb-3">Ajouter une Destination</a>
</div>    </div>

<br>

<div class="card custom-card">
        <div class="card-body">
        <table id="Table" class="table table-bordered table-striped">        <thead>
            <tr>
                <th>#</th>
                <th>Réservation ID</th>
                <th>Montant</th>
                <th>Mode de Paiement</th>
                <th>Date de Paiement</th>
                <th>Référence Transaction</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($paiements as $paiement)
                <tr>
                    <td>{{ $paiement->id }}</td>
                    <td>{{ $paiement->reservation_id }}</td>
                    <td>{{ $paiement->montant }}</td>
                    <td>{{ $paiement->mode_paiement }}</td>
                    <td>{{ $paiement->date_paiement }}</td>
                    <td>{{ $paiement->reference_transaction }}</td>
                    <td>
                        <span class="badge 
                            @if($paiement->statut == 'Effectué') bg-success 
                            @elseif($paiement->statut == 'En attente') bg-warning 
                            @else bg-danger 
                            @endif">
                            {{ $paiement->statut }}
                        </span>
                    </td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm">Voir</a>
                        <a href="#" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="#" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Aucun paiement trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<style>
    .custom-card {
        border: 2px dashed #1088F2; /* Bordure avec traits */
        border-radius: 8px; /* Coins arrondis */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Légère ombre */
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .custom-card:hover {
        transform: translateY(-5px); /* Animation au survol */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Ombre plus marquée */
    }

    .table-bordered th, .table-bordered td {
        border: 1px dashed #ddd; /* Bordure en traits pour le tableau */
    }

    .btn-success {
        background-color: #1088F2;
        border-color: #1088F2;
    }

    .btn-success:hover {
        background-color: #026838;
        border-color: #026838;
    }
</style>
@endsection


@push('styles')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/r-3.0.3/datatables.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/r-3.0.3/datatables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#Table').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
            }
        });
    });
</script>
@endpush
