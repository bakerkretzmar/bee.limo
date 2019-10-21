<script>
    import Layout from '@/components/Layout.svelte'

    // export let page
</script>

<style>
p {
    @apply mt-6 leading-relaxed;
}
p a {
    @apply border-b-2 border-grey-700;
}
p a:hover, p a:focus {
    @apply text-yellow-600 border-yellow-600;
}
</style>

<Layout title="About">

    <section class="w-full max-w-2xl my-12 mx-auto px-4">

        <h1 class="text-4xl font-bold">About <em>bee.limo</em></h1>

        <p>The dictionary used to solve puzzles and generate wordlists is the <a href="word list: https://www.wordgamedictionary.com/twl06" target="_blank">TWL06</a>, which contains about 178,000 English words. The list of 7-letter combinations used to generate puzzles was built with the delightful MathsIsFun.com <a href="https://www.mathsisfun.com/combinatorics/combinations-permutations-calculator.html" target="_blank">Combinations and Permutations Calculator</a>.</p>

    </section>

</Layout>
