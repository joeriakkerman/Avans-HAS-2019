<template>
    <v-layout align-center justify-center column fill-height>
        <v-flex xs2 style="width: 100%">
            <routes-header :parent="parent" :OnEditProjectButtonPressed="EditProjects"></routes-header>
        </v-flex>
        <v-flex style="background-color: white; overflow: auto; width: 100%;" class="removeScrollBar" v-bar>
            <v-data-table
                    :headers="headers"
                    :items="desserts"
                    class="projectTable elevation-1"
                    disable-initial-sort
                    hide-actions
                    :pagination.sync="pagination"
            >
                <template v-slot:items="props">
                    <tr @click="rowSelected(props.item)">
                        <td>{{ props.item.name }}</td>
                        <td class="text-xs-right">{{ props.item.category }}</td>
                        <td class="text-xs-right">{{ props.item.route }}</td>
                        <td class="text-xs-right">{{ props.item.km }}</td>
                    </tr>
                </template>
            </v-data-table>
        </v-flex>
    </v-layout>
</template>

<script>
    import RoutesHeader from './RoutesHeader';

    export default {
        name: "ProjectView",
        components: {
            RoutesHeader,
        },
        props: {
            headers: {
                type: Array,
                required: true
            },
            desserts: {
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
