<template>
    <v-layout align-center justify-center column fill-height>
        <v-flex xs2 style="width: 100%">
            <interest-point-header :parent="parent" :OnEditProjectButtonPressed="EditProjects"></interest-point-header>
        </v-flex>
        <v-flex style="background-color: white; overflow: auto; width: 100%;" class="removeScrollBar" v-bar>
            <v-data-table
                    :headers="headers"
                    :items="project_points"
                    class="projectTable elevation-1"
                    disable-initial-sort
                    hide-actions
                    :pagination.sync="pagination"
            >
                <template v-slot:items="props">
                    <tr @click="rowSelected(props.item.id)">
                        <td>{{ props.item.name }}</td>
                        <td class="text-xs-left">{{ props.item.category }}</td>
                        <td class="text-xs-left">{{ getProjectName(props.item.project_id) }}</td>
                        <td class="text-xs-left">{{ props.item.information }}</td>
                    </tr>
                </template>
            </v-data-table>
        </v-flex>
    </v-layout>
</template>

<script>
    import InterestPointHeader from './InterestPointHeader';

    export default {
        name: "InterestPointView",
        components: {
            InterestPointHeader,
        },
        props: {
            headers: {
                type: Array,
                required: true
            },
            project_points: {
                type: Array,
                required: true,
            },
            projects: {
                type: Array,
                required: true
            },
            parent: {
                type: Object,
                required: true,
            }
        },
        methods: {
            EditProjects() {
                this.parent.newProjectButtonPressed();
            },
            rowSelected(selectedProject) {
                this.parent.editAProject(selectedProject);
            },
            getProjectName(id){
                for(let i = 0; i < this.projects.length; i++) {
                    if (this.projects[i].id == id) return this.projects[i].name;
                }
                return "";
            }
        },
        data() {
            return {
                pagination: {
                    rowsPerPage: -1,
                },
            }
        }
    }
</script>

<style scoped>

</style>
