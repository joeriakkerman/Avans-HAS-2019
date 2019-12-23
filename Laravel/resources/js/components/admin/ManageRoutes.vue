<template>
    <div style="height: 100vh;">
        <div style="height: 80vh;">
            <v-layout column fill-height style="background-color: #89a226">
                <v-flex>
                    <l-map ref="map"
                           :zoom="zoom"
                           :center="center"
                           style="height:100%;">

                        <l-tile-layer :attribution="attribution" :url="url"></l-tile-layer>
                    </l-map>
                </v-flex>
            </v-layout>
        </div>
        <div style="height: 100%">
            <v-flex xs12 sm6 d-flex style="background-color: #89a226">
                <v-combobox
                        box
                        item-text="name"
                        item-value="id"
                        :items="routes"
                        label="Box style"
                        v-on:change="loadRouteFromDataBase"
                ></v-combobox>
                <v-btn color="success" v-on:click="saveRouteToDatabase">Update</v-btn>
                <v-btn color="error" v-on:click="removeRouteFromDatabase">Remove</v-btn>
            </v-flex>
            <v-layout column fill-height style="background-color: #89a226">
                <v-layout v-for="(point, index) in points" v-bind:key="point.id">
                    <div :key="(point, index)">
                        <h3>{{ point.name }}</h3>
                        <P>location: {{ point.location.coordinates[0] }}, {{ point.location.coordinates[1] }}</P>
                        <p>information: {{ point.information }} </p>
                        <input type="checkbox" :id="point.id" v-on:click="checkboxPlace(point, $event)">
                    </div>
                </v-layout>
            </v-layout>
        </div>
    </div>

</template>

<script>

    import {LMap, LTileLayer, LMarker, LControl, LPopup} from 'vue2-leaflet';
    import "leaflet/dist/leaflet.css";

    import axios from 'axios';
    import Options from "vue2-leaflet/src/mixins/Options";

    let leaflet_create = require('../../leaflet_create');

    export default {

        name: "ManageRoutes",

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

                zoom: 11,
                center: L.latLng(51.7142669290121, 5.3173828125),
                url: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',

                points: [],
                routes: [],
                routeHasPoints: [],

                selectedRouteName: "",
                selectedRouteId: null,

                routingControl: null,

            }
        },
        mounted() {
            //set routingControl
            this.routingControl = leaflet_create.default.setVariables();
            this.initialize();
        },

        methods: {
            initialize: function () {

                axios.post('/admin/route/data')
                    .then(response => {
                        let p = response.data.points;
                        let r = response.data.routes;
                        let rp = response.data.routeHasPoints;

                        if (p != null) this.points = p.slice(0);
                        if (r != null) this.routes = r.slice(0);
                        if (rp != null) this.routeHasPoints = rp.routeHasPoints.slice(0);
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },

            checkboxPlace: function (point, event) {
                if (event.target.checked) {
                    this.placePoint(point);
                } else {
                    this.removePoint(point);
                }
            },

            placePoint: function (point) {

                let markers = leaflet_create.default.placeMarker(point);
                let waypoints = leaflet_create.default.createWaypoints(markers);

                if (markers.length < 2) return;

                console.log(this.routingControl);
                this.routingControl.setWaypoints(waypoints);
            },
            removePoint: function (point) {
                leaflet_create.default.removeMarker(point);
            },
            enableCheckbox: function (id) {
                let checkbox = document.getElementById(id);
                if (checkbox === null) return;

                checkbox.checked = true;
            },
            disableCheckbox: function (id) {
                let checkbox = document.getElementById(id);
                if (checkbox === null) return;

                checkbox.checked = false;
            },
            saveRouteToDatabase: function () {
                /*let name = "";
                for (let i=0; i < this.routes.length; i++){

                    //console.log( this.routes[i].id + ", " + this.selectedRouteName );
                    console.log(this.selectedRouteName);
                    if(this.routes[i].id === this.selectedRouteName) { name = this.routes[i].name; break; }
                }
                */
                leaflet_create.default.uploadRoute(this.selectedRouteName);
            },

            loadRouteFromDataBase: function (e) {

                if (e === null) return;

                this.selectedRouteName = (e.name === undefined) ? e : e.name;
                this.selectedRouteId = e.id;
                let id = e.id;

                if (id === undefined) return;
                let t = this;


                t.routingControl.getPlan().setWaypoints([]);
                leaflet_create.default.showRoute(id)
                    .then(function (response) {
                        for (let i = 0; i < t.points.length; i++) {
                            for (let j = 0; j < response.length; j++) {
                                if (t.points[i].id === response[j][0]) {
                                    t.placePoint(t.points[i]);
                                    t.enableCheckbox(t.points[i].id);
                                }
                            }
                        }
                    });
            },

            removeRouteFromDatabase: function () {
                console.log(this.selectedRouteName);
                if (!this.selectedRouteId) return;
                leaflet_create.default.removeRouteFromDatabase(this.selectedRouteId)
            },
        }
    }

</script>

<style>

</style>