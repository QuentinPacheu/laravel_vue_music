<template>
    <MusicLayout>
        <template #title>
            Playlist
        </template>
        <template #action>
            <Link :href="route('playlists.create')"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all">
            Créer une playlist
            </Link>
        </template>
        <template #content>
            <div class="my-4">
                <input v-model="search" type="search" name="search" id="search"
                    class="border p-2 rounded-md w-full md:w-2/3 lg:w-1/2 xl:w-1/3"
                    placeholder="Rechercher une musique..." />
                <div class="flex flex-col mt-4 space-y-4">
                    <Track v-for="track in filteredTracks" :key="track.uuid" :track="track"
                        :active="currentTrack == track.uuid" @played="play" @click="playAudio(track)" />
                </div>
            </div>
            <div>
                <table class="min-w-full border border-gray-300 divide-y divide-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-4 text-left">#</th>
                            <th class="py-2 px-4 text-left">Titre</th>
                            <th class="py-2 px-4 text-left">Nombre de musiques</th>
                            <th class="py-2 px-4 text-left">Créé le</th>
                            <th class="py-2 px-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(playlist, i) in playlists" :key="playlist.uuid">
                            <td class="py-2 px-4">{{ i + 1 }}</td>
                            <td class="py-2 px-4">{{ playlist.title }}</td>
                            <td class="py-2 px-4">{{ playlist.tracks_count }}</td>
                            <td class="py-2 px-4">{{ $moment(playlist.created_at).format('DD/MM/YYYY') }}</td>
                            <Link :href="route('playlists.show', { playlist: playlist.uuid })"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all">
                            Voir
                            </Link>
                            <Link
                            v-if="$page.props.isAdmin"
                            :href="route('playlists.destroy', { playlist: playlist })" method="delete" as="button">
                            Supprimer
                            </Link>
                        </tr>
                    </tbody>
                </table>
            </div>
        </template>
    </MusicLayout>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import MusicLayout from "@/Layouts/MusicLayout.vue";

export default {
    components: {
        Link,
        MusicLayout,
    },
    props: {
        playlists: Array,
    },
};

</script>