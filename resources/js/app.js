import { InertiaApp } from '@inertiajs/inertia-svelte'
import '../css/x.css'

const app = document.getElementById('app')

new InertiaApp({
    target: app,
    props: {
        initialPage: JSON.parse(app.dataset.page),
        resolveComponent: name => {
            process.env.NODE_ENV === 'production' && fathom('trackPageview')
            return import(/* webpackChunkName: "[request]" */ `@/Pages/${name}.svelte`).then(module => module.default)
        },
    }
})
