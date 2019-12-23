<template>
    <v-layout align-center justify-center row fill-height>
        <v-flex shrink class="hidden-sm-and-down v-card--reveal" style="position: absolute; left: 2%;">
            <v-img src="img/RoadLeaf-Logo.png"
                   height="100%"
                   max-height="100px"
                   contain
                   style="filter: brightness(0) invert(1);"
                   width="150px"/>
        </v-flex>
        <v-flex xs12 sm8 md7 lg4 :class="{ 'mx-5': $vuetify.breakpoint.smAndUp}" fill-height>
            <v-layout align-center justify-center row fill-height :class="{ 'mx-5': $vuetify.breakpoint.smAndUp}">
                <v-flex d-flex>
                    <v-img src="img/Symbolen_Activiteiten.png"
                           :class="{'categoryButtonPressed': toggleCatogory1}">
                        <div class="categoryButton" @click="toggleCategory(0)"></div>
                    </v-img>
                </v-flex>
                <v-flex d-flex>
                    <v-img src="img/Symbolen_Horeca.png" :class="{'categoryButtonPressed': toggleCatogory2}">
                        <div class="categoryButton" @click="toggleCategory(1)"></div>
                    </v-img>
                </v-flex>
                <v-flex d-flex>
                    <v-img src="img/Symbolen_Bezienswaardigheden.png"
                           :class="{'categoryButtonPressed': toggleCatogory3}">
                        <div class="categoryButton" @click="toggleCategory(2)"></div>
                    </v-img>
                </v-flex>
                <v-flex d-flex>
                    <v-img src="img/Symbolen_Natuurgebieden.png"
                           :class="{'categoryButtonPressed': toggleCatogory4}">
                        <div class="categoryButton" @click="toggleCategory(3)"></div>
                    </v-img>
                </v-flex>
            </v-layout>
        </v-flex>
        <v-flex class="tooltipTopRight">
            <v-tooltip right content-class="tooltip-inner">
                <template v-slot:activator="{ on }">
                    <v-img class="tooltipImage"
                           contain
                           v-on="on"
                           src="img/context-sensitive-help.png"/>
                </template>
                <span>
                    Dit is de Roadleaf homepagina. Filter op de kaart d.m.v. de 4 knoppen bovenin of gebruik de
                    zoekfunctie. Scroll op de kaart om in en uit te zoomen. Klik op een interessepunt voor meer informatie.
                </span>
            </v-tooltip>
        </v-flex>

    </v-layout>
</template>

<script>
    export default {
        name: "map-page-header",
        props: {
            parent: {
                type: Object
            },
        },
        data() {
            return {
                toggleCatogory1: false,
                toggleCatogory2: false,
                toggleCatogory3: false,
                toggleCatogory4: false,
            }
        },
        methods: {
            toggleCategory(id) {
                let cat = Object.keys(this.parent.pressedImages)[id];
                this.parent.filter(cat);
                if (cat === "activiteit") {
                    this.toggleCatogory1 = !this.toggleCatogory1;
                } else if (cat === "eten en drinken") {
                    this.toggleCatogory2 = !this.toggleCatogory2;
                } else if (cat === "bezienswaardigheid") {
                    this.toggleCatogory3 = !this.toggleCatogory3;
                } else if (cat === "natuurgebied") {
                    this.toggleCatogory4 = !this.toggleCatogory4;
                }
            }
        }
    }
</script>

<style scoped>
    .v-card--reveal {
        margin-left: 1%;
    }

    .categoryButton {
        cursor: pointer;
        position: absolute;
        width: 70%;
        height: 60%;
        left: 15%;
        top: 14%;
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
        max-height: 100px;
        max-width: 450px;
    }

    .categoryButtonPressed {
        filter: brightness(0.5);
    }
</style>
