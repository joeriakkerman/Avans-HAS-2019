<template>
    <v-layout column align-start>
        <v-flex xs7 sm8 lg6 xl4>
            <v-responsive>
                <draggable
                        tag="ul"
                        v-model="currentSelectedProjects"
                        v-bind="dragOptions"
                        @start="drag=true"
                        @end="drag=false"
                        style="padding: 0"
                >
                    <template v-for="(route, index) in currentSelectedProjects">
                        <div :key="index">
                            <v-layout align-center justify-space-between row fill-height>
                                <div style="width: 100%;" class="my-1 routeDrag" flat>
                                    <v-layout align-center justify-center row fill-height
                                              class="routeButton">
                                        <v-card-text class="py-0 headline "
                                                     style="color: rgba(137,163,36,0.7575)">
                                            {{route.name}}
                                        </v-card-text>
                                        <v-icon color="#89a324" class="mr-1">
                                            list
                                        </v-icon>
                                    </v-layout>
                                </div>
                            </v-layout>
                        </div>
                    </template>
                </draggable>
            </v-responsive>
        </v-flex>
        <v-flex xs7 sm8 lg6 xl6 mt-3>
            <v-autocomplete
                    v-model="currentSelectedProjects"
                    :items="interestPoints"
                    box
                    chips
                    color="blue-grey lighten-2"
                    label="Select"
                    item-text="projectName"
                    return-object
                    multiple
                    style="max-width: 90%;"

            >
                <template
                        slot="selection"
                        slot-scope="data"
                >
                    <v-chip
                            :selected="data.selected"
                            close
                            class="chip--select-multi"
                            @input="data.parent.selectItem(data.item)"
                    >
                        {{ data.item.name }}
                    </v-chip>
                </template>
                <template
                        slot="item"
                        slot-scope="data"
                >
                    <v-list-tile-content>
                        <v-list-tile-title v-html="data.item.name"></v-list-tile-title>
                    </v-list-tile-content>
                </template>
            </v-autocomplete>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "ProjectSelectionList",
        data() {
            return {
                currentSelectedProjects: [],
                interestPoints: [],
            }
        },
        computed: {
            dragOptions() {
                return {
                    animation: 200,
                    group: "description",
                    disabled: false,
                    ghostClass: "ghost"
                };
            }
        },
        watch: {
            currentSelectedProjects(n) {
                this.$parent.clearMarkers();
                for (let i = 0; i < n.length; i++){
                    this.$parent.placePoint(n[i]);
                }
            }
        },
        methods: {
            addInterestPoints(points) {
                for (let i = 0; i < points.length; i++) {
                    this.interestPoints.push(points[i]);
                }
            },
            removeElementById(id) {
                let sp = this.currentSelectedProjects;
                for (let i = 0; i < sp.length; i++) {
                    if (id === sp[i].id) {
                        let index = this.currentSelectedProjects.indexOf(sp[i]); //Moet nog een keer de index opvragen want si is blijkbaar niet de juiste index
                        this.currentSelectedProjects.splice(index, 1);
                    }
                }
                console.log(this.currentSelectedProjects);
            },
            enableInterestPoints(points) {
                for (let i = 0; i < points.length; i++) {
                    for (let j = 0; j < this.interestPoints.length; j++) {
                        if (points[i].id === this.interestPoints[j].id) this.currentSelectedProjects.push(this.interestPoints[j]);
                    }
                }
            },
            clearInterestPoints() {
                this.interestPoints = [];
                this.currentSelectedProjects = [];
            },

            /* toggleProjectPoint(points) {
                 for (let i = 0; i < points.length; i++) {

                     points.checkboxSelected = !points.checkboxSelected;
                     if (points.checkboxSelected)
                         this.currentSelectedProjects.push(points);
                     else
                         this.removeFromSelectedProjects(points);
                 }
             },
              removeProjectPoint(interestPoints) {
                  interestPoints.checkboxSelected = false;
                 this.removeFromSelectedProjects(interestPoints);
             },
              removeFromSelectedProjects(point) {
                 for (let i = 0; i < this.currentSelectedProjects.length; i++) {
                    if (this.currentSelectedProjects[i] === point) {
                         this.currentSelectedProjects.splice(i, 1);
                     }
                 }
             }*/
        }
    }
</script>

<style scoped>

</style>
