<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register</title>
</head>
<body>
    <h1>Créer un compte administrateur</h1>
    <form method="POST" action="{{ route('admin.register') }}">
        @csrf
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required>
        <br>
        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom">
        <br>
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="contact_telephone">Téléphone :</label>
        <input type="text" name="contact_telephone" id="contact_telephone" required>
        <br>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required>
        <br>
        <label for="password_confirmation">Confirmez le mot de passe :</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
        <br>
        <button type="submit">Créer le compte</button>
    </form>
    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
</body>
</html>
