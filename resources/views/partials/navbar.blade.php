<div class="modal-overlay" id="modal-overlay" style="display: none;">
    <div class="modal">
        <button class="close-modal-btn" onclick="closeModal()" aria-label="Fermer la fenêtre">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 18L18 6M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
        <form action="/post" method="post">
            @csrf
            <textarea name="text" placeholder="Entrez quelque chose..." required></textarea>
            <br>
            <button type="submit">Poster</button>
        </form>
    </div>
</div>


<aside class="sidebar">
    <div id="twutterTitre"><a href="/"><h3>Twutter</h3></a></div>
    <div class="profile-section sectionMenu">
        <img id="profil-icon" src="{{ asset('images/profile-icon.png') }}" alt="Profil" class="icon">
        <a href="/profil" class="{{ request()->is('profil') ? 'active-link' : '' }}">Profil</a>
    </div>
    <div class="messages-section sectionMenu">
        <img id="message-icon" src="{{ asset('images/messages-icon.png') }}" alt="Messages privés" class="icon">
        <a href="/message" class="{{ request()->is('message') ? 'active-link' : '' }}">Messages</a>
    </div>
    <div class="settings-section sectionMenu">
        <img id="settings-icon" src="{{ asset('images/settings-icon.png') }}" alt="Paramètres" class="icon">
        <a href="/settings" class="{{ request()->is('settings') ? 'active-link' : '' }}">Paramètres</a>
    </div>
    <button class="open-modal-btn" onclick="openModal()">Poster</button>


    


    <div class="spacer"></div>
    <form action="/logout" method="post" class="logout-form">
        @csrf
        <input type="submit" value="Déconnexion" class="rounded-button"/>
    </form>
</aside>

<script>
    function openModal() {
        document.getElementById('modal-overlay').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('modal-overlay').style.display = 'none';
    }
</script>


