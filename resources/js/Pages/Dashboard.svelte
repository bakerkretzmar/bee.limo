<script>
    import Layout from '@/components/Layout.svelte'
    import StatCard from '@/components/StatCard.svelte'
    import StatCardGrid from '@/components/StatCardGrid.svelte'
    import ToggleSetting from '@/components/ToggleSetting.svelte'
    import SettingGrid from '@/components/SettingGrid.svelte'

    let words, letter_combinations;

    $: load()

    const load = async () => {
        let response = await fetch('api/stats')
        let data = await response.json()

        if (response.ok) {
            ({ words, letter_combinations } = data)
        } else {
            throw new Error(data)
        }
    }
</script>

<Layout title="Dashboard">
    <div class="flex">
        <StatCardGrid>
            <StatCard title="Words" stat={words}/>
            <StatCard title="Letter combinations" stat={letter_combinations}/>
            <StatCard title="Puzzles"/>
        </StatCardGrid>
        <SettingGrid>
            <ToggleSetting key="auto_puzzle_generation"/>
            <ToggleSetting key="auto_puzzle_analysis"/>
        </SettingGrid>
    </div>
</Layout>
