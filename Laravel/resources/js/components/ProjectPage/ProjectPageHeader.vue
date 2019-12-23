<template>
    <v-layout align-center justify-center row fill-height :class="{ 'ml-3': $vuetify.breakpoint.smAndUp }" style="position: relative">
        <div style="position: absolute; left: 0;">
            <v-flex shrink class="hidden-sm-and-down v-card--reveal">
                <v-layout align-center justify-center fill-height>
                    <v-img src="img/RoadLeaf-Logo.png"
                           height="100%"
                           max-height="100px"
                           contain
                           style="filter: brightness(0) invert(1);"
                           width="150px"/>
                    <v-btn fab dark class="ml-5" @click="GoBackToMapPage">
                        <v-icon>
                            arrow_upward
                        </v-icon>
                    </v-btn>
                </v-layout>
            </v-flex>
        </div>
        <v-flex fill-height xs5 :class="{'py-4': !$vuetify.breakpoint.mdAndDown}"  style="background-color: #89a226">
            <v-layout column fill-height align-center justify-center>
                <v-flex xs1>
                    <div flat color="transparent" class="white--text text-xs-center font-weight-black first-page-title"
                            :class="{'createOwnRouteTitle': $vuetify.breakpoint.xsOnly}" v-resize-text="{ratio:1, minFontSize: '30px', maxFontSize: '50px'}">
                        {{ name }}
                    </div>
                </v-flex>
            </v-layout>
        </v-flex>
        <v-flex xs1 class="hidden-md-and-up">
            <v-btn fab dark @click="GoBackToMapPage">
                <v-icon>
                    arrow_upward
                </v-icon>
            </v-btn>
        </v-flex>
        <v-flex class="tooltipTopRight hidden-xs-only">
            <v-tooltip top content-class="tooltip-inner">
                <template v-slot:activator="{ on }">
                    <v-img class="tooltipImage"
                           contain
                           v-on="on"
                           src="img/context-sensitive-help.png"/>
                </template>
                <span>
                    Deze pagina geeft informatie weer over een interessante plek.
                    Wilt u terug naar de homepagina met de kaart, druk dan op de knop linksboven.
                    Zou u graag uw eigen interessepunt op deze website terug willen zien?
                    Stuur dan een e-mail naar: roadleafbeheerder@gmail.com
                </span>
            </v-tooltip>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "ProjectPageHeader",
        props: {
            name: ''
        },
        methods: {
            GoBackToMapPage() {
                let pageStates = this.$store.getters.pageStates;
                this.$store.commit('setPageState', pageStates.mapPage);

                this.$parent.$parent.UpdateScreen();
            }
        }
    }
</script>

<style scoped>
    .tooltipTopRight {
        max-width: 30px;
        right: 10px;
        position: relative;
    }

    .tooltipImage {
        width: 20px;
        height: 20px;
    }

    .tooltip-inner {
        color: white;
        padding: 24px;
        border-radius: 5px;
        box-shadow: 0 5px 30px;
        max-height: 150px;
        max-width: 450px;
    }
    
    .first-page-title {
        font-family: "Market Deco", Market_Deco !important;
        font-weight: bold !important;
    }

    .createOwnRouteTitle {
        font-size: 14px!important;
        line-height: 16px !important;
    }
</style>
