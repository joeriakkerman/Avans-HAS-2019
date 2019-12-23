<script>
    import {Bar} from 'vue-chartjs'

    export default {
        extends: Bar,
        methods: {
            update(data){
                this.renderChart(data, {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        onClick: (e) => e.stopPropagation()
                    },
                    scales: {
                        lineWidth: 2,
                        color: 'rgba(0, 0, 0, 0.3)',
                        xAxes: [{
                            gridLines: {
                                lineWidth: 2,
                                color: 'rgba(0, 0, 0, 0.3)',
                            },
                            ticks: {
                                fontColor: '#ffffff',
                                fontSize: 14,
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                lineWidth: 2,
                                color: 'rgba(0, 0, 0, 0.3)',
                            },
                        }],
                    },
                });
            }
        }
    }
</script>

<style scoped>
    #bar-chart {
        border-color: #661913;
    }
</style>