@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Liste des Paiements</h1>

    <table class="table table-bordered">
        <thead>
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
@endsection
