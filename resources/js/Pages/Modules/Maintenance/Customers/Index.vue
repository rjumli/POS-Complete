<template>
    <Head title="Customer Management" />
    <!-- <PageHeader :title="title" :items="items" /> -->

    <b-row>
        <b-col xl="12">
            <!-- <b-card no-body>
                <b-card-body style="height: calc(100vh - 284px)"> -->
            <div class=" d-flex align-items-center">
                <h3 class="flex-grow-1 mb-n3">Customers Management</h3>
                <div class="flex-shrink-0">
                    <div class="input-group mb-1">
                        <span class="input-group-text"> <i class="ri-search-line search-icon"></i></span>
                        <input type="text" v-model="keyword" placeholder="Search Name" class="form-control" style="width: 50%;">
                        
                        <b-button @click="openCreate()" type="button" variant="primary">
                            <i class="ri-add-circle-fill align-bottom me-1"></i> Add Customer
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
                            <th style="width: 25%;">Name</th>
                            <th style="width: 17%;" class="text-center">Contact No.</th>
                            <th style="width: 17%;" class="text-center">Email</th>
                            <th style="width: 10%;" class="text-center">Status</th>
                            <th style="width: 17%;" class="text-center">Created At</th>
                            <th style="width: 17%;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(list,index) in lists" v-bind:key="index">
                            <td>
                                <h5 class="fs-13 mb-0 text-dark">{{list.name}}</h5>
                            </td>
                            <td class="text-center"> {{list.contact}}</td>
                            <td class="text-center"> {{list.email}}</td>
                            <td class="text-center">
                                <b-badge v-if="list.is_active" variant="success">Active</b-badge>
                                <b-badge v-else variant="danger">Inactive</b-badge>
                            </td>
                            <td class="text-center"> {{list.created_at}}</td>
                            <td class="text-center">
                                <b-button @click="edit(list)" variant="soft-primary" v-b-tooltip.hover title="Edit" size="sm" class="edit-list me-1 w-xs">EDIT</b-button>
                                <b-button @click="edit(list)" variant="soft-primary" v-b-tooltip.hover title="Update Status" size="sm" class="edit-list me-1 w-xs">UPDATE</b-button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Pagination class="ms-2 me-2" v-if="meta" @fetch="fetch" :lists="lists.length" :links="links" :pagination="meta" />
            </div>
        </b-col>
    </b-row>
    <Create @message="fetch()" ref="create"/>
</template>
<script>
import Create from './Create.vue';
import PageHeader from "@/Shared/Components/PageHeader.vue";
import Pagination from "@/Shared/Components/Pagination.vue";
export default {
    components: { PageHeader, Pagination, Create },
    data() {
        return {
            title: "Customer Management",
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
            page_url = page_url || '/customers';
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
        edit(data){
            this.$refs.create.edit(data);
        }
    }
}
</script>
