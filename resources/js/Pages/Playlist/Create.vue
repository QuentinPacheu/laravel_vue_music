<template>
    <MusicLayout>
        <template #title>
            Créer une playlist
        </template>
        <template #action>
            <Link :href="route('playlists.index')">
            Retour
            </Link>
        </template>
        <template #content>
            <form @submit.prevent="submit">
                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Titre
                    </label>
                    <input id="title" v-model="form.title"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        :class="{ 'border-red-500': form.errors.title }" type="text" placeholder="Title">
                    <p class="text-red-500 text-xs italic">{{ form.errors.title }}</p>
                </div>
                <div v-for="track in tracks" :key="track.uuid">
                    <input type="checkbox"  :value="track.uuid" v-model="form.tracks"  :id="track.uuid" name="track">
                    <label>{{ track.title }}</label>
                </div>
                <input 
                type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all" 
                value="Ajouter">
            </form>
        </template>
    </MusicLayout>
</template>
<script>
import MusicLayout from '@/Layouts/MusicLayout.vue';
import { Link } from '@inertiajs/vue3';

export default {
    components:{
        MusicLayout,
        Link,
    },
    props: {
        tracks: Array,
    },
    data() {
        return {
            form: this.$inertia.form({
                title: '',
                tracks: [],
            }),
        };
    },
    methods: {
        submit() {
            this.form.post(route('playlists.store'));
        },
    },
}
</script>