<script>
    import api from '@/api'
    import { onMount } from 'svelte'
    import { fade } from 'svelte/transition'
    import { Inertia } from '@inertiajs/inertia'
    import { InertiaLink, page } from '@inertiajs/inertia-svelte'
    import Layout from '@/components/Layout.svelte'
    import Message from '@/components/Message.svelte'
    import PuzzleControls from '@/components/PuzzleControls.svelte'
    import PuzzleInput from '@/components/PuzzleInput.svelte'
    import PuzzleLetters from '@/components/PuzzleLetters.svelte'
    import PuzzleWords from '@/components/PuzzleWords.svelte'
    import shuffle from 'lodash/shuffle'
    import debounce from 'lodash/debounce'

    export let puzzle

    let route = window.route
    let loading = true

    let input = ''
    let outers = shuffle(puzzle.letters.filter(l => l !== puzzle.initial))
    let found = []
    let words = puzzle.words.map(w => w.word)
    let pangrams = puzzle.pangrams.map(w => w.word)
    let erroring = false
    let justChecked = false
    let justFoundPangram = false
    let justFoundScore = 0
    let initialGenius = false
    let profanity = false
    let message = ''
    let keysDown = []

    $: ignoreKeys = keysDown.includes('Alt') || keysDown.includes('Control') || keysDown.includes('Meta')
    $: complete = found.length >= words.length
    $: score = found.reduce((score, word) => {
        if (word.length === 4) return score + 1
        return score + word.length + (pangrams.includes(word) ? 7 : 0)
    }, 0)
    $: genius = score >= puzzle.analysis.genius_score
    $: if (genius && !initialGenius) {
        initialGenius = true
        setTimeout(() => alert(`ATTENTION: YOU ARE A GENIUS`), 400)
    }

    onMount(async () => {
        if ($page.props.user.email) {
            let response = await fetch(route('api:games.show', puzzle.id))
            let data = await response.json()
            found = data.game.found_words || []
        }
        initialGenius = genius
        loading = false
    })

    function handleKeydown(e) {
        if (justChecked) {
            justChecked = false
            profanity = false
            erroring = false
            clearInput()
        }

        if (e.key === 'Backspace') {
            e.preventDefault()
            input = input.substr(0, input.length - 1)
            return
        }

        if (ignoreKeys) return

        keysDown = [...keysDown, e.key]

        switch (true) {
            case ' ' === e.key:
                return shuffleOuters()
            case /^[a-zA-Z]$/.test(e.key):
                return input += e.key.toLowerCase()
            case 'Escape' === e.key:
                e.preventDefault()
                return clearInput()
            case 'Enter' === e.key:
                e.preventDefault()
                return checkInput()
        }
    }

    function handleKeyup(e) {
        keysDown = keysDown.filter(k => k !== e.key)
    }

    function shuffleOuters() {
        let shuffled = shuffle(outers)
        outers = ['','','','','','']
        setTimeout(() => outers = shuffled, 200)
    }

    function clearInput() {
        input = ''
    }

    function checkInput() {
        if (['fuck', 'shit', 'cunt', 'ass', 'bitch'].includes(input)) {
            profanity = true
            return handleBadInput('HEY.')
        }

        if (found.includes(input)) {
            return handleBadInput('Already found')
        }

        if (words.includes(input)) {
            justFoundScore = getWordScore(input)

            if (pangrams.includes(input)) {
                justFoundPangram = true
                return handleGoodInput('Panagram!')
            }

            return handleGoodInput('Nice!')
        }

        if (input.length < 4) {
            return handleBadInput('Too short')
        }

        if (input.split('').find(l => !puzzle.letters.includes(l)) !== undefined) {
            return handleBadInput('Bad letters')
        }

        if (! input.includes(puzzle.initial)) {
            return handleBadInput('Missing center letter')
        }

        return handleBadInput('Not in word list')
    }

    function handleBadInput(msg) {
        erroring = true
        message = msg
        justChecked = true
        setTimeout(() => {
            erroring = false
            message = ''
            if (justChecked) {
                justChecked = false
                profanity = false
                clearInput()
            }
        }, 850)
    }

    function handleGoodInput(msg) {
        justChecked = true
        message = complete ? 'GENIUS!!' : msg
        found = [...found, input]
        clearInput()
        updateGame()
        setTimeout(() => {
            message = ''
            if (justChecked) {
                justChecked = false
                justFoundPangram = false
                justFoundScore = 0
            }
        }, 850)
    }

    const updateGame = debounce(async () => {
        if (! $page.props.user.email) return
        let response = await api.post(route('api:games.update', puzzle.id), { found_words: found, complete: genius })
    }, 500)

    function getWordScore(word) {
        if (word.length === 4) return 1
        return word.length + (pangrams.includes(word) ? 7 : 0)
    }
</script>

<svelte:window on:keydown={handleKeydown} on:keyup={handleKeyup} on:blur={() => keysDown = []}/>

<Layout title="Puzzle {puzzle.id.toLocaleString()}">

    <div class="flex justify-center my-12">

        <div class="relative flex flex-col items-center">

            <Message {message} score={justFoundScore} pangram={justFoundPangram} {profanity}/>

            <PuzzleInput input={input} {erroring} initial={puzzle.initial} letters={puzzle.letters}/>

            <PuzzleLetters initial={puzzle.initial} {outers} on:click={(e) => input += e.detail}/>

            <PuzzleControls {clearInput} {shuffleOuters} {checkInput}/>

            {#if !$page.props.user.email}
                <p class="mt-8 text-base text-grey-500">
                    <InertiaLink class="text-yellow-500 hover:text-yellow-600 focus:text-yellow-600" href={route('login')}>Sign in</InertiaLink> to save your progress.
                </p>
            {/if}

        </div>

        <PuzzleWords {loading} {found} {score} genius={puzzle.analysis.genius_score} max={puzzle.analysis.max_score}/>

    </div>

</Layout>
