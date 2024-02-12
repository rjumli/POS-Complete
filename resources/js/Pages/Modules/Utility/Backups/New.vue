<template>
    <b-modal v-model="showModal" title="Add Discount Item" header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <b-form class="customform mb-2">
            <div class="row customerform">
                
                <div class="col-md-12 mt-4">
                   <form class="app-search d-none d-md-block p-0 mb-2">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Search Item" autocomplete="off" id="search-options"/>
                            <span class="mdi mdi-magnify search-widget-icon"></span>
                            <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none" id="search-close-options"></span>
                        </div>
                        <div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
                            <SimpleBar data-simplebar
                                style="max-height: height: calc(100vh/2 - 326px)">
                                <div class="notification-list" v-if="names.length > 0">
                                    <b-link @click="select(list)"
                                        class="d-flex dropdown-item notify-item py-2"
                                        v-for="(list, index) of names" :key="index">
                                        <div class="flex-1">
                                            <h6 class="m-0">{{list.name}} - <span :class="list.type == 'Package' ? 'text-danger' : ''">{{ list.brand }}</span> </h6>
                                        </div>
                                    </b-link>
                                </div>
                                <div class="notification-list" v-else>
                                   <span class="text-muted fs-11 ms-3">No product/package found</span>
                                </div>
                            </SimpleBar>
                        </div>
                    </form>
                    <template v-if="name">
                        <hr class="text-muted"/>
                        <ul class="list-unstyled mb-0 vstack  gap-3">
                            <li>
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <h6 class="fs-14 mb-1">{{name.name}} - <span :class="name.type == 'Package' ? 'text-danger' : ''">{{ name.brand }}</span></h6>
                                        <p class="text-muted mb-0">{{name.code}}</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </template>
                </div>
                <div class="col-sm-12">
                    <hr class="text-muted"/>
                </div>
                <div v-if="name">
                    <div class="col-md-12 mt-2">
                        <multiselect v-model="discount" id="ajax" label="name" track-by="id"
                            placeholder="Select Discount" open-direction="bottom" :options="discount_lists"
                            :allow-empty="false"
                            :show-labels="false">
                        </multiselect> 
                    </div>

                    <div class="col-md-12 mt-2">
                        <label>Type: <span v-if="form.errors" v-text="form.errors.name" class="haveerror"></span></label>
                        <multiselect v-model="type" id="ajax" label="name" track-by="id"
                            placeholder="Select Type" open-direction="bottom" :options="types"
                            :allow-empty="false"
                            :show-labels="false">
                        </multiselect> 
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div v-if="type !=''" class="mt-1" :class="(type.name == 'Date Range') ? 'col-sm-6' : 'col-sm-12'">
                                <label><span v-if="type.name == 'Specific Date'">Date</span><span v-else>Start</span>: <span v-if="form.errors" v-text="form.errors.start" class="haveerror"></span></label>
                                <date-picker
                                    v-model:value="start"
                                    type="date" format="YYYY-MM-DD"
                                    lang="en"
                                    placeholder="Select Date"
                                    >
                                </date-picker>
                            </div>
                            <div class="col-sm-6 mt-1" v-if="type.name == 'Date Range' && type != ''">
                                <label>End: <span v-if="form.errors" v-text="form.errors.end" class="haveerror"></span></label>
                                <date-picker
                                    v-model:value="end"
                                    type="date" format="YYYY-MM-DD"
                                    lang="en"
                                    placeholder="Select Date"
                                    >
                                    
                                    <!-- :disabled-date="disabledDate" -->
                                </date-picker>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </b-form>
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
            <b-button @click="create('ok')" variant="primary" :disabled="form.processing" block>Save</b-button>
        </template>
    </b-modal>
</template>
<script>
import DatePicker from 'vue-datepicker-next';
import 'vue-datepicker-next/index.css';
import Amount from "@/Shared/Components/Amount.vue";
import { SimpleBar } from "simplebar-vue3";
import Multiselect from '@suadelabs/vue3-multiselect';
export default {
    props: ['discounts','dropdowns'],
    components: { Multiselect, SimpleBar, Amount, DatePicker },
    data(){
        return {
            currentUrl: window.location.origin,
            showModal: false,
            name: '',
            discount: '',
            days: '',
            type: '',
            form: {},
            names: [],
            start: '',
            end: '',
            editable: false,
        }
    },
    watch : {
        type(){
            if(this.type.name == 'Specific Date'){
                this.days = 1;
            }else{
                this.days = '';
            }
        }
    },
    mounted() {
        this.isCustomDropdown();
    },
    computed: {
        discount_lists(){
            return this.discounts.filter(x => x.based_id == 13);
        },
        types(){
            return this.dropdowns.filter(x => x.classification == 'Product').filter(x => x.type == 'Discount');
        }
    },
    methods : {
        show() {
            document.getElementById('search-options').focus();
            this.name = '';
            this.names = [];
            this.editable = false;
            this.showModal = true;
        },
        create(){
            this.status = 'create';
            this.form = this.$inertia.form({
                item_id: this.name.id,
                discount_id: (this.discount) ? this.discount.id : '',
                type_id: (this.type) ? this.type.id : '',
                subtype: (this.name) ? this.name.type : '',
                start:  (this.start != '') ? new Date(this.start).toLocaleDateString("af-ZA") : '',
                end:  (this.end != '') ? new Date(this.end).toLocaleDateString("af-ZA") : ''
            })

            this.form.post('/home',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.hide();
                },
            });
        },
        hide(){
            var searchInput = document.getElementById("search-options");
            searchInput.value = '';
            this.showModal = false;
        },
        checkSearchStr: _.debounce(function (string) {
            this.keyword = string;
            this.fetch();
        }, 300),
        fetch(page_url) {
            page_url = page_url || '/sales';
            axios.get(page_url, {
                params: {
                    keyword: this.keyword,
                    options: 'search',
                    category: ''
                }
            })
            .then(response => {
                if (response) {
                    this.names = response.data.data;
                }
            })
            .catch(err => console.log(err));
        },
        newName(){
            this.status = 'name';
            this.$refs.new.show(this.keyword);
        },
        select(data){
            this.name = data;
        },
        amount(val){
            this.amount1 = val;
        },
        isCustomDropdown() {
            var searchOptions = document.getElementById("search-close-options");
            var dropdown = document.getElementById("search-dropdown");
            var searchInput = document.getElementById("search-options");

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
                dropdown.classList.remove("show");
                searchOptions.classList.add("d-none");
            });

            document.body.addEventListener("click", (e) => {
                if (e.target.getAttribute("id") !== "search-options") {
                    dropdown.classList.remove("show");
                    searchOptions.classList.add("d-none");
                }
            });
        },
        // disabledDate(date) {
        //     return date <= new Date();
        // },
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
