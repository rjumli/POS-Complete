<template>
    <b-card no-body class="card-height-100">
        <b-card-header class="align-items-center d-flex">
        <b-card-title class="mb-0 flex-grow-1">Recent Sales</b-card-title>
        <div class="flex-shrink-0">
            <!-- <button @click="viewCreate()" type="button" class="btn btn-primary btn-sm">New Order</button> -->
        </div>
        </b-card-header>
        <b-card-body class="p-0">
            <div data-simplebar style="height: 390px">
                <div class="p-3">
                    <div class="table-responsive" v-if="sales.length > 0">
                        <table class="table table-nowrap table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr class="fs-11">
                                    <th style="width: 10%;" class="text-center">#</th>
                                    <th style="width: 70%;">Code</th>
                                    <th style="width: 20%;" class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="fs-12" v-for="(list,index) in sales" v-bind:key="index">
                                    <td class="text-center"> {{index+1}}</td>
                                    <td>
                                        <h6 class="mb-0 mt-n2">{{list.code}}</h6>
                                        <p class="text-muted mb-n2">{{list.customer.name}}</p>
                                    </td>
                                    <td class="text-center">
                                        <b-button @click="openView(list)" variant="soft-primary" v-b-tooltip.hover title="View Product" size="sm" class="edit-list me-1">View</b-button>
                                        <!-- <b-button @click="edit(list)" variant="soft-primary" v-b-tooltip.hover title="Edit Product" size="sm" class="edit-list me-1 w-xs">Edit</b-button> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div v-else class="alert alert-warning text-center" role="alert">
                        No sales found
                    </div>
                </div>
            </div>
        </b-card-body>
    </b-card>
    <View ref="view"/>
</template>
<script>
import View from '../Sales/View.vue';
export default {
    components: { View },
    props: ['sales'],
    methods:{
        openView(data){
            this.$refs.view.show(data);
        }
    }
}
</script>