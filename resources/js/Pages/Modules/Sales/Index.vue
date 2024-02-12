<template>
    <Head title="Sales"/>
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="input-group mb-1">
                                <span class="input-group-text"> <i class="ri-search-line search-icon"></i></span>
                                <input type="text" v-model="keyword" placeholder="Search Code" class="form-control" autofocus>
                                <b-button @click="openSearch()" type="button" variant="primary">
                                    <i class="ri-search-eye-line align-bottom me-1"></i> Search Item
                                </b-button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <b-card no-body class="product">
                        <div class="card-header align-items-center d-flex" v-if="show == false">
                            <h5 class="card-title mb-0 flex-grow-1">CART ({{items.length}} items)</h5>
                            <div class="flex-shrink-0">
                                <!-- <div class="form-check form-switch form-switch-right form-switch-md">
                                    <label for="ribbons01-showcode" class="form-label text-muted">Show Sales</label>
                                    <input class="form-check-input code-switcher" type="checkbox" v-model="show" id="ribbons01-showcode">
                                </div> -->
                            </div>
                        </div>
                        <div class="card-header align-items-center d-flex" v-else>
                            <h5 class="card-title mb-0 flex-grow-1">List Sales</h5>
                            <div class="flex-shrink-0">
                                <div class="form-check form-switch form-switch-right form-switch-md">
                                    <label for="ribbons01-showcode" class="form-label text-muted">Show Sales</label>
                                    <input class="form-check-input code-switcher" type="checkbox" v-model="show" id="ribbons01-showcode">
                                </div>
                            </div>
                        </div>
                        <b-card-body class="card ribbon-box border shadow-none mb-lg-0" style="height: calc(100vh - 340px); overflow: auto;">
                            <div class="table-responsive" v-if="show == false">
                                <table class="table table-bordered align-middle">
                                    <thead class="table-light fs-11">
                                        <tr>
                                            <th class="text-center" width="5%">#</th>
                                            <th width="39%">Items</th>
                                            <th class="text-center" width="12%">Quantity</th>
                                            <th class="text-center" width="13%">Price</th>
                                            <th class="text-center" width="13%">Discount</th>
                                            <th class="text-center" width="13%">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="product  align-items-center">
                                        <tr class="fs-12" v-for="(list, index) in items" v-bind:key="'a-'+index">
                                            <td class="text-center align-middle">
                                                <button @click="removeItem(index)" class="btn btn-soft-danger edit-list btn-sm" type="button">
                                                    <div class="btn-content"><i class="ri-delete-bin-5-line align-bottom"></i></div>
                                                </button>
                                            </td>
                                            <td>
                                                <h6 class="mb-0">{{list.name}} - <span :class="list.type == 'Package' ? 'text-danger' : ''">{{ list.brand }}</span></h6>
                                                <p class="text-muted mb-0">{{list.code}}</p>
                                            </td>
                                            <td class="text-center">
                                                <div class="input-step">
                                                    <button @click="minus(index)" type="button">–</button>
                                                    <input type="number" class="product-quantity" v-model="list.quantity" min="1" :max="list.stock" />
                                                    <button @click="plus(index)" type="button" class="plus">+</button>
                                                </div>
                                            </td>
                                            <td class="text-center">{{formatMoney(list.price) }}</td>
                                            <td class="text-center">{{checkDiscount(list.discount,list.price,index) }}</td>
                                            <td class="text-center">{{formatMoney(check(list.quantity,list.price,index))}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive" v-else>
                                <table class="table table-bordered align-middle">
                                    <thead class="table-light fs-11">
                                        <tr>
                                            <th class="text-center" width="15%">#</th>
                                            <th class="text-center" width="25%" >Customer</th>
                                            <th class="text-center" width="15%">Subtotal</th>
                                            <th class="text-center" width="15%">Discount</th>
                                            <th class="text-center" width="15%">Tax</th>
                                            <th class="text-center" width="15%">Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="product  align-items-center">
                                        <tr class="fs-12" v-for="(list, index) in lists" v-bind:key="'a-'+index">
                                            <td class="text-center">{{list.code}}</td>
                                            <td class="text-center">{{list.customer.name}}</td>
                                            <td class="text-center">{{formatMoney(list.subtotal) }}</td>
                                            <td class="text-center">{{formatMoney(list.discount) }}</td>
                                            <td class="text-center">{{formatMoney(list.tax)}}</td>
                                            <td class="text-center">{{formatMoney(list.total)}}</td>
                                            <td  class="text-center">
                                                <b-button @click="openView(list)" variant="soft-primary" v-b-tooltip.hover title="View Product" size="sm" class="edit-list me-1 w-xs">View</b-button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <Pagination class="ms-2 me-2" v-if="meta" @fetch="fetch" :lists="lists.length" :links="links" :pagination="meta" />
                            </div>
                        </b-card-body>
                    </b-card>
                </div>
            </div>
        </div>
        <div class="col-md-4" >
            <div class="card">
                <div class="card-header border-bottom-dashed">
                    <h5 class="card-title mb-0">Order Summary</h5>
                </div>
                <div class="card-header bg-light-subtle border-bottom-dashed">
                    <div class="row g-2">
                        <div class="col-md-12 ">
                            <form class="app-search d-none d-md-block p-0 mb-2">
                                <div class="position-relative">
                                    <input type="text" class="form-control" placeholder="Search Customer" autocomplete="off" id="search-options1" />
                                    <span class="mdi mdi-magnify search-widget-icon"></span>
                                    <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none" id="search-close-options1"></span>
                                </div>
                                <div class="dropdown-menu dropdown-menu-lg" id="search-dropdown1">
                                    <SimpleBar data-simplebar>
                                        <div class="notification-list" v-if="names.length > 0">
                                            <b-link @click="select(list)"
                                                class="d-flex dropdown-item notify-item py-2"
                                                v-for="(list, index) of names" :key="index">
                                                <div class="flex-1">
                                                    <h6 class="m-0">{{list.name}}</h6>
                                                </div>
                                            </b-link>
                                        </div>
                                        <div class="notification-list" v-else>
                                            <div class="d-grid gap-2">
                                                <button class="btn btn-primary btn-sm" @click="newName()"
                                                    type="button" block="">
                                                    <div class="btn-content">Add name</div>
                                                </button>
                                            </div>
                                        </div>
                                    </SimpleBar>
                                </div>
                            </form>
                            <!-- <multiselect v-model="customer" id="ajax" label="name" track-by="id"
                                placeholder="Select Customer" open-direction="bottom" :options="customers"
                                :allow-empty="false"
                                :show-labels="false">
                            </multiselect>  -->
                        </div>
                         <div class="col-md-12 mt-2">
                            <input type="text" class="form-control text-primary fw-bold" v-model="customer.name" readonly>
                        </div>
                        <div class="col-md-12 mt-2">
                            <multiselect v-model="discount" id="ajax" label="name" track-by="id"
                                placeholder="Select Discount" open-direction="bottom" :options="discount_lists"
                                :allow-empty="false"
                                :show-labels="false">
                            </multiselect> 
                        </div>
                        <div class="col-md-6 mt-2">
                            <multiselect v-model="payment" id="ajax" label="name" track-by="id"
                                placeholder="Select Payment" open-direction="bottom" :options="payments"
                                :allow-empty="false"
                                :show-labels="false">
                            </multiselect> 
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="form-group">
                                <input type="text" class="form-control" v-model="cash" placeholder="Enter Cash Amount">
                            </div>
                        </div>
                    </div>
                </div>

               
             
                <div class="card-body" style="height: calc(100vh - 460px); overflow: auto;">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <td>Change :</td>
                                    <td class="text-end" id="cart-subtotal">{{formatMoney(change)}}</td>
                                </tr>
                                <tr>
                                    <td>Non-vat:</td>
                                    <td class="text-end" id="cart-subtotal">{{formatMoney(subtotal - tax)}}</td>
                                </tr>
                                  <tr>
                                    <td>Vat:</td>
                                    <td class="text-end" id="cart-subtotal">{{formatMoney(tax)}}</td>
                                </tr>
                                <tr>
                                    <td>Discount : </td>
                                    <td class="text-end" id="cart-discount">{{formatMoney(discounted)}}</td>
                                </tr>
                                <!-- <tr>
                                    <td>Estimated Tax (12%) : </td>
                                    <td class="text-end" id="cart-tax">{{formatMoney(tax)}}</td>
                                </tr> -->
                                <tr class="table-active">
                                    <th class="fs-14">Total :</th>
                                    <td class="text-end fs-14">
                                        <span class="fw-semibold" id="cart-total">{{formatMoney(total)}}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-grid gap-2 mt-4">
                        <button  @click="create('ok')" class="btn btn-primary" type="button">Proceed</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <Confirm @clear="clearForm" ref="confirm"/>
    <Nothing ref="nothing"/>
    <Search :categories="categories" @add="addItem" ref="search"/>
    <View ref="view"/>
    <New ref="new"/>
</template>
<script>
import New from './New.vue';
import { SimpleBar } from "simplebar-vue3";
import Confirm from './Confirm.vue';
import Search from './Search.vue';
import Nothing from './Nothing.vue';
import View from './View.vue';
import Multiselect from '@suadelabs/vue3-multiselect';
import Pagination from "@/Shared/Components/Pagination.vue";
export default {
    components : { Pagination,Multiselect, Nothing, Search, Confirm, View, SimpleBar, New },
    props: ['categories','suppliers','units','dropdowns','customers','discounts'],
    data() {
        return {
            items: [],
            keyword: '',
            value: 1,
            form: {},
            customer: '',
            payment: '',
            discount: this.discounts[0],
            discounted : 0,
            show: false,
            lists: [],
            meta: {},
            links: {},
            cash: '',
            names: [],
            name: '',
            status: ''
        };
    },
    created(){
        this.fetchLists();
    },
     mounted() {
        this.isCustomDropdown();
    },
    watch: {
        keyword(newVal){
            this.checkSearchStr(newVal);
        },
        discount(newVal){
            if(newVal.subtype_id == 18){
                this.calculatePercent(newVal.value);
            }else{
                this.discounted = newVal.value;
            }
        },
        data: {
            deep: true,
            handler(val = null) {
                if(val != null && val !== ''){
                    if(this.status == 'name'){
                        this.customer = val.data;
                    }else{

                    }
                }
            },
        },
    },

    computed: {
        subtotal() {
            return this.items.reduce((total, item) => total + item.total, 0);
        },
        tax() {
            return this.subtotal * 0.12;
        },
        total() {
            // return this.subtotal + this.tax - this.discounted;
            return (this.subtotal-this.tax) + this.tax - this.discounted;
        },
        payments : function() {
            let p =  this.dropdowns.filter(x => x.classification == 'Payment');
            this.payment = p[0];
            return p;
        },
        discount_lists(){
            // return this.discounts.filter(x => x.based_id == 12).filter(x => x.type_id == 15);
            return this.discounts.filter(x => x.is_active == 1);
        },
        change(){
            if(this.cash > this.total){
                return this.cash - this.total;
            }else{
                return 0;
            }
        },
         data() {
            return this.$page.props.flash.data;
        },
    },
    methods: {
        create(){
            this.$refs.confirm.set(this.items,this.customer,this.payment,this.discount,this.subtotal,this.discounted,this.tax,this.total,this.cash,this.change);
        },
        checkSearchStr: _.debounce(function(string) {
            this.fetch();
        }, 300),
        fetch(page_url) {
            page_url = page_url || '/sales';
            axios.get(page_url, {
                params: {
                    keyword: (this.keyword) ? this.keyword : '',
                    options: 'cart'
                }
            })
            .then(response => {
                if(response.data.data.length != 0){
                    if( response.data.data.stock <= 0){
                        this.$refs.nothing.show(response.data.data);
                    }else{
                        const itemCode = response.data.data.code;
                        if (!this.itemExists(itemCode)) {
                            response.data.data.quantity = 1;
                            this.items.unshift(response.data.data);
                        }
                    }
                    this.keyword = '';
                }
            })
            .catch(err => console.log(err));
        },
        fetchLists(page_url) {
            page_url = page_url || '/sales';
            axios.get(page_url, {
                params: {
                    keyword: (this.keyword) ? this.keyword : '',
                    options: 'lists',
                    category:  (this.category) ? this.category : '',
                }
            })
            .then(response => {
                this.lists = response.data.data;
                this.meta = response.data.meta;
                this.links = response.data.links;
            })
            .catch(err => console.log(err));
        },
        itemExists(itemCode) {
            return this.items.some(item => item.code === itemCode);
        },
        formatMoney(value) {
            let val = (value/1).toFixed(2).replace(',', '.')
            return '₱'+val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        },
        plus(index){
            if(this.items[index].quantity < this.items[index].stock){
                this.items[index].quantity++;
            }
        },
        minus(index){
            if(this.items[index].quantity > 1){
                this.items[index].quantity--;
            }
        },
        removeItem(index){
            if (window.confirm('Are you sure you want to remove this item?')) {
                this.items.splice(index, 1);
            }
        },
        check(quantity,price,index){
            let dis = (this.items[index].discounted) ? this.items[index].discounted : 0;
            this.items[index].total = (quantity * price) - dis;
            return this.items[index].total;
        },
        calculatePercent(val){
            let percent = val/100
            this.discounted = this.subtotal * percent;
        },
        hide(){
            this.customer = '';
            this.items = [];
        },
        openSearch(){
            this.$refs.search.show();
        },
        addItem(item){
            const itemCode = item.code;
            if (!this.itemExists(itemCode)) {
                item.quantity = 1;
                this.items.unshift(item);
            }
        },
        clearForm(){
            this.fetchLists();
            this.items = [];
            this.customer = '';
        },
        openView(data){
            this.$refs.view.show(data);
        },
        checkDiscount(data,price,index){
            let d = 0;
            if(data == ''){
                d = 0;
            }else{
                if(data.discount.subtype.name == 'Percentage'){
                    d = (data.discount.value/100)*price;
                }else{
                    d = data.discount.value;
                }
            }
            this.items[index].discounted = d;
            return this.formatMoney(d);
        },
         select(data){
            this.customer = data;
        },
        newName(){
            this.status = 'name';
            this.$refs.new.show(this.name);
        },
        checkSearchStr1: _.debounce(function(string) {
            this.name = string;
            this.fetchNames();
        }, 300),
        fetchNames(page_url) {
            page_url = page_url || '/customers';
            axios.get(page_url, {
                params: {
                    name: this.name,
                    options: 'names',
                }
            })
            .then(response => {
                if (response) {
                    this.names = response.data.data;
                }
            })
            .catch(err => console.log(err));
        },
        isCustomDropdown() {
            var searchOptions = document.getElementById("search-close-options1");
            var dropdown = document.getElementById("search-dropdown1");
            var searchInput = document.getElementById("search-options1");

            searchInput.addEventListener("focus", () => {
                var inputLength = searchInput.value.length;
                if (inputLength > 0) {
                    dropdown.classList.add("show");
                    searchOptions.classList.remove("d-none");
                } else {
                    dropdown.classList.remove("show");
                    searchOptions.classList.add("d-none");
                }
            });

            searchInput.addEventListener("keyup", () => {
                var inputLength = searchInput.value.length;
                if (inputLength > 0) {
                    dropdown.classList.add("show");
                    searchOptions.classList.remove("d-none");
                    this.checkSearchStr1(searchInput.value);
                } else {
                    dropdown.classList.remove("show");
                    searchOptions.classList.add("d-none");
                }
            });

            searchOptions.addEventListener("click", () => {
                searchInput.value = "";
                this.name = null;
                dropdown.classList.remove("show");
                searchOptions.classList.add("d-none");
            });

            document.body.addEventListener("click", (e) => {
                if (e.target.getAttribute("id") !== "search-options1") {
                    dropdown.classList.remove("show");
                    searchOptions.classList.add("d-none");
                }
            });
        },
    }
}
</script>
<style>
.multiselect__single {
    font-size: 12px;
}
.multiselect__tags {
    border: 0;
    min-height: 37px;
    height: 37px;
} 

.dropdown-menu-lg {
    width: 95%;
}
</style>