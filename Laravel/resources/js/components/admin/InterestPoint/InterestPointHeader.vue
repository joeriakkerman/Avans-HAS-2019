<template>
    <v-layout row fill-height align-center justify-center>
        <v-flex d-flex>
            <v-card-title class="display-2" style="color: #89a324;">
                Interessepunten
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
                    Hier is een lijst van interessepunten te zien.
                    Door er op te klikken kan een interessepunt beheerd worden.
                    Met de knop 'Punt toevoegen' kan er een nieuw interessepunt worden gemaakt.
                </span>
            </v-tooltip>
        </v-flex>
        <v-flex fill-height xs6>
            <v-layout row fill-height align-center justify-end>
                <v-btn style="max-width: 10%; height: 55%" color="#89a324" @click="OnEditProjectButtonPressed">
                    <v-card style="white-space: normal; max-width: 66%; " color="transparent" flat class="white--text">
                        Punt Toevoegen
                    </v-card>
                </v-btn>
                <v-text-field solo hide-details round label="zoek een interessepunt" class="search-bar pa-0" flat append-icon="search" v-model="search"></v-text-field>
            </v-layout>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "InterestPointHeader",
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
        max-height: 100px;
        max-width: 450px;
    }
</style>