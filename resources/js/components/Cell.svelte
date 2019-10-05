<script>
    import { fade } from 'svelte/transition'
    export let letter
    export let x = 0
    export let y = 0
    export let center = false
</script>

<style>
svg {
    position: absolute;
    height: calc(100% / 3);
    width: 40%;
    top: calc(100% / 3);
    left: 30%;
}
polygon {
    transform: translate(10%, 10%);
    stroke-width: 20;
    stroke-linejoin: round;
}
text {
    text-anchor: middle;
    dominant-baseline: central;
}
</style>

<svg xmlns="http://www.w3.org/2000/svg" class="{center ? 'text-yellow-500 hover:text-yellow-400' : 'text-grey-400 hover:text-grey-300'} fill-current pointer-events-none" style="transform: translate({x}%, {y}%);" viewBox="0 0 200 180">
    <polygon class="stroke-current pointer-events-auto cursor-pointer" points="0,70 40,0 120,0 160,70 120,140 40,140"></polygon>
    {#each letter as l (l)}
        <text class="text-6xl text-grey-900 font-bold uppercase" x="50%" y="50%" transition:fade={{ duration: 150 }}>{l}</text>
    {/each}
</svg>
