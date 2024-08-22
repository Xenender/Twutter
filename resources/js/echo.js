import Echo from 'laravel-echo';
 
import Pusher from 'pusher-js';
// var pusher = new Pusher('886fe930620d0ca4fab4', {
//     cluster: 'eu'
// });
window.Pusher = Pusher
 
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
});