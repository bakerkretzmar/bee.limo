<script>
    export let entry = 'afrobboo'
    export let letters

    $: entryLetters = entry.split('')
</script>

<section class="mb-6 text-4xl text-center uppercase">

    {#each entryLetters as letter}
        {#if letters.includes(letter)}
            <span class="font-bold">{letter}</span>
        {:else}
            <span class="">{letter}</span>
        {/if}
    {/each}

</section>
