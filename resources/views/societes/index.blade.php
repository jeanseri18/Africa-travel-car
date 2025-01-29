@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Liste des Sociétés de Transport</h1>

        <a href="{{ route('societes.create') }}" class="btn btn-primary mb-3">Ajouter une Société</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom Commercial</th>
                    <th>Date de Création</th>
                    <th>Responsable Marketing</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($societes as $societe)
                    <tr>
                        <td>{{ $societe->id }}</td>
                        <td>{{ $societe->nom_commercial }}</td>
                        <td>{{ $societe->date_creation }}</td>
                        <td>{{ $societe->responsable_marketing }}</td>
                        <td>
                            <a href="{{ route('societes.edit', $societe->id) }}" class="btn btn-warning">Modifier</a>
                            <a href="{{ route('societes.gares', $societe->id) }}" class="btn btn-info">Voir les Gares</a>
                            <form action="{{ route('societes.destroy', $societe->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
