<script>
    import { InertiaLink } from '@inertiajs/inertia-svelte'

    export let title
</script>

<svelte:head>
    <title>{title}</title>
</svelte:head>

<main class="text-lg font-sans text-grey-900">
    <!-- <header>
        <InertiaLink href="/">Home</InertiaLink>
        <InertiaLink href="/about">About</InertiaLink>
        <InertiaLink href="/contact">Contact</InertiaLink>
    </header> -->

    <article>
        <slot/>
    </article>
</main>
