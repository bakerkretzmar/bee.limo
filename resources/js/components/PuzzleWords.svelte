<script>
    import { fade } from 'svelte/transition';
    import Loader from '@/components/Loader.svelte';

    export let loading = true;
    export let found = [];
    export let score = 0;
    export let genius = 0;
    export let max = 0;
</script>

<div
    class="relative ml-12 flex min-w-96 max-w-[theme(screens.md)] shrink flex-col justify-between rounded-lg border-2 px-6 py-4"
>
    {#if loading}
        <Loader />
    {:else}
        <ul class="max-w-full overflow-x-auto" transition:fade|global={{ duration: 100 }}>
            {#each found.sort() as word}
                <li class="mb-1 mr-16 capitalize">{word}</li>
            {/each}
        </ul>
        <div class="mt-6 flex justify-between" transition:fade|global={{ duration: 100 }}>
            <span
                title="Max: {max.toLocaleString()}"
                class={score >= genius ? 'font-medium text-yellow-500' : 'text-gray-600'}
                >Genius: {genius.toLocaleString()}</span
            >
            <span class="text-xl">{score.toLocaleString()}</span>
        </div>
    {/if}
</div>

<style>
    ul {
        display: grid;
        grid-auto-flow: column;
        grid-template-rows: repeat(16, auto);
    }
</style>
