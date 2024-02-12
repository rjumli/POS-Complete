<template>
    <b-modal v-model="showModal" title="View Package" size="xl" header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <div class="col-xl-12">
            <div class="mt-xl-0 mt-5">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <h4>{{package.name}}</h4>
                        <div class="hstack gap-3 flex-wrap">
                            <div><a class="text-primary d-block">#{{package.code}}</a></div>
                            <div class="vr"></div>
                            <div class="text-muted">Total : <span class="text-body fw-medium">{{formatMoney(package.price)}}</span></div>
                            <div class="vr"></div>
                            <div class="text-muted">Created At : <span class="text-body fw-medium">{{package.created_at}}</span></div>
                        </div>
                    </div>
                    <div class="flex-shrink-0 mt-n2">
                        <div>
                            <QRCodeVue3
                                :value="package.code"
                                :key="package.code"
                                :width="80"
                                :height="80"
                                :qrOptions="{ typeNumber: '0', mode: 'Byte', errorCorrectionLevel: 'Q' }"
                                :imageOptions="{ hideBackgroundDots: true, imageSize: 0.4, margin: 0 }"
                                :dotsOptions="{ type: 'square', color: '#05004d' }"
                                :download="true"
                                downloadButton="btn btn-light btn-sm"
                                :downloadOptions="{ name: package.code, extension: 'png'}"
                                :cornersSquareOptions="{ type: 'square', color: '#0e013c' }"
                            />
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
                                <th class="text-center" width="13%">Total</th>
                                <!-- <th class="text-center" width="15%">Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="fs-12" v-for="(list, index) in package.lists" v-bind:key="'a-'+index">
                                <td class="text-center">{{index+1}}</td>
                                <td>{{list.product.name}}</td>
                                <td class="text-center">{{list.quantity}}</td>
                                <td class="text-center">{{formatMoney(list.price) }}</td>
                                <td class="text-center">{{formatMoney(list.quantity *list.price)}}</td>
                                <!-- <td class="text-center">
                                   <span>-</span>
                                </td> -->
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
</template>
<script>
import QRCodeVue3 from "qrcode-vue3";
export default {
    components: { QRCodeVue3 },
    props: ['dropdowns'],
    data(){
        return {
            showModal: false,
            package: {
                category: {},
            },
            index: '',
            id: ''
        }
    },
    methods : {
        show(data) {
            this.package = data;
            this.showModal = true;
        },
        update(data){
            this.package = data;
        },
        hide(){
            this.showModal = false;
        },
        openUpdate(data,index){
            this.index = index;
            this.$refs.update.show(data,this.package.id);
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
