@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Modifier la Gare</h1>

        <form action="{{ route('societes.updateGare', ['gare_id' => $gare->id,'societe_id' => $societe->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nom_gare" class="form-label">Nom de la Gare</label>
                <input type="text" class="form-control" id="nom_gare" name="nom_gare" value="{{ old('nom_gare', $gare->nom_gare) }}" required>
            </div>

            <div class="mb-3">
                <label for="type_gare" class="form-label">Type de Gare</label>
                <select name="type_gare" id="type_gare" class="form-select" required>
                    <option value="Départ" {{ $gare->type_gare == 'Départ' ? 'selected' : '' }}>Départ</option>
                    <option value="Arrivée" {{ $gare->type_gare == 'Arrivée' ? 'selected' : '' }}>Arrivée</option>
                    <option value="Mixte" {{ $gare->type_gare == 'Mixte' ? 'selected' : '' }}>Mixte</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="latitude" class="form-label">Latitude</label>
                <input type="text" class="form-control" id="latitude" name="latitude" value="{{ old('latitude', $gare->latitude) }}">
            </div>

            <div class="mb-3">
                <label for="longitude" class="form-label">Longitude</label>
                <input type="text" class="form-control" id="longitude" name="longitude" value="{{ old('longitude', $gare->longitude) }}">
            </div>

            <div class="mb-3">
                <label for="contact" class="form-label">Contact</label>
                <input type="text" class="form-control" id="contact" name="contact" value="{{ old('contact', $gare->contact) }}">
            </div>

            <h5 class="mb-3">Horaires d'Ouverture</h5>
            <div class="row">
                @foreach(['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'] as $day)
                    <div class="col-md-4 mb-3">
                        <label for="{{ $day }}_start" class="form-label">{{ ucfirst($day) }} (Heure Début)</label>
                        <input type="time" class="form-control" id="{{ $day }}_start" name="horaires_ouverture[{{ $day }}][start]" 
                            value="{{ old('horaires_ouverture.' . $day . '.start', $gare->horaires_ouverture[$day]['start'] ?? '') }}">

                        <label for="{{ $day }}_end" class="form-label">  (Heure Fin)</label>
                        <input type="time" class="form-control" id="{{ $day }}_end" name="horaires_ouverture[{{ $day }}][end]" 
                            value="{{ old('horaires_ouverture.' . $day . '.end', $gare->horaires_ouverture[$day]['end'] ?? '') }}">
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
@endsection
