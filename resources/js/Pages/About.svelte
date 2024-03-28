<script>
    import Layout from '@/components/Layout.svelte';
</script>

<Layout title="About">
    <section class="mx-auto my-12 w-full max-w-2xl px-4">
        <h1 class="text-4xl font-bold">About <em>bee.limo</em></h1>
        <p>
            <em>bee.limo</em> is a word game based on
            <a href="https://www.nytimes.com/puzzles/spelling-bee" target="_blank">Spelling Bee</a>
            from the <em>New York Times</em> crossword—and when I say “based on,” I mean it’s an exact copy of that
            game. I built it as a learning exercise, please don’t sue me. The general quality of the puzzles in this
            game is, predictably, much lower than that of those in the <em>New York Times</em>, in large part because
            theirs are edited and mine are generated automatically.
        </p>
        <p>
            The words used in this game are those in the <a
                href="https://www.scrabbleplayers.org/w/NWL2018"
                target="_blank">NASPA Word List</a
            >
            2018 Edition, published by the North American Scrabble Players’ Association. The list of 7-letter combinations
            used to build new puzzles was generated with the delightful MathsIsFun.com
            <a href="https://www.mathsisfun.com/combinatorics/combinations-permutations-calculator.html" target="_blank"
                >Combinations and Permutations Calculator</a
            >.
        </p>
        <p>
            <em>bee.limo</em> is built with <a href="https://laravel.com" target="_blank">Laravel</a>,
            <a href="https://svelte.dev" target="_blank">Svelte</a>, and
            <a href="https://tailwindcss.com" target="_blank">Tailwind</a>. It’s open source—you can browse and download
            the source code for the project
            <a href="https://github.com/bakerkretzmar/spelling-bee" target="_blank">here</a>.
        </p>
    </section>
</Layout>

<style>
    p {
        @apply mt-6 leading-relaxed;
    }
    p a {
        border-bottom-width: 1.5px;
        border-bottom-color: currentColor;
    }
    p a:hover,
    p a:focus {
        @apply border-yellow-600 text-yellow-600;
    }
</style>
