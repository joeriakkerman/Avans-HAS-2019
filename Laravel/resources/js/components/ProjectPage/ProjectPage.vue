<template>
    <div style="height: 100vh;  background-color: #89a226; max-height: 100vh">
        <v-layout column fill-height>
            <v-flex xs1 sm1 ma-3>
                <project-page-header :name="name"></project-page-header>
            </v-flex>

            <v-flex grow d-flex v-if="!$vuetify.breakpoint.mdAndDown">
                <!--- Bigger Screen ---->
                <v-container ma-0 pl-0 fluid grid-list-md style="background-color: white; "
                >
                    <v-layout row fill-height>
                        <v-flex xs7>
                            <v-layout column align-start fill-height>
                                <v-flex d-flex xs6
                                        :style="[$vuetify.breakpoint.mdAndDown ? {'width': '100%'} : {'width': '75%'}]">
                                    <v-layout row style="background-color: #A0B550;">

                                        <v-flex xs10>
                                            <v-card flat
                                                    style=" background-color: transparent; position:relative; overflow-y: hidden; height: 100%;"
                                                    v-bar>
                                                <v-card-text class="py-4 pr-0 pl-1  white--text">
                                                    {{ information }}
                                                    <br>
                                                </v-card-text>
                                            </v-card>
                                        </v-flex>

                                        <v-flex xs2 pa-0 v-bar>
                                            <div>
                                                <v-layout column justify-start align-start ma-0 fill-height>
                                                    <div class="text-xs-center"
                                                         style="background-color: rgba(255,255,255,0.3); width: 100%"
                                                         v-resize-text="{ratio:1, minFontSize: '10px', maxFontSize: '30px'}">
                                                        Meer zoals dit
                                                    </div>
                                                    <v-flex xs2 v-for="(suggestion, i) in suggestions" :key="i"
                                                            style="width: 100%;" pa-0>
                                                        <v-card flat class="text-xs-center"
                                                                style="height: 100%; cursor: pointer; position:relative; overflow: hidden; background-color: rgb(209,218,172);"
                                                                @click="init(suggestion.id)">
                                                            <div>
                                                                <b>{{suggestion.name}}</b>
                                                            </div>
                                                        </v-card>
                                                        <v-divider></v-divider>
                                                    </v-flex>
                                                </v-layout>
                                            </div>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                                <v-flex d-flex xs6
                                        :style="[$vuetify.breakpoint.mdAndDown ? {'width': '100%'} : {'width': '75%'}]"
                                        align-self-end>
                                    <v-carousel v-if="images.length > 0" height="100%">
                                        <v-carousel-item
                                                v-for="(image,i) in images"
                                                :key="i"
                                                :src="image"
                                        ></v-carousel-item>
                                    </v-carousel>
                                </v-flex>
                            </v-layout>
                        </v-flex>
                        <v-flex xs5>
                            <v-card height="100%">
                                <map-component ref="mapComponent"></map-component>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-flex>


            <!-- SMALLER SCREEN -->
            <v-flex xs10 v-else>
                <v-layout align-center justify-start column fill-height>
                    <v-flex xs6 shrink :style="[$vuetify.breakpoint.mdAndDown ? {'width': '100%'} : {'width': '75%'}]"
                            style="background-color: #A0B550;">
                        <div style="overflow-y: auto;  max-height: 40vh;">
                            <div class="py-4 pl-1 white--text">
                                {{ information }}
                            </div>
                        </div>

                        <v-btn block @click="switchMode">
                            {{ getTextForButton() }}

                        </v-btn>
                    </v-flex>

                    <v-flex v-show="photoMode" xs6
                            :style="[$vuetify.breakpoint.mdAndDown ? {'width': '100%'} : {'width': '75%'}]"
                            align-self-end style="background-color: white">
                        <v-carousel v-if="images.length > 0" height="100%">
                            <v-carousel-item
                                    v-for="(image,i) in images"
                                    :key="i"
                                    :src="image"
                            ></v-carousel-item>
                        </v-carousel>
                    </v-flex>

                    <v-flex xs6 v-show="!photoMode" style="width: 100%;">
                        <v-card width="100%" height="100%">
                            <map-component ref="mapComponent"></map-component>
                        </v-card>
                    </v-flex>

                </v-layout>
            </v-flex>

            <v-flex xs1 d-flex>
                <v-card height="100%" color="rgb(137, 162, 38, 1)">
                </v-card>
            </v-flex>
        </v-layout>
    </div>
</template>

<script>
    import ProjectPageHeader from './ProjectPageHeader';
    import MapComponent from './MapComponent';

    export default {
        name: "ProjectPage",
        data() {
            return {
                information: "",
                images: [],
                comments: [],
                mapPage: undefined,
                mapObjects: [],
                name: '',

                suggestions: [],
                photoMode: false,
            }
        },
        props: {
            onProjectOpened: {
                type: Function,
            },
            parent: {
                type: Object,
                required: true
            }
        },
        methods: {
            init(pid) {

                this.images = [];
                this.suggestions = [];

                let id = pid;
                if (!id) {
                    id = this.$parent.selectedProjectPage.projectId;
                }

                let linkOne = "/getProjectPoint/";
                let linkTwo = "/getMediaFromProjectPoint/";
                if (this.$parent.selectedProjectPage.project) {
                    linkOne = "/getProject/";
                    linkTwo = "/getMediaFromProject/";
                }
                axios.get(linkOne + id).then(({data}) => {
                    this.information = data.information;
                    this.comments = data.comments;
                    this.name = data.name;
                    this.zoomToPoint(data.area, this.$parent.selectedProjectPage.project);

                    if (this.$parent.selectedProjectPage.project) {
                        this.findRecommendationsProjects(data, this);
                    } else {
                        this.findRecommendationsInterestPoint(data, this);
                    }


                });

                axios.get(linkTwo + id).then(({data}) => {
                    for (let i = 0; i < data.length; i++)
                        this.images.push("getmedia/" + data[i]);
                });

            },
            zoomToPoint(area, isProject) {
                let geom = area.geometries[0].coordinates;
                let lat = 0, lng = 0;
                if (Array.isArray(geom[0])) {
                    let geomLength = geom[0].length;
                    for (let i = 0; i < geomLength; i++) {
                        lat += geom[0][i][1]; // longitude
                        lng += geom[0][i][0]; // latitude
                    }
                    lat /= geomLength;
                    lng /= geomLength;
                } else {
                    lat = geom[1];
                    lng = geom[0];
                }

                if(Array.isArray(geom[0])) {
                    this.$refs.mapComponent.panTo(lat, lng, 13);
                }
                else {
                    this.$refs.mapComponent.panTo(lat, lng, 15);
                }
            },
            findRecommendationsInterestPoint(d, t) {
                axios.post('/projectpoints/similarIntrestPoint', {
                    id: d.id,
                    category: d.category,
                }).then(function (response) {
                    let projectPoints = response.data[0];
                    let images = response.data[1];


                    for (let i = 0; i < projectPoints.length; i++) {

                        let suggestion = {
                            id: projectPoints[i].id,
                            name: projectPoints[i].name,
                            information: projectPoints[i].information,
                            category: projectPoints[i].category,
                            path: ''
                        };

                        for (let j = 0; j < images.length; j++) {
                            if (images[j].id === suggestion.id) {
                                suggestion.path = images[j].location;
                                break;
                            }
                        }
                        t.suggestions.push(suggestion);
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            }
            ,
            findRecommendationsProjects(d, t) {
                axios.post('/projectpoints/similarProject', {
                    id: d.id,
                    category: d.category,
                }).then(function (response) {
                    let projects = response.data[0];
                    let images = response.data[1];

                    for (let i = 0; i < projects.length; i++) {

                        let suggestion = {
                            id: projects[i].id,
                            name: projects[i].name,
                            information: projects[i].information,
                            category: projects[i].category,
                            path: ''
                        };

                        for (let j = 0; j < images.length; j++) {
                            if (images[j].id === suggestion.id) {
                                suggestion.path = "getmedia/" + images[j].location;
                                break;
                            }
                        }
                        t.suggestions.push(suggestion);
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            },
            switchMode() {
                this.photoMode = !this.photoMode;
            },
            getTextForButton(){
                if(this.photoMode) {
                    return "Map";
                } else {
                    return "Photo's";
                }
            }
        },
        mounted() {
            this.$vuetify.goTo('#projectPage');
            this.mapPage = this.parent.getMapPage();
            this.$refs.mapComponent.assignParentPage(this);

            axios.get("/getAllMapObjects")
                .then(({data}) => {
                    for (let i = 0; i < data.length; i++) {
                        this.mapObjects.push(data[i]);
                        this.$refs.mapComponent.loadMapObjects(this.mapObjects);
                    }
                });
        },
        components: {
            ProjectPageHeader,
            MapComponent
        }
    }
</script>

<style>
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
</style>
