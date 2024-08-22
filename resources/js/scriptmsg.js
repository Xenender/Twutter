import Pusher from 'pusher-js';
import Echo from 'laravel-echo';
 
 // Check if dark mode was previously enabled
 if (localStorage.getItem('darkMode') === 'enabled') {
    document.body.classList.add('dark-mode');
}

var isInGroup = false;
var userInGroup=[];

var chattingToGroup = null;




var pusher = new Pusher('886fe930620d0ca4fab4', {
    cluster: 'eu'
  });

  var channel = pusher.subscribe('message');
  channel.bind('messageReceive', function(data) {
    
    fetchDiscussionData();

  });


document.getElementById('create-group').addEventListener('click', async function() {

    isInGroup = true;
    document.getElementById('groupMember').style.display = 'block';
    const userListGroup = document.getElementById('user-list-group');
    userListGroup.innerHTML = "";

});

document.getElementById('create-group-launch-discu').addEventListener('click', async function() {

    const userListGroup = document.getElementById('user-list-group');
    const groupName = document.getElementById('groupName');

    userListGroup.innerHTML = "";
    console.log(userInGroup);
    isInGroup = false;
    //create channel
    
    const url = `/createGroup?group=${userInGroup}&name=${groupName.value}`;

        try {
            // Await fetch completion
            fetch(url).then(response => response.json())
            .then(data => {

                userInGroup=[];

            });
            
        } catch (error) {
            console.error('Failed to send message:', error);
        }




});



document.getElementById('search').addEventListener('input', function() {
    const query = this.value.trim();

    if (query.length > 0) {
        fetch(`/search-users?query=${query}`)
            .then(response => response.json())
            .then(data => {
                const userList = document.getElementById('user-list');
                const userListGroup = document.getElementById('user-list-group');
                userList.innerHTML = '';
                data.forEach(user => {
                    const li = document.createElement('li');
                    li.textContent = user.username;
                    li.addEventListener('click', function() {
                        if(!isInGroup){
                            document.getElementById('chat-with').textContent = user.username;
                            document.getElementById('chat-messages').innerHTML = '';
                            document.getElementById('userFrom').value = user.idUser;
                            chattingToGroup = null;

                            fetchDiscussionData();
                        }
                        else{//creation de groupe
                            const li2 = document.createElement('li');
                            li2.textContent = user.username;
                            userListGroup.appendChild(li2);
                            userInGroup.push(user.idUser);
                        }
                       
                    });
                    userList.appendChild(li);
                });
            });
    } else {
        document.getElementById('user-list').innerHTML = '';
    }
});

document.getElementById('send-button').addEventListener('click', async function() {
    const messageInput = document.getElementById('message-input');
    const message = messageInput.value.trim();
    const userFromValue = document.getElementById('userFrom').value;
    

    if (message !== '') {
        // Send message
        const url = `/sendMsg?text=${message}&to=${userFromValue}`;

        try {
            // Await fetch completion
            fetch(url)
            .then(data => {
            
                 // Update chat messages
                    document.getElementById('chat-messages').scrollTop = document.getElementById('chat-messages').scrollHeight;
                  
            });
            
        } catch (error) {
            console.error('Failed to send message:', error);
            console.error('Failed to send message:', error);

        }

       
    }
});

document.getElementById('export-button').addEventListener('click', async function() {

    const to = document.getElementById('userFrom').value;

        const url = `/generate-pdf?to=${to}`;

        window.location.replace(url)

       
    
});



async function fetchDiscussionData() {
    document.getElementById('chat-messages').innerHTML = '';
    // Récupérer la valeur de l'élément avec l'ID 'userFrom'
    const userFromValue = document.getElementById('userFrom').value;
    console.log('USER TO:', userFromValue);


    // Vérifier que la valeur n'est pas vide ou indéfinie
    if (!userFromValue) {
        console.error('userFrom value is empty or not defined.');
        return;
    }

    // Construire l'URL avec la valeur récupérée
    const url = `/search-discution?fromUser=${userFromValue}`;

    try {
        // Faire la requête à l'URL spécifiée
        fetch(url).then(response => response.json())
        .then(data => {


            console.log('Data retrieved:', data);

            data.forEach(msg => {

            const div = document.createElement('div');

            if(msg.User_idReceive == userFromValue){//message envoyé par moi
               
                div.classList.add('message', 'message-sent');
            } 
            else{//message reçu
    
                div.classList.add('message');
            }
            console.log('USER MSG:', msg.message_idmessage);
            
            //recup message text from all message
            const url2 = `/getMsg?query=${msg.message_idmessage}`;

            fetch(url2).then(response => response.json())
            .then(data => {
            
                if(msg.user_id != null){//message groupé mettre user

                    const url = `/getUsernameFromId?userId=${msg.user_id}`;

                    try {
                        // Await fetch completion
                        fetch(url).then(response => response.json())
                        .then(usernameCom => {
                            div.innerHTML = `<div><p>${usernameCom.username}:</p><p>${data.text}</p></div>`

                        
                        });
                        
                    } catch (error) {
                        console.error(error);
                    }
               
                } 
                else{
                    div.textContent = data.text
                }
                

                const parentDiv = document.getElementById('chat-messages');

            if (parentDiv) {
                parentDiv.appendChild(div);

            } else {
                console.error('Parent div not found');
            }
                
            });

            
            
        });
           
        });

        

        
    } catch (error) {
        console.error('Failed to fetch discussion data:', error);
    }
}






async function fetchGroupsDiscu() {
    let groupList = document.getElementById('group-list');
    groupList.innerHTML = '';
 

    const url = `/searchGroupsUser`;

    try {

        fetch(url).then(response => response.json())
        .then(data => {


            console.log('Data retrieved:', data);

            data.forEach(group => {



                            
                const url = `/getGroupFromParticipate?groupId=${group.groupe_id}`;

                try {

                    fetch(url).then(response => response.json())
                    .then(groupObject => {

                        const li = document.createElement('li');
                        li.textContent = groupObject.name;
                        li.addEventListener('click', function() {
                        
                            document.getElementById('chat-with').textContent = groupObject.name;
                            document.getElementById('chat-messages').innerHTML = '';
                            document.getElementById('userFrom').value = `group:${groupObject.id}`;
                            chattingToGroup = groupObject.id;
                            fetchDiscussionData();


                        
                        });
                        groupList.appendChild(li);
                    
                    });

                    

                    
                } catch (error) {
                    console.error('Failed to fetch discussion data:', error);
                }




                        
            
            
        });
           
        });

        

        
    } catch (error) {
        console.error('Failed to fetch discussion data:', error);
    }
}




// Appeler la fonction pour récupérer les données
fetchDiscussionData();
fetchGroupsDiscu();

