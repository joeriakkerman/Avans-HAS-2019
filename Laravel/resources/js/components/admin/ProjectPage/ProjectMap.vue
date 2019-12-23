<template>
    <map-component ref="map" :parent-page="parent" :add-event="add"></map-component>
</template>

<script>
    import {LMap, LTileLayer, LMarker, LPolygon, LPolyline, LRectangle, LPopup,} from 'vue2-leaflet';

    import MapComponent from "../Map";
    import "leaflet/dist/leaflet.css";

    export default {
        name: "ProjectMap",
        components: {
            LPolygon,
            LMap,
            LTileLayer,
            LMarker,
            MapComponent,
        },
        props: {
            parent: {
                type: Object,
                required: true
            },
            latLngs: {
                type: Array,
                default: () => []
            },

        },
        data() {
            return {
                zoom: 11,
                center: L.latLng(51.7142669290121, 5.3173828125),
                url: 'https://api.mapbox.com/styles/v1/sakirma/cjw0hdemp03kx1coxkbji4wem/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig',
                isDrawMode: false,
                markers: [],
                coordinates: [],
                polygon: {
                    latlngs: [],
                    color: 'green'
                },
                leafletPolygon: null,
                mapObject: null,
            }
        },
        methods: {
            setDrawMode(value) {
                this.setPolygonsInteractive(!value);
                this.isDrawMode = value;
            },
            clearMap() {
                if (this.markers.length > 0) {
                    this.markers.splice(-1, 1);
                }
            },
            add(event) {
                if (this.isDrawMode) {
                    this.polygon.latlngs.push([event.latlng.lat, event.latlng.lng]);
                    this.onPolygonChanged();
                }
            },
            onPolygonChanged() {
                if (this.leafletPolygon)
                    this.mapObject.removeLayer(this.leafletPolygon);

                this.leafletPolygon = L.polygon(this.polygon.latlngs);
                this.leafletPolygon.addTo(this.mapObject);
            },
            setPolygonsInteractive(isInteractive) {
                this.$refs.map.setPolygonsInteractive(isInteractive);
            },
            resetPolygon() {
                this.polygon.latlngs = [];
                if (this.leafletPolygon)
                    this.mapObject.removeLayer(this.leafletPolygon);
            },
            loadMapObjects(projects) {
                this.$refs.map.loadMapObjects(projects);
            }
        },
        mounted() {
            this.$refs.map.assignParentPage(this.parent);
            this.mapObject = this.$refs.map.getMapObject();
        }
    }
</script>

<style scoped>
    .categorieButton {
        border-radius: 5px;
    }
</style>
