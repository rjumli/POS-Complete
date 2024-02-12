<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-0 align-items-center d-flex">
                    <h5 class="card-title mb-0 flex-grow-1">Inventory Report</h5>
                    <div class="hstack gap-1">
                        <b-col sm="auto">
                            <div class="input-group">
                                <select v-model="sort" @change="fetch()" class="form-select" id="inputGroupSelect02">
                                    <option value="created_at" selected>Created At</option>
                                    <option value="updated_at" selected>Updated At</option>
                                </select>
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
                    <div class="table-responsive mt-1" v-if="lists.length > 0">
                        <table class="table table-bordered table-centered align-middle table-nowrap mb-0">
                            <thead class="text-muted table-light">
                                <tr>
                                    <th scope="col" class="text-center">Code</th>
                                    <th scope="col" class="text-center">Name</th>
                                    <th scope="col" class="text-center">Price</th>
                                    <th scope="col" class="text-center">Stock</th>
                                    <th scope="col" class="text-center">Created At</th>
                                    <th scope="col" class="text-center">Updated At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(list,index) in lists" v-bind:key="index">
                                    <td class="text-center">{{list.code}}</td>
                                    <td class="text-center">{{list.name}}</td>
                                    <td class="text-center">{{formatMoney(list.price)}}</td>
                                    <td class="text-center">{{list.stock}}</td>
                                    <td class="text-center">{{list.created_at}}</td>
                                    <td class="text-center">{{list.updated_at}}</td>
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
            sort: 'created_at'
        }
    },
    created(){
        this.fetch();
    },
    methods: {
        fetch(page_url){
            page_url = page_url || '/reports/inventory';
            axios.get(page_url,{
                params : {
                    date : this.date,
                    subtype: 'lists',
                    sort: (this.sort == 'Created At') ? 'created_at' : 'updated_at'
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
            window.open(this.currentUrl + '/reports/'+this.date+'/edit');
        }
    }
}
</script>