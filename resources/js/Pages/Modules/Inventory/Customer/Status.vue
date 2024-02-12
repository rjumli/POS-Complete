<template>
    <b-modal v-model="showModal" title="Update Status" header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <b-form class="customform" v-if="proceed == false">
            <div class="col-md-12 mt-1">
                <div class="form-group">
                    <label>Quantity: <span v-if="form.errors" v-text="form.errors.quantity" class="haveerror"></span></label>
                    <input type="number" class="form-control" :max="selected.quantity" min="1" v-model="quantity" :readonly="(selected.quantity == 1) ? true : false">
                </div>
            </div>
            <div class="col-md-12 mt-1">
                <label>Reason: <span v-if="form.errors" v-text="form.errors.reason_id" class="haveerror"></span></label>
                <multiselect v-model="reason" id="ajax" label="name" track-by="id"
                    placeholder="Select" open-direction="bottom" :options="reasons"
                    :allow-empty="false"
                    :show-labels="false">
                </multiselect> 
            </div>
            <div class="col-md-12 mt-4">
                <div class="form-group">
                    <textarea v-model="info" class="form-control" maxlength="225" rows="1" placeholder="Information"></textarea>
                </div>
            </div>
        </b-form>
        <div class="table-responsive" v-if="proceed == true">
            <table class="table mb-0" v-if="selected.quantity == 1 && selected.sale.subtotal == selected.price*selected.quantity">
                <tbody>
                    <tr class="table-active">
                        <th class="fs-14">Total Amount to be Refunded:</th>
                        <td class="text-end fs-14">
                            <span class="fw-semibold" id="cart-total">{{formatMoney(selected.sale.total)}}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table mb-0" v-else>
                <thead>
                    <tr>
                        <th></th>
                        <th class="text-center">Refunded</th>
                        <th class="text-center">Old</th>
                        <th class="text-center">New</th>
                    </tr>
                </thead>
                <tbody>
                      <tr>
                        <td>Subtotal</td>
                        <td class="text-center">{{formatMoney(refund_subtotal)}}</td>
                        <td class="text-center">{{formatMoney(selected.sale.subtotal)}}</td>
                        <td class="text-center text-success">{{formatMoney(subtotal)}}</td>
                    </tr>
                    <tr>
                        <td>Non-Vat</td>
                        <td class="text-center">{{formatMoney(refund_subtotal - refund_tax)}}</td>
                        <td class="text-center">{{formatMoney(selected.sale.subtotal - selected.sale.tax)}}</td>
                        <td class="text-center text-success">{{formatMoney(subtotal-tax)}}</td>
                    </tr>
                    
                     <tr>
                        <td>Vat</td>
                        <td class="text-center">{{formatMoney(refund_tax)}}</td>
                        <td class="text-center">{{formatMoney(selected.sale.tax)}}</td>
                        <td class="text-center text-success">{{formatMoney(tax)}}</td>
                    </tr>
                    <tr>
                        <td>Discount</td>
                        <td class="text-center">{{formatMoney(refund_discount)}}</td>
                        <td class="text-center">{{formatMoney(selected.sale.discount)}}</td>
                        <td class="text-center text-success">{{formatMoney(discount)}}</td>
                    </tr>
                    <tr class="table-active">
                        <th class="fs-14">Total :</th>
                        <td class="text-center fs-14">
                            <span class="fw-semibold" id="cart-total">{{formatMoney(refund)}}</span>
                        </td>
                        <td class="text-center fs-14">
                            <span class="fw-semibold" id="cart-total">{{formatMoney(selected.sale.total)}}</span>
                        </td>
                        <td class="text-center fs-14 text-success">
                            <span class="fw-semibold" id="cart-total">{{formatMoney(selected.sale.total-refund)}}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <template v-slot:footer>
            <b-button @click="showModal = false" variant="light" block>Cancel</b-button>
            <b-button v-if="proceed == false && quantity != '' && reason != '' && info != ''" @click="proceed = true" variant="primary"  block>Proceed</b-button>
            <b-button v-if="proceed == true" @click="save('ok')" variant="primary"  block>Update</b-button>
        </template>
    </b-modal>
</template>

<script>
import Multiselect from '@suadelabs/vue3-multiselect';
export default {
    components : { Multiselect },
    props: ['dropdowns'],
    data() {
        return {
            currentUrl: window.location.origin,
            showModal: false,
            selected: {sale: {}},
            reason: '',
            quantity: 1,
            info: '',
            form: {},
            proceed: false,
            refund_subtotal : '',
            refund_discount : '',
            refund_tax : '',
            refund_total : '',
        }
    },
    computed: {
        reasons : function() {
            return this.dropdowns.filter(x => x.classification == 'Reason').filter(x => x.type == 'customer');
        },
        subtotal(){
            this.refund_subtotal = this.quantity*this.selected.price;
            return this.selected.sale.subtotal - (this.quantity*this.selected.price);
        },
        tax(){
            this.refund_tax = (this.quantity*this.selected.price)* 0.12;
            return this.selected.sale.tax - ((this.quantity*this.selected.price)* 0.12);
        },
        discount(){
            let v;
            if(this.selected.sale.discounted.subtype_id == 18){
                v = this.calculatePercent(this.selected.sale.discounted.value);
            }else{
                v = this.selected.sale.discounted.value;
            }
            this.refund_discount = v;
            return  (this.selected.sale.discount - v);
        },
        total() {
            return (this.subtotal * this.quantity) - this.selected.sale.total;
        },
        refund(){
            return this.refund_subtotal;
        }
    },
    methods: {
        set(data){
            this.selected = data;
            this.proceed = false;
            this.showModal = true;
        },
        save(){
            if(this.selected.sale.subtotal == this.selected.price*this.selected.quantity){
                this.form = this.$inertia.form({
                    status_id: 28,
                    id: this.selected.id,
                    total: this.selected.sale.total,
                    all: (this.selected.sale.subtotal == this.selected.price*this.selected.quantity) ? true : false, 
                    quantity: this.quantity,
                    reason: this.info,
                    reason_id: (this.reason) ? this.reason.id : '',
                });
            }else{
                this.form = this.$inertia.form({
                    status_id: 28,
                    id: this.selected.id,
                    total: this.refund,
                    all: (this.refund == this.selected.sale.total) ? true : false, 
                    quantity: this.quantity,
                    reason: this.info,
                    reason_id: (this.reason) ? this.reason.id : '',
                    sale_total: this.selected.sale.total-this.refund,
                    sale_discount: this.discount,
                    sale_tax: this.tax,
                    sale_subtotal: this.subtotal
                });
            }

            this.form.put('/customer/update',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.showModal = false;
                    this.$emit('message',true);
                }
            });
        },
        formatMoney(value) {
            let val = (value/1).toFixed(2).replace(',', '.')
            return '₱'+val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        },
         calculatePercent(val){
            let percent = val/100
            return this.subtotal * percent;
        },
    }
}
</script>
