<template>
    <Head title="Customer Management" />
    <!-- <PageHeader :title="title" :items="items" /> -->

    <b-row>
        <b-col xl="12">
            <!-- <b-card no-body>
                <b-card-body style="height: calc(100vh - 284px)"> -->
            <div class=" d-flex align-items-center">
                <h3 class="flex-grow-1 mb-n3">Backup and Restore</h3>
                <div class="flex-shrink-0">
                    <div class="input-group mb-1">
                        <span class="input-group-text"> <i class="ri-search-line search-icon"></i></span>
                        <input type="text" v-model="keyword" placeholder="Search Name" class="form-control" style="width: 50%;">
                        
                        <b-button @click="openCreate()" type="button" variant="primary">
                            <i class="ri-add-circle-fill align-bottom me-1"></i> Make Backup
                        </b-button>
                    </div>
                </div>
            </div>
                <!-- </b-card-body>
            </b-card> -->
            <hr class="text-muted"/>
        </b-col>

        <b-col xl="12">
            <div class="table-responsive mt-1">
                <table class="table table-bordered table-centered align-middle table-nowrap mb-0">
                    <thead class="text-muted table-light">
                        <tr>
                            <th scope="col" >Name</th>
                            <!-- <th scope="col" >Path</th> -->
                            <th class="text-center">Date</th>
                            <th scope="col" ></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(list,index) in lists" v-bind:key="index">
                            <td>{{list.name}}</td>
                             <!-- <td>{{list.path}}</td> -->
                              <td class="text-center">{{list.date}}</td>
                            <td class="text-center"><b-button @click="downloadFile(list.name)" target="_blank" variant="primary" v-b-tooltip.hover title="Download" size="sm" class="edit-list">Download</b-button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </b-col>
    </b-row>
   <View ref="view"/>
</template>
<script>
import View from './View.vue';
import PageHeader from "@/Shared/Components/PageHeader.vue";
import Pagination from "@/Shared/Components/Pagination.vue";
export default {
    components: { PageHeader, Pagination,View },
    props: ['dropdowns'],
    data() {
        return {
             currentUrl: window.location.origin,
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
            page_url = page_url || '/backups';
            axios.get(page_url, {
                params: {
                    keyword: this.keyword,
                    options: 'lists',
                }
            })
            .then(response => {
                console.log(response);
                this.lists = response.data;
            })
            .catch(err => console.log(err));
        },
        downloadFile(filePath) {
      // Trigger file download using the file path
      window.open(this.currentUrl+'/download/'+filePath);
    },
        openCreate(){
           this.$refs.view.show();
        },
        edit(data){
            this.$refs.create.edit(data);
        },
        update(data){
            this.$refs.update.set(data);
        },
        formatMoney(value) {
            let val = (value/1).toFixed(2).replace(',', '.')
            return '₱'+val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        },
    }
}
</script>
