<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-0 align-items-center d-flex">
                    <h5 class="card-title mb-0 flex-grow-1">Supplier Return Report</h5>
                    <div class="hstack gap-1">
                        <b-col sm="auto">
                            <div class="input-group">
                                <flat-pickr v-model="date" :config="config" class="form-control border-0 dash-filter-picker shadow"></flat-pickr>
                                <div style="cursor: pointer;" @click="fetchMine()" class="input-group-text bg-primary border-primary text-white">
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
                    <div class="table-responsive mt-1" v-if="lists.length > 0">
                        <table class="table table-bordered table-centered align-middle table-nowrap mb-0">
                            <thead class="text-muted table-light">
                                <tr>
                                    <th scope="col" class="text-center">Product</th>
                                    <th scope="col" class="text-center">Quantity</th>
                                    <th scope="col" class="text-center">Reason</th>
                                    <th scope="col" class="text-center">Total</th>
                                    <th scope="col" class="text-center">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(list,index) in lists" v-bind:key="index">
                                    <td class="text-center">{{list.product.name}}</td>
                                    <td class="text-center">{{list.quantity}}</td>
                                    <td class="text-center">{{list.reason}}</td>
                                    <td class="text-center">{{formatMoney(list.total)}}</td>
                                    <td class="text-center">{{list.created_at}}</td>
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
            page_url = page_url || '/reports/suppliers';
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
            window.open(this.currentUrl + '/reports/'+this.date+'/suppliers');
        }
    }
}
</script>