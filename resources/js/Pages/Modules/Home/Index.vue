<template>
    <Head title="Dashboard" />
    <b-row style="height: calc(100vh - 180px); overflow: auto;">
        <b-col class="col-md-8">
            <b-row>
                <b-col class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                        <i class="ri-team-fill align-middle"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">Customers</p>
                                    <h4 class="mb-0">{{this.customer_count}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </b-col>
                <b-col class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                        <i class="ri-shopping-cart-2-fill align-middle"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">STOCKS AVAILABLE</p>
                                    <h4 class="mb-0">{{stocks}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </b-col>
                <b-col class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                        <i class="ri-wallet-3-fill align-middle"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">Total Revenue</p>
                                    <h4 class="mb-0"> <span class="counter-value">{{formatMoney(this.revenue)}}</span></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </b-col>
                <b-col xl="12">
                <b-card no-body style="height: 400px;">
                    <Graph />
                </b-card>
            </b-col>
            </b-row>
        </b-col>

        <b-col xxl="4">
            <b-card no-body >
                <b-card-body style="height: 504px">
                    <Breakdown :breakdown="breakdown"/>
                </b-card-body>
            </b-card>
        </b-col>

        <b-col xxl="4" lg="6">
            <Sales :sales="sales" ref="sales"/>
        </b-col>
        <b-col xxl="4" lg="6">
            <Discount :discounts="discounts" :items="items.data" :dropdowns="dropdowns"/>
        </b-col>
        <b-col xxl="4" lg="6">
            <Order :suppliers="suppliers" :products="products" :units="units" :dropdowns="dropdowns" :orders="orders"/>
        </b-col>
    </b-row>
</template>
<script>
import Graph from './Graph.vue';
import Discount from './Discount.vue';
import Sales from './Sales.vue';
import Order from './Order.vue';
import Breakdown from './Breakdown.vue';
import PageHeader from "@/Shared/Components/PageHeader.vue";
export default {
    components: { PageHeader, Order, Sales, Discount, Graph, Breakdown },
    props: ['revenue','customer_count','stocks','orders','dropdowns','discounts','units','suppliers','products','sales','active_discounts','breakdown','items'],
    methods: {
        formatMoney(value) {
            let val = (value/1).toFixed(2).replace(',', '.')
            return '₱'+val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        },
    }
}
</script>
