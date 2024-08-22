import Pusher from 'pusher-js';
import Echo from 'laravel-echo';

 
 // Check if dark mode was previously enabled
 if (localStorage.getItem('darkMode') === 'enabled') {
    document.body.classList.add('dark-mode');
}



document.addEventListener('DOMContentLoaded', function() {
    const likeButtons = document.querySelectorAll('.like-button');
    const dislikeButtons = document.querySelectorAll('.dislike-button');
    const commentButtons = document.querySelectorAll('.comment-button');
    const sendCommentButtons = document.querySelectorAll('.send-comment-button');
    const deletePostButtons = document.querySelectorAll('.delete-button');

    const tweets = document.querySelectorAll('.tweet');




        // Enable pusher logging - don't include this in production

    //     console.log("BEFPRE LIKE COUNT");

    //         window.Echo.channel('posts')
    // .listen('likeCount', (data) => {
    //     console.log("LIKE COUNT");
    //     alert(JSON.stringify(data));

    // });

    Pusher.logToConsole = true;


    var pusher = new Pusher('886fe930620d0ca4fab4', {
        cluster: 'eu'
      });
  
      var channel = pusher.subscribe('posts');
      channel.bind('likeCount', function(data) {
        actuNbLikePost(data['postId']);

      });


    tweets.forEach(function(tweet) {
        const postId = tweet.getAttribute('data-post-id');
        if (postId) {
            actuNbLikePost(postId);
        }
    });


    likeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const postId = this.getAttribute('data-post-id');
            console.log(`Like post with ID: ${postId}`);
            // Handle the like action


            const url = `/likePost?postId=${postId}`;

            try {
                // Await fetch completion
                fetch(url)
                .then(data => {

                    
                    actuNbLikePost(postId);

                    
                });
                
            } catch (error) {
                console.error('Failed to send message:', error);
            }


        });
    });

    dislikeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const postId = this.getAttribute('data-post-id');
            console.log(`Dislike post with ID: ${postId}`);
            // Handle the dislike action



            
            const url = `/dislikePost?postId=${postId}`;

            try {
                // Await fetch completion
                fetch(url)
                .then(data => {
                
                    actuNbLikePost(postId);
                    
                });
                
            } catch (error) {
                console.error('Failed to send message:', error);
            }


        });
    });

    commentButtons.forEach(button => {
        button.addEventListener('click', function() {
            const postId = this.getAttribute('data-post-id');
            const commentSection = document.getElementById(`comment-section-${postId}`);
            commentSection.style.display = commentSection.style.display === 'none' ? 'block' : 'none';

            const commentaires = document.getElementById(`commentaires${postId}`);

            const url = `/getAllCommentPost?postId=${postId}`;

            try {
                // Await fetch completion
                fetch(url).then(response => response.json())
                .then(data => {
                
                    console.log(data);
                    data.forEach(function(comment) {

                        commentaires.innerHTML = ""

                        const url = `/getUsernameFromId?userId=${comment.avis_user_id}`;

                        try {
                            // Await fetch completion
                            fetch(url).then(response => response.json())
                            .then(usernameCom => {
                            
                               
                                const div = document.createElement('div');

                                div.innerHTML = `<div class="comment"><span class="comment-username">${usernameCom.username}:</span><p class="comment-text">${comment.text}</p></div>`
                                commentaires.appendChild(div);
                                
                            });
                            
                        } catch (error) {
                            console.error(error);
                        }
                        
                       

                    });
                    
                    
                });
                
            } catch (error) {
                console.error('Failed to send message:', error);
            }


        });
    });

    sendCommentButtons.forEach(button => {
        button.addEventListener('click', function() {
            const postId = this.getAttribute('data-post-id');
            const commentInput = document.getElementById(`comment-input-${postId}`);
            const commentText = commentInput.value;
            console.log(`Send comment for post with ID: ${postId}. Comment: ${commentText}`);
            commentInput.value = ''; // Clear the input after sending
            // Handle the send comment action


            const url = `/commentPost?postId=${postId}&comment=${commentText}`;

            try {
                // Await fetch completion
                fetch(url)
                .then(data => {
                
                    console.log(data);
                    
                });
                
            } catch (error) {
                console.error('Failed to send message:', error);
            }

        });
    });



    
    deletePostButtons.forEach(button => {
        button.addEventListener('click', function() {
            const postId = this.getAttribute('data-post-id');
            const url = `/deletePost?postId=${postId}`;

            try {
                // Await fetch completion
                fetch(url)
                .then(data => {
                
                    console.log(data);
                    window.location.reload();
                    
                });
                
            } catch (error) {
                console.error('Failed to send message:', error);
            }
        });
    });

});






async function actuNbLikePost(postId) {

    const url = `/nbLikePostUser?postId=${postId}`;

            try {
                // Await fetch completion
                fetch(url).then(response => response.json())
                .then(data => {
                
                    console.log("avant actu like")
                    console.log(data);

                    const imgDislike =  document.getElementById('dislike-image'+postId);

                    if (localStorage.getItem('darkMode') === 'enabled') {
              

                        
                    if(data == -1){//dislike
                        imgDislike.src = "images/dark/dislikeRedDark.png";
             
                    }
                    else if(data == 0){//normal
                        imgDislike.src =  "images/dark/dislikeDark.png";
                    }
                    else{//like
                        imgDislike.src =  "images/dark/dislikeDark.png";
                    }


                    const imgLike = document.getElementById('like-image'+postId);


                    if(data == -1){//dislike
                        imgLike.src = "images/dark/likeDark.png";
 
                    }
                    else if(data == 0){//normal
                        imgLike.src = "images/dark/likeDark.png";
                  
                    }
                    else{//like
                        imgLike.src = "images/dark/likeGreenDark.png";
             
                    }


                }
                else{//MODE CLAIR

                    if(data == -1){//dislike
                        imgDislike.src = "images/dislikeRed.png";
             
                    }
                    else if(data == 0){//normal
                        imgDislike.src =  "images/dislike.png";
                    }
                    else{//like
                        imgDislike.src =  "images/dislike.png";
                    }


                    const imgLike = document.getElementById('like-image'+postId);


                    if(data == -1){//dislike
                        imgLike.src = "images/like.png";
 
                    }
                    else if(data == 0){//normal
                        imgLike.src = "images/like.png";
                  
                    }
                    else{//like
                        imgLike.src = "images/likeGreen.png";
             
                    }
                }
                 

                    const url = `/nbLikePost?postId=${postId}`;

                    try {
                        // Await fetch completion
                        fetch(url).then(response => response.json())
                        .then(data => {
                        
                            const compteurLike =  document.getElementById('nbLike'+postId);
                            compteurLike.innerHTML = data;

                            
                            
                        });
                        
                    } catch (error) {
                        console.error('Failed to send message:', error);
                    }

                    


                    return data;
                    
                });
                
            } catch (error) {
                console.error('Failed to send message:', error);
            }

}