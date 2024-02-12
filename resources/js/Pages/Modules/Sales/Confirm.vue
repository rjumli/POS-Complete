<template>
    <b-modal v-model="showModal" title="Confirm" header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <div class="mt-0" v-if="Object.keys(errors).length === 0">
            <div class="table-responsive">
                <table class="table table-nowrap table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr class="fw-semibold text-center">
                            <th colspan="2">{{customer.name}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="50%"  class="text-center">Non-Vat</td>
                            <td width="50%" class="text-center"> {{formatMoney(subtotal-tax)}}</td>
                        </tr>
                        <tr>
                            <td width="50%"  class="text-center">Discount</td>
                            <td width="50%" class="text-center"> {{formatMoney(discounted)}}</td>
                        </tr>
                        <tr>
                            <td width="50%"  class="text-center">Vat</td>
                            <td width="50%" class="text-center"> {{formatMoney(tax)}}</td>
                        </tr>
                         <tr class="text-muted">
                            <td width="50%"  class="text-center">Cash</td>
                            <td width="50%" class="text-center"> {{formatMoney(cash)}}</td>
                        </tr>
                         <tr class="text-muted">
                            <td width="50%"  class="text-center">Change</td>
                            <td width="50%" class="text-center"> {{formatMoney(change)}}</td>
                        </tr>
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td width="50%"  class="text-center fw-semibold">Grand Total</td>
                            <td width="50%" class="text-center fw-semibold"> {{formatMoney(total)}}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
            <div class="mt-0" v-else>
            <p class="text-muted mb-2">Please check the following fields.</p>
        </div>
        <div class="live-preview">
            <ul class="list-group">
                <li class="list-group-item text-danger" v-for="(error,index) in errors" v-bind:key="index"><i class="mdi mdi-check-bold align-middle lh-1 me-2"></i> 
                    {{ error }} 
                </li>
            </ul>
        </div>
        <!-- Buttons Grid -->
        <div class="d-grid gap-2 mt-2" >
        <!-- <b-button @click="printReceipt" variant="light">Print</b-button> -->
        <b-button @click="printReceipt" class="btn-soft-dark waves-effect waves-light">Print Receipt</b-button>
        </div>
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
            <b-button @click="create('ok')" variant="primary" :disabled="form.processing" block>Save</b-button>
        </template>
    </b-modal>
</template>
<script>
import { createApp } from 'vue';
import Receipt from './Receipt.vue';
import VueBarcode from '@chenfengyuan/vue-barcode';
export default {
    components : {VueBarcode},
    data(){
        return {
            showModal: false,
            value: '',
            errors: [],
            form: {},
            customer: '',
            payment: '',
            discount: '',
            discounted: 0,
            tax: 0,
            subtotal: 0,
            total: 0,
            cash: 0,
            change: 0,
            lists: [],
            currentDate: ''
        }
    },
    methods : {
        set(lists,customer,payment,discount,subtotal,discounted,tax,total,cash,change) {
            this.lists = lists;
            this.customer = customer;
            this.payment = payment;
            this.discount = discount;
            this.subtotal = subtotal;
            this.discounted = discounted;
            this.tax = tax, 
            this.total = total;
            this.cash = cash;
            this.change = change;
            this.errors = [];
            this.showModal = true;
        },
        printReceipt() {
            const printWindow = window.open('', '_blank', 'width=600,height=400,resizable=no');
            printWindow.document.write('<html style="width:260px; margin-bottom: 200px"><head><title>Receipt</title></head><body>');

            // Your receipt content goes here
            
            const now = new Date();
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            this.currentDate = now.toLocaleDateString('en-US', options);

            // printWindow.document.write('<center><h3>POS 9 INVENTORY SYSTEM</h3></center>');
            printWindow.document.write(`
            <style>\
                body {\
                    font-size: 10px;\
                    font-family:Calibri;\
                }\
                table {\
                    font-size: 10px;\
                    font-family:Calibri;\
                }\
            </style>\
            <div style="text-align:center">\
            _________________________________________________\
            <br/>\
            POS & INVENTORY SYSTEM\
            <br/>\
            <span style="font-size: 9px;">SALES INVOINCE</span>\
            <br/>\
            <span style="float: left;">Date:</span> <span style="float: right; margin-right: 0;">` + this.currentDate + `</span>\
            <br/>\
            <span style="margin-top: 20px;">
            _________________________________________________</span>\
            </div>\
            <table style="width:100%">
                <thead>
                    <td>Qnty</td>
                    <td style="text-align: center;">Item</td>
                    <td style="text-align: right;">Price</td>
                </thead>
                <tbody>
                    ${this.lists.map(item => `
                    <tr>\
                        <td>`+item.quantity+`</td>\
                        <td style="text-align: center;">`+item.name+`</td>\
                        <td style="text-align: right;">`+this.formatMoney(item.price)+`</td>\
                    </tr>\
                    `).join('')}
                </tbody>
            </table>
            _________________________________________________\
            <div style="width: 50%; float: right;">
                <span style="float: left;">Non-Vat:</span> <span style="float: right; margin-right: 0;">` + this.formatMoney(this.subtotal-this.tax) + `</span>\
                <br/>\
                <span style="float: left;">Vat:</span> <span style="float: right; margin-right: 0;">` + this.formatMoney(this.tax) + `</span>\
                <br/>\
                <span style="float: left;">Discount:</span> <span style="float: right; margin-right: 0;">` + this.formatMoney(this.discounted) + `</span>\
                <br/>\
                <span style="float: left; font-weight: bold;">Total:</span> <span style="float: right; font-weight: bold; margin-right: 0;">` + this.formatMoney(this.total) + `</span>\
                <br/>\
                <br/>\
                <span style="float: left;">Cash:</span> <span style="float: right; margin-right: 0;">` + this.formatMoney(this.cash) + `</span>\
                <br/>\
                <span style="float: left;">Change:</span> <span style="float: right; margin-right: 0;">` + this.formatMoney(this.change) + `</span>\
                <br/>\
                <br/>\
                <span style="float: left;">Customer:</span> <span style="float: right; margin-right: 0;">` + this.customer.name + `</span>\
                <br/>\
                <span style="float: left;">Contact</span> <span style="float: right; margin-right: 0;">` + this.customer.contact + `</span>\
            </div>
             _________________________________________________\
            `);

            printWindow.document.write('</body></html>');
            printWindow.document.close();

            // Wait for the content to be rendered before printing
            printWindow.onload = () => {
            printWindow.print();
      };
        },
        create(){
            this.form = this.$inertia.form({
                customer_id: (this.customer) ? this.customer.id : '', 
                payment_id: (this.payment) ? this.payment.id : '', 
                discount_id: (this.discount) ? this.discount.id : '', 
                discount: this.discounted,
                tax: this.tax,
                subtotal: this.subtotal,
                total: this.total,
                cash: this.cash,
                change: this.change,
                status_id: 24,
                lists: this.lists
            })

            this.form.post('/sales',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.hide();
                    this.$emit('clear',true);
                },
            });
            
            // this.$inertia.post('/sales', this.value, {
            //     preserveScroll: true,
            //     forceFormData: true,
            //     onSuccess: (response) => {
            //         this.showModal = false;
            //         this.errors = [];
            //     },
            //     onError: () => {
            //         this.errors = this.$page.props.errors;
            //     }
            // });
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
   

    .receipt {
      max-width: 300px;
      margin: auto;
      padding: 10px;
      border: 1px solid #ccc;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .receipt-header {
      text-align: center;
      margin-bottom: 10px;
    }

    .receipt-items {
      margin-bottom: 10px;
    }

    .item {
      display: flex;
      justify-content: space-between;
      margin-bottom: 5px;
    }

    .receipt-total {
      font-weight: bold;
      margin-top: 10px;
    }

    .print-button {
      margin-top: 10px;
      text-align: center;
    }
  </style>
