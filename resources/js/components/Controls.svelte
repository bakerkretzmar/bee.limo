<script>
    export let clearEntry
    export let shuffleOuters
    export let checkEntry
</script>

<section class="flex justify-center mt-8">

    <button on:click={clearEntry} class="block px-4 py-2 bg-grey-300 hover:bg-grey-200 border-2 rounded-full focus:bg-grey-200 focus:outline-none">
        Clear
    </button>

    <button on:click={shuffleOuters} class="block px-4 py-2 ml-4 bg-grey-300 hover:bg-grey-200 border-2 rounded-full focus:bg-grey-200 focus:outline-none">
        <svg class="stroke-current fill-none" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="1 4 1 10 7 10"></polyline>
            <polyline points="23 20 23 14 17 14"></polyline>
            <path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path>
        </svg>
    </button>

    <button on:click={checkEntry} class="block px-4 py-2 ml-4 bg-grey-300 hover:bg-grey-200 border-2 rounded-full focus:bg-grey-200 focus:outline-none">
        Enter
    </button>

</section>
