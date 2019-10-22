<script>
    import Layout from '@/components/Layout.svelte'

    // export let page
</script>

<style>
p {
    @apply mt-6 leading-relaxed;
}
p a {
    border-bottom-width: 1.5px;
    border-bottom-color: currentColor;
}
p a:hover, p a:focus {
    @apply text-yellow-600 border-yellow-600;
}
</style>

<Layout title="About">

    <section class="w-full max-w-2xl my-12 mx-auto px-4">

        <h1 class="text-4xl font-bold">About <em>bee.limo</em></h1>

        <p><em>bee.limo</em> is a word game based on <a href="https://www.nytimes.com/puzzles/spelling-bee" target="_blank">Spelling Bee</a> from the <em>New York Times</em> crossword—and when I say “based on,” I mean it’s an exact copy of that game. It was a learning exercise, please don’t sue me.</p>

        <p>The dictionary used to solve puzzles and generate wordlists is the <a href="https://www.wordgamedictionary.com/twl06" target="_blank">‘TWL06’</a> Scrabble players’ dictionary, which contains about 178,000 English words. The list of 7-letter combinations used to build new puzzles was generated with the delightful MathsIsFun.com <a href="https://www.mathsisfun.com/combinatorics/combinations-permutations-calculator.html" target="_blank">Combinations and Permutations Calculator</a>.</p>

        <p><em>bee.limo</em> is built with <a href="https://laravel.com" target="_blank">Laravel</a>, <a href="https://svelte.dev" target="_blank">Svelte</a>, and <a href="https://tailwindcss.com" target="_blank">Tailwind</a>. It’s open source—you can browse and download the source code for the project <a href="https://github.com/bakerkretzmar/spelling-bee" target="_blank">here</a>.</p>

    </section>

</Layout>
