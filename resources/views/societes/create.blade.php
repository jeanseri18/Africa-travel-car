@extends('layouts.app')

@section('content')

@section('title', 'Créer une Société de Transport')

<div class="container ">
    <div class="row ">
        <div class="col-md-8">
        <h3>Créer une Société de Transport</h3>

            <div class="">
              
                <div class="">
                    <form method="POST" action="{{ route('societes.store') }}">
                        @csrf
                        
                        <!-- Nom Commercial -->
                        <div class="mb-3">
                            <label for="nom_commercial" class="form-label">Nom Commercial :</label>
                            <input type="text" class="form-control @error('nom_commercial') is-invalid @enderror" 
                                   name="nom_commercial" id="nom_commercial" value="{{ old('nom_commercial') }}" required>
                            @error('nom_commercial')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Date de Création -->
                        <div class="mb-3">
                            <label for="date_creation" class="form-label">Date de Création :</label>
                            <input type="date" class="form-control @error('date_creation') is-invalid @enderror" 
                                   name="date_creation" id="date_creation" value="{{ old('date_creation') }}" required>
                            @error('date_creation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Siège Social -->
                        <div class="mb-3">
                            <label for="siege_social" class="form-label">Siège Social :</label>
                            <input type="text" class="form-control @error('siege_social') is-invalid @enderror" 
                                   name="siege_social" id="siege_social" value="{{ old('siege_social') }}" required>
                            @error('siege_social')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Responsable Marketing -->
                        <div class="mb-3">
                            <label for="responsable_marketing" class="form-label">Responsable Marketing :</label>
                            <input type="text" class="form-control @error('responsable_marketing') is-invalid @enderror" 
                                   name="responsable_marketing" id="responsable_marketing" value="{{ old('responsable_marketing') }}" required>
                            @error('responsable_marketing')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Contact Téléphone -->
                        <div class="mb-3">
                            <label for="contact_telephone" class="form-label">Contact Téléphone :</label>
                            <input type="text" class="form-control @error('contact_telephone') is-invalid @enderror" 
                                   name="contact_telephone" id="contact_telephone" value="{{ old('contact_telephone') }}" required>
                            @error('contact_telephone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- WhatsApp -->
                        <div class="mb-3">
                            <label for="whatsapp" class="form-label">WhatsApp :</label>
                            <input type="text" class="form-control @error('whatsapp') is-invalid @enderror" 
                                   name="whatsapp" id="whatsapp" value="{{ old('whatsapp') }}" required>
                            @error('whatsapp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email :</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" id="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Nombre de Gares -->
                        <div class="mb-3">
                            <label for="nombre_gares" class="form-label">Nombre de Gares :</label>
                            <input type="number" class="form-control @error('nombre_gares') is-invalid @enderror" 
                                   name="nombre_gares" id="nombre_gares" value="{{ old('nombre_gares') }}" required>
                            @error('nombre_gares')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Sites de Gares -->
                        <div class="mb-3">
                            <label for="sites_gares" class="form-label">Sites de Gares (JSON) :</label>
                            <textarea class="form-control @error('sites_gares') is-invalid @enderror" 
                                      name="sites_gares" id="sites_gares" rows="3">{{ old('sites_gares') }}</textarea>
                            @error('sites_gares')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Enregistrer la Société</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
