<!DOCTYPE html>
<html>
<head>
    @vite('resources/css/home/NavBarStyle.css')
    @vite('resources/css/home/HomeConnectedStyle.css')
    @vite('resources/css/home/tweetStyle.css')
    @vite('resources/css/app.css')


</head>
<body>
@extends('layouts.NavBar')
@section('title', 'Accueil')

@section('content')

@vite('resources/js/scriptHome.js')
@vite('resources/js/scriptPost.js')
@vite('resources/js/bootstrap.js')

    <h2 id="titreMain">Pour vous</h2>
    <div class="tweets">
    @foreach($posts as $post)

    <script>





    </script>

        @php
            $userPost = $post->user;
        @endphp

    <!-- @foreach($users as $user)
    @if($user->idUser == $post->User_idUser)
        @php
            $userPost = $user;
        @endphp
        @break
    @endif
    @endforeach -->
    <div class="tweet" data-post-id="{{ $post->idpost }}">
        <div class="tweet-header">
            <img src="{{ asset('images/dark/profile-iconDark.png') }}" alt="User 1" class="avatar">
            <span class="username">{{$userPost->username}}</span>
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
            
            <div id="commentaires{{$post->idpost}}" class="divCommentaires">

           
           

            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection

</body>
</html>
