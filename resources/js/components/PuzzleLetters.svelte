<script>
    import { createEventDispatcher } from 'svelte'
    import { fade } from 'svelte/transition'

    const dispatch = createEventDispatcher()

    export let initial = ''
    export let outers = ['','','','','','']

    let coords = [
        { x: 0, y: -100 },
        { x: 75, y: -50 },
        { x: 75, y: 50 },
        { x: 0, y: 100 },
        { x: -75, y: 50 },
        { x: -75, y: -50 },
    ]
</script>

<style>
svg {
    @apply absolute w-2/5;
    top: calc(100% / 3);
    left: 30%;
    height: calc(100% / 3);
}
polygon {
    stroke-width: 20;
    stroke-linejoin: round;
}
text {
    text-anchor: middle;
    dominant-baseline: central;
}
</style>

<div class="relative" style="width: 260px; padding-bottom: 273px;">

    <!-- Center -->
    <!-- @todo transform when active!! -->
    <svg xmlns="http://www.w3.org/2000/svg" on:click={() => dispatch('click', initial)} class="fill-current text-yellow-400 hover:text-yellow-500 pointer-events-none" viewBox="0 0 190 170">
        <polygon class="stroke-current pointer-events-auto cursor-pointer" points="0,70 40,0 120,0 160,70 120,140 40,140" transform="translate(15, 15)"></polygon>
        <text class="text-6xl text-grey-900 font-bold uppercase fill-current" x="50%" y="50%">{initial}</text>
    </svg>

    <!-- Outers -->
    {#each outers as letter, i (letter)}
        <svg xmlns="http://www.w3.org/2000/svg" on:click={() => dispatch('click', letter)} class="fill-current text-grey-300 hover:text-grey-400 pointer-events-none" style="transform: translate({coords[i].x}%, {coords[i].y}%);" viewBox="0 0 190 170">
            <polygon class="stroke-current pointer-events-auto cursor-pointer" points="0,70 40,0 120,0 160,70 120,140 40,140" transform="translate(15, 15)"></polygon>
            <text class="text-6xl text-grey-900 font-bold uppercase fill-current" x="50%" y="50%" transition:fade={{ duration: 150 }}>{letter}</text>
        </svg>
    {/each}

</div>
