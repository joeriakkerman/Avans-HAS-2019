<template>
    <div id="mapPage" style="height: 100vh;">
        <v-layout column fill-height style="background-color: #89a226">
            <v-flex ma-3 xs1></v-flex>

            <v-flex>
                <l-map :center="center" :zoom="zoom" id="map" ref="map" style="height:100%;">
                    <v-container fluid grid-list-md ma-0 pa-0>
                        <v-layout align-start fill-height justify-end row>
                            <list-routes :routesParent="this"></list-routes>
                        </v-layout>
                        <v-layout justify-end>
                            <v-btn class="putOnTop" v-on:click="exportToGoogle">Bekijk de route in Google Maps</v-btn>
                        </v-layout>
                    </v-container>

                    <l-tile-layer :attribution="attribution" :url="url"></l-tile-layer>

                    <template v-for="(marker, index) in markers">
                        <l-marker :key="index" :lat-lng="marker.latlng">
                            <l-popup>
                                <v-btn @click="OpenProjectPagePressed(1)">To Project Page</v-btn>
                            </l-popup>
                        </l-marker>
                    </template>

                </l-map>
            </v-flex>

            <v-flex xs1>
                <v-card color="rgb(137, 162, 38, 1)" height="100%"></v-card>

            </v-flex>
        </v-layout>
    </div>
</template>

<script>
    import MapPage from "./MapPage";
    import {LMap, LTileLayer, LMarker, LControl, LPopup} from "vue2-leaflet";
    import "leaflet/dist/leaflet.css";
    import ListRoutes from "./routePage/list-routes";

    import MapPageHeader from "./map-page-header";
    import DropDownButton from "./mapPage/DropDownButton";

    import routing from "leaflet-routing-machine";
    import * as routeList from "./routelist.js";

    export default {
        name: "RoutesComponent",
        components: {
            MapPageHeader,
            DropDownButton,
            LMap,
            LTileLayer,
            LMarker,
            LPopup,
            LControl,
            ListRoutes
        },
        data() {
            return {
                zoom: 11,
                center: L.latLng(51.7142669290121, 5.3173828125),
                url: "http://{s}.tile.osm.org/{z}/{x}/{y}.png",
                attribution:
                    '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                markers: [],
                projectPoints: [],
                routingControl: null,
                map: null,
            };
        },
        methods: {
            disableInputEvents(element) {
                this.$parent.disableInputEvents(element);
            },
            OpenProjectPagePressed: function (projectId) {
                this.$root.onProjectOpened(projectId);
            },
            drawPoints: function ($arr) {
                this.markers = [];
                this.projectPoints = [];
                for (let i = 0; i < $arr.length; i++) {
                    this.projectPoints.push({location: $arr[i].location});
                    var pointId = this.projectPoints[i].id;
                    var lat = this.projectPoints[i].location.coordinates[1];
                    var lng = this.projectPoints[i].location.coordinates[0];
                    this.markers.push({
                        id: pointId,
                        latlng: L.latLng(parseFloat(lat), parseFloat(lng)),
                        content: ""
                    });
                }
                routeList.routeClicked(this.$refs.map.mapObject, this.projectPoints);
            },
            exportToGoogle: function () {
                if (this.projectPoints.length > 0) {
                    let url = "https://www.google.com/maps/dir/";
                    for (let i = 0; i < this.projectPoints.length; i++){
                        url = url.toString() + this.projectPoints[i].location.coordinates[1].toString() + "," +this.projectPoints[i].location.coordinates[0].toString() + "/";
                    }
                    window.open(url, "_blank");
                }
            },
        },
    };
</script>

<style>
    .leaflet-top.leaflet-right {
        display: none;
    }
    .putOnTop {
        z-index: 1000;
    }
</style>
