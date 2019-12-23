<template>
    <v-container fluid fill-height pt-3 pb-5>
        <v-layout row fill-height justify-space-around>
            <v-flex xs6 class="ml-5">
                <interest-point-view :parent="this" :headers="headers" :project_points="filteredPoints"
                                     :projects="projects"
                                     v-if="currentPageState === ProjectPageStates.viewMode"></interest-point-view>
                <interest-point-new :parent="this" :projects="projects" :projectNames="projectNames"
                                    :projectIds="projectIds" ref="newInterestPage"
                                    v-else-if="currentPageState === ProjectPageStates.newMode"></interest-point-new>
                <interest-point-edit :parent="this" ref="projectEditSection" :projects="projects"
                                     :projectNames="projectNames" :projectIds="projectIds"
                                     v-show="currentPageState === ProjectPageStates.editMode"></interest-point-edit>
            </v-flex>
            <v-flex d-flex xs5>
                <interest-point-map ref="map" :parent="this"></interest-point-map>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import InterestPointMap from './InterestPointMap';
    import InterestPointView from './InterestPointView';
    import InterestPointNew from './InterestPointNew';
    import InterestPointEdit from './InterestPointEdit'

    export default {
        name: "InterestPointPage",
        components: {
            InterestPointMap,
            InterestPointView,
            InterestPointNew,
            InterestPointEdit
        },
        data() {
            return {
                ProjectPageStates: {'viewMode': 0, 'editMode': 1, 'newMode': 2},
                currentPageState: 0,
                project_points: [],
                projects: [],
                projectNames: [],
                projectIds: [],
                categories: [],
                marker: {},
                filteredPoints: [],

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
                        text: 'Project',
                        align: 'left',
                        value: 'project_id',
                    },
                    {
                        text: 'Beschrijving',
                        align: 'left',
                        value: 'text'
                    },
                ]
            }
        },
        methods: {
            getMarker() {
                return this.marker;
            },
            newProjectButtonPressed() {
                this.currentPageState = this.ProjectPageStates.newMode;
                this.$refs.map.setDrawMode(true);
                this.$refs.map.setNewMode(true);
            },
            loadPoints() {
                axios.get("/getProjectPoints").then(response => {
                    this.project_points = this.filteredPoints = response.data;
                    this.$refs.map.loadMapObjects(this.project_points);
                }).catch(function (error) {
                    console.log(error);
                });
            },
            enableViewMode() {
                this.currentPageState = this.ProjectPageStates.viewMode;
            },
            editAProject(productId) {
                this.$refs.projectEditSection.loadEditSection(productId);
                this.$refs.map.setDrawMode(true);
                this.$refs.map.setEditMode(true);

                // let point = null;
                // for (let i = 0; i < this.project_points.length; i++) {
                //         if (this.project_points[i].id === productId) {
                //             point = this.project_points[i];
                //         }
                // }
                // this.$refs.projectEditSection.markerLat = point.latlng.lat;
                // this.$refs.projectEditSection.markerLong = point.latlng.lng;
                // this.$refs.map.editPoint(point.latlng.lng, point.latlng.lat);
                this.currentPageState = this.ProjectPageStates.editMode;
            },
            filterList(search) {
                this.filteredPoints = this.project_points.filter(point => {
                    return point.name.toLowerCase().includes(search.toLowerCase());
                });
            }
        },
        mounted() {
            this.loadPoints();
            window.axios.get('/getProjects').then(response => {
                let temp = response.data;
                for (let i = 0; i < temp.length; i++) {
                    this.projects.push({id: temp[i].id.toString(), name: temp[i].name.toString()});
                    this.projectNames.push(temp[i].name.toString());
                    this.projectIds.push(temp[i].id.toString());
                }
            }).catch(function (error) {
                console.log(error);
            });
        }
    }
</script>

<style scoped>

</style>
