<script>
    export let clearInput
    export let shuffleOuters
    export let checkInput
</script>

<section class="flex items-center justify-center mt-8">

    <button on:click={clearInput} class="px-3 py-1 hover:bg-cream-darker focus:bg-cream-darker rounded">
        Clear
    </button>

    <button on:click={shuffleOuters} class="px-4 py-2 ml-4 hover:bg-cream-darker focus:bg-cream-darker rounded">
        <svg class="stroke-current" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="1 4 1 10 7 10"></polyline>
            <polyline points="23 20 23 14 17 14"></polyline>
            <path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path>
        </svg>
    </button>

    <button on:click={checkInput} class="px-3 py-1 ml-4 hover:bg-cream-darker focus:bg-cream-darker rounded">
        Enter
    </button>

</section>
