@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Liste des Lieux</h1>
    <a href="{{ route('lieux.create') }}" class="btn btn-primary mb-3">Ajouter un Lieu</a>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ville</th>
                <th>Commune</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lieux as $lieu)
                <tr>
                    <td>{{ $lieu->id }}</td>
                    <td>{{ $lieu->ville }}</td>
                    <td>{{ $lieu->commune }}</td>
                    <td>{{ $lieu->type }}</td>
                    <td>
                        <a href="{{ route('lieux.edit', $lieu->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('lieux.destroy', $lieu->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Aucun lieu disponible.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
