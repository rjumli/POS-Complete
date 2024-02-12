<template>
    <Head title="Product Management" />
    <b-row>
        <b-col xl="12">
            <div class=" d-flex align-items-center">
                <h3 class="flex-grow-1 mb-n3">Products Management</h3>
                <div class="flex-shrink-0">
                    <div class="input-group mb-1">
                        <span class="input-group-text"> <i class="ri-search-line search-icon"></i></span>
                        <input type="text" v-model="keyword" placeholder="Search Name" class="form-control" style="width: 25%;">
                        <select v-model="category" @change="fetch()" class="form-select" id="inputGroupSelect02">
                            <option :value="null" selected>Select Category</option>
                            <option :value="list.id" v-for="list in categories" v-bind:key="list.id">{{list.name}}</option>
                        </select>
                        <select v-model="is_available" @change="fetch()" class="form-select" id="inputGroupSelect02">
                            <option :value="null" selected>All</option>
                            <option :value="false" selected>Available</option>
                            <option :value="true" selected>Not Available</option>
                        </select>
                        <b-button @click="openCreate()" type="button" variant="primary">
                            <i class="ri-add-circle-fill align-bottom me-1"></i> Add Product
                        </b-button>
                    </div>
                </div>
            </div>
            <hr class="text-muted"/>
        </b-col>
        <b-col xl="12">
            <div class="table-responsive">
                <table class="table table-nowrap table-bordered align-middle mb-0">
                    <thead class="bg-primary">
                        <tr class="fs-13 text-light">
                            <th style="width: 2%;"></th>
                            <th style="width: 12%;" class="text-center">Code</th>
                            <th style="width: 21%;" class="text-center">Name</th>
                            <th style="width: 13%;" class="text-center">Description</th>
                            <th style="width: 14%;" class="text-center">Brand</th>
                            <th style="width: 14%;" class="text-center">Unit</th>
                            <th style="width: 13%;" class="text-center">Category</th>
                            <th style="width: 7%;" class="text-center">Stock</th>
                            <th style="width: 7%;" class="text-center">Discount</th>
                            <th style="width: 9%;" class="text-center">Price</th>
                            <th style="width: 7%;" class="text-center">Status</th>
                            <th style="width: 7%;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="fs-12" v-for="(list,index) in lists" v-bind:key="index">
                            <td><b-button @click="openView(list)" variant="soft-primary" v-b-tooltip.hover title="QR Code" size="sm" class="edit-list"><i class="ri-qr-code-fill align-bottom"></i> </b-button></td>
                            <td class="text-center"> {{list.code}}</td>
                            <td class="text-center">
                                <h5 class="fs-12 mb-0">{{list.name}}</h5>
                            </td>
                            <td class="text-center"> {{list.description}}</td>
                            <td class="text-center"> {{list.brand}}</td>
                             <td class="text-center"> {{list.size}} {{list.unit.name}}</td>
                            <td class="text-center"> {{list.category.name}}</td>
                            <td class="text-center"> {{list.stock}}</td>
                            <td class="text-center"> -</td>
                            <td class="text-center"> {{formatMoney(list.price)}}</td>
                            <td class="text-center"> 
                                <span v-if="list.is_active" class="badge bg-success">Available</span>
                                <span v-else class="badge bg-danger">Not Available</span>
                            </td>
                            <td class="text-center">
                                <!-- <b-button @click="openView(list)" variant="soft-primary" v-b-tooltip.hover title="View Product" size="sm" class="edit-list me-1 w-xs">View</b-button> -->
                                <!-- <b-button @click="edit(list)" variant="soft-primary" v-b-tooltip.hover title="Edit Product" size="sm" class="edit-list me-1 w-xs">Edit</b-button> -->
                                <!-- <b-button @click="openPrice(list)" variant="dark" v-b-tooltip.hover title="Update Price" size="sm" class="edit-list me-1"><i class="ri-hand-coin-line"></i></b-button> -->
                                <b-button @click="openStock(list)" variant="success" v-b-tooltip.hover title="Stock Adjustment" size="sm" class="edit-list me-1"><i class="ri-shopping-cart-2-fill"></i></b-button>
                                <b-button @click="openStatus(list)" variant="danger" v-b-tooltip.hover title="Update Status" size="sm" class="edit-list me-1"><i class="bx bxs-hand"></i></b-button>
                                <b-button @click="openOrder(list)" variant="info" v-b-tooltip.hover title="View Orders" size="sm" class="edit-list me-1"><i class="ri-eye-fill"></i></b-button>
                                <b-button @click="openUpdate(list)" variant="warning" v-b-tooltip.hover title="Update Product" size="sm" class="edit-list"><i class="ri-edit-2-fill"></i></b-button>
                            
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Pagination class="ms-2 me-2" v-if="meta" @fetch="fetch" :lists="lists.length" :links="links" :pagination="meta" />
            </div>
        </b-col>
    </b-row>
    <Price ref="price"/>
    <Stock ref="stock"/>
    <View ref="view"/>
    <Order ref="order"/>
    <Status ref="status"/>
    <Create :percentages="percentages" :categories="categories" :suppliers="suppliers" :units="units" :dropdowns="dropdowns" @message="fetch()" ref="create"/>
</template>
<script>
import Price from './Price.vue';
import Stock from './Stock.vue';
import Status from './Status.vue';
import Order from './Order.vue';
import View from './View.vue';
import Create from './Create.vue';
import PageHeader from "@/Shared/Components/PageHeader.vue";
import Pagination from "@/Shared/Components/Pagination.vue";
export default {
    components: { PageHeader, Pagination, Create, View, Order, Status, Stock, Price },
    props: ['categories','suppliers','units','dropdowns','percentages'],
    data() {
        return {
            title: "Products Management",
            items: [{text: "View",href: "/"},{ text: "Dasboard",active: true}, ],
            keyword: null,
            category: null,
            is_available: null,
            lists: [],
            meta: {},
            links: {},
        };
    },
    watch: {
        keyword(newVal){
            this.checkSearchStr(newVal);
        },
        data: {
            deep: true,
            handler(val = null) {
                if(val != null && val !== ''){
                   this.fetch();
                }
            },
        },
    },
    computed: {
        data() {
            return this.$page.props.flash.data;
        },
    },
    created(){
        this.fetch();
    },
    methods: {
        checkSearchStr: _.debounce(function(string) {
            this.fetch();
        }, 300),
        fetch(page_url) {
            page_url = page_url || '/products';
            axios.get(page_url, {
                params: {
                    keyword: (this.keyword) ? this.keyword : '',
                    is_available: (this.is_available) ? this.is_available : '',
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
        openCreate(){
            this.$refs.create.show();
        },
        openUpdate(data){
            this.$refs.create.edit(data);
        },
        openView(data){
            this.$refs.view.show(data);
        },  
        openStock(data){
            this.$refs.stock.set(data);
        },  
        openStatus(data){
            this.$refs.status.set(data);
        },  
        openOrder(data){
            this.$refs.order.show(data);
        },
        openPrice(data){
            this.$refs.price.set(data);
        },
        formatMoney(value) {
            let val = (value/1).toFixed(2).replace(',', '.')
            return '₱'+val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        },
    }
}
</script>
