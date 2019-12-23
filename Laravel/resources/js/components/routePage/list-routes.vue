<template>
    <v-flex xs12 sm4 md3 py-3 style="background-color: #D9DECD; z-index: 1001;">
        <v-card flat color="#D9DECD" style="min-height: 250px;" v-bar>
            <v-responsive max-height="250px">
                <draggable
                        tag="ul"
                        v-model="routeList"
                        v-bind="dragOptions"
                        @start="drag=true"
                        @end="drag=false"
                >
                    <transition-group type="transition">
                        <template v-for="(route, index) in routeList">
                            <selected-list-route
                                    :key="index"
                                    :name="route.name"
                                    :id="route.id"
                                    :routesParent="route.parent"
                            ></selected-list-route>
                        </template>
                    </transition-group>
                </draggable>
            </v-responsive>
        </v-card>
    </v-flex>
</template>

<script>
    import SelectedListRoute from "./selected-list-route";
    import draggable from "vuedraggable";

    export default {
        name: "list-routes",
        components: {
            SelectedListRoute,
            draggable
        },
        props: {
            routesParent: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                routeList: []
            };
        },
        mounted() {
            this.$root.disableInputEvents(this);
            window.axios
                .get("getAllRoutes")
                .then(response => {
                    for (let i = 0; i < response.data.length; i++) {
                        this.routeList.push({
                            name: response.data[i].name,
                            id: response.data[i].id,
                            parent: this.routesParent
                        });
                    }
                })
                .catch(e => {
                    console.log(e);
                });
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
        }
    };
</script>

<style scoped>
    .button {
        margin-top: 35px;
    }

    .flip-list-move {
        transition: transform 0.5s;
    }

    .no-move {
        transition: transform 0s;
    }

    .ghost {
        opacity: 0.5;
        background: #c8ebfb;
    }

    .list-group {
        min-height: 20px;
    }

    .list-group-item {
        cursor: move;
    }

    .list-group-item i {
        cursor: pointer;
    }
</style>