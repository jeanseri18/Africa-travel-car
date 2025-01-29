@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Liste des gares</h1>


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom Gare</th>
                    <th>Type Gare</th>
                    <th>Contact</th>
                    <th>Horaires Ouverture</th>
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
                       
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
