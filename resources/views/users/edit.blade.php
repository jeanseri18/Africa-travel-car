@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier un utilisateur</h2>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" value="{{ $user->nom }}" required>
        </div>
        <div class="mb-3">
            <label>Prénom</label>
            <input type="text" name="prenom" class="form-control" value="{{ $user->prenom }}">
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>
        <div class="mb-3">
            <label>Type</label>
            <select name="type" class="form-control" required>
                <option value="Administrateur" {{ $user->type == 'Administrateur' ? 'selected' : '' }}>Administrateur</option>
                <option value="Sous-Traitant" {{ $user->type == 'Sous-Traitant' ? 'selected' : '' }}>Sous-Traitant</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Mettre à jour</button>
    </form>
</div>
@endsection
