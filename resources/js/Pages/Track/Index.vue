<template>
    <MusicLayout>
        <template #title>
            Tracks
        </template>
        <template #action>
            <Link
            v-if="$page.props.isAdmin"
                :href="route('track.create')"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all"
            >
                Créer une musique
            </Link>
        </template>
        <template #content>
            <div class="my-4">
                <input v-model="search" type="search" name="search" id="search" class="border p-2 rounded-md w-full md:w-2/3 lg:w-1/2 xl:w-1/3">
                <div class="flex flex-col mt-4 gap-4">
                    <Track v-for="track in filteredTracks" 
                    :key="track.uuid" 
                    :track="track" :active="currentTrack == track.uuid" 
                    @click="playAudio(track)" />
                </div>
                <div v-if="filteredTracks.length === 0" class="text-center text-gray-600 mt-4">
                Aucun résultat trouvé.
                </div>
            </div>
        </template>
    </MusicLayout>
</template>

<script>
    import MusicLayout from "@/Layouts/MusicLayout.vue";
    import { Link } from "@inertiajs/vue3";
    import Track from "@/Components/Track/Track.vue";

export default {
    components: {
        MusicLayout,
        Link,
        Track,
    },
    props: {
        tracks: Array,
    },
    data(){
        return{
            search: '',
            audio: null,
            currentTrack: null,
        }
    },
    computed: {
        filteredTracks(){
            return this.tracks.filter(track => track.title.toLowerCase().includes(this.search.toLowerCase()));
        }
    },
    methods: {
        playAudio(track) {
            const audioUrl = '/storage/'+ track.music;
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

}
</script>