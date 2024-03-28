<script>
    import { fade } from 'svelte/transition';

    export let message = '';
    export let score = 0;
    export let pangram = false;
    export let profanity = false;
</script>

{#if message}
    <div class="absolute mb-2 flex items-center" in:fade|global={{ duration: 50 }} out:fade|global={{ duration: 100 }}>
        <span
            class="rounded px-2 py-1 text-sm text-white {profanity
                ? 'bg-red-600'
                : pangram
                  ? 'bg-yellow-500'
                  : 'bg-gray-700'}">{message}</span
        >
        {#if score}
            <span class="ml-2 font-medium">+{score}</span>
        {/if}
    </div>
{/if}

<style>
    div {
        bottom: 100%;
    }
</style>
