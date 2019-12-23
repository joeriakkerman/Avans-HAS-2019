<template>
    <div>
        <v-img
            height="100vh"
            src="/img/FirstPage/wet-rainy-road-leaf-fallen-hd-gl.jpg">
            <v-layout justify-end row fill-height style="transition: none;">
                <v-flex xs12 sm4 lg5 xl4>
                    <v-card height="100vh" color="rgb(100, 130, 0, 0.5)"
                            style="transition: none" class="text-xs-center white--text">

                        <v-layout align-center justify-center column fill-height>

                            <v-spacer></v-spacer>
                            <v-flex grow>
                                <v-card-text :class="{'display-3': $vuetify.breakpoint.mdAndDown}"
                                             class="display-4 first-page-title">
                                    ROADLEAF
                                </v-card-text>

                                <v-card-text class="first-page-text display-2">
                                    Ontdek Brabant op een andere wijze
                                </v-card-text>
                            </v-flex>

                            <v-flex shrink pa-3
                                    :class="{'mb-5': $vuetify.breakpoint.smAndDown, 'ma-0': $vuetify.breakpoint.mdAndUp}">
                                <v-btn color="rgb(0, 0, 0, 1)" large fab @click="GoToMapPage">
                                    <v-icon x-large color="white">arrow_drop_down_circle</v-icon>
                                </v-btn>
                            </v-flex>

                        </v-layout>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-img>
    </div>
</template>

<script>

    export default {
        name: "FirstPage",
        data() {
            return {
                ts: 0,
            }
        },
        methods: {
            GoToMapPage() {
                document.removeEventListener('touchmove', this.touchHandler);
                document.removeEventListener('touchstart', this.touchStart);
                this.$parent.OpenMapPage();
            },
            touchHandler(e) {
                let te = e.touches[0].clientY;
                if (this.ts > te) {
                    if ((this.ts - te) > 60) {

                        this.GoToMapPage();
                    }
                }
            },
            touchStart(e) {
                this.ts = e.touches[0].clientY;
            },
        },

        mounted() {
            document.addEventListener('touchmove', this.touchHandler, false);
            document.addEventListener('touchstart', this.touchStart, false);
        },
    }
</script>

<style scoped>
    .first-page-title {
        font-family: "Market Deco", Market_Deco !important;
    }

    .first-page-text {
        font-family: "FlorenceRegular", FlorenceRegular !important;
        font-weight: bold !important;
    }
</style>
