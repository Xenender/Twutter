 // Check if dark mode was previously enabled
 if (localStorage.getItem('darkMode') === 'enabled') {
    document.body.classList.add('dark-mode');

    const profilIcon = document.getElementById(`profil-icon`);
    const messageIcon = document.getElementById(`message-icon`);
    const settingsIcon = document.getElementById(`settings-icon`);

    profilIcon.src = "images/dark/profile-iconDark.png";
    messageIcon.src = "images/dark/messages-iconDark.png";
    settingsIcon.src = "images/dark/settings-iconDark.png";

}