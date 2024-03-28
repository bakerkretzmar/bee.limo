<script>
    import { Link } from '@inertiajs/svelte';

    export let prev;
    export let next;
    export let current;
    export let last;
</script>

<nav class="mx-auto mb-8 flex w-full max-w-6xl items-center justify-between px-8">
    <Link
        class="text-gray-600 hover:text-yellow-500 focus:text-yellow-500 {prev ? '' : 'pointer-events-none opacity-0'}"
        href={prev}>Previous</Link
    >
    <span>{current.toLocaleString()} / {last.toLocaleString()}</span>
    <Link
        class="text-gray-600 hover:text-yellow-500 focus:text-yellow-500 {next ? '' : 'pointer-events-none opacity-0'}"
        href={next}>Next</Link
    >
</nav>
