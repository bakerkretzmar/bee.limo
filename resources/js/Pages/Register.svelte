<script>
    import { Inertia } from '@inertiajs/inertia'
    import { InertiaLink } from '@inertiajs/inertia-svelte'
    import Brand from '@/components/Brand.svelte'
    import Card from '@/components/Card.svelte'

    export let errors = undefined
    let route = window.route

    let email = ''
    let password = ''
</script>

<svelte:head>
    <title>Register | bee.limo</title>
</svelte:head>

<main class="flex flex-col items-center justify-center min-h-screen font-sans font-medium text-lg text-grey-900 bg-cream">

    <Brand class="w-48 my-8"/>

    <Card class="w-full max-w-xs">

        <h1 class="mb-4 text-3xl font-semibold">
            Register
        </h1>

        <form class="flex flex-col" on:submit|preventDefault={() => Inertia.post(route('api:register'), { email, password })}>

            <label class="flex flex-col">
                <span class="text-grey-600">Email</span>
                <input type="text" name="email" class="form-input mt-1" bind:value={email}>
                {#if errors && errors.email}
                    <span class="mt-1 text-sm text-red-600">{errors.email[0]}</span>
                {/if}
            </label>

            <label class="flex flex-col mt-4">
                <span class="text-grey-600">Password</span>
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

    <InertiaLink href={route('login')} class="text-grey-600 hover:text-teal-600 focus:text-teal-600 mt-4 mb-20 text-base">
        Log in
    </InertiaLink>

</main>
