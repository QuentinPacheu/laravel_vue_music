<template>
    <div
        class="flex items-center flex-row p-4 bg-white shadow-md rounded-md transition duration-300 hover:shadow-lg cursor-pointer">
        <img :src="'/storage/' + track.image" alt="track_cover" class="mr-4 rounded-md w-20 h-20">
        <div @click="playAudio(track)">
            <h3 class="text-xl font-bold text-blue-600 hover:underline">{{ track.title }}</h3>
            <h4 class="text-gray-600">{{ track.artist }}</h4>
        </div>
        <Link
            v-if="$page.props.isAdmin"
            :href="route('track.edit', { track: track })">
            Modifier
            </Link>
            <Link
            v-if="$page.props.isAdmin"
            :href="route('track.destroy', { track: track })" method="delete" as="button">
            Supprimer
            </Link>
    </div>
</template>
<script>
import { Link } from "@inertiajs/vue3";
export default {
    props: {
        track: Object,
    },
    methods: {

    },
    components: {
        Link
    }
}
</script>