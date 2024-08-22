<html>
    <head>
    @vite('resources/css/home/NavBarStyle.css')

    @vite('resources/css/home/MessageStyle.css')
    @vite('resources/css/app.css')

    </head>
    <body>
    @extends('layouts.NavBar')
    @section('title', 'Accueil')

    @section('content')

    <div class="containermsg">
        <div class="sidebarUsers">
        <input type="text" placeholder="Rechercher un utilisateur" id="search" autocomplete="off">
            <ul id="user-list">

            </ul>
           <div id="groupMember" style="display: none;">
             Nom du groupe:
             <input type="text" id="groupName"/>
            Membres du groupe:
            <ul id="user-list-group">

            </ul>
            <button id="create-group-launch-discu">Discuter</button>
           </div> 

          <p style="margin-top: 10px;"> Vos discutions:</p>
           <ul id="group-list">

            </ul>     

            <button id="create-group">Créer un groupe</button>
        </div>
        <div class="chat-window">
            <input type="hidden" id="userFrom" value="null"/>
            <div class="chat-header">Discussion avec <span id="chat-with">[veuillez rechercher un utilisateur]</span><button id="export-button">Exporter</button></div>
            <div class="chat-messages" id="chat-messages">

            </div>
            <div class="chat-input">
                <input type="text" placeholder="Tapez votre message..." id="message-input">
                <button id="send-button">Envoyer</button>
            </div>
        </div>
    </div>
@endsection
@vite('resources/js/scriptmsg.js')



    </body>
</html>