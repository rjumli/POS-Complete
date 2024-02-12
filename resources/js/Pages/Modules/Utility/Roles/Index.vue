<template>
    <b-form class="customform mb-2">
        <div class="row customerform">
            <div class="col-md-12 mt-2">
                <div class="form-group">
                    <label>Cashier: <span v-if="form.errors" v-text="form.errors.is_active" class="haveerror"></span></label>
                    <multiselect v-model="cashier" id="ajax" label="name" track-by="id"
                        placeholder="Select Status" open-direction="bottom" :options="roles"
                        :allow-empty="false" multiple="true" @update:modelValue="handleMultiselectChange('cashier')"
                        :show-labels="false">
                    </multiselect> 
                </div>
            </div>

            <div class="col-md-12 mt-4">
                <div class="form-group">
                    <label>Owner: <span v-if="form.errors" v-text="form.errors.is_active" class="haveerror"></span></label>
                    <multiselect v-model="owner" id="ajax" label="name" track-by="id"
                        placeholder="Select Status" open-direction="bottom" :options="roles"
                        :allow-empty="false" multiple="true" @update:modelValue="handleMultiselectChange('owner')"
                        :show-labels="false">
                    </multiselect> 
                </div>
            </div>

            <div class="col-md-12 mt-4">
                <div class="form-group">
                    <label>Inventory Manager: <span v-if="form.errors" v-text="form.errors.is_active" class="haveerror"></span></label>
                    <multiselect v-model="inventory_manager" id="ajax" label="name" track-by="id"
                        placeholder="Select Status" open-direction="bottom" :options="roles"
                        :allow-empty="false" multiple="true" @update:modelValue="handleMultiselectChange('inventory_manager')"
                        :show-labels="false">
                    </multiselect> 
                </div>
            </div>

            <div class="col-md-12 mt-4">
                <div class="form-group">
                    <label>Assistant Clerk: <span v-if="form.errors" v-text="form.errors.is_active" class="haveerror"></span></label>
                    <multiselect v-model="assistant_clerk" id="ajax" label="name" track-by="id"
                        placeholder="Select Status" open-direction="bottom" :options="roles"
                        :allow-empty="false" multiple="true" @update:modelValue="handleMultiselectChange('assistant_clerk')"
                        :show-labels="false">
                    </multiselect> 
                </div>
            </div>

        </div>
    </b-form>
</template>

<script>
import Multiselect from '@suadelabs/vue3-multiselect';
export default {
    components: { Multiselect },
    props: ['dropdowns','cashiers','assistants','owners','inventories'],
    data(){
        return {
            inventory_manager: [],
            cashier: [],
            assistant_clerk: [],
            owner: [],
            form: {}
        }
    },
    created(){
        this.cashier = this.cashiers.data;
        this.assistant_clerk = this.assistants.data;
        this.owner = this.owners.data;
        this.inventory_manager = this.inventories.data;
    },
    computed: {
        roles : function() {
            return this.dropdowns.filter(x => x.type == 'Menu');
        },
    },
    methods : {
        handleMultiselectChange(type){
            if(type == 'cashier'){
                this.form = this.$inertia.form({
                    'role': 'Cashier',
                    menus: this.cashier
                });
            }else if(type == 'assistant_clerk'){
                this.form = this.$inertia.form({
                    'role': 'Assistant Clerk',
                    menus: this.assistant_clerk
                });
             }else if(type == 'owner'){
                this.form = this.$inertia.form({
                    'role': 'Owner',
                    menus: this.owner
                })
             }else{
                this.form = this.$inertia.form({
                    'role': 'Inventory Manager',
                    menus: this.inventory_manager
                })
             }

            this.form.post('/roles',{
                preserveScroll: true,
                onSuccess: (response) => {
                },
            });
        }
    }
}
</script>
<style>
.multiselect__tags {
  font-size: 10px;
}
</style>