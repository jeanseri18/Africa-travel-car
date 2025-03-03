@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Liste des Réservations</h1>
        
        <div class="card custom-card">
        <div class="card-body">
        <table id="Table" class="table table-bordered table-striped">            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom Voyageur</th>
                    <th>Nom Société</th>
                    <th>Gare Départ</th>
                    <th>Lieu Embarquement</th>
                    <th>Destination</th>
                    <th>Date Départ</th>
                    <th>Heure Départ</th>
                    <th>Assurance</th>

                    <th>Tarif Unitaire</th>
                    <th>Total Payé</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->id }}</td>
                        <td>{{ $reservation->voyageur->name }}</td>
                        <td>{{ $reservation->societe->nom }}</td>
                        <td>{{ $reservation->gare_depart }}</td>
                        <td>{{ $reservation->lieu_embarquement }}</td>
                        <td>{{ $reservation->destination }}</td>
                        <td>{{ $reservation->date_depart }}</td>
                        <td>{{ $reservation->heure_depart }}</td>
                        <td>{{ $reservation->assurance }}</td>
                        <td>{{ $reservation->tarif_unitaire }}CFA</td>
                        <td>{{ $reservation->total_paye }}CFA</td>
                        <td>{{ $reservation->statut }}</td>
                        <td>
                            <!-- Ajoutez des boutons pour les actions -->
                            <a href="{{ route('reservations.show', $reservation->id) }}" class="btn btn-info btn-sm">Voir</a>
                        </td>
                    </tr>
                @endforeach
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