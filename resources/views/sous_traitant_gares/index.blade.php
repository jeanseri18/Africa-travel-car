@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Gares attribuées à {{ $sousTraitant->nom }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Formulaire pour attribuer des gares -->
    <h3>Attribuer des nouvelles gares</h3>
    <form action="{{ route('sous_traitant_gares.store') }}" method="POST">
        @csrf
        <input type="hidden" name="sous_traitants[]" value="{{ $sousTraitant->id }}">
        <div class="form-group">
            <label for="gares">Sélectionner des gares :</label>
            <select name="gares[]" id="gares" class="form-control" multiple>
                @foreach ($gares as $gare)
                    <option value="{{ $gare->id }}">{{ $gare->nom_gare }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Attribuer</button>
    </form>

    <!-- Tableau des gares attribuées -->
    <h3 class="mt-5">Liste des Gares attribuées</h3>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nom de la Gare</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sousTraitant->gares as $gare)
                <tr>
                    <td>{{ $gare->nom_gare }}</td>
                    <td>
                        <form action="{{ route('sous_traitant_gares.destroy', [$sousTraitant->id, $gare->id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Retirer cette gare ?')">Retirer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
