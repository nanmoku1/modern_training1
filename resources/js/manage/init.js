import alpinejs from 'alpinejs';
import axios from 'axios';
import * as popperjs from '@popperjs/core';

window.Alpine = alpinejs;
alpinejs.start();

window.Axios = axios;
window.Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Popper = popperjs;
