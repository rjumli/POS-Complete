<template>
    <b-modal v-model="showModal" title="Update Discount" header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <b-form class="customform mb-2">
            <div class="row customerform">
                
                <div class="col-md-12 mt-2">
                   <div class="form-group">
                        <input type="text" class="form-control" v-model="discount.name" readonly>
                    </div>
                    <hr class="text-muted"/>
                </div>
                <div class="col-md-12 mt-2">
                   <div class="form-group">
                        <label>Status: <span v-if="form.errors" v-text="form.errors.is_active" class="haveerror"></span></label>
                        <multiselect v-model="is_active" id="ajax"
                            placeholder="Select Status" open-direction="bottom" :options="statuses"
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
    props: ['dropdowns'],
    components: { Multiselect },
    data(){
        return {
            showModal: false,
            discount: {
                id: '',
                name: '',
                value: '',
                based: '',
                type: '',
                subtype: '',
                is_active: ''
            },
            is_active: '',
            statuses: ['Active','Inactive'],
            form: {},
            editable: false,
        }
    },

    methods : {
        set(data) {
            this.discount = data;
            this.is_active = (this.discount.is_active) ? 'Active' : 'Inactive'; 
            this.showModal = true;
            this.editable = true;
        },
        create(){
            this.form = this.$inertia.form({
                id: this.discount.id,
                is_active: (this.is_active == 'Active') ? 1 : 0,
                editable: this.editable
            })

            this.form.post('/discounts',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.hide();
                },
            });
        },
        hide(){
            this.discount = {
                id: '',
                name: '',
                value: '',
                based: '',
                type: '',
                subtype: '',
            };
            this.$emit('message',true);
            this.showModal = false;
        },
    }
}
</script>
<style>
.multiselect__single {
    font-size: 12px;
}
.multiselect__tags {
    border: 0;
    min-height: 37px;
    height: 37px;
} 
</style>
