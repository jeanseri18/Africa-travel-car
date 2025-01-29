@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Gares de la Société</h1>

        <a href="{{ route('societes.createGare', $societe_id) }}" class="btn btn-primary mb-3">Ajouter une Gare</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom Gare</th>
                    <th>Type Gare</th>
                    <th>Contact</th>
                    <th>Horaires Ouverture</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($gares as $gare)
                    <tr>
                        <td>{{ $gare->id }}</td>
                        <td>{{ $gare->nom_gare }}</td>
                        <td>{{ $gare->type_gare }}</td>
                        <td>{{ $gare->contact }}</td>
                        <td>
                            @if ($gare->horaires_ouverture)
                                <ul>
                                    @foreach (json_decode($gare->horaires_ouverture, true) as $day => $times)
                                        <li>
                                            <strong>{{ ucfirst($day) }}</strong>: 
                                            {{ $times['start'] ?? 'Fermé' }} - {{ $times['end'] ?? 'Fermé' }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                Non défini
                            @endif
                        </td>
                        <td>
                            <!-- Actions pour modifier et supprimer la gare -->
                            <a href="{{ route('societes.editGare', ['societe_id' => $societe_id, 'gare_id' => $gare->id]) }}" class="btn btn-sm btn-warning">Modifier</a>
                            <form action="{{ route('societes.deleteGare', ['societe_id' => $societe_id, 'gare_id' => $gare->id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette gare ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
