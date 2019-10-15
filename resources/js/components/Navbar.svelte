<script>
    import Brand from '@/components/Brand.svelte'
    import { Inertia } from '@inertiajs/inertia'
    import { InertiaLink } from '@inertiajs/inertia-svelte'

    let route = window.route

    const logout = () => {
        Inertia.post(route('api:logout'))
    }
</script>

<style>
li:hover, li:focus, li:focus-within {
    @apply bg-cream-darker outline-none;
}
</style>

<nav class="flex items-center justify-between px-4 py-3">

    <Brand/>

    <ul class="flex items-center">

        <li class="rounded">
            <InertiaLink class="inline-block px-2 py-1 font-medium" href="/">Home</InertiaLink>
        </li>

        <li class="rounded ml-4">
            <InertiaLink class="inline-block px-2 py-1 font-medium" href="/">About</InertiaLink>
        </li>

        <li class="rounded ml-4">
            <InertiaLink class="inline-block px-2 py-1 font-medium" href="/">Account</InertiaLink>
        </li>

        <li class="rounded ml-4">
            <button class="px-2 py-1 text-grey-600" on:click={logout}>Log out</button>
        </li>

    </ul>

</nav>
