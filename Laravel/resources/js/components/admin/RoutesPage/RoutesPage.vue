<template>
    <v-container fluid fill-height pt-3 pb-5>
        <v-layout row fill-height justify-space-around>
            <v-flex xs6 class="ml-5">
                <routes-view :parent="this" :headers="headers" :desserts="filteredRoutes"
                             v-show="currentPageState === ProjectPageStates.viewMode"></routes-view>
                <routes-new :parent="this" ref="projectNewSection"
                            v-show="currentPageState === ProjectPageStates.newMode"></routes-new>
                <routes-edit :parent="this" ref="projectEditSection"
                             v-show="currentPageState === ProjectPageStates.editMode"></routes-edit>
            </v-flex>
            <v-flex d-flex xs5>
                <map-section :parent-page="this" ref="mapSection"></map-section>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import MapSection from '../Map';
    import RoutesView from './RoutesView';
    import RoutesNew from './RoutesNew';
    import RoutesEdit from './RoutesEdit';
    import axios from 'axios';

    export default {
        name: "ProjectList",
        components: {
            MapSection,
            RoutesView,
            RoutesNew,
            RoutesEdit
        },
        data() {
            return {
                ProjectPageStates: {'viewMode': 0, 'editMode': 1, 'newMode': 2},
                currentPageState: 0,
                headers: [
                    {
                        text: 'Naam',
                        align: "left",
                        value: 'name',
                    },
                    {
                        text: 'Categorie',
                        align: 'left',
                        value: 'category',
                    },
                    {
                        text: 'Route',
                        align: 'left',
                        value: 'route',
                    },
                    {
                        text: 'Aantal Km',
                        align: 'left',
                        value: 'km',
                    }
                ],
                routes: [],
                filteredRoutes: [],
                points: []
            }
        },
        mounted() {
            this.initialize();
        },
        methods: {
            initialize: function () {
                this.routes = [];
                this.filteredRoutes = [];
                axios.post('/admin/route/data')
                    .then(response => {
                        let r = response.data.routes;
                        let p = response.data.points;

                        for (let i = 0; i < r.length; i++) {
                            let t = {
                                name: r[i].name,
                                km: r[i].length,
                                route: r[i].id,
                            };
                            this.routes.push(t);
                            this.filteredRoutes.push(t);
                        }
                        for (let i = 0; i < p.length; i++) {
                            //this.points = p.slice(0);
                            let point = {
                                area: p[i].area,
                                category: p[i].category,
                                id: p[i].id,
                                information: p[i].information,
                                location: p[i].location,
                                name: p[i].name,
                                project_id: p[i].project_id,
                                selected: false,
                            };

                            this.points.push(point);
                        }
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            filterList(search) {
                this.filteredRoutes = this.routes.filter(route => {
                    return route.name.toLowerCase().includes(search.toLowerCase());
                });
            },
            newProjectButtonPressed() {
                this.currentPageState = this.ProjectPageStates.newMode;
                this.$refs.projectNewSection.createNewRouteButtonPressed(this.$refs.mapSection.getMapObject(), this.points);
            },
            enableViewMode() {
                this.currentPageState = this.ProjectPageStates.viewMode;
                this.routes = [];
                this.filteredRoutes = [];
                axios.post('/admin/route/data')
                    .then(response => {
                        let r = response.data.routes;

                        for (let i = 0; i < r.length; i++) {
                            let t = {
                                name: r[i].name,
                                km: r[i].length,
                                route: r[i].id,
                            };
                            this.routes.push(t);
                            this.filteredRoutes.push(t);
                        }
                    }).catch(error => {
                        console.log(error);
                });
            },
            editAProject(product) {
                this.currentPageState = this.ProjectPageStates.editMode;
                this.$refs.projectEditSection.loadEditSection(product, this.points, this.$refs.mapSection.getMapObject());
            }
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

    .removeScrollBar::-webkit-scrollbar {
        display: none;
    }

    .removeScrollBar {
        scrollbar-width: none;
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
