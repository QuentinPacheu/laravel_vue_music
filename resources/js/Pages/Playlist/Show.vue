<template>
    <MusicLayout>
        <template #title>
            Playlist Show
        </template>
        <template #action>
            <Link :href="route('playlists.index')"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all">
            Retour
            </Link>
        </template>
        <template #content>
            <Track v-for="track in playlist.tracks" :key="track.uuid" :track="track" :active="currentTrack == track"
                @played="play">
            </Track>
        </template>
    </MusicLayout>
</template>
<script>
import { Link } from "@inertiajs/vue3";
import MusicLayout from "@/Layouts/MusicLayout.vue";
import Track from "@/Components/Track/Track.vue";

export default {
    components: {
        Link,
        MusicLayout,
        Track,
    },
    props: {
        playlist: Object,
    },
    methods: {
        playAudio(track) {
            const audioUrl = '/storage/' + track.music;
            if (!this.currentTrack) {
                this.audio = new Audio(audioUrl);
                this.audio.play();
            } else if (this.currentTrack !== track.uuid) {
                this.audio.pause();
                this.audio.src = audioUrl;
                this.audio.play();
            } else if (!this.audio.paused) {
                this.audio.pause();
            } else {
                this.audio.play();
            }
            this.currentTrack = track.uuid;
            this.audio.addEventListener('ended', () => {
                this.currentTrack = null;
            });
        }
    }
};

</script>