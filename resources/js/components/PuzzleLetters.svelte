<script>
    import { createEventDispatcher } from 'svelte';
    import { fade } from 'svelte/transition';

    const dispatch = createEventDispatcher();

    export let initial = '';
    export let outers = ['', '', '', '', '', ''];

    let coords = [
        { x: 0, y: -100 },
        { x: 75, y: -50 },
        { x: 75, y: 50 },
        { x: 0, y: 100 },
        { x: -75, y: 50 },
        { x: -75, y: -50 },
    ];
</script>

<div class="relative" style="width: 260px; padding-bottom: 273px;">
    <!-- Center -->
    <!-- @todo transform when active!! -->
    <svg
        xmlns="http://www.w3.org/2000/svg"
        on:click={() => dispatch('click', initial)}
        class="pointer-events-none absolute w-2/5 fill-current text-yellow-400 hover:text-yellow-500"
        viewBox="0 0 190 170"
        role="button"
        tabindex="0"
    >
        <polygon
            class="pointer-events-auto cursor-pointer stroke-current"
            points="0,70 40,0 120,0 160,70 120,140 40,140"
            transform="translate(15, 15)"
        ></polygon>
        <text class="fill-current text-6xl font-bold uppercase text-gray-900" x="50%" y="50%">{initial}</text>
    </svg>

    <!-- Outers -->
    {#each outers as letter, i}
        <svg
            xmlns="http://www.w3.org/2000/svg"
            on:click={() => dispatch('click', letter)}
            class="pointer-events-none absolute w-2/5 fill-current text-gray-300 hover:text-gray-400"
            style="transform: translate({coords[i].x}%, {coords[i].y}%);"
            viewBox="0 0 190 170"
            role="button"
            tabindex="0"
        >
            <polygon
                class="pointer-events-auto cursor-pointer stroke-current"
                points="0,70 40,0 120,0 160,70 120,140 40,140"
                transform="translate(15, 15)"
            ></polygon>
            {#if letter}
                <text
                    class="fill-current text-6xl font-bold uppercase text-gray-900"
                    x="50%"
                    y="50%"
                    transition:fade|global={{ duration: 100 }}>{letter}</text
                >
            {/if}
        </svg>
    {/each}
</div>

<style>
    svg {
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
