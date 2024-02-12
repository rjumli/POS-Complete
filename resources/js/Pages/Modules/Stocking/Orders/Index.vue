<template>
    <Head title="Order Management" />
    <!-- <PageHeader :title="title" :items="items" /> -->

    <b-row>
        <b-col xl="12">
            <!-- <b-card no-body>
                <b-card-body style="height: calc(100vh - 284px)"> -->
            <div class=" d-flex align-items-center">
                <h3 class="flex-grow-1 mb-n3">Purchased Order Management</h3>
                <div class="flex-shrink-0">
                    <div class="input-group mb-1">
                        <span class="input-group-text"> <i class="ri-search-line search-icon"></i></span>
                        <input type="text" v-model="keyword" placeholder="Search Name" class="form-control" style="width: 25%;">
                        <select v-model="category" @change="fetch()" class="form-select" id="inputGroupSelect02">
                            <option :value="null" selected>Select Category</option>
                            <option :value="list.id" v-for="list in categories" v-bind:key="list.id">{{list.name}}</option>
                        </select>
                        <b-button @click="openCreate()" type="button" variant="primary">
                            <i class="ri-add-circle-fill align-bottom me-1"></i> New Order
                        </b-button>
                    </div>
                </div>
            </div>
                <!-- </b-card-body>
            </b-card> -->
            <hr class="text-muted"/>
        </b-col>

        <b-col xl="12">
            <div class="table-responsive">
                <table class="table table-nowrap table-bordered align-middle mb-0">
                    <thead class="bg-primary">
                        <tr class="fs-13 text-light">
                            <th style="width: 13%;" class="text-center">Code</th>
                            <th style="width: 17%;" class="text-center">Supplier</th>
                            <th style="width: 17%;" class="text-center">Products</th>
                            <th style="width: 14%;" class="text-center">Total</th>
                            <th style="width: 14%;" class="text-center">Status</th>
                            <th style="width: 15%;" class="text-center">Created At</th>
                            <th style="width: 10%;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="fs-12" v-for="(list,index) in lists" v-bind:key="index">
                            <td class="text-center"> {{list.code}}</td>
                            <td class="text-center">
                                <h5 class="fs-13 mb-0 text-dark">{{list.supplier.supplier.name}} - {{list.supplier.name}}</h5>
                            </td>
                            <td class="text-center"> {{list.lists.length}}</td>
                            <td class="text-center"> {{formatMoney(list.total)}}</td>
                            <td class="text-center"> 
                                <span :class="'badge '+list.status.color">{{list.status.name}}</span>
                            </td>
                            <td class="text-center"> {{list.created_at}}</td>
                            <td class="text-center">
                                <b-button @click="openView(list,index)" variant="soft-primary" v-b-tooltip.hover title="View Product" size="sm" class="edit-list me-1 w-xs">View</b-button>
                                <!-- <b-button @click="edit(list)" variant="soft-primary" v-b-tooltip.hover title="Edit Product" size="sm" class="edit-list me-1 w-xs">Edit</b-button> -->
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Pagination class="ms-2 me-2" v-if="meta" @fetch="fetch" :lists="lists.length" :links="links" :pagination="meta" />
            </div>
        </b-col>
    </b-row>
    <View :dropdowns="dropdowns" ref="view"/>
    <Create :suppliers="suppliers" :products="products" :units="units" :dropdowns="dropdowns" @message="fetch()" ref="create"/>
</template>
<script>
import View from './View.vue';
import Create from './Create.vue';
import PageHeader from "@/Shared/Components/PageHeader.vue";
import Pagination from "@/Shared/Components/Pagination.vue";
export default {
    components: { PageHeader, Pagination, Create, View },
    props: ['categories','suppliers','units','dropdowns','products'],
    data() {
        return {
            title: "Products Management",
            items: [{text: "View",href: "/"},{ text: "Dasboard",active: true}, ],
            keyword: null,
            category: null,
            lists: [],
            meta: {},
            links: {},
            index: ''
        };
    },
    watch : {
        data: {
            deep: true,
            handler(val = null) {
                if(val != null && val !== ''){
                    this.lists[this.index]= val.data;
                    this.$refs.view.update(val.data);
                }
            },
        },
        keyword(newVal){
            this.checkSearchStr(newVal);
        }
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
            page_url = page_url || '/orders';
            axios.get(page_url, {
                params: {
                    keyword: (this.keyword) ? this.keyword : '',
                    options: 'lists',
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
        openView(data,index){
            this.index = index;
            this.$refs.view.show(data);
        },  
        formatMoney(value) {
            let val = (value/1).toFixed(2).replace(',', '.')
            return '₱'+val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        },
    }
}
</script>
