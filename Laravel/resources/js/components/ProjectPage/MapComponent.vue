<template>
    <l-map ref="map"
           :zoom="zoom"
           :center="center"
           style="height:100%;"
           @click="invokeAddEvent($event)">
        <l-tile-layer :url="url"></l-tile-layer>

        <template v-for="(marker, index) in markers">
            <l-marker :key="index" v-if="isAllowedCategory(marker.category)"
                      :lat-lng="marker.latlng" style="transform: scale(0.1)"
                      :icon="getPin(marker.category)">
                <pop-up :item="marker" :parent="marker.parent"></pop-up>
            </l-marker>
        </template>

        <div v-for="(polygon, index) in polygons">
            <l-polygon :key="index + markers.length"
                       v-if="isAllowedCategory(polygon.category)"
                       :lat-lngs="polygon.latlng"
                       :color="polygonLineColor" :fill-color="polygonFillColor" :fill-opacity="0.6">
                <pop-up id="leaflet-popup" :lat-lng="polygon.latlng[0]" :item="polygon"
                        :parent="polygon.parent"></pop-up>
            </l-polygon>
        </div>

        <template v-for="(polyline, index) in polylines">
            <l-polyline :key="index + markers.length + polygons.length"
                        v-if="isAllowedCategory(polyline.category)"
                        :lat-lngs="polyline.latlng">
                <pop-up :item="polyline" :parent="polyline.parent"></pop-up>
            </l-polyline>
        </template>

        <template v-for="(rectangle, index) in rectangles">
            <l-polyline :key="index + markers.length + polygons.length + polylines.length"
                        v-if="isAllowedCategory(rectangle.category)" :lat-lngs="rectangle.latlng">
                <pop-up :item="rectangle" :parent="rectangle.parent"></pop-up>
            </l-polyline>
        </template>
    </l-map>
</template>

<script>
    import {LMap, LTileLayer, LMarker, LPolygon, LPolyline, LRectangle, LPopup} from 'vue2-leaflet';
    import "leaflet/dist/leaflet.css";
    import PopUp from "./PopUp";

    export default {
        name: 'MapPage',
        props: {
            addEvent: {
                type: Function,
            }
        },
        components: {
            PopUp,
            LMap,
            LTileLayer,
            LMarker,
            LPolygon,
            LPolyline,
            LRectangle,
            LPopup
        },
        data() {
            return {
                zoom: 11,
                center: L.latLng(51.53096001302975, 5.288543701171875),
                url: 'https://api.mapbox.com/styles/v1/sakirma/cjw0hdemp03kx1coxkbji4wem/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig',
                markers: [],

                polygons: [],

                polylines: [],
                rectangles: [],
                buttonImage: "img/MapPage/button.png",
                LeftDropDownButton: ['Projectnaam A', 'Projectnaam B', 'Projectnaam C'],
                RightDropDownButton: ['Een kopje koffie', 'Mooie kunst', 'promenade', 'Heerlijke Snacks', 'Een kopje koffie', 'Mooie kunst', 'promenade', 'Heerlijke Snacks', 'Een kopje koffie', 'Mooie kunst', 'promenade', 'Heerlijke Snacks', 'Een kopje koffie', 'Mooie kunst', 'promenade', 'Heerlijke Snacks'],

                polygonFillColor: '#C5DF24',
                polygonLineColor: '#89a324',
                redPin: L.icon({
                    iconUrl: 'img/Punaise rood.svg',

                    iconSize: [30, 60],
                }),
                bluePin: L.icon({
                    iconUrl: 'img/punaise_eten (2).svg',

                    iconSize: [30, 60],
                }),
                greenPin: L.icon({
                    iconUrl: 'img/punaise_natuur (3).svg',

                    iconSize: [30, 60],
                }),
                yellowPin: L.icon({
                    iconUrl: 'img/punaise_activiteiten (4).svg',

                    iconSize: [30, 60],
                }),

                parent: null,
                currentPopUp: null
            }
        },
        methods: {
            checkOpenPopUp(marker, event) {
                if (this.parent && this.parent.$options._componentTag === "project-page" && this.parent.parent && marker && marker.id == this.parent.parent.selectedProject.id && ((typeof (marker.project_id) !== 'undefined' && !this.parent.parent.selectedProject.project) || (typeof (marker.project_id) == 'undefined' && this.parent.parent.selectedProject.project))) {
                    console.log("show pressed project!");
                    this.$nextTick(() => {
                        event.target.openPopup();
                        this.zoomToPoint(marker);
                    })
                }
            },
            invokeAddEvent(e) {
                if (this.addEvent)
                    this.addEvent(e);
            },
            assignParentPage(parent) {
                this.parent = parent;
            },
            isAllowedCategory(cat) {
                if (!this.parent || typeof (this.parent.pressedImages) == 'undefined')
                    return true;

                if (cat in this.parent.pressedImages)
                    return !this.parent.pressedImages[cat];
                else return false;
            },
            disableInputEvents(element) {
                this.$parent.disableInputEvents(element);
            },
            OpenProjectPagePressed: function (projectId, isProject) {
                this.parent.onProjectOpened(projectId, isProject);
            },
            createPolygon: function (data, coordinates) {
                let points = [];
                for (let k = 0; k < coordinates[0].length; k++) {
                    points.push(L.latLng(coordinates[0][k][1], coordinates[0][k][0]));
                }
                data.latlng = points;
                data.parent = this;
                data.isInteractive = true;
                this.polygons.push(data);
            },
            createPoint: function (data, coordinates) {
                data.latlng = L.latLng(coordinates[1], coordinates[0]);
                data.parent = this;
                this.markers.push(data);
            },
            getMapObject() {
                return this.$refs.map.mapObject;
            },
            loadMapObjects: function (data) {
                this.markers = [];
                this.polygons = [];
                this.polylines = [];
                this.rectangles = [];
                for (let i = 0; i < data.length; i++) {
                    if (data[i].area) data[i].info = data[i].area;
                    else if (data[i].location) {
                        data[i].info = data[i].location;
                    } else continue;

                    if (data[i].info.type == "Point") {
                        this.createPoint(data[i], data[i].info.coordinates);
                    } else if (data[i].info.type == "GeometryCollection") {
                        for (let j = 0; j < data[i].info.geometries.length; j++) {
                            if (data[i].info.geometries[j].type == "Point") {
                                this.createPoint(data[i], data[i].info.geometries[j].coordinates);
                            } else if (data[i].info.geometries[j].type == "Polygon") {
                                this.createPolygon(data[i], data[i].info.geometries[j].coordinates);
                            } else {
                                let points = [];
                                for (let k = 0; k < data[i].info.geometries[j].coordinates.length; k++) {
                                    points.push(L.latLng(data[i].info.geometries[j].coordinates[k][1], data[i].info.geometries[j].coordinates[k][0]));
                                }
                                if (data[i].info.geometries[j].type == "LineString") {
                                    data[i].parent = this;
                                    data[i].latlng = points;
                                    this.polylines.push(data[i]);
                                } else if (data[i].info.geometries[j].type == "Rectangle") {
                                    data[i].parent = this;
                                    data[i].latlng = points;
                                    this.polylines.push(data[i]);
                                }
                            }
                        }
                    }
                }
            },
            setPolygonsInteractive(isInteractive) {
                this.polygons = [];
            },
            getPin(category) {
                switch (category) {
                    case "activiteit":
                        return this.yellowPin;
                    case "eten en drinken":
                        return this.bluePin;
                    case "bezienswaardigheid":
                        return this.redPin;
                    case "natuurgebied":
                        return this.greenPin;
                }
            },
            panTo(lat, lng, zoomIn) {
                this.$refs.map.mapObject.setView([lat,lng], zoomIn);
            }
        },
        mounted() {
        }
    }
</script>

<style scoped>
    .rounded-bottom-card {
        margin: 0;
        border-radius: 10px 10px 0px 0px;
        height: 50px;
        width: 100%;
    }
</style>
