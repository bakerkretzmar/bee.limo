<div class="grid w-1/2 p-4">
    <slot />
</div>

<style>
    .grid {
        display: grid;
        grid-gap: 2rem;
        grid-auto-rows: min-content;
    }
</style>
