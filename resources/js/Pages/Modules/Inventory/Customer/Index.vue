<template>
    <Head title="Customer Return" />
    <!-- <PageHeader :title="title" :items="items" /> -->

    <b-row>
        <b-col xl="12">
            <!-- <b-card no-body>
                <b-card-body style="height: calc(100vh - 284px)"> -->
            <div class=" d-flex align-items-center">
                <h3 class="flex-grow-1 mb-n3">Customer Returns</h3>
                <div class="flex-shrink-0">
                    <div class="input-group mb-1">
                        <span class="input-group-text"> <i class="ri-search-line search-icon"></i></span>
                        <input type="text" v-model="keyword" placeholder="Search Name" class="form-control" style="width: 50%;">
                        
  
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
                            <th style="width: 45%;" class="text-center">Product</th>
                            <th style="width: 20%;" class="text-center">Customer</th>
                            <th style="width: 10%;" class="text-center">Quantity</th>
                            <th style="width: 12%;" class="text-center">Warranty</th>
                            <th style="width: 10%;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(list,index) in lists" v-bind:key="index">
                            <td class="text-center">{{ list.product.code }}</td>
                            <td class="text-center"> {{list.product.name}}</td>
                            <td class="text-center"> {{list.sale.customer.name}}</td>
                            <td class="text-center"> {{list.quantity}}</td>
                            <td class="text-center"> {{list.warranty}}</td>
                            <td class="text-center">
                                <b-button @click="openEdit(list)" variant="soft-primary" v-b-tooltip.hover title="Return" size="sm" class="edit-list me-1 w-xs">RETURN</b-button>
                                <b-button v-if="(list.type.name == 'Limited' && list.based.name == 'Occasional')" @click="update(list)" variant="soft-primary" v-b-tooltip.hover title="Update Status" size="sm" class="edit-list me-1 w-xs">UPDATE</b-button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Pagination class="ms-2 me-2" v-if="meta" @fetch="fetch" :lists="lists.length" :links="links" :pagination="meta" />
            </div>
        </b-col>
    </b-row>
    <Status :dropdowns="dropdowns" ref="status" @message="fetch()"/>
</template>
<script>
import Status from './Status.vue';
import PageHeader from "@/Shared/Components/PageHeader.vue";
import Pagination from "@/Shared/Components/Pagination.vue";
export default {
    components: { PageHeader, Pagination, Status },
    props: ['dropdowns'],
    data() {
        return {
            title: "Customer Return",
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
        }
    },
    created(){
        this.fetch();
    },
    methods: {
        checkSearchStr: _.debounce(function(string) {
            this.fetch();
        }, 300),
        fetch(page_url) {
            page_url = page_url || '/customer';
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
        openEdit(data){
            this.$refs.status.set(data);
        },
        formatMoney(value) {
            let val = (value/1).toFixed(2).replace(',', '.')
            return '₱'+val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        },
    }
}
</script>
