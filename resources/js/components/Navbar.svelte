<script>
    import { Inertia } from '@inertiajs/inertia'
    import { InertiaLink, page } from '@inertiajs/inertia-svelte'
    import Brand from '@/components/Brand.svelte'

    let route = window.route
</script>

<nav class="flex items-center justify-between p-4">

    <InertiaLink href={$page.user ? route('puzzles') : route('splash')}>
        <Brand class="w-24"/>
    </InertiaLink>

    <ul class="flex items-center">

        <li class="ml-2 rounded overflow-hidden">
            <InertiaLink class="inline-block px-3 py-1 hover:bg-cream-darker focus:bg-cream-darker" href={route('about')}>
                About
            </InertiaLink>
        </li>

        {#if $page.user}

            <li class="ml-2 rounded overflow-hidden">
                <InertiaLink class="inline-block px-3 py-1 hover:bg-cream-darker focus:bg-cream-darker" href="/">
                    Account
                </InertiaLink>
            </li>

            <li class="ml-2 rounded overflow-hidden">
                <button class="px-3 py-1 text-grey-600 hover:bg-cream-dark focus:bg-cream-dark" on:click={() => Inertia.post(route('api:logout'))}>
                    Log out
                </button>
            </li>

        {:else}

            <li class="ml-2 rounded overflow-hidden">
                <InertiaLink class="inline-block px-3 py-1 hover:bg-cream-darker focus:bg-cream-darker" href={route('login')}>
                    Log in
                </InertiaLink>
            </li>

        {/if}

    </ul>

</nav>
