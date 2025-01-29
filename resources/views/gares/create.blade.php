@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Ajouter une Gare pour la Société</h1>

        <form action="{{ route('societes.storeGare', $societe_id) }}" method="POST">
            @csrf

            <!-- Nom de la Gare -->
            <div class="mb-3">
                <label for="nom_gare" class="form-label">Nom de la Gare</label>
                <input type="text" class="form-control @error('nom_gare') is-invalid @enderror" id="nom_gare" name="nom_gare" value="{{ old('nom_gare') }}" required>
                @error('nom_gare')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Type de Gare -->
            <div class="mb-3">
                <label for="type_gare" class="form-label">Type de Gare</label>
                <select name="type_gare" id="type_gare" class="form-control @error('type_gare') is-invalid @enderror" required>
                    <option value="Départ" {{ old('type_gare') == 'Départ' ? 'selected' : '' }}>Départ</option>
                    <option value="Arrivée" {{ old('type_gare') == 'Arrivée' ? 'selected' : '' }}>Arrivée</option>
                    <option value="Mixte" {{ old('type_gare') == 'Mixte' ? 'selected' : '' }}>Mixte</option>
                </select>
                @error('type_gare')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Type de Destination -->
            <div class="mb-3">
                <label for="type_destination" class="form-label">Type de Destination</label>
                <select name="type_destination" id="type_destination" class="form-control @error('type_destination') is-invalid @enderror" required>
                    <option value="nation" {{ old('type_destination') == 'nation' ? 'selected' : '' }}>Nation</option>
                    <option value="sous region" {{ old('type_destination') == 'sous region' ? 'selected' : '' }}>Sous Région</option>
                </select>
                @error('type_destination')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Ville -->
            <div class="mb-3">
                <label for="ville" class="form-label">Ville</label>
                <input type="text" class="form-control @error('ville') is-invalid @enderror" id="ville" name="ville" value="{{ old('ville') }}" required>
                @error('ville')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Commune -->
            <div class="mb-3">
                <label for="commune" class="form-label">Commune</label>
                <input type="text" class="form-control @error('commune') is-invalid @enderror" id="commune" name="commune" value="{{ old('commune') }}" required>
                @error('commune')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Quartier -->
            <div class="mb-3">
                <label for="quartier" class="form-label">Quartier</label>
                <input type="text" class="form-control @error('quartier') is-invalid @enderror" id="quartier" name="quartier" value="{{ old('quartier') }}" required>
                @error('quartier')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Latitude -->
            <div class="mb-3">
                <label for="latitude" class="form-label">Latitude</label>
                <input type="text" class="form-control @error('latitude') is-invalid @enderror" id="latitude" name="latitude" value="{{ old('latitude') }}">
                @error('latitude')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Longitude -->
            <div class="mb-3">
                <label for="longitude" class="form-label">Longitude</label>
                <input type="text" class="form-control @error('longitude') is-invalid @enderror" id="longitude" name="longitude" value="{{ old('longitude') }}">
                @error('longitude')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Horaires d'Ouverture -->
            <div class="mb-3">
                <label for="horaires_ouverture" class="form-label">Horaires d'Ouverture</label>

                @php
                    $days = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
                @endphp

                @foreach ($days as $day)
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <label for="{{ $day }}" class="form-label text-capitalize">{{ ucfirst($day) }}</label>
                        </div>
                        <div class="col-md-4">
                            <input type="time" class="form-control" id="{{ $day }}_start" name="horaires_ouverture[{{ $day }}][start]" placeholder="Ouverture">
                        </div>
                        <div class="col-md-4">
                            <input type="time" class="form-control" id="{{ $day }}_end" name="horaires_ouverture[{{ $day }}][end]" placeholder="Fermeture">
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Contact -->
            <div class="mb-3">
                <label for="contact" class="form-label">Contact</label>
                <input type="text" class="form-control" id="contact" name="contact" value="{{ old('contact') }}">
            </div>

            <!-- Submit Button -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Enregistrer la Gare</button>
            </div>
        </form>
    </div>
@endsection
