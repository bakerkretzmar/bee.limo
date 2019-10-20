<script>
    import Navbar from '@/components/Navbar.svelte'

    export let title
    let classes = ''
    export { classes as class }
</script>

<svelte:head>
    <title>{title} | bee.limo</title>
</svelte:head>

<main class="flex flex-col min-h-screen font-sans text-lg text-grey-900 bg-cream {classes}">

    <Navbar/>

    <slot/>

</main>
