import VueProgressBar from "vue-progressbar";

window.Vue = require('vue');

Vue.use(VueProgressBar, {
    color: '#337ab7',
    failedColor: '#874b4b',
    thickness: '4px',
    transition: {
        speed: '80s',
        opacity: '1s',
        termination: 800
    },
    location: 'top',
});


try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}



window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';



let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo'

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '6110d024b849977d80dd',
    cluster: 'ap2',
    encrypted: true
});

