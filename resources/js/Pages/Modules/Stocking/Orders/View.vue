<template>
    <b-modal v-model="showModal" title="Purchased Order" size="xl" header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <div class="col-xl-12">
            <div class="mt-xl-0 mt-5">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <h4>{{order.supplier.supplier.name}}</h4>
                        <div class="hstack gap-3 flex-wrap">
                            <div><a class="text-primary d-block">#{{order.code}}</a></div>
                            <div class="vr"></div>
                            <div class="text-muted">Total : <span class="text-body fw-medium">{{formatMoney(order.total)}}</span></div>
                            <div class="vr"></div>
                            <div class="text-muted">Created At : <span class="text-body fw-medium">{{order.created_at}}</span></div>
                        </div>
                    </div>
                    <!-- <div class="flex-shrink-0">
                        <div>
                            <a href="apps-ecommerce-add-product.html" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Edit" data-bs-original-title="Edit"><i class="ri-pencil-fill align-bottom"></i></a>
                        </div>
                    </div> -->
                </div>

                <div class="col-sm-12 mt-n1">
                    <hr class="text-muted"/>
                </div>
                <div class="col-sm-12 mt-0">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light fs-11">
                            <tr>
                                <th width="5%" class="text-center">#</th>
                                <th width="37%">Product</th>
                                <th class="text-center" width="10%">Quantity</th>
                                <th class="text-center" width="13%">Price</th>
                                <th class="text-center" width="13%">Total</th>
                                <th class="text-center" width="10%">Status</th>
                                <th class="text-center" width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="fs-12" v-for="(list, index) in order.lists" v-bind:key="'a-'+index">
                                <td class="text-center">{{index+1}}</td>
                                <td>{{list.product.name}}</td>
                                <td class="text-center">{{list.quantity}}</td>
                                <td class="text-center">{{formatMoney(list.price) }}</td>
                                <td class="text-center">{{formatMoney(list.quantity *list.price)}}</td>
                                <td class="text-center">
                                    <span :class="'badge '+list.status.color">{{list.status.name}}</span>
                                </td>
                                <td class="text-center">
                                    <!-- <b-button v-if="list.status.name == 'Pending'" @click="openUpdate(list,index)" variant="soft-primary" v-b-tooltip.hover title="Update" size="sm" class="edit-list me-1 w-xs">Update</b-button> -->
                                    <span>-</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                   
                </div>
            </div>
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
            <!-- <b-button @click="create('ok')" variant="primary" :disabled="form.processing" block>Save</b-button> -->
        </template>
    </b-modal>
    <Update :dropdowns="dropdowns" ref="update"/>
</template>
<script>
import Update from './Update.vue';
export default {
    components: { Update },
    props: ['dropdowns'],
    data(){
        return {
            showModal: false,
            order: {
                supplier: { supplier: ''},
                status: '',
            },
            index: '',
            id: ''
        }
    },
    methods : {
        show(data) {
            this.order = data;
            this.showModal = true;
        },
        update(data){
            this.order = data;
        },
        hide(){
            this.showModal = false;
        },
        openUpdate(data,index){
            this.index = index;
            this.$refs.update.show(data,this.order.id);
        },
        formatMoney(value) {
            let val = (value/1).toFixed(2).replace(',', '.')
            return '₱'+val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        },
    }
}
</script>
<style>
.multiselect__single {
    font-size: 12px;
}
</style>
