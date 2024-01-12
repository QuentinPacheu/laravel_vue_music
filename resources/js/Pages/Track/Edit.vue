<template>
    <MusicLayout>
        <template #title>
            Musiques
        </template>
        <template #action>
            <Link :href="route('track.index')">
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
                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="artist">
                        Artiste
                    </label>
                    <input id="artist" v-model="form.artist"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        :class="{ 'border-red-500': form.errors.artist }" type="text" placeholder="Artist">
                    <p class="text-red-500 text-xs italic">{{ form.errors.artist }}</p>
                </div>
                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Afficher
                    </label>
                    <select v-model="form.display" name="display" id="display">
                        <option :value="true">Oui</option>
                        <option :value="false">Non</option>
                    </select>
                    <p class="text-red-500 text-xs italic">{{ form.errors.display }}</p>
                </div>
                <input 
                type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all" 
                value="Modifier la musique">
            </form>
        
        </template>
    </MusicLayout>
</template>
<script>
import MusicLayout from '@/Layouts/MusicLayout.vue';
import { Link } from '@inertiajs/vue3';
export default {
    components: {
        MusicLayout, Link
    },
    data() {
        return {
            form: this.$inertia.form({
                title: this.track.title,
                artist: this.track.artist,
                display: this.track.display ? true : false,
            }),
        }
    },
    props: {
        track:Object,
    },

    methods:{
        submit() {
            this.form.put(route('track.update', { track: this.track}));
        }
    }
}
</script>