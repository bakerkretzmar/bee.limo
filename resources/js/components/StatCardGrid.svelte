<div class="grid w-1/2 p-4">
    <slot />
</div>

<style>
    .grid {
        display: grid;
        grid-gap: 2rem;
        grid-template-columns: repeat(2, 1fr);
    }
</style>
