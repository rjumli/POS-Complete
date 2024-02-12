<template>
    <b-modal v-model="showModal" title="View Sale" size="xl" header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <div class="col-xl-12">
            <div class="mt-xl-0 mt-5">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <h4>{{sale.code}}</h4>
                        <div class="hstack gap-3 flex-wrap">
                            <div><span class="badge" :class="sale.status.color">{{sale.status.name}}</span></div>
                            <div class="vr"></div>
                            <div class="text-muted">Customer : <span class="text-body fw-medium">{{sale.customer.name}}</span></div>
                            <div class="vr"></div>
                            <div class="text-muted">Created At : <span class="text-body fw-medium">{{sale.created_at}}</span></div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-3 col-sm-6">
                        <div class="p-2 border border-dashed rounded">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-2">
                                    <div class="avatar-title rounded bg-transparent text-primary fs-24">
                                        <i class="ri-price-tag-2-fill"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="text-muted fs-11 mb-1">Subtotal :</p>
                                    <h5 class="mb-0 fs-13">{{formatMoney(sale.subtotal)}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="p-2 border border-dashed rounded">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-2">
                                    <div class="avatar-title rounded bg-transparent text-primary fs-24">
                                        <i class="ri-percent-fill"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="text-muted fs-11 mb-1">Discount :</p>
                                    <h5 class="mb-0 fs-13">{{formatMoney(sale.discount)}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="p-2 border border-dashed rounded">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-2">
                                    <div class="avatar-title rounded bg-transparent text-primary fs-24">
                                        <i class="ri-stack-fill"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="text-muted fs-11 mb-1">Tax :</p>
                                    <h5 class="mb-0 fs-13">{{formatMoney(sale.tax)}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="p-2 border border-dashed rounded">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-2">
                                    <div class="avatar-title rounded bg-transparent text-success fs-24">
                                        <i class="ri-hand-coin-fill"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="text-muted fs-11 mb-1">Grand Total :</p>
                                    <h5 class="mb-0 fs-13">{{formatMoney(sale.total)}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
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
                                <th class="text-center" width="13%">Discount</th>
                                <th class="text-center" width="13%">Total</th>
                                <th class="text-center" width="10%">Status</th>
                                <th class="text-center" width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="fs-12" v-for="(list, index) in sale.lists" v-bind:key="'a-'+index">
                                <td class="text-center">{{index+1}}</td>
                                <td>{{(list.product) ? list.product.name+' - '+list.product.brand : list.package.name+' (Package)'}}</td>
                                <td class="text-center">{{list.quantity}}</td>
                                <td class="text-center">{{formatMoney(list.price) }}</td>
                                <td class="text-center">{{formatMoney(list.discount)}}</td>
                                <td class="text-center">{{formatMoney(list.total)}}</td>
                                <td class="text-center">
                                    <span :class="'badge '+list.status.color">{{list.status.name}}</span>
                                </td>
                                <td class="text-center">
                                    <b-button v-if="list.status.name == 'Pending'" @click="openUpdate(list,index)" variant="soft-primary" v-b-tooltip.hover title="Update" size="sm" class="edit-list me-1 w-xs">Update</b-button>
                                    <span v-else>-</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
            <!-- <b-button @click="create('ok')" variant="primary" :disabled="form.processing" block>Save</b-button> -->
        </template>
    </b-modal>
</template>
<script>
import VueBarcode from '@chenfengyuan/vue-barcode';
export default {
    components : {VueBarcode},
    data(){
        return {
            showModal: false,
            sale: {
                lists: [],
                status: {},
                customer: {}
            },
        }
    },
    methods : {
        show(data) {
            this.sale = data;
            this.showModal = true;
        },
        hide(){
            this.showModal = false;
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
