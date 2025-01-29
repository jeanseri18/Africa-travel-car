@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier le Lieu</h1>
    <form action="{{ route('lieux.update', $lieu->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="ville" class="form-label">Ville</label>
            <input type="text" class="form-control" id="ville" name="ville" value="{{ $lieu->ville }}" required>
        </div>
        <div class="mb-3">
            <label for="commune" class="form-label">Commune</label>
            <input type="text" class="form-control" id="commune" name="commune" value="{{ $lieu->commune }}" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select class="form-select" id="type" name="type" required>
                <option value="Départ" {{ $lieu->type == 'Départ' ? 'selected' : '' }}>Départ</option>
                <option value="Arrivée" {{ $lieu->type == 'Arrivée' ? 'selected' : '' }}>Arrivée</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
