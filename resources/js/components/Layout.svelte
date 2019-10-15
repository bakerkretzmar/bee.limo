<script>
    // import { InertiaLink } from '@inertiajs/inertia-svelte'
    export let title
    let classes = ''
    export { classes as class }
</script>

<svelte:head>
    <title>bee.limo | {title}</title>
</svelte:head>

<main class="flex flex-col min-h-screen font-sans text-lg text-grey-900 bg-cream {classes}">
    <!-- <header>
        <InertiaLink href="/">Home</InertiaLink>
        <InertiaLink href="/about">About</InertiaLink>
        <InertiaLink href="/contact">Contact</InertiaLink>
    </header> -->

    <slot/>

</main>
