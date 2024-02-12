<template>
    <b-modal v-model="showModal" title="Add Supplier" style="--vz-modal-width: 30%;" header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <b-form class="customform mb-2">
            <div class="row customerform">
                <div class="col-md-12 mt-4">
                    <form class="app-search d-none d-md-block p-0 mb-2">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Search Supplier" autocomplete="off" id="search-options1" />
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
                    <template v-if="name">
                        <hr class="text-muted"/>
                        <div class="form-group mt-2">
                            <input type="text" class="form-control text-primary fw-bold" v-model="name.name" readonly>
                        </div>
                    </template>
                </div>
                <div class="col-md-12 mt-2">
                    <hr class="text-muted"/>
                </div>
                <div class="col-md-12 mt-2">
                   <div class="form-group">
                        <label>Branch: <span v-if="form.errors" v-text="form.errors.name" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="supplier.name" style="text-transform: capitalize;">
                    </div>
                </div>
                <div class="col-md-6 mt-2">
                   <div class="form-group">
                        <label>Contact Person: <span v-if="form.errors" v-text="form.errors.contact_person" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="supplier.contact_person">
                    </div>
                </div>
                <div class="col-md-6 mt-2">
                   <div class="form-group">
                        <label>Contact Number: <span v-if="form.errors" v-text="form.errors.contact_number" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="supplier.contact_number">
                    </div>
                </div>
                <div class="col-md-6 mt-2">
                   <div class="form-group">
                        <label>Email: <span v-if="form.errors" v-text="form.errors.email" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="supplier.email">
                    </div>
                </div>
                <div class="col-md-6 mt-2">
                   <div class="form-group">
                        <label>Address: <span v-if="form.errors" v-text="form.errors.address" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="supplier.address">
                    </div>
                </div>
    
            </div>
        </b-form>
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
            <b-button @click="create('ok')" variant="primary" :disabled="form.processing" block>Save</b-button>
        </template>
    </b-modal>
    <New ref="new"/>
</template>
<script>
import New from './New.vue';
import { SimpleBar } from "simplebar-vue3";
export default {
    components: { SimpleBar, New },
    data(){
        return {
            showModal: false,
            supplier: {
                id: '',
                name: '',
                contact_person: '',
                contact_number: '',
                email: '',
                address: '',
            },
            keyword: '',
            name: '',
            names: [],
            form: {},
            status: '',
            editable: false,
        }
    },
    mounted() {
        this.isCustomDropdown();
    },
    watch : {
        data: {
            deep: true,
            handler(val = null) {
                if(val != null && val !== ''){
                    if(this.status == 'name'){
                        this.name = val.data;
                    }else{

                    }
                }
            },
        },
    },
    computed: {
        data() {
            return this.$page.props.flash.data;
        },
    },
    methods : {
        show() {
            this.showModal = true;
        },
        edit(data){
            this.supplier = data;
            this.name = this.supplier.supplier;
            this.editable = true;
            this.showModal = true;
        },
        create(){
            this.form = this.$inertia.form({
                id: this.supplier.id,
                name: this.supplier.name,
                contact_person: this.supplier.contact_person,
                contact_number: this.supplier.contact_number,
                address: this.supplier.address,
                email: this.supplier.email,
                supplier_id: (this.name) ? this.name.id : '',
                editable: this.editable
            })

            this.form.post('/suppliers',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.hide();
                },
            });
        },
        hide(){
            this.supplier = {
                id: '',
                name: '',
                contact_person: '',
                contact_number: '',
                email: '',
                address: ''
            };
            this.name = '';
            this.status = '';
            this.$emit('message',true);
            this.showModal = false;
        }, 
        select(data){
            this.name = data;
        },
        newName(){
            this.status = 'name';
            this.$refs.new.show(this.keyword);
        },
        checkSearchStr: _.debounce(function (string) {
            this.keyword = string;
            this.fetch();
        }, 300),
        fetch(page_url) {
            page_url = page_url || '/suppliers';
            axios.get(page_url, {
                params: {
                    keyword: this.keyword,
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
                    this.checkSearchStr(searchInput.value);
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
.dropdown-menu-lg {
    width: 95%;
}
</style>
