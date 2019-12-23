<template>
    <v-layout row fill-height align-center justify-center>
        <v-flex d-flex>
            <v-card-title class="display-2" style="color: #89a324;">
                Routes
            </v-card-title>
        </v-flex>
        <v-flex class="tooltipTopRight">
            <v-tooltip top content-class="tooltip-inner">
                <template v-slot:activator="{ on }">
                    <v-img class="tooltipImage"
                           contain
                           v-on="on"
                           src="img/context-sensitive-help.png"/>
                </template>
                <span>
                    Hier is een lijst van routes te zien. Een route bestaat uit 2 of meer interessepunten.
                    Klik op een route om het te beheren.
                    Met de knop 'route toevoegen' kan een nieuwe route worden gemaakt.
                </span>
            </v-tooltip>
        </v-flex>
        <v-flex fill-height xs6>
            <v-layout row fill-height align-center justify-end>
                <v-btn style="max-width: 10%; height: 55%" color="#89a324" @click="OnEditProjectButtonPressed">
                    <v-card style="white-space: normal; max-width: 65%; " color="transparent" flat class="white--text">
                        Route toevoegen
                    </v-card>
                </v-btn>
                <v-text-field solo hide-details round label="zoek een route" class="search-bar pa-0" flat
                              append-icon="search"
                              v-model="search"
                ></v-text-field>
            </v-layout>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "ProjectsHeader",
        props: {
            OnEditProjectButtonPressed: {
                type: Function,
                required: true,
            },
            parent: {
                type: Object,
                required: true,
            }
        },
        data() {
            return {
                search: "",
            }
        },
        watch: {
            search() {
                this.parent.filterList(this.search);
            }
        }
    }
</script>

<style scoped>
    .tooltipTopRight {
        max-width: 30px;
        right: 10px;
        position: relative;
    }

    .tooltipImage {
        width: 20px;
        height: 20px;
    }

    .tooltip-inner {
        color: white;
        padding: 24px;
        border-radius: 5px;
        box-shadow: 0 5px 30px;
        max-height: 200px;
        max-width: 450px;
    }
</style>