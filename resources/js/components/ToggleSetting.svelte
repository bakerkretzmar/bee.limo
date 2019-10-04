<script>
    import { tick } from 'svelte'
    import api from '@/api'

    export let key

    let value = false
    let loading = true
    let title = key[0].toUpperCase() + key.slice(1).replace(/_/g, ' ')

    $: load(key)
    $: update(value)

    const update = async (value) => {
        if (loading) return

        await api.post('api/settings', { key, value })
            .then(response => response.json())
            .catch(error => console.error(error))
    }

    const load = async (key) => {
        value = await api.get('api/settings')
            .then(response => response.json())
            .then(data => data[key])

        tick().then(() => loading = false)
    }
</script>

<div class="flex items-center px-6 py-4 bg-yellow-200 rounded-lg shadow-md">

    <label class="inline-flex rounded-full">
        <input type="checkbox" class="hidden" bind:checked={value}>
        <div class="toggle"></div>
    </label>

    <p class="ml-4">{title}</p>

</div>
