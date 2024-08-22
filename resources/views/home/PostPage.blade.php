<html>
    <head>
    @vite('resources/css/home/NavBarStyle.css')

    @vite('resources/css/home/HomeConnectedStyle.css')
    @vite('resources/css/app.css')

    </head>
    <body>
    @extends('layouts.NavBar')
    @section('title', 'Accueil')

    @section('content')

<div class="tweet">
    <div class="tweet-header">
        <img src="{{ asset('images/profile-icon.png') }}" alt="User 1" class="avatar">
        <span class="username">User 1</span>
    </div>
    <p class="tweet-text">Ceci est un exemple de tweet.</p>
</div>
<div class="tweet">
    <div class="tweet-header">
        <img src="{{ asset('images/profile-icon.png') }}" alt="User 2" class="avatar">
        <span class="username">User 2</span>
    </div>
    <p class="tweet-text">Voici un autre exemple de tweet.</p>
</div>
<!-- Ajoutez plus de tweets ici -->
@endsection
@vite('resources/js/scriptPost.js')

    </body>
</html>