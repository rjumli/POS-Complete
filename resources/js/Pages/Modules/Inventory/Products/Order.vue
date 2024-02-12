<template>
    <b-modal v-model="showModal" hide-footer title="View Order History" size="lg" header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <div class="col-xl-12">
            <div class="mt-xl-0 mt-5">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <h4 class="text-primary">{{product.name}}</h4>
                        <div class="hstack gap-3 flex-wrap">
                            <div><a href="#" class="text-primary d-block">{{product.category.name}}</a></div>
                            <div class="vr"></div>
                            <div class="text-muted">Brand : <span class="text-body fw-medium">{{product.brand}}</span></div>
                            <div class="vr"></div>
                            <div v-if="product.size" class="text-muted">Size : <span class="text-body fw-medium">{{product.size}}</span></div>
                            <div v-if="product.size" class="vr"></div>
                            <div class="text-muted">Created At : <span class="text-body fw-medium">{{product.created_at}}</span></div>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <div>
                            <QRCodeVue3
                                    :value="product.code"
                                    :key="product.code"
                                    :width="50"
                                    :height="50"
                                    :qrOptions="{ typeNumber: '0', mode: 'Byte', errorCorrectionLevel: 'Q' }"
                                    :imageOptions="{ hideBackgroundDots: true, imageSize: 0.4, margin: 0 }"
                                    :dotsOptions="{ type: 'square', color: '#05004d' }"
                                    :cornersSquareOptions="{ type: 'square', color: '#0e013c' }"
                                />
                            <!-- <vue-barcode  :value="product.code" :options="{ displayValue: true }"  style="height: 50px;"></vue-barcode> -->
                            <!-- <a href="apps-ecommerce-add-product.html" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Edit" data-bs-original-title="Edit"><i class="ri-pencil-fill align-bottom"></i></a> -->
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="col-xl-12"><hr class="text-muted"/></div>
        <div class="col-xl-12">
            <table class="table table-bordered align-middle">
                <thead class="table-light fs-11">
                    <tr>
                        <th width="5%" class="text-center">#</th>
                        <th width="35%">Supplier</th>
                        <th class="text-center" width="15%">Quantity</th>
                        <th class="text-center" width="15%">Price</th>
                        <th class="text-center" width="18%">Total</th>
                        <th class="text-center" width="12%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="fs-12" v-for="(list, index) in lists" v-bind:key="'a-'+index">
                        <td class="text-center">{{index+1}}</td>
                        <td>{{list.order.supplier.supplier.name}} - {{list.order.supplier.name}}</td>
                        <td class="text-center">{{list.quantity}}</td>
                        <td class="text-center">{{formatMoney(list.price) }}</td>
                        <td class="text-center">{{formatMoney(list.quantity *list.price)}}</td>
                        <td class="text-center">
                            <span :class="'badge '+list.status.color">{{list.status.name}}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <Pagination class="ms-2 me-2" v-if="meta" @fetch="fetch" :lists="lists.length" :links="links" :pagination="meta" />
        </div>
    </b-modal>
</template>
<script>
import VueBarcode from '@chenfengyuan/vue-barcode';
import QRCodeVue3 from "qrcode-vue3";
import Pagination from "@/Shared/Components/Pagination.vue";
export default {
    components : { VueBarcode, Pagination, QRCodeVue3 },
    data(){
        return {
            showModal: false,
            product: {
                category: ''
            },
            lists: [],
            meta: {},
            links: {},
        }
    },
    methods : {
        show(data) {
            this.product = data;
            this.fetch();
            this.showModal = true;
        },
        hide(){
            this.showModal = false;
        },
        formatMoney(value) {
            let val = (value/1).toFixed(2).replace(',', '.')
            return '₱'+val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        },
        fetch(page_url) {
            page_url = page_url || '/orders';
            axios.get(page_url, {
                params: {
                    options: 'view',
                    product_id: this.product.id
                }
            })
            .then(response => {
                this.lists = response.data.data;
                this.meta = response.data.meta;
                this.links = response.data.links;
            })
            .catch(err => console.log(err));
        },
    }
}
</script>
<style>
.multiselect__single {
    font-size: 12px;
}
</style>
