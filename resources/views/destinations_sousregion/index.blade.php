@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h1 class="mb-4">Liste des Destinations Sous region</h1>
            </div>
            <div class="col-md-3">

                <a href="{{ route('destinations_sousregion.create') }}" class="btn btn-primary mb-3">Ajouter une
                    Destination</a>
            </div>
        </div>
        <br>

        <div class="card custom-card">
            <div class="card-body">
                <table id="Table" class="table table-bordered table-striped">
                    <thead>
                        <tr>

                            <th>#</th>
                            <th>Société</th>
                            <th>Gare de Départ</th>
                            <th>Depart</th>
                            <th>Arrivé</th>
                            <th>Tarif Unitaire</th>
                            <th>Premier Départ</th>
                            <th>Dernier Départ</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($destinations as $destination)
                        <tr>
                            <td>{{ $destination->id }}</td>
                            <td>{{ $destination->societe->nom_commercial ?? 'Non spécifié' }}</td>
                            <td>{{ $destination->gare_depart }}</td>
                            <td>
                                @if ($destination->lieuDepart)
                                {{ $destination->lieuDepart->ville }} - {{ $destination->lieuDepart->commune }}
                                @else
                                Non spécifié
                                @endif
                            </td>
                            <td>
                                @if ($destination->lieuArrive)
                                {{ $destination->lieuArrive->ville }} - {{ $destination->lieuArrive->commune }}
                                @else
                                Non spécifié
                                @endif
                            </td>
                            <td>{{ $destination->tarif_unitaire }} CFA</td>
                            <td>{{ $destination->premier_depart }}</td>
                            <td>{{ $destination->dernier_depart }}</td>
                            <td>
                                <a href="{{ route('destinations_sousregion.edit', $destination->id) }}"
                                    class="btn btn-warning btn-sm">Modifier</a>
                                <form action="{{ route('destinations_sousregion.destroy', $destination->id) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <style>
    .custom-card {
        border: 2px dashed #1088F2;
        /* Bordure avec traits */
        border-radius: 8px;
        /* Coins arrondis */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Légère ombre */
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .custom-card:hover {
        transform: translateY(-5px);
        /* Animation au survol */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        /* Ombre plus marquée */
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px dashed #ddd;
        /* Bordure en traits pour le tableau */
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
    <link
        href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/r-3.0.3/datatables.min.css"
        rel="stylesheet">
    @endpush

    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/r-3.0.3/datatables.min.js">
    </script>
    <script>
    $(document).ready(function() {
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