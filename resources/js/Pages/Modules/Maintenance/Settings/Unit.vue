<template>
    <b-modal v-model="showModal" :title="(editable) ? 'Edit Unit' : 'Add Unit'" header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <b-form class="customform mb-2">
            <div class="row customerform">
                <div class="col-md-12 mt-4">
                   <div class="form-group">
                        <label>Name: <span v-if="form.errors" v-text="form.errors.name" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="unit.name" style="text-transform: capitalize;">
                    </div>
                </div>
                <div class="col-md-6 mt-2">
                   <div class="form-group">
                        <label>Shortcut: <span v-if="form.errors" v-text="form.errors.shortcut" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="unit.shortcut">
                    </div>
                </div>
                <div class="col-md-6 mt-2">
                   <div class="form-group">
                        <label>Status: <span v-if="form.errors" v-text="form.errors.name" class="haveerror"></span></label>
                        <multiselect v-model="unit.type" id="ajax"
                            placeholder="Select" open-direction="bottom" :options="types"
                            :allow-empty="false"
                            :show-labels="false">
                        </multiselect> 
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
import Multiselect from '@suadelabs/vue3-multiselect';
export default {
    components: { Multiselect },
    data(){
        return {
            showModal: false,
            unit: {
                id: '',
                name: '',
                shortcut: '',
                type: ''
            },
            form: {},
            types: ['Length','Weight','Volume','Pieces'],
            editable: false,
        }
    },

    methods : {
        show() {
            this.editable = false;
            this.unit = {
                id: '',
                name: '',
                shortcut: '',
                type: ''
            };
            this.showModal = true;
        },
        edit(data){
            this.unit = data;
            this.editable = true;
            this.showModal = true;
        },
        create(){
            this.form = this.$inertia.form({
                id: this.unit.id,
                name: this.unit.name,
                shortcut: this.unit.shortcut,
                type: this.unit.type,
                type: 'Unit',
                editable: this.editable
            })

            this.form.post('/settings',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.hide();
                },
            });
        },
        hide(){
            this.unit = {
                id: '',
                name: '',
                shortcut: '',
                type: ''
            };
            this.showModal = false;
        },
    }
}
</script>
<style>
.multiselect__single {
    font-size: 12px;
}
</style>
