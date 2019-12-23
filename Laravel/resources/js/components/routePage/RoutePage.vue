<template>
    <div id="mapPage" style="height: 100vh;">
        <v-layout column fill-height style="background-color: #C3D091">
            <v-flex xs1>
                <route-page-header></route-page-header>
            </v-flex>

            <v-flex style="position: relative">
                <map-component ref="mapComponent"></map-component>

                <v-layout style="position: absolute; top: 0; right: 0; z-index: 1005;"
                          column justify-start class="searchBarAboveMap"
                          :style="{'width': (($vuetify.breakpoint.mdAndUp) ? 25 : 100) + '%'}"
                          :fill-height="searchFieldIsFocused === true"
                          :class="{'backgroundOnFieldFocused': searchFieldIsFocused === true}">
                    <v-btn class="putOnTop" v-on:click="exportToGoogle" v-if="projectPoints.length > 0">Bekijk de route in Google Maps</v-btn>
                    <v-flex xs1>
                        <v-layout row align-start justify-center>
                            <v-text-field
                                    hide-details
                                    class="mx-3 py-2"
                                    ref="field"
                                    prepend-inner-icon="search"
                                    solo
                                    v-model="searchInput"
                            ></v-text-field>
                            <v-btn fab v-if="searchFieldIsFocused === true"
                                   @click="() => {this.searchFieldIsFocused = false}">
                                <v-icon large>close</v-icon>
                            </v-btn>
                        </v-layout>
                    </v-flex>
                    <div v-bar>
                        <div>
                            <v-flex class="removeScrollbar" xs12 v-if="searchFieldIsFocused === true">
                                <search-list :on-search-tile-clicked="searchTileClicked"
                                             :filtered-map-objects="filteredRoutes"/>
                            </v-flex>
                        </div>
                    </div>
                </v-layout>
            </v-flex>

            <v-flex xs1>
                <v-card height="100%" color="rgb(137, 162, 38, 1)"></v-card>
            </v-flex>
        </v-layout>
    </div>
</template>

<script>
    import {LMap, LTileLayer, LMarker, LPopup} from 'vue2-leaflet';
    import "leaflet/dist/leaflet.css";
    import SearchList from "../mapPage/SearchList"

    import RoutePageHeader from "./route-page-header";
    import ListRoutes from "./list-routes";
    import MapComponent from "../ProjectPage/MapComponent"

    import * as routeList from "../routelist.js";

    export default {
        name: "RoutePage",
        mounted() {
            this.$vuetify.goTo('#routePage');
            this.mapObject = this.$refs.mapComponent.getMapObject();
            this.$refs.mapComponent.assignParentPage(this);

            this.$watch(
                () => {
                    return this.$refs.field.isFocused
                },
                (val) => {
                    if (val === true)
                        this.searchFieldIsFocused = true;
                }
            );

            window.axios
                .get("getAllRoutes")
                .then(response => {
                    for (let i = 0; i < response.data.length; i++) {
                        this.routeList.push({
                            name: response.data[i].name,
                            id: response.data[i].id,
                            location: response.data[i].location,
                        });
                    }

                    this.filteredRoutes = this.routeList;
                })
                .catch(e => {
                    console.log(e);
                });
        },
        props: {
            onProjectOpened: {
                type: Function,
            }
        },
        data() {
            return {
                zoom: 11,
                center: L.latLng(51.7142669290121, 5.3173828125),
                url: 'https://api.mapbox.com/styles/v1/sakirma/cjw0hdemp03kx1coxkbji4wem/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig',
                projectPoints: [],
                routingControl: null,
                mapObject: null,


                searchFieldIsFocused: true,
                searchInput: '',

                routeList: [],
                filteredRoutes: []
            };
        },
        components: {
            RoutePageHeader,
            ListRoutes,
            MapComponent,
            LMap,
            LTileLayer,
            LMarker,
            LPopup,
            SearchList
        },
        methods: {
            GoToMapPage() {
                this.$parent.OpenMapPage();
            },
            disableInputEvents(element) {
                this.$parent.disableInputEvents(element);
            },
            OpenProjectPagePressed: function (projectId, isProject) {
                this.onProjectOpened(projectId, isProject);
            },
            drawPoints: function (arr) {
                this.projectPoints = [];
                for (let i = 0; i < arr.length; i++) {
                    this.projectPoints.push({location: arr[i].location});
                }
                this.$refs.mapComponent.loadMapObjects(arr);
                routeList.routeClicked(this.mapObject, this.projectPoints);
            },
            exportToGoogle: function () {
                if (this.projectPoints.length > 0) {
                    let url = "https://www.google.com/maps/dir/";
                    for (let i = 0; i < this.projectPoints.length; i++) {
                        url = url.toString() + this.projectPoints[i].location.coordinates[1].toString() + "," + this.projectPoints[i].location.coordinates[0].toString() + "/";
                    }
                    window.open(url, "_blank");
                }
            },
            searchTileClicked(item) {
                window.axios.get("getProjectPointOfRoute/" + item.id)
                    .then(response => {
                        this.drawPoints(response.data);
                    });

                if (this.$vuetify.breakpoint.mdAndDown)
                    this.searchFieldIsFocused = false;
            },
        },
        watch: {
            searchInput: function (n, o) {
                this.filteredRoutes = this.routeList.filter(item => {
                    return item.name.toLowerCase().includes(n.toLowerCase());
                });

                if (this.$vuetify.breakpoint.xsOnly)
                    this.searchFieldIsFocused = (n.length !== 0)
            }
        },
    }
</script>

<style>
    .leaflet-top.leaflet-right {
        display: none;
    }

    .putOnTop {
        z-index: 1000;
    }

    .removeScrollbar::-webkit-scrollbar {
        display: none;
    }

    .backgroundOnFieldFocused {
        background-color: rgba(137, 163, 36, 0.58);
    }

    .rounded-bottom-card {
        margin: 0;
        border-radius: 10px 10px 0 0;
        height: 50px;
        width: 100%;
    }

    .searchBarAboveMap {
        position: absolute;
        z-index: 1000;
        top: 0;
        right: 0;
    }
</style>