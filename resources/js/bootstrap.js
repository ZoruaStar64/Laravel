import _ from 'lodash';
window._ = _;

// One of the following themes
// import '@simonwep/pickr/dist/themes/classic.min.css';   // 'classic' theme
// import '@simonwep/pickr/dist/themes/monolith.min.css';  // 'monolith' theme
// import '@simonwep/pickr/dist/themes/nano.min.css';      // 'nano' theme

// Modern or es5 bundle (pay attention to the note below!)
// import Pickr from '@simonwep/pickr';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Alpine from 'alpinejs';
import selectTags from '../../public/tagInput.js';
Alpine.data('selectTags', selectTags);
window.Alpine = Alpine;
Alpine.start();

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

// Simple example, see optional options for more configuration.
// const customColorPicker = document.querySelector('.customColorPicker');
// const mypickr = new Pickr({
//     el: '.customColorPicker',
//     theme: 'monolith', // or 'monolith', or 'nano'

//     swatches: [
//         '#FFF',
//         '#09F',
//         '#C00',
//         '93F',
//         '#3C3',
//         '#000'
//     ],

//     components: {

//         // Main components
//         preview: false,
//         opacity: false,
//         hue: false,

//         // Input / output Options
//         interaction: {
//             hex: true,
//             rgba: false,
//             hsla: false,
//             hsva: false,
//             cmyk: false,
//             input: true,
//             clear: true,
//             save: true
//         }
//     }
// });