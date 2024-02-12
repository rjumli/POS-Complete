<template>
    <b-modal v-model="showModal" title="New Discount" header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <b-form class="customform mb-2">
            <div class="row customerform">
                
                <div class="col-md-8 mt-4">
                   <div class="form-group">
                        <label>Name: <span v-if="form.errors" v-text="form.errors.name" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="discount.name" style="text-transform: capitalize;">
                    </div>
                </div>
                <div class="col-md-4 mt-4">
                   <div class="form-group">
                        <label>Value: <span v-if="form.errors" v-text="form.errors.value" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="discount.value">
                    </div>
                </div>
                <div class="col-md-12 mt-1">
                    <label>Based: <span v-if="form.errors" v-text="form.errors.based_id" class="haveerror"></span></label>
                    <multiselect v-model="discount.based" id="ajax" label="name" track-by="id"
                        placeholder="Select" open-direction="bottom" :options="baseds"
                        :allow-empty="false"
                        :show-labels="false">
                    </multiselect> 
                </div>
                <div class="col-md-6 mt-2">
                    <label>Type: <span v-if="form.errors" v-text="form.errors.type_id" class="haveerror"></span></label>
                    <multiselect v-model="discount.type" id="ajax" label="name" track-by="id"
                        placeholder="Select" open-direction="bottom" :options="types"
                        :allow-empty="false"
                        :show-labels="false">
                    </multiselect> 
                </div>
                <div class="col-md-6 mt-2">
                    <label>Subtype: <span v-if="form.errors" v-text="form.errors.subtype_id" class="haveerror"></span></label>
                    <multiselect v-model="discount.subtype" id="ajax" label="name" track-by="id"
                        placeholder="Select" open-direction="bottom" :options="subtypes"
                        :allow-empty="false"
                        :show-labels="false">
                    </multiselect> 
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
                subtype: ''
            },
            form: {},
            editable: false,
        }
    },
    computed: {
        baseds : function() {
            return this.dropdowns.filter(x => x.classification == 'Discount').filter(x => x.type == 'Based');
        },
        types : function() {
            return this.dropdowns.filter(x => x.classification == 'Discount').filter(x => x.type == 'Type');
        },
        subtypes : function() {
            return this.dropdowns.filter(x => x.classification == 'Discount').filter(x => x.type == 'Subtype');
        },
    },
    methods : {
        show() {
            this.showModal = true;
        },
        edit(data){
            this.discount = data;
            this.editable = true;
            this.showModal = true;
        },
        create(){
            this.form = this.$inertia.form({
                id: this.id,
                name: this.discount.name,
                value: this.discount.value,
                based_id: (this.discount.based) ? this.discount.based.id : '',
                type_id: (this.discount.type) ? this.discount.type.id : '',
                subtype_id: (this.discount.subtype) ? this.discount.subtype.id : '',
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
