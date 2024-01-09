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

        </template>
    </MusicLayout>
</template>
<script>
import MusicLayout from '@/Layouts/MusicLayout.vue';

export default {
    components: {
        MusicLayout
    }
}
</script>