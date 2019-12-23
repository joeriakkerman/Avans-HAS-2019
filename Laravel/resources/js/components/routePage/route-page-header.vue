<template>
    <v-layout align-center justify-center fill-height >
        <v-flex>
            <v-btn fab dark class="ml-5" @click="GoToMapPage">
                <v-icon>
                    arrow_upward
                </v-icon>
            </v-btn>
        </v-flex>
        <v-flex class="tooltipTopRight">
            <v-tooltip top content-class="tooltip-inner">
                <template v-slot:activator="{ on }">
                    <v-img class="tooltipImage"
                           contain
                           v-on="on"
                           src="img/context-sensitive-help.png"/>
                </template>
                <span>
                    Op deze pagina staan leuke routes die u kunt volgen.
                    Klik op een route in de lijst aan om deze op de kaart weer te geven.
                    Om met Google Maps de route te volgen, drukt u op de knop onder de route lijst en een nieuw tabblad met de route zal openen.
                    U kunt terug naar de homepagina met de knop linksboven.
                </span>
            </v-tooltip>
        </v-flex>
        <v-flex fill-height xs5 py-4 style="background-color: #89a226">
            <v-card style="" flat color="transparent" class="white--text text-xs-center display-2 font-weight-black first-page-title"
                    :class="{'createOwnRouteTitle': $vuetify.breakpoint.xsOnly}">
                VOLG EEN ROUTE!
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "route-page-header",
        methods: {
            GoToMapPage() {
                this.$parent.GoToMapPage();
            },
        }
    }
</script>

<style scoped>
    .first-page-title {
        font-family: "Market Deco", Market_Deco !important;
        font-weight: bold !important;
    }

    .first-page-text {
        font-family: "FlorenceRegular", FlorenceRegular !important;
        font-weight: bold !important;
    }

    .createOwnRouteTitle {
        font-size: 14px!important;
        line-height: 16px !important;
    }

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
        max-height: 90vh;
        max-width: 900px;
    }
</style>