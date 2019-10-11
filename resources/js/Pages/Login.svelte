<script>
    import { Inertia } from '@inertiajs/inertia'
    import { InertiaLink } from '@inertiajs/inertia-svelte'
    import Card from '@/components/Card.svelte'
    import Layout from '@/components/Layout.svelte'

    export let errors = undefined

    let email = ''
    let password = ''
    let remember = false

    const login = () => {
        Inertia.post(route('api:login'), { email, password, remember })
    }
</script>

<Layout title="Log in" class="items-center justify-center">

    <Card class="w-full max-w-xs">

        <h1 class="mb-4 text-3xl font-medium">
            Log in
        </h1>

        <form class="flex flex-col" on:submit|preventDefault={login}>

            <label class="flex flex-col">
                <span class="text-grey-700">Email</span>
                <input type="text" name="email" class="form-input mt-1" bind:value={email}>
                {#if errors && errors.email}
                    <span class="mt-1 text-sm text-red-600">{errors.email[0]}</span>
                {/if}
            </label>

            <label class="flex flex-col mt-4">
                <span class="text-grey-700">Password</span>
                <input type="password" name="password" class="form-input mt-1" bind:value={password}>
                {#if errors && errors.password}
                    <span class="mt-1 text-sm text-red-600">{errors.password[0]}</span>
                {/if}
            </label>

            <label class="flex items-center mt-4">
                <input type="checkbox" class="form-checkbox" bind:checked={remember}>
                <span class="ml-2">Remember me</span>
            </label>

            <button type="submit" class="btn btn-teal mt-6 mb-2">
                Log in
            </button>

        </form>

    </Card>

    <InertiaLink href={route('register')} class="link link-muted mt-4 text-base">
        Register
    </InertiaLink>

</Layout>
