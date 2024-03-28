import { createInertiaApp } from '@inertiajs/svelte';
import '../css/app.css';

createInertiaApp({
    resolve: (name) => {
        // TODO fathom?
        const pages = import.meta.glob('./Pages/**/*.svelte', { eager: true });
        return pages[`./Pages/${name}.svelte`];
    },
    setup({ el, App, props }) {
        new App({ target: el, props });
    },
});
