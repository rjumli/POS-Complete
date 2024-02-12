<template>
    <b-card no-body class="card-height-100">
        <b-card-header class="align-items-center d-flex">
        <b-card-title class="mb-0 flex-grow-1">Active Discount</b-card-title>
        <div class="flex-shrink-0">
            <button @click="viewCreate()" type="button" class="btn btn-primary btn-sm mt-n3 mb-n3">New Discount</button>
        </div>
        </b-card-header>
        <b-card-body class="p-0">
            <div data-simplebar style="height: 390px">
                <div class="p-3">
                    <div class="table-responsive" v-if="items.length > 0">
                        <table class="table table-nowrap table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr class="fs-11">
                                    <th style="width: 10%;" class="text-center">#</th>
                                    <th style="width: 60%;">Name</th>
                                    <th style="width: 15%;" class="text-center">Value</th>
                                    <th style="width: 15%;" class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="fs-12" v-for="(list,index) in items" v-bind:key="index">
                                    <td class="text-center"> {{index+1}}</td>
                                    <td>
                                        <h6 class="mb-0">{{list.item.name}} - <span :class="list.item.type == 'Package' ? 'text-danger' : ''">{{ list.item.brand }}</span></h6>
                                        <p class="text-muted mb-0">{{list.item.code}}</p>
                                    </td>
                                    <td class="text-center"> {{(list.discount.subtype.name == 'Amount') ? formatMoney(list.discount.value) : list.discount.value+'%'}}</td>
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
                    <div v-else class="alert alert-warning text-center" role="alert">
                        No discounts found
                    </div>
                </div>
            </div>
        </b-card-body>
    </b-card>
    <View ref="view"/>
    <New :discounts="discounts" :dropdowns="dropdowns" ref="new"/>
</template>
<script>
import View from '../Maintenance/Discounts/View.vue';
import New from '../Maintenance/Discounts/New.vue';
export default {
    components: { New, View},
    props: ['discounts','dropdowns','items'],
    methods:{
        viewCreate(data){
            this.$refs.new.show(data);
        },
        view(data){
            this.$refs.view.show(data);
        },
        formatMoney(value) {
            let val = (value/1).toFixed(2).replace(',', '.')
            return '₱'+val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        },
    }
}
</script>