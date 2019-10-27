<script>
    import { fade } from 'svelte/transition'

    export let message = ''
    export let score = 0
    export let pangram = false
    export let profanity = false
</script>

<style>
div {
    bottom: 100%;
}
</style>

{#if message}
    <div class="absolute flex items-center mb-2" in:fade={{ duration: 50 }} out:fade={{ duration: 100 }}>
        <span class="px-2 py-1 text-sm text-white rounded {profanity ? 'bg-red-600' : (pangram ? 'bg-yellow-500' : 'bg-grey-700')}">{message}</span>
        {#if score}
            <span class="ml-2 font-medium">+{score}</span>
        {/if}
    </div>
{/if}
