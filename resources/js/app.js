import { App } from '@inertiajs/inertia-svelte';
import '../css/x.css';

const el = document.getElementById('app');

new App({
    target: el,
    props: {
        initialPage: JSON.parse(el.dataset.page),
        resolveComponent: name => {
            if (process.env.NODE_ENV === 'production') {
                fathom.trackPageview();
            }

            return require(`@/Pages/${name}.svelte`);
        },
    },
});
