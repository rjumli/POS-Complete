<template>
    <b-card no-body class="card-height-100">
        <b-card-header class="align-items-center d-flex">
        <b-card-title class="mb-0 flex-grow-1">Pending Orders</b-card-title>
        <div class="flex-shrink-0">
            <button @click="viewCreate()" type="button" class="btn btn-primary btn-sm mt-n3 mb-n3">New Order</button>
        </div>
        </b-card-header>
        <b-card-body class="p-0">
            <div data-simplebar style="height: 390px">
                <div class="p-3">
                    <div class="table-responsive" v-if="orders.length > 0">
                        <table class="table table-nowrap table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr class="fs-11">
                                    <th style="width: 10%;" class="text-center">#</th>
                                    <th style="width: 70%;">Code</th>
                                    <th style="width: 20%;" class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="fs-12" v-for="(list,index) in orders" v-bind:key="index">
                                    <td class="text-center"> {{index+1}}</td>
                                    <td>
                                        <h6 class="mb-0">{{list.code}}</h6>
                                        <p class="text-muted mb-0">{{list.supplier.supplier.name}} - {{list.supplier.name}}</p>
                                    </td>
                                    <td class="text-center">
                                        <b-button @click="view(list)" variant="soft-primary" v-b-tooltip.hover title="View Product" size="sm" class="edit-list me-1">View</b-button>
                                        <!-- <b-button @click="edit(list)" variant="soft-primary" v-b-tooltip.hover title="Edit Product" size="sm" class="edit-list me-1 w-xs">Edit</b-button> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div v-else class="alert alert-warning text-center" role="alert">
                        No pending orders
                    </div>
                </div>
            </div>
        </b-card-body>
    </b-card>
    <View :dropdowns="dropdowns" ref="view"/>
    <Create :suppliers="suppliers" :products="products" :units="units" :dropdowns="dropdowns" @message="fetch()" ref="create"/>
</template>
<script>
import Create from '../Stocking/Orders/Create.vue';
import View from '../Stocking/Orders/View.vue';
export default {
    props: ['dropdowns','orders','suppliers','products','units'],
    components: { View, Create },
    methods:{
        view(data){
            this.$refs.view.show(data);
        },
        viewCreate(){
            this.$refs.create.show();
        }
    }
}
</script>