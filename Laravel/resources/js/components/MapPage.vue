<template>
    <div id="mapPage" style="height: 100vh;">
        <v-layout column fill-height style="background-color: #89a226">
            <v-flex sm1 xs2>
                <map-page-header :parent="this"></map-page-header>
            </v-flex>

            <v-flex style="position: relative">
                <map-component ref="mapComponent">
                </map-component>
                <v-layout :class="{'ml-5': $vuetify.breakpoint.mdAndUp, 'ml-3': $vuetify.breakpoint.smOnly}" align-end
                          justify-start row
                          style="position: absolute; bottom: 0; width: 100%;">
                    <v-flex xs12 sm3 lg2>
                        <v-btn style="z-index: 1005;" depressed class="rounded-bottom-card" color="rgb(160, 181, 80, 1)"
                               @click="OpenRoutePagePressed">
                            <v-layout column>
                                <v-flex class="white--text font-weight-bold">
                                    EEN ROUTE VOLGEN
                                </v-flex>
                            </v-layout>
                        </v-btn>
                    </v-flex>

                    <!-- Search bar below-->
                    <v-flex xs12 md3 lg2 v-show="$vuetify.breakpoint.xs">
                        <v-card style="z-index: 1005;" class="rounded-bottom-card" color="rgb(160, 181, 80, 1)" flat>
                            <v-layout column>
                                <v-flex class="white--text font-weight-bold">
                                    <v-text-field
                                            class="mx-3"
                                            style="padding-top: 8px;"
                                            prepend-inner-icon="search"
                                            ref="fieldLower"
                                            v-model="searchInput"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>
                        </v-card>
                    </v-flex>
                </v-layout>

                <!--   Search bar above -->
                <v-layout v-show="$vuetify.breakpoint.smAndUp" column justify-start class="searchBarAboveMap" :style="{'width': (($vuetify.breakpoint.mdAndUp) ? 25 : 35) + '%'}"
                          :fill-height="searchFieldIsFocused === true"
                          :class="{'backgroundOnFieldFocused': searchFieldIsFocused === true}">
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
                                             :filtered-map-objects="filteredMapObjects"/>
                            </v-flex>
                        </div>
                    </div>
                </v-layout>

                <!-- Search List full screen -->
                <v-container fluid fill-height v-if="$vuetify.breakpoint.xsOnly && searchFieldIsFocused"
                             style="background-color: #6e8822; position: absolute; bottom: 0; z-index: 1006;">
                    <v-layout column fill-height justify-space-between>
                        <div v-bar>
                            <div>
                                <v-flex d-flex xs11 class="removeScrollbar" style="max-width: 100%">
                                    <search-list :on-search-tile-clicked="searchTileClicked"
                                                 :filtered-map-objects="filteredMapObjects"></search-list>
                                </v-flex>
                            </div>
                        </div>
                        <v-flex d-flex xs1>
                            <v-layout row align-center>
                                <v-text-field
                                        hide-details
                                        class="py-2"
                                        prepend-inner-icon="search"
                                        solo
                                        v-model="searchInput"
                                ></v-text-field>
                                <v-btn fab small @click="closeFullScreenSearchList">
                                    <v-icon>
                                        close
                                    </v-icon>
                                </v-btn>
                            </v-layout>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-flex>

            <v-flex xs1>
                <v-card height="100%" color="rgb(137, 162, 38, 1)">
                </v-card>
            </v-flex>
        </v-layout>
    </div>
</template>

<script>
    import MapPageHeader from "./map-page-header";
    import DropDownButton from "./mapPage/DropDownButton"
    import MapComponent from './ProjectPage/MapComponent';
    import SearchList from './mapPage/SearchList'

    export default {
        name: 'MapPage',
        components: {
            MapPageHeader,
            DropDownButton,
            MapComponent,
            SearchList
        },
        props: {
            onProjectOpened: {
                type: Function,
            },
            onRoutePageOpened: {
                type: Function,
            },
            mapObjects: {
                type: Array,
                required: true
            }
        },
        data() {
            return {
                zoom: 11,
                center: L.latLng(51.7142669290121, 5.3173828125),
                url: 'https://api.mapbox.com/styles/v1/sakirma/cjw0hdemp03kx1coxkbji4wem/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig',
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                buttonImage: "img/MapPage/button.png",

                pressedImages: {
                    activiteit: false,
                    "eten en drinken": false,
                    bezienswaardigheid: false,
                    natuurgebied: false
                },

                searchFieldIsFocused: false,
                searchInput: '',
                filteredMapObjects: []
            }
        },
        methods: {
            filter(key) {
                this.pressedImages[key] = !this.pressedImages[key];
            },
            disableInputEvents(element) {
                this.$parent.disableInputEvents(element);
            },
            OpenProjectPagePressed: function (projectId, isProject) {
                this.onProjectOpened(projectId, isProject);
            },
            OpenRoutePagePressed: function () {
                this.onRoutePageOpened();
            },
            searchTileClicked(item) {
                this.OpenProjectPagePressed(item.id, (item.project_id !== null));
            },
            closeFullScreenSearchList() {
                this.searchFieldIsFocused = false;
                this.searchInput = '';
            }
        },
        watch: {
            searchInput: function (n, o) {
                this.filteredMapObjects = this.mapObjects.filter(item => {
                    return item.name.toLowerCase().includes(n.toLowerCase());
                });

                if (this.$vuetify.breakpoint.xsOnly)
                    this.searchFieldIsFocused = (n.length !== 0)
            }
        },
        mounted() {
            this.$refs.mapComponent.assignParentPage(this);
            axios.get("/getAllMapObjects")
                .then(({data}) => {
                    for (let i = 0; i < data.length; i++) {
                        this.mapObjects.push(data[i]);
                    }
                    this.$refs.mapComponent.loadMapObjects(this.mapObjects);
                    this.filteredMapObjects = this.mapObjects;
                });

            this.$watch(
                () => {
                    return this.$refs.field.isFocused
                },
                (val) => {
                    if (val === true)
                        this.searchFieldIsFocused = true;
                }
            );
        },
    }
</script>

<style>
    .searchBarAboveMap .flex .v-input__control .v-input__slot {
        border-radius: 10px;
        border-style: solid;
        border-width: 1px;
        border-color: #b4c9cf;
    }
</style>

<style scoped>
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
