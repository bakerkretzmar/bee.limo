<script>
    import api from '@/api'
    import { onMount } from 'svelte'
    import { fade } from 'svelte/transition'
    import { alphabet } from '@/util'
    import { Inertia } from '@inertiajs/inertia'
    import Cell from '@/components/Cell.svelte'
    import Controls from '@/components/Controls.svelte'
    import Entry from '@/components/Entry.svelte'
    import Layout from '@/components/Layout.svelte'
    import Message from '@/components/Message.svelte'
    import Loader from '@/components/Loader.svelte'
    import shuffle from 'lodash/shuffle'
    import debounce from 'lodash/debounce'

    export let puzzle

    let route = window.route
    let loading = true

    let entry = ''
    let outers = shuffle(puzzle.letters.filter(l => l !== puzzle.initial))
    let error = false
    let found = []
    let words = puzzle.words.map(w => w.word)
    let pangram = false
    let pangrams = puzzle.pangrams.map(w => w.word)
    let forbidden = alphabet.filter(l => ! puzzle.letters.includes(l))
    let message = ''

    onMount(async () => {
        let response = await fetch(route('api:game', puzzle.id))
        let data = await response.json()
        found = data.game.found_words || []
        loading = false
    })

    const handleKeydown = (e) => {
        switch (true) {
            case ' ' === e.key:
                return shuffleOuters()
            case /^[a-zA-Z]$/.test(e.key):
                return entry += e.key.toLowerCase()
            case 'Backspace' === e.key:
                e.preventDefault()
                return entry = entry.substr(0, entry.length - 1)
            case 'Escape' === e.key:
                e.preventDefault()
                return clearEntry()
            case 'Enter' === e.key:
                e.preventDefault()
                return checkEntry()
            default:
                return
        }
    }

    const shuffleOuters = () => {
        let shuffled = shuffle(outers)
        outers = ['','','','','','']
        setTimeout(() => outers = shuffled, 200)
    }

    const clearEntry = () => {
        entry = ''
    }

    const checkEntry = () => {
        if (found.includes(entry)) {
            return handleBadEntry('Already found')
        }

        if (words.includes(entry)) {
            if (pangrams.includes(entry)) {
                pangram = true
                return handleGoodEntry('Panagram!')
            }

            return handleGoodEntry('Nice!')
        }

        if (entry.length < 4) {
            return handleBadEntry('Too short')
        }

        if (forbidden.find(l => entry.split('').includes(l)) !== undefined) {
            return handleBadEntry('Bad letters')
        }

        if (! entry.includes(puzzle.initial)) {
            return handleBadEntry('Missing center letter')
        }

        return handleBadEntry('Not in word list')
    }

    const handleBadEntry = (msg) => {
        showMessage(msg)
        error = true
        setTimeout(() => {
            error = false
            clearEntry()
        }, 850)
    }

    const handleGoodEntry = (msg) => {
        showMessage(msg)
        found = [...found, entry]
        clearEntry()
        updateGame()
    }

    const showMessage = (msg) => {
        message = msg
        setTimeout(() => {
            message = ''
            pangram = false
        }, 800)
    }

    const updateGame = debounce(async () => {
        let response = await api.post(route('api:game', puzzle.id), { found_words: found })
        let data = await response.json()
    }, 500)
</script>

<svelte:window on:keydown={handleKeydown} />

<Layout title="Puzzle {puzzle.id.toLocaleString()}">

    <div class="flex items-center justify-center flex-grow">

        <div class="relative flex flex-col items-center">

            <Message {message} {pangram} />

            <Entry {entry} {error} letters={puzzle.letters} center={puzzle.initial} />

            <div class="relative" style="width: 280px; padding-bottom: 294px;">
                <Cell letter={puzzle.initial} on:click={() => entry += puzzle.initial} center />
                <Cell letter={[outers[0]]} on:click={() => entry += outers[0]} y=-100 />
                <Cell letter={[outers[1]]} on:click={() => entry += outers[1]} x=75 y=-50 />
                <Cell letter={[outers[2]]} on:click={() => entry += outers[2]} x=75 y=50 />
                <Cell letter={[outers[3]]} on:click={() => entry += outers[3]} y=100 />
                <Cell letter={[outers[4]]} on:click={() => entry += outers[4]} x=-75 y=50 />
                <Cell letter={[outers[5]]} on:click={() => entry += outers[5]} x=-75 y=-50 />
            </div>

            <Controls {clearEntry} {shuffleOuters} {checkEntry}/>

        </div>

        <div class="relative flex flex-col justify-between ml-12 px-6 py-4 w-full max-w-md h-full max-h-lg border rounded-lg">
            {#if loading}
                <Loader/>
            {:else}
                <ul class="flex flex-col flex-wrap content-start max-h-md overflow-scroll" transition:fade={{duration: 100}}>
                    {#each found.sort() as word}
                        <li class="w-1/3 mb-1 capitalize">{word}</li>
                    {/each}
                </ul>

                <p class="text-center text-xl" transition:fade={{duration: 100}}>{found.length} / {words.length}</p>
            {/if}
        </div>

    </div>

</Layout>
