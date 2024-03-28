<script>
    import { Link, page } from '@inertiajs/svelte';
    import Brand from '@/components/Brand.svelte';

    let route = window.route;
</script>

<svelte:head>
    <title>bee.limo</title>
</svelte:head>

<main
    class="flex min-h-screen flex-col items-center justify-center bg-cream font-sans text-lg font-medium text-gray-900"
>
    <Brand class="w-full max-w-lg px-4" />
    <div class="mb-8 mt-24">
        <Link
            href={$page.props.user?.email ? route('puzzles') : route('puzzles.random')}
            class="flex h-12 items-center justify-center rounded px-16 text-2xl font-bold uppercase tracking-wider hover:bg-cream-darker"
        >
            Play
        </Link>
    </div>
</main>
