<template>
    <div class="projectEditSection" v-bar>
        <div class="pr-2">
            <v-layout align-center justify-space-between row>
                <v-card-title class="display-1">Nieuw punt</v-card-title>
                <v-flex class="tooltipTopRight">
                    <v-tooltip top content-class="tooltip-inner">
                        <template v-slot:activator="{ on }">
                            <v-img class="tooltipImage"
                                   contain
                                   v-on="on"
                                   src="img/context-sensitive-help.png"/>
                        </template>
                        <span>
                            Op deze pagina kan een nieuw interessepunt worden gemaakt.
                            Geef het punt een passende naam en beschrijving.
                            Een overkoepelend project kan gekozen worden, maar dit hoeft niet.
                            Kies de categorie die het beste past bij het nieuwe punt.
                            Klik op de kaart om aan te geven waar dit punt is.
                            Druk op 'punt toevoegen' als u klaar bent.
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
                                <v-text-field v-model="name" :rules="nameRules"></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-flex>

                    <v-flex xs1>
                        <v-layout row>
                            <v-flex xs3>
                                <v-card-title class="title">Kies een project:</v-card-title>
                            </v-flex>
                            <v-flex xs3>
                                <v-select v-model="projectName" :items="projectNames" label="optioneel"></v-select>
                            </v-flex>
                        </v-layout>
                    </v-flex>

                    <v-flex xs1>
                        <v-layout row>
                            <v-flex xs3>
                                <v-card-title class="title">Kies een categorie:</v-card-title>
                            </v-flex>
                            <v-flex xs3>
                                <v-select v-model="category" :items="categories" :rules="categoryRules"></v-select>
                            </v-flex>
                        </v-layout>
                    </v-flex>

                    <v-flex xs1>
                        <v-layout row>
                            <v-flex xs3>
                                <v-card-title class="title">Beschrijving:</v-card-title>
                            </v-flex>
                            <v-flex xs4>
                                <v-textarea v-model="text" :rules="textRules" box></v-textarea>
                            </v-flex>
                        </v-layout>
                    </v-flex>

                    <v-flex xs1>
                        <v-layout row>
                            <v-flex xs3>
                                <v-card-title class="title">Locatie (breedtegraad):</v-card-title>
                            </v-flex>
                            <v-flex xs4>
                                <v-text-field v-model="markerLat" :rules="markerRules" box readonly></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-flex>

                    <v-flex xs1>
                        <v-layout row>
                            <v-flex xs3>
                                <v-card-title class="title">Locatie (lengtegraad):</v-card-title>
                            </v-flex>
                            <v-flex xs4>
                                <v-text-field v-model="markerLng" :rules="markerRules" box readonly></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-flex>

                    <v-flex xs1>
                        <v-layout column>
                            <v-flex>
                                <v-card-title class="title">Afbeelding toevoegen:</v-card-title>
                            </v-flex>
                            <input type="file">
                            <v-carousel v-if="images.length > 0">
                                <v-carousel-item
                                        v-for="(image,i) in images"
                                        :key="i"
                                        :src="image"
                                ></v-carousel-item>
                            </v-carousel>
                        </v-layout>
                    </v-flex>

                    <v-layout align-center justify-end row>
                        <v-btn @click="validate" style="max-width: 10%; height: 100%;" color="#89A226">
                            <v-card style="white-space: normal; max-width: 60%;" color="transparent" flat
                                    class="white--text">
                                Project punt Toevoegen
                            </v-card>
                        </v-btn>
                    </v-layout>
                </v-layout>
            </v-form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "InterestPointNew",
        props: {
            parent: {
                type: Object,
                required: true
            },
            projects: {
                type: Array,
                required: true
            },
            projectNames: {
                type: Array,
                required: true
            },
            projectIds: {
                type: Array,
                required: true
            },
        },
        data() {
            return {
                name: '',
                nameRules: [
                    v => !!v || 'Naam is vereist',
                    v => (v && v.length <= 191) || 'Naam mag niet langer zijn dan 190 karakters'
                ],
                projectName: null,
                projectId: null,
                category: null,
                categories: [],
                categoryRules: [
                    v => !!v || 'Categorie is vereist',
                ],
                text: '',
                textRules: [
                    v => !!v || 'Beschrijving is vereist',
                    v => (v && v.length <= 10000) || 'Tekst mag niet langer zijn dan 10.000 karakters'
                ],
                markerRules: [
                    v => !!v || 'U moet een locatie voor deze punt kiezen',
                ],
                input: null,
                files: [],
                images: [],
                markerLat:null,
                markerLng: null,
                marker: {},
            }
        },
        methods: {
            close() {
                this.parent.$refs.map.clearMap();

                this.parent.$refs.map.setDrawMode(false);
                this.parent.$refs.map.setNewMode(false);
                this.markerLat = null;
                this.markerLng = null;

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
            validate() {
                if (this.projectName != null) {
                    for (let i = 0; i < this.projectNames.length; i++) {
                        if (this.projects[i].name === this.projectName) {
                            this.projectId = this.projects[i].id;
                        }
                    }
                }
                console.log(this.projectId);
                if (this.$refs.form.validate()) {
                    axios({
                        method: 'post',
                        url: '/admin/addProjectPoint',
                        data: {
                            project_id: this.projectId,
                            name: this.name,
                            category: this.category,
                            information: this.text,
                            markerLat: this.markerLat,
                            markerLong: this.markerLng,
                            area: null,
                        }
                    }).then(response => {
                        for (let i = 0; i < this.files.length; i++) {
                            let formData = new FormData();
                            formData.append("image", this.files[i]);
                            formData.append("name", response.data.id + "_" + i);
                            formData.append("folder", "points");
                            formData.append("id", response.data.id);
                            console.log(response);
                            axios.post("/beheer/media", formData,
                                {
                                    headers: {
                                        'Content-Type': 'multipart/form-data'
                                    }
                                }
                            ).catch(error => {
                                alert("Er ging iets mis bij het opslaan van het interesse punt!");
                                console.log(error);
                            });
                        }

                        this.parent.loadPoints();
                        this.close();
                    }).catch(error => {
                        alert("Er ging iets mis bij het opslaan van het interesse punt!");
                        console.log(error);
                    });
                } else {
                    alert("U heeft niet alles ingevuld");
                }
            },
        },
        mounted() {
            this.marker = this.parent.getMarker();
            window.axios.get('/getCategories').then(response => {
                let temp = response.data;
                for (let i = 0; i < temp.length; i++) {
                    this.categories.push(temp[i].name.toString());
                }
            }).catch(function (error) {
                console.log(error);
            });
            this.input = this.$el.querySelector('input[type=file]');
            this.input.addEventListener('change', () => this.onFileSelection());
            this.input.setAttribute('multiple', 'multiple');
        }
    }
</script>

<style>
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
        max-height: 200px;
        max-width: 350px;
    }
</style>
