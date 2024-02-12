<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-0 align-items-center d-flex">
                    <h5 class="card-title mb-0 flex-grow-1">Sales Report</h5>
                    <div class="hstack gap-1">
                        <b-col sm="auto">
                            <div class="input-group">
                                <flat-pickr v-model="date" :config="config" class="form-control border-0 dash-filter-picker shadow"></flat-pickr>
                                <div style="cursor: pointer;" @click="fetch()" class="input-group-text bg-primary border-primary text-white">
                                    <i class="ri-calendar-2-line"></i>
                                </div>
                            </div>
                        </b-col>
                        <div class="col-auto">
                            <b-button @click="print()" type="button" variant="success">
                            <i class=" ri-printer-fill  align-middle"></i>
                            </b-button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="p-2 mt-n4 mb-3 border border-dashed rounded">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm me-2" style="cursor: pointer;">
                                <div class="avatar-title rounded bg-transparent text-primary fs-24"><i class="ri-hand-coin-fill "></i></div>
                            </div>
                            <div class="flex-grow-1">
                                <p class="text-muted fs-11 mb-0">Total Sales :</p>
                                <h5 class="fs-16 text-success mb-0">{{calculateTotal()}}</h5>
                            </div>
                            <!-- <div class="text-end">
                                <button class="btn btn-light btn-md btn-label waves-effect waves-light" type="button">
                                    <div class="btn-content"><i class="bx bxs-webcam label-icon align-middle fs-16 me-2"></i> test</div>
                                </button>
                            </div> -->
                        </div>
                    </div>
                    <div class="table-responsive mt-1" v-if="lists.length > 0">
                        <table class="table table-bordered table-centered align-middle table-nowrap mb-0">
                            <thead class="text-muted table-light">
                                <tr>
                                    <th scope="col" class="text-center">Customer</th>
                                    <th scope="col" class="text-center">Type</th>
                                    <th scope="col" class="text-center">Product</th>
                                    <th scope="col" class="text-center">Qnty</th>
                                    <th scope="col" class="text-center">Price</th>
                                    <th scope="col" class="text-center">Total</th>
                                    <th scope="col" class="text-center">Cashier</th>
                                    <th scope="col" class="text-center">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(list,index) in lists" v-bind:key="index">
                                    <td class="text-center">{{list.customer}}</td>
                                    <td class="text-center">{{list.type}}</td>
                                    <td class="text-center">{{list.product}}</td>
                                    <td class="text-center">{{list.quantity}}</td>
                                    <td class="text-center">{{formatMoney(list.price)}}</td>
                                    <td class="text-center">{{formatMoney(list.total)}}</td>
                                    <td class="text-center">{{list.cashier}}</td>
                                    <td class="text-center">{{list.date}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div v-else class="alert alert-warning" role="alert"><strong>No report found, </strong>for this range of date.</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";
export default {
    props: ['d'],
    components: { flatPickr },
    data(){
        return {
            currentUrl: window.location.origin,
            date: this.d,
            lists: [],
            config: {
                mode: "range",
            },
        }
    },
    created(){
        this.fetch();
    },
    methods: {
        fetch(page_url){
            page_url = page_url || '/reports/sales';
            axios.get(page_url,{
                params : {
                    date : this.date,
                    subtype: 'lists'
                }
            })
            .then(response => {
                if(response){
                    this.lists = response.data;                    
                }
            })
            .catch(err => console.log(err));
        },
        formatMoney(value) {
            let val = (value/1).toFixed(2).replace(',', '.')
            return '₱'+val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        },
        print(){
            window.open(this.currentUrl + '/reports/'+this.date+'/sales');
        },
        calculateTotal() {
            return this.formatMoney(this.lists.reduce((total, item) => total + parseInt(item.total), 0));
        },
    }
}
</script>