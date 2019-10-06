<script>
    export let entry = entry => entry.split('')
    export let letters
    export let center
    export let error = false
</script>

<style>
section::after {
    @apply absolute block h-10 rounded bg-grey-500;
    content: '';
    top: 50%;
    transform: translateY(-50%);
    right: -.375rem;
    width: 3px;
    animation: 1000ms blink ease-in-out infinite;
}

section.error {
    animation: shake 250ms cubic-bezier(.19,1,.22,1);
}

@keyframes shake {
    15%, 85% { transform: translateX(-4px); }
    50% { transform: translateX(4px); }
}

@keyframes blink {
    from, to { opacity: 0; }
    50% { opacity: 1; }
}
</style>

<section class="relative flex items-center h-16 mb-4 text-4xl uppercase tracking-wide" class:error class:mr-2={entry.length == 0}>

    {#each entry as letter}
        <span class="font-bold" class:text-grey-500={!letters.includes(letter)} class:text-yellow-400={letter === center}>{letter}</span>
    {/each}

</section>
