<template>
    <v-content style="background-color: #89a324">
        <v-container fill-height fluid pa-0 ma-0>
            <v-layout column fill-height style="max-height: 100vh;">
                <v-flex xs1 mx-5 my-3>
                    <c-r-u-d-page-header :parent="this" style="z-index: 3"></c-r-u-d-page-header>
                </v-flex>
                <v-flex style="background-color: white; overflow: hidden;" xs11 >
                    <project-page v-if="currentCrudPageState === crudPageState.Projects"></project-page>
                    <statistics-page v-else-if="currentCrudPageState === crudPageState.Statistics"></statistics-page>
                    <interest-point-page
                        v-else-if="currentCrudPageState === crudPageState.InterestPoints"></interest-point-page>
                    <routes-page v-else-if="currentCrudPageState === crudPageState.Routes"></routes-page>
                </v-flex>
            </v-layout>
        </v-container>
    </v-content>
</template>

<script>
    import CRUDPageHeader from './CRUDPageHeader';
    import ProjectPage from './ProjectPage/ProjectPage';
    import StatisticsPage from './StatisticsPage';
    import InterestPointPage from './InterestPoint/InterestPointPage'
    import RoutesPage from './RoutesPage/RoutesPage';

    export default {
        name: "MainCrudPage",
        components: {
            CRUDPageHeader,
            ProjectPage,
            StatisticsPage,
            InterestPointPage,
            RoutesPage
        },
        data() {
            return {
                crudPageState: {'Projects': 0, 'InterestPoints': 1, 'Routes': 2, 'Statistics': 3},
                currentCrudPageState: 3,
            }
        },
        methods: {
            openEditProjectPage() {
                this.currentCrudPageState = this.crudPageState.Projects;
            },
            openStatisticsPage() {
                this.currentCrudPageState = this.crudPageState.Statistics;
            },
            openInterestPointPage() {
                this.currentCrudPageState = this.crudPageState.InterestPoints;
            },
            openRoutesPage() {
                this.currentCrudPageState = this.crudPageState.Routes;
            }
        }
    }
</script>

<style>
    .search-bar.v-input .v-input__control .v-input__slot {
        border-radius: 20px;
        border-style: solid;
        border-width: 2px;
        border-color: rgba(174, 195, 207, 0.21);
    }
</style>
