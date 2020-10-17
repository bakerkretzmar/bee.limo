<script>
    import { InertiaLink } from '@inertiajs/inertia-svelte'

    export let prev
    export let next
    export let current
    export let last
</script>

<nav class="flex items-center justify-between w-full max-w-6xl mx-auto px-8 mb-8">

    <InertiaLink class="text-gray-600 hover:text-yellow-500 focus:text-yellow-500 {prev ? '' : 'pointer-events-none opacity-0'}" href={prev}>Previous</InertiaLink>

    <span>{current.toLocaleString()} / {last.toLocaleString()}</span>

    <InertiaLink class="text-gray-600 hover:text-yellow-500 focus:text-yellow-500 {next ? '' : 'pointer-events-none opacity-0'}" href={next}>Next</InertiaLink>

</nav>
