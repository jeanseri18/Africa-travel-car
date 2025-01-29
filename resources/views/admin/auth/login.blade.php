@extends('layouts.auth')

@section('content')

@section('title', 'Connexion | Africa Travel Car')

<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-4">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h2 class="text-center mb-4">Connexion <br> Administrateur</h2>
                    <form method="POST" action="{{ route('admin.login') }}">
                        @csrf
                        
                        <!-- Email Field -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email :</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Password Field -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe :</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn " style="background-color:#1088F2;color:white;">Se connecter</button>
                        </div>
                    </form>
                    
                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="alert alert-danger mt-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
    <style>
      

        .card {
            border-radius: 10px;
            padding: 30px;
        }

        .btn-primary {
            background-color: #0A91EA;
            border-color: #0A91EA;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
@endsection
