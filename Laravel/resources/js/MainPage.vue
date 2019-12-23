<template>
    <div v-resize="UpdateScreen">
        <first-page id="firstPage" ref="firstPage" v-scroll="onScrollFirstPage" v-show="firstPageEnabled === true"></first-page>
        <map-page id="mapPage" ref="mapPage" :mapObjects="mapObjects" :onProjectOpened="OpenProjectPage" :onRoutePageOpened="OpenRoutePage"></map-page>
        <project-page id="projectPage" ref="projectPage" :mapObjects="mapObjects" :parent="this" :onProjectOpened="OpenProjectPage" v-if="selectedProjectPage.isSelected === true"></project-page>
        <RoutePage ref="routePage" id="routePage" :onProjectOpened="OpenProjectPage" v-if="selectedRoutePage === true"></RoutePage>
        <div v-else></div>
    </div>
</template>

<script>
    import MapPage from './components/MapPage';
    import FirstPage from './components/FirstPage';
    import ProjectPage from './components/ProjectPage/ProjectPage';
    import RoutePage from './components/routePage/RoutePage';

    export default {
        name: "MainPage",
        components: {
            MapPage,
            FirstPage,
            ProjectPage,
            RoutePage,
        },
        watch: {
            selectedProjectPage: function(){
                this.$nextTick(() => {
                    this.$refs.projectPage.init();
                })
            }
        },
        data() {
            return {
                selectedProjectPage: {
                    isSelected: false,
                    projectId: undefined,
                    project: false
                },
                selectedRoutePage: false,
                firstPageEnabled: true,
                scrolledOnFirstPage: false,
                mapPage: null,
                mapObjects: []
            }
        },
        methods: {
            OpenProjectPage(projectId, isProject) {
                this.selectedProjectPage = {
                    isSelected: true,
                    projectId: projectId,
                    project: isProject
                };
                this.selectedRoutePage = false;

                let pageStates = this.$store.getters.pageStates;
                this.$store.commit('setPageState', pageStates.projectPage);

                if (this.$refs.projectPage !== undefined) {
                    this.UpdateScreen();
                }
            },
            OpenRoutePage() {
                this.selectedRoutePage = true;
                this.selectedProjectPage.isSelected = false;

                let pageStates = this.$store.getters.pageStates;
                this.$store.commit('setPageState', pageStates.routePage);

                if (this.$refs.routePage !== undefined) {
                    this.UpdateScreen();
                }
            },
            OpenMapPage() {
                let pageStates = this.$store.getters.pageStates;
                this.$store.commit('setPageState', pageStates.mapPage);

                this.UpdateScreen();
            },
            UpdateScreen() {
                let currentPageState = this.$store.getters.getCurrentPageState;
                let pageStates = this.$store.getters.pageStates;

                switch (currentPageState) {
                    case pageStates.startPage:
                        this.GoToSection('#firstPage');
                        break;
                    case pageStates.mapPage:
                        this.GoToSection('#mapPage');
                        break;
                    case pageStates.projectPage:
                        this.GoToSection('#projectPage');
                        break;
                    case pageStates.routePage:
                        this.GoToSection('#routePage');
                        break;
                }
            },
            GoToSection(id) {
                this.$vuetify.goTo(id, {duration: 500});
            },
            disableInputEvents(element) {
                L.DomEvent.disableClickPropagation(element.$el);
                L.DomEvent.disableScrollPropagation(element.$el);
            },
            ScrollOnWheelEvent(e) {
                if(this.scrolledOnFirstPage === false && e.deltaY > 0)
                {
                    this.OpenMapPage();
                    document.removeEventListener("wheel", this.ScrollOnWheelEvent);

                    this.scrolledOnFirstPage = true;
                }
            },
            onScrollFirstPage(e) {
                let firstPageEl = this.$refs.firstPage.$el;
                let path = e.path || (e.composedPath && e.composedPath());
                let scrollPercentage = 1 / firstPageEl.clientHeight * path[1].scrollY;


                if(scrollPercentage > 0.95)
                {
                    this.firstPageEnabled = false;
                }
            },
            getMapPage(){
                return this.$refs.mapPage;
            }
        },
        mounted() {
            this.UpdateScreen();
            document.addEventListener("wheel", this.ScrollOnWheelEvent);


        }
    }
</script>

<style>
    .leaflet-popup-content-wrapper {
        background-color: #D9D9D9;
    }

    .leaflet-popup-tip {
        background-color: #D9D9D9;
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
        background-color: rgba(64, 64, 64, 0.64);
        margin: 5px 5px 5px 0;
        border-radius: 10px;
        height: calc(100% - 10px);
        display: block;
    }

    .vb.vb-scrolling-phantom > .vb-dragger > .vb-dragger-styler {
        background-color: rgba(64, 64, 64, 0.64);
    }

    .vb > .vb-dragger:hover > .vb-dragger-styler {
        background-color: rgba(64, 64, 64, 0.64);
        height: 100%;
    }

    .vb.vb-dragging > .vb-dragger > .vb-dragger-styler {
        background-color: rgba(64, 64, 64, 0.64);
        height: 100%;
    }

    .vb.vb-dragging-phantom > .vb-dragger > .vb-dragger-styler {
        background-color: rgba(64, 64, 64, 0.64);
    }
</style>
