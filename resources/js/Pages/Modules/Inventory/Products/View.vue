<template>
    <b-modal v-model="showModal" title="View QR Code" hide-footer header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <div class="col-xl-12 align-items-center">
            <center>
            <QRCodeVue3
                :value="product.code"
                :key="product.code"
                :width="350"
                :height="350"
                :qrOptions="{ typeNumber: '0', mode: 'Byte', errorCorrectionLevel: 'Q' }"
                :imageOptions="{ hideBackgroundDots: true, imageSize: 0.4, margin: 0 }"
                :dotsOptions="{ type: 'square', color: '#05004d' }"
                :download="true"
                downloadButton="btn btn-light btn-sm"
                :downloadOptions="{ name: product.code, extension: 'png'}"
                :cornersSquareOptions="{ type: 'square', color: '#0e013c' }"
                                /></center>
                <!-- <div class="mt-xl-0 mt-5">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <h4>{{product.name}}</h4>
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
                        <div class="flex-shrink-0 mt-n2">
                            <div>
                                <QRCodeVue3
                                    :value="product.code"
                                    :key="product.code"
                                    :width="80"
                                    :height="80"
                                    :qrOptions="{ typeNumber: '0', mode: 'Byte', errorCorrectionLevel: 'Q' }"
                                    :imageOptions="{ hideBackgroundDots: true, imageSize: 0.4, margin: 0 }"
                                    :dotsOptions="{ type: 'square', color: '#05004d' }"
                                    :download="true"
                                    downloadButton="btn btn-light btn-sm"
                                    :downloadOptions="{ name: product.code, extension: 'png'}"
                                    :cornersSquareOptions="{ type: 'square', color: '#0e013c' }"
                                />
                              
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-3 col-sm-6">
                            <div class="p-2 border border-dashed rounded">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-2">
                                        <div class="avatar-title rounded bg-transparent text-success fs-24">
                                            <i class="ri-money-dollar-circle-fill"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-muted fs-11 mb-1">Price :</p>
                                        <h5 class="mb-0 fs-13">{{formatMoney(product.price)}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="p-2 border border-dashed rounded">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-2">
                                        <div class="avatar-title rounded bg-transparent text-success fs-24">
                                            <i class="ri-file-copy-2-fill"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-muted fs-11 mb-1">Orders :</p>
                                        <h5 class="mb-0 fs-13">{{product.quantities}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="p-2 border border-dashed rounded">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-2">
                                        <div class="avatar-title rounded bg-transparent text-success fs-24">
                                            <i class="ri-stack-fill"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-muted fs-11 mb-1">Stocks :</p>
                                        <h5 class="mb-0 fs-13">{{product.stock}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="p-2 border border-dashed rounded">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-2">
                                        <div class="avatar-title rounded bg-transparent text-success fs-24">
                                            <i class="ri-inbox-archive-fill"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-muted fs-11 mb-1">Revenue :</p>
                                        <h5 class="mb-0 fs-13">{{formatMoney(product.total)}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 text-muted">
                        <h5 class="fs-14">Description :</h5>
                        <p>{{product.information}}.</p>
                    </div>
                </div> -->
            </div>
        <!-- <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
            <b-button @click="create('ok')" variant="primary" :disabled="form.processing" block>Save</b-button>
        </template> -->
    </b-modal>
</template>
<script>
import VueBarcode from '@chenfengyuan/vue-barcode';
import QRCodeVue3 from "qrcode-vue3";
export default {
    components : { VueBarcode, QRCodeVue3 },
    data(){
        return {
            showModal: false,
            product: {
                category: ''
            },
        }
    }, 
    methods : {
        show(data) {
            this.product = data;
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
