<script>
    import { InertiaLink } from '@inertiajs/inertia-svelte'

    export let prev_page_url
    export let next_page_url
    export let current_page
    export let last_page
</script>

<nav class="flex items-center justify-between w-full max-w-6xl mx-auto px-8">
    <InertiaLink class="block px-2 py-1 bg-grey-300 hover:bg-grey-200 border-2 rounded focus:bg-grey-200 focus:outline-none" href={prev_page_url}>Previous</InertiaLink>
    <span>{current_page} / {last_page}</span>
    <InertiaLink class="block px-2 py-1 bg-grey-300 hover:bg-grey-200 border-2 rounded focus:bg-grey-200 focus:outline-none" href={next_page_url}>Next</InertiaLink>
</nav>
