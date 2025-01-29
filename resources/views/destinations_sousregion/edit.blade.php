@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier la Destination Sous region</h1>
    
    <form action="{{ route('destinations_sousregion.update', $destination->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Société -->
        <div class="mb-3">
            <label for="societe_id" class="form-label">Société de transport</label>
            <select name="societe_id" id="societe_id" class="form-select" required>
                @foreach ($societes as $societe)
                    <option value="{{ $societe->id }}" {{ $destination->societe_id == $societe->id ? 'selected' : '' }}>
                        {{ $societe->nom_commercial }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Gare de départ -->
        <div class="mb-3">
            <label for="gare_depart" class="form-label">Gare de Départ</label>
            <select name="gare_depart" id="gare_depart" class="form-select" required>
                <option value="{{ $destination->gare_depart }}">{{ $destination->gare_depart }}</option>
            </select>
        </div>

        <!-- Lieu de départ -->
        <div class="mb-3">
            <label for="depart" class="form-label">Lieu de Départ</label>
            <select name="depart" id="depart" class="form-select" required>
                @foreach ($lieux as $lieu)
                    <option value="{{ $lieu->id }}" {{ $destination->depart == $lieu->id ? 'selected' : '' }}>
                        {{ $lieu->ville }} - {{ $lieu->commune }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Lieu d’arrivée -->
        <div class="mb-3">
            <label for="arrivé" class="form-label">Lieu d’Arrivée</label>
            <select name="arrive" id="arrivé" class="form-select" required>
                @foreach ($lieux as $lieu)
                    <option value="{{ $lieu->id }}" {{ $destination->arrivé == $lieu->id ? 'selected' : '' }}>
                        {{ $lieu->ville }} - {{ $lieu->commune }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tarif Unitaire -->
        <div class="mb-3">
            <label for="tarif_unitaire" class="form-label">Tarif Unitaire</label>
            <input type="number" step="0.01" name="tarif_unitaire" id="tarif_unitaire" class="form-control" value="{{ $destination->tarif_unitaire }}" required>
        </div>

        <!-- Premier départ -->
        <div class="mb-3">
            <label for="premier_depart" class="form-label">Premier Départ</label>
            <input type="time" name="premier_depart" id="premier_depart" class="form-control" value="{{ old('premier_depart', $destination->premier_depart) }}" required>
        </div>

        <!-- Dernier départ -->
        <div class="mb-3">
            <label for="dernier_depart" class="form-label">Dernier Départ</label>
            <input type="time" name="dernier_depart" id="dernier_depart" class="form-control" value="{{ old('dernier_depart', $destination->dernier_depart) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>

<script>
    document.getElementById('societe_id').addEventListener('change', function () {
        const societeId = this.value;
        const gareSelect = document.getElementById('gare_depart');
        const departSelect = document.getElementById('depart');
        const arriveSelect = document.getElementById('arrivé');

        // Réinitialise les options
        gareSelect.innerHTML = '<option value="">Sélectionnez une gare</option>';
        departSelect.innerHTML = '<option value="">Sélectionnez un lieu de départ</option>';
        arriveSelect.innerHTML = '<option value="">Sélectionnez un lieu d\'arrivée</option>';

        if (societeId) {
            // Récupérer les gares pour la société
            fetch(`/societes-gare/${societeId}/gares`)
                .then(response => response.json())
                .then(gares => {
                    gares.forEach(gare => {
                        const option = document.createElement('option');
                        option.value = gare.id;
                        option.textContent = gare.nom_gare;
                        gareSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Erreur lors de la récupération des gares :', error));
        }
    });

// Lorsque la gare de départ est sélectionnée
document.getElementById('gare_depart').addEventListener('change', function () {
        const gareId = this.value;
        const departSelect = document.getElementById('depart');
        const arriveSelect = document.getElementById('arrive');

        // Réinitialiser les options
        departSelect.innerHTML = '<option value="">Sélectionnez un lieu de départ</option>';
        arriveSelect.innerHTML = '<option value="">Sélectionnez un lieu d\'arrivée</option>';

        if (gareId) {
            // Récupérer les lieux de départ associés à la gare sélectionnée
            fetch(`/gares-lieux/`)
                .then(response => response.json())
                .then(lieux => {
                    lieux.depart.forEach(lieu => {
                        const option = document.createElement('option');
                        option.value = lieu.id;
                        option.textContent = lieu.ville + ' - ' + lieu.commune;
                        departSelect.appendChild(option);
                    });
                    lieux.arrive.forEach(lieu => {
                        const option = document.createElement('option');
                        option.value = lieu.id;
                        option.textContent = lieu.ville + ' - ' + lieu.commune;
                        arriveSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Erreur lors de la récupération des lieux :', error));
        }
    });
@endsection
