<html>
    <head>
    @vite('resources/css/home/NavBarStyle.css')

    @vite('resources/css/home/SettingsStyle.css')
    @vite('resources/css/app.css')

    </head>
    <body>
    @extends('layouts.NavBar')
    @section('title', 'Accueil')

    @section('content')

    <div class="settings-container">
        <h1>Paramètres</h1>
        <label for="dark-mode-toggle">Mode sombre :</label>
        <input type="checkbox" id="dark-mode-toggle">
   


    <div class="contact-form-container">
        <form id="contact-form" method="post" action="/send-email">
            @csrf
            <h2>Contactez-nous</h2>
            <div class="form-group">
                <label for="name">Nom:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="subject">Objet:</label>
                <input type="text" id="subject" name="Objet" required>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Envoyer</button>
            </div>
        </form>
    </div>
    </div>
    

    @endsection
    @vite('resources/js/scriptTools.js')
    </body>
</html>