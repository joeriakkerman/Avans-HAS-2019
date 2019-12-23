<template>
    <l-popup>
        <v-layout column align-center fill-height>
            <p class="text-xs-center title">{{ this.item.name }}
                <br>
                {{this.project ? '(Project)' : ''}}
            </p>
            <v-card-text class="text-xs-center"
                         style="height: 10vh; overflow: hidden;">
                {{ this.item.information }}
            </v-card-text>
            <v-btn dark @click="parent.OpenProjectPagePressed(item.id, project)">Open</v-btn>
        </v-layout>
    </l-popup>
</template>

<script>
    import {LPopup} from 'vue2-leaflet';

    export default {
        name: "PopUp",
        components: {
            LPopup
        },
        props: {
            item: {
                type: Object,
                required: true
            },
            parent: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                project: false
            }
        },
        mounted() {
            this.project = (typeof (this.item.project_id) == 'undefined');
        }
    }
</script>

<style scoped>

</style>