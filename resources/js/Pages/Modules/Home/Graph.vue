<template>
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">Sales</h4>
        <div>
            <button @click="previous(this.year)" class="btn btn-soft-primary btn-sm me-1" type="button">
                <div class="btn-content"> Previous </div>
            </button>
            <button @click="next(this.year)" class="btn btn-soft-primary btn-sm" type="button" :disabled="this.year == new Date().getFullYear() ">
                <div class="btn-content"> Next </div>
            </button>
        </div>
    </div>
    <b-card-body>
        <apexchart ref="realtimeChart" class="apex-charts mb-n5 mt-2" type="bar" dir="ltr" height="360" :series="series"
            :options="chartOptions">
        </apexchart>
    </b-card-body>
</template>
<script>
export default {
    data(){
        return {
            currentUrl: window.location.origin,
            years: [],
            year: new Date().getFullYear(),
            series: [],
            chartOptions: {
                chart: {
                    stacked: true,
                    toolbar: {
                        show: false,
                    },
                    zoom: {
                        enabled: true,
                    },
                    id: "vuechart-example",
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: "50%",
                        endingShape: "rounded",
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                xaxis: {
                    labels: {
                        rotate: -45
                    },
                    categories: [
                        "Jan",
                        "Feb",
                        "Mar",
                        "Apr",
                        "May",
                        "Jun",
                        "Jul",
                        "Aug",
                        "Sep",
                        "Oct",
                        "Nov",
                        "Dec",
                    ],
                    tickPlacement: 'on'
                },
                yaxis: {
                    title: {
                        text: 'Total Amounts'
                    },
                },
                colors: ["#556ee6", "#ea6868", "#34c38f", "#f1b44c", "#a20cce", " #713d3d"],
                legend: {
                    position: "top",
                },
                fill: {
                    opacity: 1,
                },
            },
        }
    },
    created() {
        this.fetch();
    },
    methods : {
        fetch() {
            axios.get(this.currentUrl + '/home',{
                params : {
                    type : 'years',
                    year: this.year,
                    options: 'lists'
                }
            })
            .then(response => {
                this.chartOptions = {
                    ...this.chartOptions,
                    ...{
                        xaxis: {
                            labels: {
                                show: true,
                                rotate: -65,
                                rotateAlways: true,
                                minHeight: 100,
                                maxHeight: 180,
                                style: {
                                    colors: "red"
                                }
                            },
                            categories: response.data.categories,
                            tickPlacement: 'on'
                        }
                    }
                };
                this.series = response.data.lists;
            })
            .catch(err => console.log(err));
        },
        previous(year){
            this.year = year - 20;
            this.fetch();
        },
        next(year){
            this.year = year + 20;
            this.fetch();
        }
    }
}
</script>