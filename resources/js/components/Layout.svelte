<script>
    import Navbar from '@/components/Navbar.svelte';

    export let title;
    let classes = '';
    export { classes as class };
</script>

<svelte:head>
    <title>{title} | bee.limo</title>
</svelte:head>

<main class="flex min-h-screen flex-col bg-cream font-sans text-lg font-medium text-gray-900 {classes}">
    <Navbar />
    <slot />
</main>
