<script>
    export let initial;
    export let letters;
    export let erroring = false;
    export let input = (input) => input.split('');
</script>

<section
    class="relative mb-4 flex h-16 items-center text-4xl uppercase tracking-wide"
    class:erroring
    class:mr-2={!input.length}
>
    {#each input as letter}
        <span
            class="font-bold"
            class:text-gray-500={!letters.includes(letter)}
            class:text-yellow-500={letter === initial}
        >
            {letter}
        </span>
    {/each}
</section>

<style>
    section::after {
        @apply absolute block h-10 rounded bg-gray-500;
        content: '';
        top: 53%;
        transform: translateY(-50%);
        right: -0.375rem;
        width: 3px;
        animation: 1000ms blink ease-in-out infinite;
    }
    section.erroring {
        animation: shake 250ms cubic-bezier(0.19, 1, 0.22, 1);
    }
    @keyframes shake {
        15%,
        85% {
            transform: translateX(-4px);
        }
        50% {
            transform: translateX(4px);
        }
    }
    @keyframes blink {
        from,
        to {
            opacity: 0;
        }
        50% {
            opacity: 1;
        }
    }
</style>
