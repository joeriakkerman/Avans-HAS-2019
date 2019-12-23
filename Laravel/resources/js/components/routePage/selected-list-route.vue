<template>
    <v-layout align-center justify-center row fill-height>
        <v-flex xs9>
            <v-btn
                    block
                    outline
                    color="secondary"
                    @click="followRoute(id)"
                    dark
                    flat
                    class="custom-btn"
                    :ripple="false"
            >
                <v-layout align-center justify-space-around row fill-height>
                    <v-flex>
                        <div class="text-xs-left">{{ name }}</div>
                    </v-flex>
                </v-layout>
            </v-btn>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "selected-list-route",
        props: {
            name: {
                type: String,
                required: true
            },

            id: {
                type: Number,
                required: true
            },

            routesParent: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                allProjectPointIDs: [],
                projectPoints: [],
                parent: undefined
            };
        },
        methods: {
            followRoute($id) {
                window.axios.get("getProjectPointOfRoute/" + $id)
                    .then(response => {
                        this.routesParent.drawPoints(response.data);
                    });
            },
            exportToGoogle(){

            }
        }
    };
</script>

<style scoped>
    .v-btn:hover:before {
        color: transparent;
    }

    .v-btn:focus:before {
        color: transparent;
    }
</style>