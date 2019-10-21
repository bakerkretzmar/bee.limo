<script>
    import { fade } from 'svelte/transition'
    import Loader from '@/components/Loader.svelte'

    export let loading = true
    export let found = []
    export let total = 0
</script>

<style>
ul {
    display: grid;
    grid-auto-flow: column;
    grid-template-rows: repeat(16, auto);
}
</style>

<div class="relative flex flex-col flex-shrink justify-between ml-12 px-6 py-4 min-w-sm max-w-xl border-2 rounded-lg">
    {#if loading}
        <Loader/>
    {:else}
        <ul class="max-w-full overflow-x-auto" transition:fade={{duration: 100}}>
            {#each found.sort() as word}
                <li class="mr-16 mb-1 capitalize">{word}</li>
            {/each}
        </ul>
        <p class="text-center text-xl mt-6" transition:fade={{duration: 100}}>{found.length} / {total}</p>
    {/if}
</div>
