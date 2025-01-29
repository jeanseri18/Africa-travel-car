@extends('layouts.public')

<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

<style>
/* Effet pour la section */
.bg-slide3 {
    background: linear-gradient(to right, #011E314F, #0A91EA), url('{{ asset('assets/hombg.jpg') }}') no-repeat right;
    background-size: cover;
    background-position: right;
    height: 700px;
    padding: 20px;
    animation: fadeIn 2s ease-in-out;
    transition: transform 0.5s ease, filter 0.5s ease;
}

.bg-slide3:hover {
    transform: scale(1.02); /* Agrandissement léger */
    filter: brightness(1.1); /* Augmente la luminosité */
}

/* Animation fadeIn */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Styles des cartes */
.cards {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    min-height: 320px;
}

.cards:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    border-color: #A51916;
    background-color: #A518162A; /* Fond clair */
    color: black;
}

/* Icônes personnalisées */
.custom-icon {
    font-size: 3rem;
}

.icon-circle {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background-color: #A51916;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    color: white;
}

/* Bouton avec effets */
.btn-primary {
    transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
}

.btn-primary:hover {
    background-color: #0056b3;
    transform: translateY(-3px);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
}

.btn-primary:active {
    transform: scale(0.95);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
}

/* Conteneur */
.container-custom {
    max-width: 2000px;
    margin: 0 auto;
}
</style>

@section('content')

@section('title', 'Welcome | Africa Travel Car')

<section class="bg-slide3">
    <div class="container-custom row h-100 align-items-center justify-content-left" style="margin-left:40px;margin-right:40px">
        <div class="col-xl-11 col-lg-11 text-left">
            <h1 class="text-white" style="font-size: 100px; margin-right: 160px;">Bienvenue sur Africa Travel Car</h1>
            <p class="fs-3 text-white mb-4">Votre solution pour voyager partout en Côte d'Ivoire et au-delà, facilement et rapidement.</p>
            <a class="btn btn-primary btn-sm" href="#">Commencez dès maintenant</a>
        </div>
    </div>
</section>

<!-- Section: Votre solution pour voyager -->
<section class="py-5" tyle="margin-left:40px;margin-right:40px">
    <div class="container">
        <h1 class="text-center mb-1">Votre Solution pour Voyager Partout en Côte d'Ivoire</h1>
        <p class="text-center fs-5">Africa Travel Car vous offre la meilleure expérience de voyage à travers toute la Côte d'Ivoire. Avec des solutions simples et sécurisées, vous pouvez réserver vos tickets facilement et profiter d'un service de transport fiable.</p>
        <div class="text-center">
            <a href="#" class="btn btn-primary btn-sm mt-1">Télécharger l'application</a>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-3">
                <img src="{{ asset('assets/sousregion.jpg') }}" height="300px" class="img-fluid rounded" alt="Transport en Afrique">
            </div>
            <div class="col-md-3">
                <img src="{{ asset('assets/sousregion.jpg') }}" height="500px" class="img-fluid rounded" alt="Transport en Afrique">
            </div>
            <div class="col-md-3">
                <img src="{{ asset('assets/sousregion.jpg') }}" height="300px" class="img-fluid rounded" alt="Transport en Afrique">
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</section>

<!-- Section: Réservez facilement votre ticket -->
<section class="bg-primary py-5" style="height: 400px; color: white;">
    <div class="container" tyle="margin-left:40px;margin-right:40px">
        <h1 class="text-center text-white mb-4">Réservez Facilement Votre Ticket</h1>
        <p class="text-center fs-5">Grâce à notre plateforme intuitive, réservez vos tickets en quelques clics seulement. Choisissez votre destination, sélectionnez votre transport et effectuez votre paiement en toute sécurité.</p>
    </div>
</section>

<!-- Section: Facilitez votre voyage dans la sous-région -->
<section class="py-5" tyle="margin-left:40px;margin-right:40px">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('assets/sousregion.jpg') }}" width="300px" class=" w-100 rounded" alt="Transport en Afrique">
            </div>
            <div class="col-md-6 align-items-center justify-content-center">
                <h5 class="text-left">Facilitez Votre Voyage dans la Sous-Région</h5>
                <h1>Voyagez avec Confort et Sécurité</h1>
                <p>Notre service vous permet de voyager confortablement et en toute sécurité. Avec nos partenaires de transport fiables et des horaires flexibles, vous êtes sûr d'arriver à destination dans les meilleures conditions.</p>
            </div>
        </div>
    </div>
</section>

@endsection
