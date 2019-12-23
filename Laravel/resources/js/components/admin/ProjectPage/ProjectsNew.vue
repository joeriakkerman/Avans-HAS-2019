<template>
    <div class="projectEditSection" v-bar>
        <div class="pr-2">
            <v-layout align-center justify-space-between row>
                <v-card-title class="display-1">Nieuw Project</v-card-title>
                <v-flex class="tooltipTopRight">
                    <v-tooltip top content-class="tooltip-inner">
                        <template v-slot:activator="{ on }">
                            <v-img class="tooltipImage"
                                   contain
                                   v-on="on"
                                   src="img/context-sensitive-help.png"/>
                        </template>
                        <span>
                            Op deze pagina kan een nieuw project worden gemaakt.
                            Geef het project een passende naam en beschrijving.
                            Kies de categorie die het beste past bij het nieuwe project.
                            Klik op de kaart om het gebied aan te geven waar dit project is (niet verplicht).
                            Druk op 'project toevoegen' als u klaar bent.
                        </span>
                    </v-tooltip>
                </v-flex>
                <v-btn fab flat @click="close">
                    <v-icon x-large color="green"> close</v-icon>
                </v-btn>
            </v-layout>

            <v-layout column>
                <v-flex xs1>
                    <v-layout row>
                        <v-flex xs3>
                            <v-card-title class="title">Naam:</v-card-title>
                        </v-flex>
                        <v-flex xs3>
                            <v-text-field v-model="name"></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-flex>


                <v-flex xs1>
                    <v-layout row>
                        <v-flex xs3>
                            <v-card-title class="title">Kies een categorie:</v-card-title>
                        </v-flex>
                        <v-flex xs3>
                            <v-select
                                    v-model="select"
                                    :items="categories"
                                    menu-props="auto"
                                    label="Selecteren"
                                    :rules="[v => !!v || 'Categorie is vereist']"
                                    required
                                    single-line>
                            </v-select>
                        </v-flex>
                    </v-layout>
                </v-flex>

                <v-flex xs1>
                    <v-layout row>
                        <v-flex xs3>
                            <v-card-title class="title">Beschrijving:</v-card-title>
                        </v-flex>
                        <v-flex xs4>
                            <v-textarea v-model="information" box></v-textarea>
                        </v-flex>
                    </v-layout>
                </v-flex>

                <v-flex xs1>
                    <v-layout column>
                        <v-flex>
                            <v-card-title class="title">Afbeelding toevoegen:</v-card-title>
                        </v-flex>
                        <input type="file">
                        <v-carousel ref="carousel" v-if="images.length > 0" style="height:100%"
                                    class="blackButtonCarousel" :cycle="false">
                            <v-carousel-item
                                    v-for="(image,i) in images"
                                    :key="i"
                                    :src="image"
                                    class="containCarouselItem"
                            >
                                <v-btn absolute dark fab top right color="red" class="deleteButtonCarousel"
                                       @click="removeFile(i)">
                                    <v-icon>close</v-icon>
                                </v-btn>
                            </v-carousel-item>
                        </v-carousel>
                    </v-layout>
                </v-flex>

                <v-layout align-center justify-end row>
                    <v-btn style="max-width: 10%; height: 100%;" color="#89A226" @click="save()">
                        <v-card style="white-space: normal; max-width: 60%;" color="transparent" flat
                                class="white--text">
                            Project Toevoegen
                        </v-card>
                    </v-btn>
                </v-layout>

                <v-layout align-center justify-end row>
                    <v-btn style="max-width: 10%; height: 100%;" color="#89A226" @click="reset()">
                        <v-card style="white-space: normal; max-width: 60%;" color="transparent" flat
                                class="white--text">
                           reset polygon
                        </v-card>
                    </v-btn>
                </v-layout>
            </v-layout>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProjectsEdit",
        props: {
            parent: {
                type: Object,
                required: true
            }

        },

        methods: {
            close() {
                this.reset();
                this.parent.$refs.mapSection.setDrawMode(false);
                this.polygon.latlngs = [];
                this.parent.enableViewMode();
            },
            onFileSelection() {
                for (let file of this.input.files) {
                    this.files.push(file);
                    let reader = new FileReader();
                    reader.onload = (ev) => {
                        this.images.push(ev.target.result);
                    };
                    reader.readAsDataURL(file);
                }
                this.input.value = null;
            },
            removeFile(index) {
                this.files.splice(index, 1);
                this.images.splice(index, 1);
            },
            reset(){
                this.parent.$refs.mapSection.polygon.latlngs = [];
                this.parent.$refs.mapSection.resetPolygon();
            },
            save() {
                  this.polygon.latlngs = this.parent.$refs.mapSection.polygon.latlngs ;
                axios.post("/beheer/createProject", {
                    project_id: this.project,
                    name: this.name,
                    information: this.information,
                    category: this.select,
                    latlngs: this.polygon.latlngs
                }).then(({data}) => {
                    for (let i = 0; i < this.files.length; i++) {
                        let formData = new FormData();
                        formData.append("image", this.files[i]);
                        formData.append("name", data.id + "_" + i);
                        formData.append("folder", "projects");
                        formData.append("id", data.id);
                        axios.post("/beheer/media", formData,
                            {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            }
                        ).catch(error => {
                            alert("Er ging iets mis bij het opslaan van het project!");
                            console.log(error);
                        });
                    }

                    this.close();
                }).catch(error => {
                    alert("Er ging iets mis bij het opslaan van het project!");
                    console.log(error);
                });
            }
        },
        data() {
            return {
                input: null,
                files: [],
                images: [],
                name: null,
                information: null,
                categories: [],
                select: null,
                polygon: {
                    latlngs: [],
                },
            }
        },
        mounted() {
            this.input = this.$el.querySelector('input[type=file]');
            this.input.addEventListener('change', () => this.onFileSelection());
            this.input.setAttribute('multiple', 'multiple');

            window.axios.get('/getCategories').then(response => {
                let temp = response.data;
                for (let i = 0; i < temp.length; i++) {
                    this.categories.push(temp[i].name);
                }
            }).catch(function (error) {
                console.log(error);
            });
        }
    }
</script>

<style>
    .deleteButtonCarousel.v-btn--top.v-btn--absolute {
        top: 10px;
    }

    .containCarouselItem .v-carousel__item .v-image__image {
        background-size: contain;
    }

    .blackButtonCarousel .v-carousel__next .v-btn {
        background-color: gray;
    }

    .blackButtonCarousel .v-carousel__prev .v-btn {
        background-color: gray;
    }

    .projectEditSection {
        height: 100%;
        border-radius: 20px;
        border-style: solid;
        border-width: 2px;
        border-color: #89a226;
    }

    .projectTable .v-datatable .v-datatable__actions .v-datatable__actions__select {
        display: none;
    }

    .projectTable .v-table__overflow {
        overflow-y: hidden;
        padding-right: 15px;
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