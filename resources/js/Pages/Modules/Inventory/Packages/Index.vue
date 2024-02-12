<template>
    <Head title="Package Management" />
    <!-- <PageHeader :title="title" :items="items" /> -->

    <b-row>
        <b-col xl="12">
            <!-- <b-card no-body>
                <b-card-body style="height: calc(100vh - 284px)"> -->
            <div class=" d-flex align-items-center">
                <h3 class="flex-grow-1 mb-n3">Packages Management</h3>
                <div class="flex-shrink-0">
                    <div class="input-group mb-1">
                        <span class="input-group-text"> <i class="ri-search-line search-icon"></i></span>
                        <input type="text" v-model="keyword" placeholder="Search Name" class="form-control" style="width: 50%;">
                        
                        <b-button @click="openCreate()" type="button" variant="primary">
                            <i class="ri-add-circle-fill align-bottom me-1"></i> New Package
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
                            <th style="width: 15%;" class="text-center">Code</th>
                            <th style="width: 20%;" class="text-center">Name</th>
                            <th style="width: 15%;" class="text-center">Category</th>
                            <th style="width: 10%;" class="text-center">Stock</th>
                            <th style="width: 10%;" class="text-center">Price</th>
                            <th style="width: 10%;" class="text-center">Status</th>
                            <th style="width: 15%;" class="text-center">Created At</th>
                            <th style="width: 10%;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(list,index) in lists" v-bind:key="index">
                            <td class="text-center"> {{list.code}}</td>
                            <td>
                                <h5 class="fs-13 mb-0 text-dark text-center">{{list.name}}</h5>
                            </td>
                            <td class="text-center"> {{list.category.name}}</td>
                            <td class="text-center"> {{list.stock}}</td>
                            <td class="text-center"> {{list.price}}</td>
                            <td class="text-center">
                                <b-badge v-if="list.is_available" variant="success">Active</b-badge>
                                <b-badge v-else variant="danger">Inactive</b-badge>
                            </td>
                            <td class="text-center"> {{list.created_at}}</td>
                            <td class="text-center">
                                <!-- <b-button @click="openView(list,index)" variant="soft-primary" v-b-tooltip.hover title="View Product" size="sm" class="edit-list me-1 w-xs">View</b-button> -->
                                <b-button @click="openPrice(list)" variant="danger" v-b-tooltip.hover title="Update Price" size="sm" class="edit-list me-1"><i class="ri-money-dollar-circle-fill"></i></b-button>
                                <b-button @click="openStatus(list)" variant="warning" v-b-tooltip.hover title="Update Status" size="sm" class="edit-list me-1"><i class="ri-edit-2-fill"></i></b-button>
                                <b-button @click="openView(list)" variant="info" v-b-tooltip.hover title="View Orders" size="sm" class="edit-list"><i class="ri-eye-fill"></i></b-button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Pagination class="ms-2 me-2" v-if="meta" @fetch="fetch" :lists="lists.length" :links="links" :pagination="meta" />
            </div>
        </b-col>
    </b-row>
    <View ref="view"/>
    <Status ref="status"/>
    <Price ref="price"/>
    <Create :categories="categories" :products="products" @message="fetch()" ref="create"/>
</template>
<script>
import Price from './Price.vue';
import Status from './Status.vue';
import View from './View.vue';
import Create from './Create.vue';
import PageHeader from "@/Shared/Components/PageHeader.vue";
import Pagination from "@/Shared/Components/Pagination.vue";
export default {
    components: { PageHeader, Pagination, Create, View, Status, Price},
    props: ['dropdowns','categories','products'],
    data() {
        return {
            title: "Discount Management",
            items: [{text: "View",href: "/"},{ text: "Dasboard",active: true}, ],
            keyword: '',
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
            page_url = page_url || '/packages';
            axios.get(page_url, {
                params: {
                    keyword: this.keyword,
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
        openStatus(data){
            this.$refs.status.set(data);
        },  
        openPrice(data){
            this.$refs.price.set(data);
        },  
        edit(data){
            this.$refs.create.edit(data);
        },
        formatMoney(value) {
            let val = (value/1).toFixed(2).replace(',', '.')
            return '₱'+val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        },
    }
}
</script>
