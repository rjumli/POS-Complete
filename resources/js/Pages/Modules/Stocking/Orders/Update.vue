<template>
    <b-modal v-model="showModal" title="Order Item"  header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <b-form class="customform mb-2">
            <div class="row customerform">
                <div class="col-md-12">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <h5>{{product.product.name}}</h5>
                            <div class="hstack gap-3 flex-wrap">
                                <div><a class="text-primary d-block">{{product.product.brand}}</a></div>
                                <div class="vr"></div>
                                <div class="text-muted">Quantity : <span class="text-body fw-medium">{{product.quantity}}</span></div>
                                <div class="vr"></div>
                                <div class="text-muted">Ordered At : <span class="text-body fw-medium">{{product.created_at}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12"><hr class="text-muted"/></div>
                <div class="col-md-12">
                    <label>Status: <span v-if="form.errors" v-text="form.errors.status_id" class="haveerror"></span></label>
                    <multiselect v-model="status" id="ajax" label="name" track-by="id"
                        placeholder="Select " open-direction="bottom" :options="statuses"
                        :allow-empty="false"
                        :show-labels="false">
                    </multiselect> 
                </div>
                <div class="col-md-6 mt-3" v-if="status.name == 'Received' || status.name == 'Incomplete'">
                    <div class="form-group">
                        <label>Quantity:<span v-if="form.errors" v-text="form.errors.quantity" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="quantity">
                    </div>
                </div>
                <div class="col-md-6 mt-3" v-if="status.name == 'Received' || status.name == 'Incomplete'">
                    <div class="form-group">
                        <label>Price:<span v-if="form.errors" v-text="form.errors.price" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="price">
                        <!-- <Amount class="text-center" @amount="handleAmount" :size="'form-control'" ref="testing" :readonly="false"/> -->
                    </div>
                </div>
            </div>
        </b-form>
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
            <b-button @click="create('ok')" variant="primary" :disabled="form.processing" block>Save</b-button>
        </template>
    </b-modal>
</template>
<script>
import Amount from "@/Shared/Components/Amount.vue";
import Multiselect from '@suadelabs/vue3-multiselect';
export default {
    components: { Multiselect, Amount },
    props: ['dropdowns'],
    data(){
        return {
            showModal: false,
            product: { product: {}},
            status: '',
            price: '',
            quantity: '',
            form: {},
            id: ''
        }
    },
    computed: {
        statuses : function() {
            return this.dropdowns.filter(x => x.classification == 'Orderlist').filter(x => x.name != 'Pending');
        },
    },
    methods : {
        show(data,id) {
            this.id = id;
            this.product = data;
            this.quantity = this.product.quantity;
            this.price = this.product.price;
            this.showModal = true;
        },
        handleAmount(val){
            this.price = this.product.price.replace('₱ ', '').replace(/,/g, '');
        },
        create(){
            this.form = this.$inertia.form({
                id: this.id,
                orderlist_id: (this.product) ? this.product.id : '', 
                status_id: (this.status) ? this.status.id : '', 
                price: this.price,
                quantity: this.quantity
            })

            this.form.post('/receives',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.hide();
                },
            });
        },
        hide(){
            this.status = '';
            this.quantity = '';
            this.price = '';
            this.product = { product: {}};
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
