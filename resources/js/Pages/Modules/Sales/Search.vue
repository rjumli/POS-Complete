<template>
    <b-modal v-model="showModal" hide-footer title="Search Item" size="xl" header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <b-row>
            <b-col xl="12">
                <div class="input-group mb-1">
                    <span class="input-group-text"> <i class="ri-search-line search-icon"></i></span>
                    <input type="text" v-model="keyword" placeholder="Search Name" class="form-control" style="width: 25%;">
                    <select v-model="category" @change="fetch()" class="form-select" id="inputGroupSelect02">
                        <option :value="null" selected>Select Category</option>
                        <option :value="list.id" v-for="list in categories" v-bind:key="list.id">{{list.name}}</option>
                    </select>
                </div>
                <hr class="text-muted"/>
            </b-col>
            <b-col xl="12">
                <div class="table-responsive">
                    <table class="table table-nowrap table-bordered align-middle mb-0">
                        <thead class="bg-primary">
                            <tr class="fs-11 text-light">
                                <th style="width: 22%;">Name</th>
                                <th style="width: 13%;" class="text-center">Category</th>
                                <th style="width: 8%;" class="text-center">Stock</th>
                                <th style="width: 7%;" class="text-center">Price</th>
                                <th style="width: 7%;" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="fs-11" v-for="(list,index) in lists" v-bind:key="index">
                                <td>
                                    <h5 class="fs-11 mb-0 mt-n2 text-dark">{{list.name}} - {{list.brand}}</h5>
                                    <p class="fs-11 text-muted mb-n2"> {{list.code}}</p>
                                </td>
                                <td class="text-center"> {{list.category.name}}</td>
                                <td class="text-center"> {{list.stock}}</td>
                                <td class="text-center"> {{formatMoney(list.price)}}</td>
                                <td class="text-center">
                                    <b-button v-if="list.stock > 0" @click="addItem(list)" variant="soft-primary" v-b-tooltip.hover title="Add Item" size="sm" class="edit-list me-1 w-xs">Add</b-button>
                                    <b-button v-else variant="soft-light" size="sm" class="edit-list me-1 w-xs" disabled>No Stock Available</b-button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <Pagination class="ms-2 me-2" v-if="meta" @fetch="fetch" :lists="lists.length" :links="links" :pagination="meta" />
                </div>
            </b-col>
        </b-row>
    </b-modal>
</template>
<script>
export default {
    props:['categories'],
    data(){
        return {
            showModal: false,
            keyword: null,
            category: null,
            lists: [],
            meta: {},
            links: {},
        }
    },
    watch: {
        keyword(newVal){
            this.checkSearchStr(newVal);
        }
    },
    methods : {
        show() {
            this.showModal = true;
        },
        checkSearchStr: _.debounce(function(string) {
            this.fetch();
        }, 300),
        fetch(page_url) {
            page_url = page_url || '/sales';
            axios.get(page_url, {
                params: {
                    keyword: (this.keyword) ? this.keyword : '',
                    options: 'search',
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
        hide(){
            this.showModal = false;
        },
        formatMoney(value) {
            let val = (value/1).toFixed(2).replace(',', '.')
            return '₱'+val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        },
        addItem(data){
            this.$emit('add',data);
            this.keyword = null;
            this.category = null;
            this.showModal = false;
        }
    }
}
</script>