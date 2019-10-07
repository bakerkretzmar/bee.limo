<script>
    import { alphabet } from '@/util'
    import Cell from '@/components/Cell.svelte'
    import Controls from '@/components/Controls.svelte'
    import Entry from '@/components/Entry.svelte'
    import Layout from '@/components/Layout.svelte'
    import Message from '@/components/Message.svelte'
    import shuffle from 'lodash/shuffle'

    export let puzzle

    let entry = ''
    let outers = shuffle(puzzle.others)
    let error = false
    let found = []
    let words = puzzle.words.map(word => word.word)
    let pangram = false
    let pangrams = puzzle.pangrams.map(word => word.word)
    let forbidden = alphabet.filter(l => ! puzzle.letters.includes(l))
    let message = ''

    // $: console.log(puzzle)
    $: alphaFound = found.sort()

    const handleKeydown = (e) => {
        switch (true) {
            case ' ' === e.key:
                return shuffleOuters()
            case /^[a-zA-Z]$/.test(e.key):
                return entry += e.key
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
    }

    const showMessage = (msg) => {
        message = msg
        setTimeout(() => {
            message = ''
            pangram = false
        }, 800)
    }
</script>

<svelte:window on:keydown={handleKeydown} />

<Layout title="Play">

    <div class="flex items-center justify-center flex-grow">

        <div class="relative flex flex-col items-center">

            <Message {message} {pangram} />

            <Entry {entry} {error} letters={puzzle.letters} center={puzzle.initial} />

            <div class="relative" style="width: 300px; padding-bottom: 315px;">
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

        <div class="flex flex-col justify-between ml-12 px-6 py-5 w-full max-w-md h-full max-h-lg border rounded-lg">
            <ul class="flex flex-col flex-wrap">
                {#each alphaFound as word}
                    <li class="w-1/2 mb-1 capitalize">{word}</li>
                {/each}
            </ul>

            <p class="text-center text-xl">{found.length} / {words.length}</p>
        </div>

    </div>

</Layout>
