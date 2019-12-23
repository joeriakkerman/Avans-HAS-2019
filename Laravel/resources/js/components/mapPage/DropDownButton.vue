<template>
    <div>
        <v-btn style="z-index: 1005;" class="rounded-bottom-card" color="rgb(160, 181, 80, 1)"
               @click="expand = !expand">
            <v-layout column>
                <v-flex class="white--text font-weight-bold">
                    {{ buttonTitle }}
                </v-flex>
                <transition name="fade">
                    <v-icon style="height: 10px;" id="arrow_down" large color="white" :class="{'rotateArrow': expand}">
                        expand_more
                    </v-icon>
                </transition>
            </v-layout>
        </v-btn>

        <v-expand-transition>
            <v-layout row v-show="expand">
                <v-flex xs12>
                    <v-card :class="{'px-0': $vuetify.breakpoint.lgAndDown, 'px-5': $vuetify.breakpoint.xl}"
                            class=" map-page-themes-list pt-4" color="rgb(217, 217, 217, 1)">
                        <div class="title text-xs-center pb-2">
                            {{ title }}
                        </div>
                        <v-divider class="mx-3"></v-divider>

                        <v-layout justify-center v-bar>
                            <v-card
                                style="background-color: #d9d9d9;"
                                class="text-xs-center removeScrollBar"
                                flat
                                max-height="30vh"
                            >
                                <template v-for="(item, index) in items">
                                    <v-list-tile>
                                        <v-list-tile-action>
                                            <v-checkbox></v-checkbox>
                                        </v-list-tile-action>

                                        <v-list-tile-action-text>
                                            {{ item }}
                                        </v-list-tile-action-text>
                                    </v-list-tile>
                                </template>

                            </v-card>
                        </v-layout>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-expand-transition>
    </div>
</template>

<script>
    export default {
        name: "DropDownButton",
        props: {
            buttonTitle: {
                type: String,
                default: '',
            },
            title: {
                type: String,
                default: "",
            },
            items: {
                type: Array,
                default: ['Leeg'],
            }
        },
        data() {
            return {
                expand: false,
            }
        },
        mounted() {
            // Parent is map, but we need the parent of the map to access the code.
            this.$parent.$parent.disableInputEvents(this);
        }
    }
</script>

<style>
    .rounded-bottom-card {
        margin: 0px 0px 0px 0px;
        border-radius: 0px 0px 10px 10px;
        height: 50px;
        width: 100%;
    }

    .map-page-themes-list {
        border-radius: 0px 0px 10px 10px;
        position: relative;
        top: -10px;
    }

    .removeScrollBar::-webkit-scrollbar {
        display: none;
    }

    .removeScrollBar {
        scrollbar-width: none;
    }

    #arrow_down {
        -webkit-transition: -webkit-transform 0.2s; /* Safari */
        transition: transform 0.2s;
    }

    #arrow_down.rotateArrow {
        -webkit-transform: rotate(180deg); /* Safari */
        transform: rotate(180deg);
    }
</style>
