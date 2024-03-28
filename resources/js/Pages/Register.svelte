<script>
    import { Link, router } from '@inertiajs/svelte';
    import Brand from '@/components/Brand.svelte';

    export let errors = undefined;
    let route = window.route;

    let email = '';
    let password = '';
</script>

<svelte:head>
    <title>Sign up | bee.limo</title>
</svelte:head>

<main
    class="flex min-h-screen flex-col items-center justify-center bg-cream font-sans text-lg font-medium text-gray-900"
>
    <Brand class="my-8 w-48" />
    <div class="w-full max-w-xs rounded-lg border border-yellow-800/20 px-6 py-4">
        <h1 class="mb-4 text-center text-3xl font-semibold">Sign up</h1>
        <form
            class="flex flex-col"
            on:submit|preventDefault={() => router.post(route('api:register'), { email, password })}
        >
            <label class="flex flex-col gap-1">
                <span class="text-gray-600">Email</span>
                <input type="text" name="email" class="rounded border-yellow-800/20 px-2 py-1.5" bind:value={email} />
                {#if errors && errors.email}
                    <span class="mt-1 text-sm text-red-600">{errors.email}</span>
                {/if}
            </label>
            <label class="mt-4 flex flex-col gap-1">
                <span class="text-gray-600">Password</span>
                <input
                    type="password"
                    name="password"
                    class="rounded border-yellow-800/20 px-2 py-1.5"
                    bind:value={password}
                />
                {#if errors && errors.password}
                    <span class="mt-1 text-sm text-red-600">{errors.password}</span>
                {/if}
            </label>
            <button
                type="submit"
                class="mb-2 mt-6 flex h-10 items-center justify-center rounded bg-yellow-500 font-semibold tracking-wide text-white outline-none hover:bg-yellow-600 focus:bg-yellow-600 focus:ring"
            >
                Sign up
            </button>
        </form>
    </div>
    <Link href={route('login')} class="mb-20 mt-4 text-base text-gray-600 hover:text-yellow-600 focus:text-yellow-600">
        Log in
    </Link>
</main>
