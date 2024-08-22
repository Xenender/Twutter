





<html>
    <head>
    @vite('resources/css/home/NavBarStyle.css')
    @vite('resources/css/home/ProfilStyle.css')
    @vite('resources/css/home/tweetStyle.css')
    @vite('resources/css/app.css')



    </head>
    <body>
    @extends('layouts.NavBar')
    @section('title', 'Accueil')

    @section('content')
    @vite('resources/js/scriptPost.js')
    <div class="profile-container">
        <div class="profile-header">
            <img src="{{ asset('images/dark/profile-iconDark.png') }}" alt="Photo de profil" class="profile-photo">
            <div class="profile-info">
                <h1 class="username">{{$user->username}}</h1>
                <p class="bio">Ceci est une bio exemple. Elle peut contenir des informations sur l'utilisateur.</p>
                <button class="edit-profile-btn">Éditer le profil</button>
            </div>
        </div>
      
        <div class="tweets">
        <div  id="titrePost"> <h2>Posts</h2></div>
            @foreach($postsUser as $post)
            <div class="tweet" data-post-id="{{ $post->idpost }}">
        <div class="tweet-header">
            <img src="{{ asset('images/profile-icon.png') }}" alt="User 1" class="avatar">
            <span class="username">{{$user->username}}</span>
            <div class="dropdown">
                <button class="dropbtn">⋮</button>
                <div class="dropdown-content">
                    <button class="edit-button" data-post-id="{{$post->idpost}}">Editer</button>
                    <button class="delete-button" data-post-id="{{$post->idpost}}">Supprimer</button>
                </div>
            </div>
        </div>
        <pre class="tweet-text">{{$post->text}} </pre>
        <p class="tweet-date">{{$post->date}}</p>
        
        <div class="tweet-actions">
            <button class="like-button" data-post-id="{{$post->idpost}}"> <img id="like-image{{$post->idpost}}" src="{{ asset('images/like.png') }}" alt="Like" class="icon"></button>
            <button class="dislike-button" data-post-id="{{$post->idpost}}"> <img id="dislike-image{{$post->idpost}}" src="{{ asset('images/dislike.png') }}" alt="Dislike" class="icon"></button>
            <p id="nbLike{{$post->idpost}}"></p>
            <button class="comment-button" data-post-id="{{$post->idpost}}"> <img id="comment-image{{$post->idpost}}" src="{{ asset('images/dark/chatDark.png') }}" alt="Commentaire" class="icon"></button>           
        </div>
        <div class="comment-section" id="comment-section-{{$post->idpost}}" style="display: none;">
            <textarea class="comment-input" id="comment-input-{{$post->idpost}}" placeholder="Write a comment..."></textarea>
            <button class="send-comment-button" data-post-id="{{$post->idpost}}">Send</button>
        </div>
    </div>
            @endforeach

        </div>
    </div>
    @endsection
    @vite('resources/js/scriptProfil.js')

    </body>
</html>


