<script>
    export let title;
    export let stat = 0;
</script>

<div class="rounded-lg bg-yellow-200 px-6 py-4 shadow-md">
    <p class="text-center text-6xl font-medium tabular-nums">
        {stat.toLocaleString()}
    </p>
    <p class="mt-2 text-center">
        {title}
    </p>
</div>
