@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des Utilisateurs</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary">Créer un utilisateur</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->nom }} {{ $user->prenom }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->type }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Modifier</a>

                        @if($user->type === 'Sous-Traitant')
                            <a href="{{ route('sous_traitant_gares.index', $user->id) }}" class="btn btn-info btn-sm">Voir les Gares</a>
                        @endif

                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
