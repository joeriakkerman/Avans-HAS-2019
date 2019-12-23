<template>
    <v-layout align-center justify-center row fill-height>
        <v-flex shrink class="hidden-sm-and-down v-card--reveal">
            <v-layout align-center justify-center fill-height>
                <v-img class="mt-2 roadleafPhoto"
                       src="img/RoadLeaf-Logo.png"
                       height="100%"
                       max-height="100px"
                       contain
                       width="150px"
                       @click="openStatisticsPage"/>
            </v-layout>
        </v-flex>
        <v-btn class="button-page-title title" flat @click="openEditProjectPage"> Projecten</v-btn>
        <v-btn class="button-page-title title" flat @click="openEditRoutesPage"> Interessepunten</v-btn>
        <v-btn class="button-page-title title" flat @click="routesPage"> Routes</v-btn>
        <v-spacer></v-spacer>
        <v-flex class="tooltipTopRight">
            <v-tooltip left content-class="tooltip-inner">
                <template v-slot:activator="{ on }">
                    <v-img class="tooltipImage"
                           contain
                           v-on="on"
                           src="img/context-sensitive-help.png"/>
                </template>
                <span>
                    Dit is het Roadleaf content management systeem.
                    Hiermee kan de inhoud van de website worden beheerd.
                    Druk op Projecten, Interessepunten of Routes om te beginnen.
                    Druk op het Roadleaf logo om terug te gaan naar het beheerder overzicht.
                </span>
            </v-tooltip>
        </v-flex>
        <v-btn class="button-page-title title" icon flat color="white" @click="goBackToPage">
            <v-icon large color="#032C4A"> web</v-icon>
        </v-btn>
        <v-btn class="button-page-title title" icon flat color="white" @click="logout">
            <v-icon large color="#032C4A"> exit_to_app</v-icon>
        </v-btn>
    </v-layout>
</template>

<script>
    export default {
        name: "ProjectPageHeader",
        props: {
            parent: {
                type: Object,
                required: true,
            }
        },
        methods: {
            openEditProjectPage() {
                this.parent.openEditProjectPage();
            },
            openStatisticsPage() {
                this.parent.openStatisticsPage();
            },
            openEditRoutesPage() {
                this.parent.openInterestPointPage();
            },
            routesPage() {
                this.parent.openRoutesPage();
            },
            logout() {
                axios.get('admin/logout').then(response => {
                    window.location.href = '/admin/login';
                });
            },
            goBackToPage() {
                window.location.href = '/';
            }
        }
    }
</script>

<style scoped>
    .button-page-title {
        color: white;
    }

    .button-page-title:hover {
        color: black;
    }

    .button-page-title:hover:before {
        background-color: transparent;
        color: black;
    }

    .roadleafPhoto {
        filter: brightness(0) invert(1);
        cursor: pointer;
        transition: 0.2s;
    }

    .roadleafPhoto:hover {
        filter: brightness(0) invert(0);
    }

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
        max-width: 550px;
    }
</style>
