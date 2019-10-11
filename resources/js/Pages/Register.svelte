<script>
    import { Inertia } from '@inertiajs/inertia'
    import { InertiaLink } from '@inertiajs/inertia-svelte'
    import Card from '@/components/Card.svelte'
    import Layout from '@/components/Layout.svelte'

    export let errors = undefined

    let email = ''
    let password = ''

    const register = () => {
        Inertia.post(route('api:register'), { email, password })
    }
</script>

<Layout title="Register" class="items-center justify-center">

    <Card class="w-full max-w-xs">

        <h1 class="mb-4 text-3xl font-medium">
            Register
        </h1>

        <form class="flex flex-col" on:submit|preventDefault={register}>

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

            <button type="submit" class="btn btn-teal mt-6 mb-2">
                Register
            </button>

        </form>

    </Card>

    <InertiaLink href={route('login')} class="link link-muted mt-4 text-base">
        Log in
    </InertiaLink>

</Layout>
