@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter un Lieu</h1>
    <form action="{{ route('lieux.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="ville" class="form-label">Ville</label>
            <input type="text" class="form-control" id="ville" name="ville" required>
        </div>
        <div class="mb-3">
            <label for="commune" class="form-label">Commune</label>
            <input type="text" class="form-control" id="commune" name="commune" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select class="form-select" id="type" name="type" required>
                <option value="Départ">Départ</option>
                <option value="Arrivée">Arrivée</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>
@endsection
