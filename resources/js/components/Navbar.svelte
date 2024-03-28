<script>
    import { Link, router, page } from '@inertiajs/svelte';
    import Brand from '@/components/Brand.svelte';

    let route = window.route;
</script>

<nav class="flex items-center justify-between p-4">
    <Link href={$page.props.user?.email ? route('puzzles') : route('splash')}>
        <Brand class="w-24" />
    </Link>
    <ul class="flex items-center">
        <li class="ml-2 overflow-hidden rounded">
            <Link class="inline-block px-3 py-1 hover:bg-cream-darker focus:bg-cream-darker" href={route('about')}>
                About
            </Link>
        </li>
        {#if $page.props.user?.email}
            <li class="ml-2 overflow-hidden rounded">
                <Link class="inline-block px-3 py-1 hover:bg-cream-darker focus:bg-cream-darker" href="/">Account</Link>
            </li>

            <li class="ml-2 overflow-hidden rounded">
                <button
                    class="px-3 py-1 text-gray-600 hover:bg-cream-dark focus:bg-cream-dark"
                    on:click={() => router.post(route('api:logout'))}
                >
                    Log out
                </button>
            </li>
        {:else}
            <li class="ml-2 overflow-hidden rounded">
                <Link class="inline-block px-3 py-1 hover:bg-cream-darker focus:bg-cream-darker" href={route('login')}>
                    Log in
                </Link>
            </li>
        {/if}
    </ul>
</nav>
