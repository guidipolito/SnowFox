import './bootstrap';
import '../css/app.scss';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import ConfirmationService from 'primevue/confirmationservice';
import PrimeVue from 'primevue/config'
import Ripple from 'primevue/ripple';
import Tooltip from 'primevue/tooltip';


const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(PrimeVue, { ripple: true })
            .use(ConfirmationService)
            .directive('ripple', Ripple)
            .directive('tooltip', Tooltip)
            .mount(el);
    },
});

InertiaProgress.init({ 
    color: '#2196F3', 
    includeCSS: true,
    showSpinner: true, 
    delay: 15,
});
