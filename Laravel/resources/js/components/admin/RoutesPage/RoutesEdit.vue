<template>
    <div class="projectEditSection" v-bar>
        <div>
            <v-layout align-center justify-space-between row>
                <v-card-title class="display-1">Route</v-card-title>
                <v-flex class="tooltipTopRight">
                    <v-tooltip top content-class="tooltip-inner">
                        <template v-slot:activator="{ on }">
                            <v-img class="tooltipImage"
                                   contain
                                   v-on="on"
                                   src="img/context-sensitive-help.png"/>
                        </template>
                        <span>
                            Op deze pagina kan een route worden gewijzigd.
                            Geef de route een passende naam.
                            Kies alle interessepunten die in de route opgenomen moeten worden.
                            Verander de volgorde van de punten in de route door ze te verslepen in de lijst.
                            Druk op 'aanpassing toepassen' om de wijziging door te voeren of op 'route verwijderen' om de route weg te gooien.
                        </span>
                    </v-tooltip>
                </v-flex>
                <v-btn fab flat @click="close">
                    <v-icon x-large color="green">close</v-icon>
                </v-btn>
            </v-layout>
            <v-layout column>
                <v-flex xs1>
                    <v-layout row>
                        <v-flex xs3>
                            <v-card-title class="title">Naam:</v-card-title>
                        </v-flex>
                        <v-flex xs3>
                            <v-text-field v-model="selectedRoute.name">
                            </v-text-field>
                        </v-flex>
                    </v-layout>
                </v-flex>

                <v-flex xs1>
                    <v-layout row align-start>
                        <v-card-title style="padding-top: 0 !important;" class="title">Punten toevoegen:</v-card-title>
                        <project-selection-list ref="selectionList"></project-selection-list>
                    </v-layout>
                </v-flex>

                <v-flex xs1 pt-5>
                    <v-layout row>
                        <v-card-title
                                class="title"
                                :key="routeInformation.distance"
                        >Uitgerekende kilometers: {{routeInformation.distance}}
                        </v-card-title>
                    </v-layout>
                </v-flex>
                <v-flex xs1>
                    <v-layout row>
                        <v-card-title
                                class="title"
                                :key="routeInformation.time"
                        >Uitgerekende duur {{routeInformation.time}}
                        </v-card-title>
                    </v-layout>
                </v-flex>

                <v-flex xs1 pr-5>
                    <v-layout reverse row xs1>
                        <v-btn style="max-width: 10%; height: 100%;" color="#89A226">
                            <v-card style="white-space: normal; max-width: 60%;" color="transparent" flat
                                    class="white--text"
                                    @click="saveRouteToDatabase"
                            >
                                Aanpassing toepassen
                            </v-card>
                        </v-btn>

                        <v-btn style="max-width: 10%; height: 100%;" color="#89A226">
                            <v-card style="white-space: normal; max-width: 60%;" color="transparent" flat
                                    class="white--text"
                                    @click="removeRouteFromDatabase"
                            >
                                Route verijderen
                            </v-card>
                        </v-btn>
                    </v-layout>
                </v-flex>
            </v-layout>
        </div>
    </div>
</template>

<script>
    import draggable from "vuedraggable";
    import ProjectSelectionList from "./ProjectSelectionList";

    import {LMap, LTileLayer, LMarker, LControl, LPopup} from 'vue2-leaflet';
    import "leaflet/dist/leaflet.css";
    import Options from "vue2-leaflet/src/mixins/Options";

    import axios from 'axios';

    let leaflet_create = require('../../../leaflet_create');

    export default {
        name: "ProjectsEdit",
        components: {
            Options,
            LMap,
            LTileLayer,
            LMarker,
            LPopup,
            LControl,
        },
        data() {
            return {
                selectedRoute: {
                    id: '', // ID is used to get data from database, as an example, to retrieve which image and youtube url is being used.
                    name: '',
                    categorie: '',
                    beschrijving: '',
                },

                map: null,
                routingControl: null,
                routeInfo: null,
                routeInformation: {
                    distance: 0,
                    time: 0,
                },
            }
        },
        props: {
            parent: {
                type: Object,
                required: true,
            }
        },
        methods: {
            loadProjectPoints(id) {

                let t = this;
                axios.post('/admin/route/points', {
                    routeId: id,
                }).then(response => {
                    let selectedPoints = [];
                    response.data.forEach(function (point) {
                        t.placePoint(point);
                        selectedPoints.push(point);
                    });
                    this.$refs.selectionList.enableInterestPoints(selectedPoints);
                });
            },
            placePoint: function (point) {

                let markers = leaflet_create.default.placeMarker(point);
                let waypoints = leaflet_create.default.createWaypoints(markers);

                if (markers.length < 2) return;

                this.routingControl.setWaypoints(waypoints);
            },
            removePoint: function (point) {
                leaflet_create.default.removeMarker(point);
            },
            removeFromView(e) {
                this.$refs.selectionList.removeElementById(e.layer.options.id);
            },
            clearMarkers: function () {
                leaflet_create.default.clearMarkers();
            },
            loadEditSection(product, points, map) {
                this.selectedRoute = product;

                this.map = map;
                this.routingControl = leaflet_create.default.setVariables(map);

                this.loadProjectPoints(product.route);
                this.$refs.selectionList.addInterestPoints(points);

                let markers = leaflet_create.default.getProjectMarkers();
                markers.on('dblclick', this.removeFromView);

                this.routingControl.on('routesfound', (e) => this.getRouteInformation(e));
            },
            getRouteInformation(e) {
                this.routeInformation = {
                    distance: Number(Math.round(e.routes[0].summary.totalDistance / 1000 + 'e2') + 'e-2'),
                    time: Number(Math.round(e.routes[0].summary.totalTime / 3600 + 'e2') + 'e-2'),
                };
            },
            saveRouteToDatabase() {
                leaflet_create.default.uploadRoute(this.selectedRoute.name)
                this.close();
            },
            removeRouteFromDatabase: function () {
                if (!this.selectedRoute.route) return;
                leaflet_create.default.removeRouteFromDatabase(this.selectedRoute.route)
                this.close();
            },
            close() {
                this.clearMarkers();
                this.map.removeControl(this.routingControl);
                this.$refs.selectionList.clearInterestPoints();

                this.routeInformation = {
                    distance: 0,
                    time: 0,
                };

                this.parent.enableViewMode();
            },
        },
        components: {
            draggable,
            ProjectSelectionList,
        }
    }
</script>

<style>
    .roundedCorners.v-input .v-input__control .v-input__slot {
        border-radius: 15px;
        background-color: rgba(137, 163, 36, 0.6);
    }

    .routeButton {
        border-style: solid;
        border-color: rgba(137, 163, 36, 0.6);
        border-width: 2px;
    }

    .routeDrag {
        cursor: grab;
    }

    .projectEditSection {
        height: 100%;
        border-radius: 20px;
        border-style: solid;
        border-width: 2px;
        border-color: #89a226;
    }

    .removeScrollbar::-webkit-scrollbar {
        display: none;
    }

    .projectTable .v-datatable .v-datatable__actions .v-datatable__actions__select {
        display: none;
    }

    .projectTable .v-table__overflow {
        overflow-y: hidden;
        padding-right: 15px;
    }

    .vb > .vb-dragger {
        z-index: 5;
        width: 12px;
        right: 0;
    }

    .vb > .vb-dragger > .vb-dragger-styler {
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        -webkit-transform: rotate3d(0, 0, 0, 0);
        transform: rotate3d(0, 0, 0, 0);
        -webkit-transition: background-color 100ms ease-out,
        margin 100ms ease-out,
        height 100ms ease-out;
        transition: background-color 100ms ease-out,
        margin 100ms ease-out,
        height 100ms ease-out;
        background-color: rgba(38, 38, 38, 0.1);
        margin: 5px 5px 5px 0;
        border-radius: 20px;
        height: calc(100% - 10px);
        display: block;
    }

    .vb.vb-scrolling-phantom > .vb-dragger > .vb-dragger-styler {
        background-color: rgba(38, 38, 38, 0.3);
    }

    .vb > .vb-dragger:hover > .vb-dragger-styler {
        background-color: rgba(38, 38, 38, 0.5);
        margin: 0px;
        height: 100%;
    }

    .vb.vb-dragging > .vb-dragger > .vb-dragger-styler {
        background-color: rgba(38, 38, 38, 0.5);
        margin: 0px;
        height: 100%;
    }

    .vb.vb-dragging-phantom > .vb-dragger > .vb-dragger-styler {
        background-color: rgba(38, 38, 38, 0.5);
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
        max-height: 200px;
        max-width: 450px;
    }
</style>
