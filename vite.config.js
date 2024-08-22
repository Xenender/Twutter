import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'
                ,'resources/css/hub/HubPageStyle.css'
                ,'resources/css/hub/HubPageStyle.css',
                'resources/css/home/HomeConnectedStyle.css',
                'resources/css/home/ProfilStyle.css',
                'resources/css/home/NavBarStyle.css',
                'resources/css/home/MessageStyle.css',
                'resources/css/home/SettingsStyle.css',
                'resources/css/home/tweetStyle.css',
                'resources/js/scriptmsg.js',
                'resources/js/scriptTools.js',
                'resources/js/scriptHome.js',
                'resources/js/scriptPost.js',
                'resources/js/scriptProfil.js',
                'resources/js/scriptNavBar.js',
                'resources/js/bootstrap.js',

                'resources/css/templates/userHomeStyle.css',
            ],
            refresh: true,
        }),
    ],
});
