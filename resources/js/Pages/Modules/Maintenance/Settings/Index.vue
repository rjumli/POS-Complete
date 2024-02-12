<template>
    <Head title="Customer Management" />

    <b-row>
        <b-col xl="12">
            <div class=" d-flex align-items-center">
                <h3 class="flex-grow-1">Settings</h3>
                <!-- <div class="flex-shrink-0">
                    <div class="input-group mb-1">
                        <span class="input-group-text"> <i class="ri-search-line search-icon"></i></span>
                        <input type="text" v-model="keyword" placeholder="Search Name" class="form-control" style="width: 50%;">
                        
                        <b-button @click="openCreate()" type="button" variant="primary">
                            <i class="ri-add-circle-fill align-bottom me-1"></i> Add Customer
                        </b-button>
                    </div>
                </div> -->
            </div>
            <hr class="text-muted"/>
        </b-col>

        <b-col xl="6">
            <div class=" d-flex align-items-center">
                <h5 class="flex-grow-1 mb-n1">List of Units</h5>
                <div class="flex-shrink-0">
                    <button @click="openUnit()" type="button" class="btn btn-primary btn-sm">Add Unit</button>
                </div>
            </div>
            <hr class="text-muted"/>
            <div class="table-responsive" style="height: 500px; overflow: auto;">
                <table class="table table-nowrap table-bordered align-middle mb-0">
                    <thead class="bg-primary">
                        <tr class="fs-13 text-light">
                            <th class="text-center" style="width: 5%;">#</th>
                            <th style="width: 30%;">Name</th>
                            <th style="width: 20%;"  class="text-center">Shortcut</th>
                            <th style="width: 20%;"  class="text-center">Type</th>
                            <th style="width: 15%;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(list,index) in units" v-bind:key="index">
                            <td class="text-center">{{ index+1 }}</td>
                            <td>
                                <h5 class="fs-13 mb-0 text-dark">{{list.name}}</h5>
                            </td>
                            <td class="text-center">{{ list.shortcut }}</td>
                            <td class="text-center">{{ list.type }}</td>
                            <td class="text-center">
                                <b-button @click="editUnit(list)" variant="soft-primary" v-b-tooltip.hover title="Edit" size="sm" class="edit-list me-1 w-xs">EDIT</b-button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </b-col>

        <b-col xl="6">
            <div class=" d-flex align-items-center">
                <h5 class="flex-grow-1 mb-n1">List of Categories</h5>
                <div class="flex-shrink-0">
                    <button @click="openCategory()" type="button" class="btn btn-primary btn-sm">Add Category</button>
                </div>
            </div>
            <hr class="text-muted"/>
            <div class="table-responsive" style="height: 500px; overflow: auto;">
                <table class="table table-nowrap table-bordered align-middle mb-0">
                    <thead class="bg-primary">
                        <tr class="fs-13 text-light">
                            <th class="text-center" style="width: 7%;">#</th>
                            <th style="width: 60%;">Categories</th>
                            <th style="width: 18%;" class="text-center">Status</th>
                            <th style="width: 15%;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(list,index) in categories" v-bind:key="index">
                            <td class="text-center">{{ index+1 }}</td>
                            <td>
                                <h5 class="fs-13 mb-0 text-dark">{{list.name}}</h5>
                            </td>
                            <td class="text-center">
                                <b-badge v-if="list.is_active" variant="success">Active</b-badge>
                                <b-badge v-else variant="danger">Inactive</b-badge>
                            </td>
                            <td class="text-center">
                                <b-button @click="editCategory(list)" variant="soft-primary" v-b-tooltip.hover title="Edit" size="sm" class="edit-list me-1 w-xs">EDIT</b-button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </b-col>
    </b-row>
    <Unit ref="unit"/>
    <Category ref="category"/>
</template>
<script>
import Category from './Category.vue';
import Unit from './Unit.vue';
export default {
    components: { Category, Unit },
    props: ['categories','units'],
    data() {
        return {
            keyword: '',
            lists: [],
            meta: {},
            links: {},
        };
    },
    methods: {
        openCategory(){
            this.$refs.category.show();
        },
        openUnit(){
            this.$refs.unit.show();
        },
        editCategory(data){
            this.$refs.category.edit(data);
        },
        editUnit(data){
            this.$refs.unit.edit(data);
        }
    }
}
</script>
