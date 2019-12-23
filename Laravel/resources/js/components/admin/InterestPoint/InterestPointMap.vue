<template>
    <map-component ref="mapComponent" :add-event="add">

    </map-component>
</template>

<script>
    import {LMap, LTileLayer, LMarker, LPolygon, LPolyline, LRectangle, LPopup} from 'vue2-leaflet';
    import "leaflet/dist/leaflet.css";
    import mapComponent from "../Map";

    export default {
        name: "InterestPointMap",
        components: {
            LMap,
            LTileLayer,
            LMarker,
            mapComponent,
        },
        props: {
            parent: {
                type: Object,
                required: true,
            }
        },
        data() {
            return {
                zoom: 11,
                center: L.latLng(51.7142669290121, 5.3173828125),
                url: 'https://api.mapbox.com/styles/v1/sakirma/cjw0hdemp03kx1coxkbji4wem/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig',
                isDrawMode: false,
                markers: [],
                mapObject: null,
                placedMarker: null,
                newMode: false,
                editMode: false
            }
        },
        mounted() {
            this.$refs.mapComponent.assignParentPage(this.parent);
            this.mapObject = this.$refs.mapComponent.getMapObject();
        },
        methods: {
            setNewMode(value) {
                this.newMode = value;
            },
            setEditMode(value) {
                this.editMode = value;
            },
            setDrawMode(value) {
                this.isDrawMode = value;
            },
            loadMapObjects(points) {
                this.$refs.mapComponent.loadMapObjects(points);
            },
            clearMap() {
                if (this.placedMarker)
                    this.mapObject.removeLayer(this.placedMarker);
            },
            editPoint(lat, lng) {
                this.placedMarker = L.marker([lat, lng]);
                this.placedMarker.addTo(this.mapObject);
            },
            add(event) {
                if (this.isDrawMode) {
                    let coords = event.latlng;
                    let lat = coords.lat;
                    let lng = coords.lng;

                    if (this.placedMarker)
                        this.mapObject.removeLayer(this.placedMarker);

                    this.placedMarker = L.marker([lat, lng]);
                    this.placedMarker.addTo(this.mapObject);

                    if (this.newMode) {
                        let newInterestPageComponent = this.parent.$refs.newInterestPage;
                        newInterestPageComponent.marker = this.placedMarker._latlng;
                        newInterestPageComponent.markerLat = this.placedMarker._latlng.lat;
                        newInterestPageComponent.markerLng = this.placedMarker._latlng.lng;
                    }
                    if (this.editMode) {
                        this.parent.$refs.projectEditSection.markerLat = this.placedMarker._latlng.lat;
                        this.parent.$refs.projectEditSection.markerLong = this.placedMarker._latlng.lng;
                    }
                }
            },
        }
    }
</script>

<style scoped>
    .categorieButton {
        border-radius: 5px;
    }
</style>