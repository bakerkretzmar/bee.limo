<script>
    import { InertiaLink } from '@inertiajs/inertia-svelte'

    export let title
</script>

<svelte:head>
    <title>{title}</title>
</svelte:head>

<main class="flex flex-col p-4 min-h-screen text-lg font-sans text-grey-900 bg-cream">
    <!-- <header>
        <InertiaLink href="/">Home</InertiaLink>
        <InertiaLink href="/about">About</InertiaLink>
        <InertiaLink href="/contact">Contact</InertiaLink>
    </header> -->

    <slot/>

</main>
