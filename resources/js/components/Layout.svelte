<script>
    import Navbar from '@/components/Navbar.svelte'

    export let title
    let classes = ''
    export { classes as class }
</script>

<svelte:head>
    <title>{title} | bee.limo</title>
</svelte:head>

<main class="flex flex-col min-h-screen font-sans font-medium text-lg text-gray-900 bg-cream {classes}">

    <Navbar/>

    <slot/>

</main>
