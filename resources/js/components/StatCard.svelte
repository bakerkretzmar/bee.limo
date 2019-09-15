<script>
    export let title
    export let stat = 0
</script>

<div class="px-6 py-4 bg-yellow-200 rounded-lg shadow-md">

    <p class="text-6xl font-medium text-center tabular-nums">
        { stat.toLocaleString() }
    </p>

    <p class="text-center mt-2">
        { title }
    </p>
</div>
