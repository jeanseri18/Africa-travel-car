@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Liste des Réservations</h1>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom Voyageur</th>
                    <th>Nom Société</th>
                    <th>Gare Départ</th>
                    <th>Lieu Embarquement</th>
                    <th>Destination</th>
                    <th>Date Départ</th>
                    <th>Heure Départ</th>
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
                        <td>{{ $reservation->tarif_unitaire }}€</td>
                        <td>{{ $reservation->total_paye }}€</td>
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
@endsection
