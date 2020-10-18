<script>
    import { InertiaLink, page } from '@inertiajs/inertia-svelte'
    import Brand from '@/components/Brand.svelte'

    let route = window.route
</script>

<svelte:head>
    <title>bee.limo</title>
</svelte:head>

<main class="flex flex-col items-center justify-center min-h-screen font-sans font-medium text-lg text-gray-900 bg-cream">

    <Brand class="w-full max-w-lg px-4"/>

    <div class="mt-24 mb-8">

        <InertiaLink href={$page.props.user?.email ? route('puzzles') : route('puzzles.random')} class="flex items-center justify-center h-12 px-16 text-2xl font-bold tracking-wider hover:bg-cream-darker rounded uppercase">
            Play
        </InertiaLink>

    </div>

</main>
