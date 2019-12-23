<template>
    <v-container fluid fill-height pa-5 style="z-index: 3; background-size: 100%" :style="{ backgroundImage: `url('${'img/admin/natuurgebied_brabant.jpg'}')` }">
        <v-layout align-start justify-space-between row fill-height>
            <v-flex xs7 d-flex fill-height pr-5>
                <v-layout align-space-between justify-space-between column fill-height>
                    <v-flex d-flex xs6 lg5 xl5>
                        <v-card color="#8DA659" class="roundedCard">
                            <v-card-title class="display-1 white--text">
                                <v-layout align-start column>
                                    Statistieken
                                    <div class="chart-container">
                                        <bar-chart ref="barChart" :styles="myStyles"/>
                                    </div>

                                </v-layout>

                            </v-card-title>
                        </v-card>
                    </v-flex>

                    <v-flex xs6 d-flex fill-height>
                        <v-card color="#8DA659" class="roundedCard">
                            <v-card-title class="headline white--text">
                                <v-layout column align-start fill-height>


                                    <v-layout align-start justify-space-between row fill-height>
                                        <v-layout column align-start>
                                            <v-flex xs1>
                                                Meest bezochte routes
                                            </v-flex>
                                            <v-flex xs6>
                                                <v-card-text class="body-2">
                                                    1. Route van de avonturier <br>
                                                    2. Route van Napoleon <br>
                                                    3. Traditionele route <br>
                                                    4.Vlinder tocht <br>
                                                    5. Herfst promenade <br>
                                                </v-card-text>
                                            </v-flex>
                                        </v-layout>
                                        <v-flex xs6>
                                            
                                        </v-flex>
                                    </v-layout>
                                </v-layout>
                            </v-card-title>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-flex>

            <v-flex xs5 d-flex fill-height>
                <v-layout align-space-between justify-space-between column fill-height>
                    <v-flex d-flex fill-height xs6>
                        <v-layout align-center justify-center column>
                            <v-flex xs5 d-flex pb-1 style="width: 40%">
                                <v-card color="#8DA659" class="visitorsToday">
                                    <v-card-text class="pt-1 pb-0">
                                        <v-layout column align-center fill-height>
                                            <v-flex shrink>
                                                <p class="text-xs-center headline font-weight-bold mb-0">
                                                    Vandaag
                                                </p>
                                            </v-flex>
                                            <v-flex grow>
                                                <v-layout align-end justify-center row fill-height>
                                                    <p class="display-4 font-weight-bold white--text">
                                                        {{ visitorsToday }}
                                                    </p>
                                                    <p class="text-xs-right body-1">
                                                        Bezoekers
                                                    </p>
                                                </v-layout>
                                            </v-flex>
                                        </v-layout>

                                    </v-card-text>
                                </v-card>
                            </v-flex>

                            <v-flex xs5 d-flex pb-1 style="width: 40%">
                                <v-card color="#8DA659" class="visitorsWeek">
                                    <v-card-text class="pt-1 pb-0">
                                        <v-layout column align-center fill-height reverse>
                                            <v-flex shrink>
                                                <p class="text-xs-center headline font-weight-bold mb-0">
                                                    Deze week
                                                </p>
                                            </v-flex>
                                            <v-flex grow>
                                                <v-layout align-end justify-center row fill-height>
                                                    <p class="display-4 font-weight-bold white--text">
                                                        {{ visitorsThisWeek }}
                                                    </p>
                                                    <p class="text-xs-right body-1">
                                                        Bezoekers
                                                    </p>
                                                </v-layout>
                                            </v-flex>
                                        </v-layout>

                                    </v-card-text>
                                </v-card>
                            </v-flex>
                        </v-layout>
                    </v-flex>

                    <v-flex xs6 d-flex fill-height>

                    </v-flex>
                </v-layout>
            </v-flex>
        </v-layout>
    </v-container>
</template>


<script>
    import BarChart from './BarChart';

    export default {
        name: "StatisticsPage",
        data() {
            return {
                months: ['Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December'],
                datasets: {
                    labels: ['Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December'],
                    datasets: [{
                        label: 'bezoekers',
                        backgroundColor: '#d9decd',
                        data: [20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20]
                    }]
                },
                dates: {year: [], lastYear: []},
                visitorsThisWeek: 0,
                visitorsToday: 0
            }
        },
        components: {
            BarChart,
        },
        computed: {
            myStyles() {
                return {
                    height: `25vh`,
                    width: `25vw`
                }
            }
        },
        methods: {
            getWeekNumber(d) {
                d = new Date(Date.UTC(d.getFullYear(), d.getMonth(), d.getDate()));
                d.setUTCDate(d.getUTCDate() + 4 - (d.getUTCDay()||7));
                var yearStart = new Date(Date.UTC(d.getUTCFullYear(),0,1));
                return Math.ceil(( ( (d - yearStart) / 86400000) + 1)/7);
            }
        },
        mounted(){
            axios.get("/getAllVisitors")
                .then(({ data }) => {
                    this.datasets.labels = [];
                    this.datasets.datasets[0].data = [];
                    let today = new Date();
                    let day = String(today.getDate());
                    let month = String(today.getMonth() + 1);
                    let year = today.getFullYear();

                    for(let i = month; i > month - 12; i--){
                        if(i > 0) {
                            this.dates.year[this.months[i-1]] = [];
                            this.datasets.labels.unshift(this.months[i-1]);
                        }else{
                            this.dates.lastYear[this.months[12 + i-1]] = [];
                            this.datasets.labels.unshift(this.months[12 + i-1]);
                        }
                    }

                    for(let i = 0; i < data.length; i++){
                        let dateParts = data[i].date.split("-");
                        let date = new Date(dateParts[0], dateParts[1]-1, dateParts[2]);
                        if(date.getFullYear() === year) this.dates.year[this.months[date.getMonth()]].push(date);
                        else if(date.getFullYear() === year-1) this.dates.lastYear[this.months[date.getMonth()]].push(date);
                    }

                    for (let property in this.dates.year) {
                        if (this.dates.year.hasOwnProperty(property)) {
                            this.datasets.datasets[0].data.unshift(this.dates.year[property].length);
                        }
                    }

                    for (let property in this.dates.lastYear) {
                        if (this.dates.lastYear.hasOwnProperty(property)) {
                            this.datasets.datasets[0].data.unshift(this.dates.lastYear[property].length);
                        }
                    }

                    this.$refs.barChart.update(this.datasets);

                    for(let i = 0; i < this.dates.year[this.months[month-1]].length; i++){
                        if(this.getWeekNumber(today) === this.getWeekNumber(this.dates.year[this.months[month-1]][i])){
                            this.visitorsThisWeek++;
                            if(today.toDateString() === this.dates.year[this.months[month-1]][i].toDateString()) this.visitorsToday++;
                        }
                    }
                });
        }
    }
</script>

<style scoped>
    .visitorsToday {
        border-radius: 15px 15px 0 0;
    }

    .visitorsWeek {
        border-radius: 0 0 15px 15px;
    }

    .roundedCard {
        border-radius: 15px;
    }
</style>
