<script>
    import { fade } from 'svelte/transition'

    export let message = ''
    export let pangram = false
    export let profanity = false
</script>

<style>
div {
    bottom: 100%;
}
</style>

{#if message}
    <div class="absolute px-2 py-1 mb-2 text-sm text-white rounded {profanity ? 'bg-red-600' : (pangram ? 'bg-yellow-500' : 'bg-grey-700')}" in:fade={{ duration: 50 }} out:fade={{ duration: 100 }}>
        {message}
    </div>
{/if}
