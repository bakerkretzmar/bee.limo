<script>
    import { Inertia } from '@inertiajs/inertia'
    import { InertiaLink } from '@inertiajs/inertia-svelte'
    import Brand from '@/components/Brand.svelte'

    let route = window.route
</script>

<nav class="flex items-center justify-between px-4 py-3">

    <Brand class="w-24"/>

    <ul class="flex items-center">

        <li class="rounded overflow-hidden">
            <InertiaLink class="inline-block px-3 py-1 font-medium hover:bg-cream-darker focus:bg-cream-darker" href="/">
                Home
            </InertiaLink>
        </li>

        <li class="ml-2 rounded overflow-hidden">
            <InertiaLink class="inline-block px-3 py-1 font-medium hover:bg-cream-darker focus:bg-cream-darker" href="/">
                About
            </InertiaLink>
        </li>

        <li class="ml-2 rounded overflow-hidden">
            <InertiaLink class="inline-block px-3 py-1 font-medium hover:bg-cream-darker focus:bg-cream-darker" href="/">
                Account
            </InertiaLink>
        </li>

        <li class="ml-2 rounded overflow-hidden">
            <button class="px-3 py-1 text-grey-600 hover:bg-cream-dark focus:bg-cream-dark" on:click={() => Inertia.post(route('api:logout'))}>
                Log out
            </button>
        </li>

    </ul>

</nav>
