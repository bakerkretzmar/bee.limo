<script>
    import { InertiaLink } from '@inertiajs/inertia-svelte'
    import Layout from '@/components/Layout.svelte'
    import Navbar from '@/components/Navbar.svelte'
    import Pagination from '@/components/Pagination.svelte'
    import PuzzleThumbnail from '@/components/PuzzleThumbnail.svelte'

    export let page

    $: puzzles = page.data

    let route = window.route

    function started(puzzle) {
        return puzzle.users.length && puzzle.users[0].game
    }

    function completed(puzzle) {
        return puzzle.users.length && puzzle.users[0].game && puzzle.users[0].game.completed_at
    }
</script>

<style>
ul {
    display: grid;
    grid-template-columns: repeat(auto-fit, 12rem);
    grid-auto-rows: 12rem;
    align-items: center;
    justify-items: center;
    justify-content: space-around;
}
li:hover, li:focus, li:focus-within {
    @apply bg-cream-dark;
}
</style>

<Layout title="Puzzles">

    <ul class="w-full max-w-6xl mx-auto py-4">

        {#each puzzles as puzzle (puzzle.id)}
            <li class="rounded-lg w-40">

                <InertiaLink class="relative flex items-center justify-center h-40 group" href={route('puzzles.show', puzzle.id)}>

                    <PuzzleThumbnail status={completed(puzzle) ? 'completed' : (started(puzzle) ? 'started' : null)}/>

                    <span class="absolute text-3xl text-gray-800">{puzzle.id.toLocaleString()}</span>

                </InertiaLink>

            </li>
        {/each}

    </ul>

    <Pagination prev={page.prev_page_url} next={page.next_page_url} current={page.current_page} last={page.last_page}/>

</Layout>
