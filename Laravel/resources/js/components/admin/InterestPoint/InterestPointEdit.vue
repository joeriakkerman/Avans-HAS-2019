<template>
    <div class="projectEditSection" v-bar>
        <div class="removeScrollbar">
            <v-layout align-center justify-space-between row>
                <v-card-title class="display-1">Punt</v-card-title>
                <v-flex class="tooltipTopRight">
                    <v-tooltip top content-class="tooltip-inner">
                        <template v-slot:activator="{ on }">
                            <v-img class="tooltipImage"
                                   contain
                                   v-on="on"
                                   src="img/context-sensitive-help.png"/>
                        </template>
                        <span>
                            Op deze pagina kan een interessepunt worden aangepast.
                            Geef het punt een passende naam en beschrijving.
                            Een overkoepelend project kan gekozen worden, maar dit hoeft niet.
                            Kies de categorie die het beste past bij het punt.
                            Klik op de kaart om aan te geven waar dit punt is.
                            Klik op 'aanpassingen toepassen' om de wijzigingen door te voeren of op 'punt verwijderen' om het punt weg te gooien.
                        </span>
                    </v-tooltip>
                </v-flex>
                <v-btn fab flat @click="close">
                    <v-icon x-large color="green"> close</v-icon>
                </v-btn>
            </v-layout>

            <v-form ref="form">
                <v-layout column>
                    <v-flex xs1>
                        <v-layout row>
                            <v-flex xs3>
                                <v-card-title class="title">Naam:</v-card-title>
                            </v-flex>
                            <v-flex xs3>
                                <v-text-field v-model="selectedProject.name" :rules="nameRules"></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-flex>

                    <v-flex xs1>
                        <v-layout row>
                            <v-flex xs3>
                                <v-card-title class="title">Kies een Project:</v-card-title>
                            </v-flex>
                            <v-layout row align-center>
                                <v-flex xs3>
                                    <v-select v-model="projectName" :items="projectNames" label="optioneel"></v-select>
                                </v-flex>
                                <v-btn icon color="green" flat @click="removeProject">
                                    <v-icon>
                                        close
                                    </v-icon>
                                </v-btn>
                            </v-layout>
                        </v-layout>
                    </v-flex>

                    <v-flex xs1>
                        <v-layout row>
                            <v-flex xs3>
                                <v-card-title class="title">Kies een categorie:</v-card-title>
                            </v-flex>
                            <v-flex xs3>
                                <v-select v-model="selectedProject.category" :items="categories"
                                          :rules="categoryRules"></v-select>
                            </v-flex>
                        </v-layout>
                    </v-flex>

                    <v-flex xs1>
                        <v-layout row>
                            <v-flex xs3>
                                <v-card-title class="title">Beschrijving</v-card-title>
                            </v-flex>
                            <v-flex xs4>
                                <v-textarea v-model="selectedProject.information" :rules="textRules" box></v-textarea>
                            </v-flex>
                        </v-layout>
                    </v-flex>



                    <v-flex xs1>
                        <v-layout row>
                            <v-flex xs3>
                                <v-card-title class="title">Locatie Latidude:</v-card-title>
                            </v-flex>
                            <v-flex xs4>
                                <v-text-field v-model="markerLat" :rules="markerRules" box></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-flex>

                    <v-flex xs1>
                        <v-layout row>
                            <v-flex xs3>
                                <v-card-title class="title">Locatie Longitude::</v-card-title>
                            </v-flex>
                            <v-flex xs4>
                                <v-text-field v-model="markerLong" :rules="markerRules" box></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-flex>

                    <v-flex xs1>
                        <v-layout column>
                            <v-flex>
                                <v-card-title class="title">Afbeelding toevoegen:</v-card-title>
                            </v-flex>
                            <input type="file">
                            <v-carousel ref="carousel" v-if="currentImages.length > 0" style="height:100%"
                                        class="blackButtonCarousel" :cycle="false">
                                <v-carousel-item
                                        v-for="(image,i) in currentImages"
                                        v-if="!image.isRemoved"
                                        :key="i"
                                        :src="image.imageLocation"
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

                    <v-flex xs1 pr-5>
                        <v-layout reverse row xs1>
                            <v-btn @click="validate" style="max-width: 10%; height: 100%;" color="#89A226">
                                <v-card style="white-space: normal; max-width: 60%;" color="transparent" flat
                                        class="white--text">
                                    Aanpassingen Toepassen
                                </v-card>
                            </v-btn>

                            <v-btn @click="deleteItem" style="max-width: 10%; height: 100%;"
                                   color="#89A226">
                                <v-card style="white-space: normal; max-width: 60%;" color="transparent" flat
                                        class="white--text text-xs-center">
                                    Punt Verwijderen
                                </v-card>
                            </v-btn>
                        </v-layout>
                    </v-flex>
                </v-layout>
            </v-form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "InterestPointEdit",
        data() {
            return {
                name: '',
                nameRules: [
                    v => !!v || 'Naam is vereist',
                    v => (v && v.length <= 191) || 'Naam mag niet langer zijn dan 190 karakters'
                ],
                bool: false,
                projectName: null,
                projectId: null,
                category: null,
                categories: [],
                categoryRules: [
                    v => !!v || 'Categorie is vereist',
                ],
                text: '',
                textRules: [
                    v => !!v || 'Beschreiving is vereist',
                    v => (v && v.length <= 10000) || 'Tekst mag niet langer zijn dan 10.000x` karakters zijn'
                ],
                markerRules:[
                    v => !!v || 'U moet een locatie voor deze punt kiezen',
                ],
                selectedProject: {
                    id: '', // ID is used to get data from database, as an example, to retrieve which image and youtube url is being used.
                    name: '',
                    category: '',
                    project_id: '',
                    information: '',
                },
                markerLat: null,
                markerLong: null,
                input: null,
                currentImages: [],
                project_points:[],
                point:{

                },
            }
        },
        props: {
            parent: {
                type: Object,
                required: true,
            },
            projectNames: {
                type: Array,
                required: true
            },
            projects: {
                type: Array,
                required: true
            },
        },
        methods: {
            onFileSelection() {
                for (let file of this.input.files) {
                    let reader = new FileReader();
                    reader.onload = (ev) => {
                        this.currentImages.push({
                            newFile: file,
                            imageLocation: ev.target.result,
                            isRemoved: false,
                            number: this.currentImages.length
                        });
                    };
                    reader.readAsDataURL(file);
                }
                this.input.value = null;
            },
            removeFile(index) {
                if(!this.currentImages[index].newFile)
                    this.currentImages[index].isRemoved = true;
                else
                    this.currentImages.splice(index, 1);
            },
            loadEditSection(product) {
                this.currentImages = [];
                axios.get("/getSingleProjectPoint/" + product)
                    .then(({data}) => {
                        let interestPoint = data[0];
                        this.selectedProject.id = interestPoint.id;
                        this.selectedProject.name = interestPoint.name;
                        this.selectedProject.category = interestPoint.category;
                        this.selectedProject.information = interestPoint.information;
                        this.markerLat = interestPoint.location.coordinates[1];
                        this.markerLong = interestPoint.location.coordinates[0];

                        this.currentImages = [];
                        axios.get("/getMediaFromProjectPoint/" + this.selectedProject.id)
                            .then(({data}) => {
                                for (let i = 0; i < data.length; i++) {
                                    this.currentImages.push({imageLocation: "getmedia/" + data[i], isRemoved: false, imageName: data[i]});
                                }
                            });
                    });
            },
            close() {
                this.parent.loadPoints();
                this.parent.$refs.map.clearMap();
                this.parent.enableViewMode();
            },

            deleteItem() {
                if (confirm('Weet u zeker dat u dit interessepunt wilt verwijderen?')) {
                    axios({
                        method: 'post',
                        url: '/admin/deleteProjectPoint',
                        data: {
                            id: this.selectedProject.id,
                        }
                    }).then(() => {
                        for (let i = 0; i < this.currentImages.length; i++) {
                            let projectImage = this.currentImages[i];

                            // Remove existing file of the project
                            if (!projectImage.newFile) {
                                axios.post("/beheer/removemedia", {
                                    medianame: projectImage.imageName,
                                    folder: "points"
                                });
                            }
                        }
                    });
                    this.close();
                }
            },
            validate() {
                if (this.projectName != null) {
                    for (let i = 0; i < this.projectNames.length; i++) {
                        if (this.projects[i].name === this.projectName) {
                            this.projectId = this.projects[i].id;
                        }
                    }
                }

                if (this.$refs.form.validate()) {
                    axios({
                        method: 'post',
                        url: '/admin/updateProjectPoint',
                        data: {
                            id: this.selectedProject.id,
                            name: this.selectedProject.name,
                            category: this.selectedProject.category,
                            information: this.selectedProject.information,
                            project_id: this.projectId,
                            lat: this.markerLat,
                            long: this.markerLong,
                        }
                    }).then(({data}) => {
                        for (let i = 0; i < this.currentImages.length; i++) {
                            let projectImage = this.currentImages[i];
                            // Remove existing file of the project
                            if (!projectImage.newFile && projectImage.isRemoved) {
                                axios.post("/beheer/removemedia", {
                                    medianame: projectImage.imageName,
                                    folder: "points"
                                });
                            } else if (projectImage.newFile) {
                                let formData = new FormData();
                                formData.append("image", projectImage.newFile);
                                formData.append("name", projectImage.newFile.name);
                                formData.append("folder", "points");
                                formData.append("id", data.id);
                                axios.post("/beheer/media", formData,
                                    {
                                        headers: {
                                            'Content-Type': 'multipart/form-data'
                                        }
                                    }
                                )
                            }
                        }
                        this.close();
                    }).catch(error => {
                        alert("Er ging iets mis bij het opslaan van het interesse punt!");
                        console.log(error);
                    });
                }
            },
            removeProject() {
                this.projectName = null;
                this.projectId = null;
            },
        },
        mounted() {
            this.input = this.$el.querySelector('input[type=file]');
            this.input.addEventListener('change', () => this.onFileSelection());
            this.input.setAttribute('multiple', 'multiple');
            window.axios.get('/getCategories').then(response => {
                let temp = response.data;
                for (let i = 0; i < temp.length; i++) {
                    this.categories.push(temp[i].name.toString());
                }
            }).catch(function (error) {
                console.log(error);
            });
            window.axios.get('/getProjectPoints').then(response => {
               // this.project_points = response.data;
            }).catch(function (error) {
                console.log(error);
            });
        },

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

    .removeScrollbar::-webkit-scrollbar {
        display: none;
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
</style>
