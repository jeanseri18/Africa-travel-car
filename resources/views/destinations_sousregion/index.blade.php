@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Liste des Destinations Sous region</h1>

    <a href="{{ route('destinations_sousregion.create') }}" class="btn btn-primary mb-3">Ajouter une Destination</a>

    <table class="table table-bordered">
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
            @forelse($destinations as $destination)
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
                        <a href="{{ route('destinations_sousregion.edit', $destination->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('destinations_sousregion.destroy', $destination->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Aucune destination trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
