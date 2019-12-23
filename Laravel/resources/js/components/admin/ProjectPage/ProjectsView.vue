<template>
    <v-layout align-start justify-center column fill-height>
        <v-flex xs2 style="width: 100%">
            <projects-header :parent="parent" :OnEditProjectButtonPressed="EditProjects"></projects-header>
        </v-flex>
        <v-flex style="background-color: white; overflow: auto; width: 100%;" class="removeScrollBar" v-bar>
            <v-data-table
                    :headers="headers"
                    :items="values"
                    class="projectTable elevation-1"
                    disable-initial-sort
                    hide-actions
                    :pagination.sync="pagination"
            >
                <template v-slot:items="props">
                    <tr @click="rowSelected(props.item.id)">
                        <td>{{ props.item.name }}</td>
                        <td class="text-xs-right">{{ props.item.category }}</td>
                        <td class="text-xs-right">{{ props.item.information }}</td>
                    </tr>
                </template>
            </v-data-table>
        </v-flex>
    </v-layout>
</template>

<script>
    import ProjectsHeader from './ProjectsHeader';
    export default {
        name: "ProjectView",
        components: {
            ProjectsHeader,
        },
        props: {
            headers: {
                type: Array,
                required: true
            },
            values: {
                type: Array,
                required: true,
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
