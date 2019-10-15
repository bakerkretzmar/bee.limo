<script>
    import Layout from '@/components/Layout.svelte'
    import Navbar from '@/components/Navbar.svelte'
    import Pagination from '@/components/Pagination.svelte'
    import { InertiaLink } from '@inertiajs/inertia-svelte'

    export let data

    $: puzzles = data.data
    let route = window.route
</script>

<style>
ul {
    display: grid;
    grid-template-columns: repeat(auto-fit, 12rem);
    grid-auto-rows: 12rem;
    align-items: center;
    justify-items: center;
    justify-content: space-between;
}
li:hover, li:focus, li:focus-within {
    @apply bg-cream-dark;
}
polygon {
    stroke-width: 14;
    stroke-linejoin: round;
}
</style>

<Layout title="Play">

    <Navbar/>

    <ul class="w-full max-w-6xl mx-auto py-4">
        {#each puzzles as { id }}
            <li class="rounded-lg w-40">
                <InertiaLink class="relative flex items-center justify-center h-40 group" href={route('puzzle', id)}>
                    <svg xmlns="http://www.w3.org/2000/svg" class="absolute w-32" viewBox="0 0 400 420">
                        <polygon class="stroke-cream group-hover:stroke-cream-dark fill-yellow-300 group-hover:fill-yellow-400" points="240 140 160 140 120 210 160 280 240 280 280 210 240 140"/>
                        <polygon class="stroke-cream group-hover:stroke-cream-dark fill-grey-200 group-hover:fill-grey-300" points="120 70 40 70 0 140 40 210 120 210 160 140 120 70"/>
                        <polygon class="stroke-cream group-hover:stroke-cream-dark fill-grey-200 group-hover:fill-grey-300" points="360 210 280 210 240 280 280 350 360 350 400 280 360 210"/>
                        <polygon class="stroke-cream group-hover:stroke-cream-dark fill-grey-200 group-hover:fill-grey-300" points="240 280 160 280 120 350 160 420 240 420 280 350 240 280"/>
                        <polygon class="stroke-cream group-hover:stroke-cream-dark fill-grey-200 group-hover:fill-grey-300" points="240 0 160 0 120 70 160 140 240 140 280 70 240 0"/>
                        <polygon class="stroke-cream group-hover:stroke-cream-dark fill-grey-200 group-hover:fill-grey-300" points="360 70 280 70 240 140 280 210 360 210 400 140 360 70"/>
                        <polygon class="stroke-cream group-hover:stroke-cream-dark fill-grey-200 group-hover:fill-grey-300" points="120 210 40 210 0 280 40 350 120 350 160 280 120 210"/>
                    </svg>
                    <span class="absolute text-4xl font-medium text-grey-800 tracking-tight">{id}</span>
                </InertiaLink>
            </li>
        {/each}
    </ul>

    <Pagination {...data}/>

</Layout>
