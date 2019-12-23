<template>
    <div>
        <v-img
                height="100vh"
                src="/img/FirstPage/wet-rainy-road-leaf-fallen-hd-gl.jpg">
            <v-layout align-center justify-center row fill-height>
                <v-flex xs12 sm5 md4 lg4>
                    <v-card color="rgba(160, 181, 80, 0.9)" height="100%" width="100%" class="pa-4" style="max-width: 500px">
                        <v-img src="/img/RoadLeaf-Logo.png" style="filter: brightness(0) invert(1);" class="mb-5"/>

                        <v-layout align-center justify-center column >
                            <v-card width="100%" style="border-radius: 20px;"  class="mb-4">
                                <v-text-field
                                        v-model="username"
                                        prepend-inner-icon="person"
                                        single-line
                                        full-width
                                        flat
                                        hide-details
                                        color="green"
                                ></v-text-field>
                            </v-card>

                            <v-card width="100%" style="border-radius: 20px;">
                                <v-text-field
                                        prepend-inner-icon="lock"
                                        :append-icon="show1 ? 'visibility' : 'visibility_off'"
                                        :type="show1 ? 'text' : 'password'"
                                        @click:append="show1 = !show1"
                                        v-model="password"
                                        single-line
                                        full-width
                                        flat
                                        hide-details
                                        color="green"
                                        @keyup.enter="authenticate"
                                ></v-text-field>
                            </v-card>
                            <v-btn large class="mt-4" style="border-radius: 8px">
                                <div class="light-green--text display-1 font-weight-black" @click="authenticate">
                                    LOGIN
                                </div>
                            </v-btn>
                        </v-layout>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-img>
    </div>
</template>

<script>
    export default {
        name: "loginScreen",
        data() {
            return {
                show1: false,
                password: undefined,
                username: undefined,
            }
        },
        methods: {
            authenticate() {
                axios.post('/admin/authenticate', {name: this.username, password: this.password}).then(response => {
                   window.location.href = '/beheer';
                });
            }
        }
    }
</script>

<style scoped>

</style>