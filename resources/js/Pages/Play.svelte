<script>
    import Cell from '@/components/Cell.svelte'
    import Controls from '@/components/Controls.svelte'
    import Entry from '@/components/Entry.svelte'
    import Layout from '@/components/Layout.svelte'
    import shuffle from 'lodash/shuffle'

    export let puzzle

    let entry
    let outers = puzzle.others

    $: console.log(puzzle)

    const check = () => {
        console.log('suibmitted!!')
    }

    const handleKeydown = (e) => {
        switch (e.key) {
            case ' ':
                return shuffleOuters()
            default:
                return console.log(e.key)
        }
    }

    const shuffleOuters = () => {
        let shuffled = shuffle(outers)
        outers = ['','','','','','']
        setTimeout(() => outers = shuffled, 200)
    }

    const clearEntry = () => {
        console.log('clearEntry')
    }

    const submitEntry = () => {
        console.log('submitEntry')
    }
</script>

<svelte:window on:keydown={handleKeydown} />

<Layout title="Play">
    <div class="flex items-center justify-center flex-grow">

    <!-- <input type="text" bind:value={guess} on:keydown={(e) => e.key === 'Enter' && check()} /> -->

        <div class="flex flex-col">

            <Entry {entry} letters={puzzle.letters}/>

            <div class="relative" style="width: 300px; padding-bottom: 315px;">
                <Cell letter={puzzle.initial} center />
                <Cell letter={[outers[0]]} y=-100 />
                <Cell letter={[outers[1]]} x=75 y=-50 />
                <Cell letter={[outers[2]]} x=75 y=50 />
                <Cell letter={[outers[3]]} y=100 />
                <Cell letter={[outers[4]]} x=-75 y=50 />
                <Cell letter={[outers[5]]} x=-75 y=-50 />
            </div>

            <Controls {clearEntry} {shuffleOuters} {submitEntry}/>

        </div>

        <div>
            answers
        </div>

    </div>
</Layout>
